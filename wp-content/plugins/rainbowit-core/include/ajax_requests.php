<?php

class ajax_requests
{

    protected $ajax_onoce;
    public function __construct()
    {
        
        $this->ajax_onoce = 'rainbowit-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));

        /* Get All Portfolio Load More */
        add_action('wp_ajax_nopriv_rainbowit_get_all_posts_content', array($this, 'rainbowit_get_all_posts_content'));
        add_action('wp_ajax_rainbowit_get_all_posts_content', array($this, 'rainbowit_get_all_posts_content'));
        add_action('admin_enqueue_scripts', array($this, 'rainbowit_scripts'));
        
        /** Add image url */
        add_action('wp_ajax_nopriv_upload_image_from_url', array($this, 'rainbow_upload_image_from_url'));
        add_action('wp_ajax_upload_image_from_url', array($this, 'rainbow_upload_image_from_url'));
        add_action('wp_ajax_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));
    }
    
    function rainbowit_ajax_enqueue()
    {
        wp_enqueue_script( 'rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/ajax-scripts.js', array('jquery'), null, true );
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        wp_localize_script('rainbowit-core-ajax', 'rainbowit_portfolio_ajax', $params);
    }

    function rainbowit_scripts() {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script( 'rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/media_admin.js', array('jquery'), null, true );
        
    }

    public function rbt_ajax_product_order_now_func() {

        $nonce = isset( $_POST['orderNonce'] ) ? $_POST['orderNonce'] : 0;
        if ( ! wp_verify_nonce( $nonce, 'rainbowit-feature-plugin' ) ) {
            die( __( 'Security check', 'rainbowit' ) ); 
        } 
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
        if ($productId > 0) {
            WC()->cart->add_to_cart($productId, 1);
        }
        // Redirect to the cart page
        return true;
        die();
    }

    /* Portfolio Load More */
    function rainbowit_get_all_posts_content()
    {
        check_ajax_referer($this->ajax_onoce, 'security');

        $Helper = new \Helper();
        $rainbowit_options = $Helper->rainbowit_get_options();

        if (isset($_POST) && !empty($_POST)) {

            $page = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;
            $posts_per_page = (isset($_POST['settings']['posts_per_page']) && !empty($_POST['settings']['posts_per_page'])) ? $_POST['settings']['posts_per_page'] : "6";
            $orderby = (isset($_POST['query']['orderby']) && !empty($_POST['query']['orderby'])) ? $_POST['query']['orderby'] : "ID";
            $order = (isset($_POST['query']['order']) && !empty($_POST['query']['order'])) ? $_POST['query']['order'] : "ASC";

            // Column
            $for_desktop = (isset($_POST['settings']['rbt_minimal_portfolio_columns_for_desktop']) && !empty($_POST['settings']['rbt_minimal_portfolio_columns_for_desktop'])) ? $_POST['settings']['rbt_minimal_portfolio_columns_for_desktop'] : "3";
            $for_laptop = (isset($_POST['settings']['rbt_minimal_portfolio_columns_for_laptop']) && !empty($_POST['settings']['rbt_minimal_portfolio_columns_for_laptop'])) ? $_POST['settings']['rbt_minimal_portfolio_columns_for_laptop'] : "6";
            $for_tablet = (isset($_POST['settings']['rbt_minimal_portfolio_columns_for_tablet']) && !empty($_POST['settings']['rbt_minimal_portfolio_columns_for_tablet'])) ? $_POST['settings']['rbt_minimal_portfolio_columns_for_tablet'] : "6";
            $for_mobile = (isset($_POST['settings']['rbt_minimal_portfolio_columns_for_mobile']) && !empty($_POST['settings']['rbt_minimal_portfolio_columns_for_mobile'])) ? $_POST['settings']['rbt_minimal_portfolio_columns_for_mobile'] : "12";

            // Thumbnail Size
            $thumb_size = (isset($_POST['settings']['minimal_portfolio_thumb_size_size']) && !empty($_POST['settings']['minimal_portfolio_thumb_size_size'])) ? $_POST['settings']['minimal_portfolio_thumb_size_size'] : "rainbowit-portfolio-thumb";

            $offset = $page * (int)$posts_per_page;
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => (int) $posts_per_page,
                'orderby' => $orderby,
                'order' => $order,
                'offset' => $offset,
                'ignore_sticky_posts' => true,
            );

            $query = new WP_Query($args);



            $return = array();
            $found_posts = (int)$query->found_posts;
            $return['posts_count'] = $found_posts;

            if ($query->have_posts()) {
                ob_start();

                $taxonomy = 'portfolio-cat';
                $termsArgs = array('taxonomy' => $taxonomy, 'hide_empty' => false);
                $categories = get_terms($termsArgs);

                if (!empty($categories) && !is_wp_error($categories)) {
                    $termID = 1;
                    foreach ($categories as $c => $cat) {
                        $mixitupcats[$cat->slug] = $cat->name;
                        $catsTerms[$cat->slug] = $cat->term_id;
                        $termID++;
                    }
                }
                while ($query->have_posts()) {
                    $query->the_post();

                    global $post;
                    $terms = get_the_terms($post->ID, 'portfolio-cat');
                    if ($terms && !is_wp_error($terms)) {
                        $termsList = array();
                        foreach ($terms as $category) {
                            $termsList[] = $category->slug;
                        }
                        $termsAssignedCat = join(" ", $termsList);
                    } else {
                        $termsAssignedCat = '';
                    }
                    ?>

                    <!-- Start Single Portfolio  -->
                    <div class="portfolio-tilthover col-lg-<?php echo esc_attr($for_desktop); ?> col-md-<?php echo esc_attr($for_laptop); ?> col-sm-<?php echo esc_attr($for_tablet); ?> col-<?php echo esc_attr($for_mobile); ?>">
                        <div class="Tilt-inner">
                            <div class="portfolio">
                                <div class="thumbnail-inner">
                                    <div class="thumbnail image-1" style="background-image: url(<?php the_post_thumbnail_url($thumb_size); ?>)"></div>
                                    <div class="bg-blr-image image-1" style="background-image: url(<?php the_post_thumbnail_url($thumb_size); ?>)"></div>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <?php if ($terms && !is_wp_error($terms)): ?>
                                            <p><?php foreach ($terms as $term) { ?>
                                                    <span><?php echo esc_html($term->name); ?></span>
                                                <?php } ?>
                                            </p>
                                        <?php endif ?>
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <?php if ($rainbowit_options['rainbowit_enable_case_study_button'] == 'yes') { ?>
                                            <div class="portfolio-button">
                                                <a class="rn-btn"
                                                   href="<?php the_permalink(); ?>"><?php echo esc_html($rainbowit_options['rainbowit_enable_case_study_button_text']); ?></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Portfolio  -->
                    <?php

                }
            }
            $return['outputs'] .= ob_get_clean();
            echo json_encode($return);
            die();
        }

    }

}

new ajax_requests();
