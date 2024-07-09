<?php

class ajax_requests
{

    protected $ajax_onoce;
    public function __construct()
    {

        $this->ajax_onoce = 'rainbowit-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));


        add_action('admin_enqueue_scripts', array($this, 'rainbowit_scripts'));

        add_action('wp_ajax_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));
        
        add_action('wp_ajax_rbt_ajax_header_search', array($this, 'rbt_ajax_header_search_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_header_search', array($this, 'rbt_ajax_header_search_func'));

        add_action('wp_ajax_rbt_ajax_envato_api_product', array($this, 'rbt_ajax_envato_api_product_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_envato_api_product', array($this, 'rbt_ajax_envato_api_product_func'));

        add_action('wp_ajax_rainbowit_load_more_products', array($this, 'rainbowit_load_more_products'));
        add_action('wp_ajax_nopriv_rainbowit_load_more_products', array($this, 'rainbowit_load_more_products'));

        add_action('wp_ajax_rainbowit_get_cart_count', array($this,'rainbowit_get_cart_count'));
        add_action('wp_ajax_nopriv_rainbowit_get_cart_count', array($this,'rainbowit_get_cart_count'));
    }

    function rainbowit_get_cart_count() {
        if (class_exists('woocommerce')) {
            echo WC()->cart->get_cart_contents_count();
        }
        wp_die();
    }
    
    
    /**
     * Ajax search functionality for header search popup
     * 
     * This will work for all product are available
     * 
     * @since 1.0.0
     * @return void
     */

    public function rbt_ajax_header_search_func() {
        /**
         * Return if nonce is not exists
         */
        if (!isset($_POST['nonce'])) {
            return wp_send_json_error(
                array(
                    'message' => __('Sorry! nonce is not exists.', 'rainbowit')
                ),
                404
            );
        }
        /**
         * Check if nonce are valid then do other things.
         */
        if (wp_verify_nonce(wp_unslash($_POST['nonce']), 'rainbowit-feature-plugin')) {
            $search_query = isset($_POST['inputValue']) ? sanitize_text_field(wp_unslash($_POST['inputValue'])) : '';
    
            /**
             * Add a custom filter to modify the search query
             */
            add_filter('posts_search', 'custom_search_by_title', 10, 2);
    
            add_filter('posts_search', 'custom_search_by_title', 10, 2);

            function custom_search_by_title($search, $wp_query) {
                global $wpdb;

                // Only modify the query for the main search
                if (!empty($wp_query->query_vars['s']) && $wp_query->is_search()) {
                    $search_term = '%' . $wpdb->esc_like($wp_query->query_vars['s']) . '%';
                    $search = $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s ", $search_term);
                }

                return $search;
            }
                
            /**
             * Query for fetching posts
             */
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true,
                's' => $search_query // Use the 's' parameter
            );
    
            $query = new \WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                while ($query->have_posts()) {
                    $query->the_post();
                    global $product;
                    $product_id = $product->get_id();
                    $located = locate_template('woocommerce/content-product-grid4.php', false, false);
                    if ($located) {
                        include($located);
                    }
                }
                $found_product = 'yes';
                $rbt_products = ob_get_clean();
                
            } else {
               
                $found_product = 'no';
                $query_args =  array(
                    'posts_per_page' =>  9, // -1 (for all)
                    'post_type'      =>  array( 'product' ),
                    'post_status'    =>  'publish',
                    'meta_key'       => 'total_sales',
                    'order'          => 'DESC',
                    'orderby'        => 'meta_value_num',
                    'ignore_sticky_posts' => true,
                );

                $query = new \WP_Query($query_args);

                if ($query->have_posts()) {
                    ob_start();
                    while ($query->have_posts()) {
                        $query->the_post();
                        global $product;
                        $product_id = $product->get_id();
                        $located = locate_template('woocommerce/content-product-grid4.php', false, false);
                        if ($located) {
                            include($located);
                        }
                    }
                    $rbt_products = ob_get_clean();
                }
                
            }
    
            // Remove the filter after the query
            remove_filter('posts_search', 'custom_search_by_title', 10);
    
            return wp_send_json_success(
                array(
                    'message' => __('Product fetched successfully!', 'rainbowit'),
                    'products' => $rbt_products,
                    'foundproduct' => $found_product,
                )
            );
        }
        die;
    }
    


    function rainbowit_ajax_enqueue()
    {
        wp_enqueue_script('rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/ajax-scripts.js', array('jquery'), null, true);

        wp_enqueue_style("rainbowit-admin-css", RAINBOWIT_ADDONS_URL . 'assets/css/admin.css', time());
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        wp_localize_script('rainbowit-core-ajax', 'rainbowit_portfolio_ajax', $params);
    }

    function rainbowit_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_script('rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/media_admin.js', array('jquery'), null, true);
    }

    function rainbowit_load_more_products()
    {

        $paged                  = isset($_POST['page']) ? $_POST['page'] : 1;
        $posts_per_page         = isset($_POST['perpage']) ? $_POST['perpage'] : -1;
        $category               = isset($_POST['category']) ? explode(',', $_POST['category']) : array();
        $post__not_in           = isset($_POST['post__not_in']) ? explode(',', $_POST['post__not_in']) : array();
        $product_grid_type      = isset($_POST['product_grid_type']) ? $_POST['product_grid_type'] : 1;
        $offset                 = isset($_POST['offset']) ? $_POST['offset'] : 0;
        $exclude_categories     = isset($_POST['exclude_category']) ? $_POST['exclude_category'] : array();
        $product_order_by       = isset($_POST['product_orderby']) ? $_POST['product_orderby'] : 'date';
        $product_order          = isset($_POST['product_order']) ? $_POST['product_order'] : 'desc';
        $ignore_sticky_posts    = isset($_POST['ignore_sticky_posts']) ? $_POST['ignore_sticky_posts'] : '';

        $exclude_category_list_value = explode(",", $exclude_categories);

        $post__not_in = '';
        if (!empty($post__not_in)) {
            $post__not_in = $post__not_in;
            $args['post__not_in'] = $post__not_in;
        }

        $posts_per_page         = (!empty($posts_per_page)) ? $posts_per_page : '-1';
        $orderby                = (!empty($product_order_by)) ? $product_order_by : 'post_date';
        $order                  = (!empty($product_order)) ? $product_order : 'desc';
        $offset_value           = (!empty($offset)) ? $offset : '0';
        $ignore_sticky_posts    = (!empty($ignore_sticky_posts) && 'yes' == $ignore_sticky_posts) ? true : false;


        // number
        $off            = (!empty($offset_value)) ? $offset_value : 0;
        $offset         = $off + (($paged - 1) * $posts_per_page);
        $p_ids          = array();
        $post__not_in   = isset($_POST['post__not_in']) ? explode(',', $_POST['post__not_in']) : array();

        // build up the array
        if (!empty($post__not_in)) {
            foreach ($post__not_in as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'posts_per_page'        => $posts_per_page,
            'orderby'               => $orderby,
            'order'                 => $order,
            'offset'                => $offset,
            'paged'                 => $paged,
            'post__not_in'          => $p_ids,
            'ignore_sticky_posts'   => $ignore_sticky_posts
        );

        // Initialize tax_query if it's not already set
        if (!isset($args['tax_query'])) {
            $args['tax_query'] = array();
        }

        // Exclude the correct categories
        if (!empty($exclude_categories)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $exclude_category_list_value,
                'operator' => 'NOT IN'
            );
        }

        // Include the correct categories
        if (!empty($category)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category,
                'operator' => 'IN'
            );
        }

        // If both exclude and include categories are present, set the relation
        if (!empty($exclude_categories) && !empty($category)) {
            $args['tax_query']['relation'] = 'AND';
        }


        if ($product_grid_type == 'sale_products') {
            // Meta query arguments
            $meta_query = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array( // Variable products type
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            );

            // Add the meta query to the common arguments
            $args['meta_query'] = $meta_query;
        }

        if ($product_grid_type == 'best_selling_products') {

            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }

        if ($product_grid_type == 'featured_products') {
            $tax_query = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                ),
            );

            // Add the tax query to the common arguments
            $args['tax_query'] = $tax_query;
        }
        if ($product_grid_type == 'top_rated_products') {

            $args['no_found_rows'] = 1;
            $args['meta_key'] = '_wc_average_rating';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'] = WC()->query->get_tax_query();
        }



        $products_query2 = new WP_Query($args);

        /*product category count code*/

        if (!empty($category)) {
            foreach ($category as $category_single) {
        
                $categoryName = get_term_by('slug', $category_single, 'product_cat');
                $get_category = get_term_by('id', $categoryName->term_id, 'product_cat');
        
                if ($get_category) {
                    $cat_count = $get_category->count;
                }
        
            }
        } else {
            if (!empty($exclude_category_list_value)) {
                $terms = get_terms(array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'exclude'    => array_map(function ($slug) {
                        $term = get_term_by('slug', $slug, 'product_cat');
                        return $term ? $term->term_id : 0;
                    }, $$exclude_category_list_value),
                ));
            } else {
                $terms = get_terms(array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                ));
            }
        
        
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
        
                    $get_category = get_term_by('id', $term->term_id, 'product_cat');
                    if ($get_category) {
                        $cat_count = $get_category->count;
                    } 
        
                }
            }
        } 

        // Check if the rainbowit_Helper class exists
        if (class_exists('Rainbowit_Helper')) {
            $rainbowit_Helper = new \Rainbowit_Helper();
            $rainbowit_options = $rainbowit_Helper->rainbowit_get_options();
        } else {
            // Handle the case where the class doesn't exist
            return;
        }
        /*end product category count code*/

        if ($products_query2->have_posts()) {
            while ($products_query2->have_posts()) {
                $products_query2->the_post();

                global $product;
                global $post;

                $terms = get_the_terms($post->ID, 'product_cat');
                if ($terms && !is_wp_error($terms)) {
                    $termsList = array();
                    $parentList = array();
                    foreach ($terms as $category) {
                        $termsList[] = $category->slug;
                        $parentTerm = get_term($category->parent, 'product_cat'); // 'category' is the taxonomy name
                        if (!is_wp_error($parentTerm) && $parentTerm) {
                            $parentList[] = $parentTerm->name;
                        } else {
                            $parentList[] = ''; // If parent term is not found or is an error, add empty string
                        }
                    }

                    $termsAssignedCat = join(" ", $termsList);
                    $parentCat = join(" ", $parentList);

                } else {
                    $termsAssignedCat = '';
                    $parentCat = '';
                }

                global $product;

                $rainbowit_own_product_checkbox         =  get_post_meta(get_the_ID(), 'rainbowit_own_product_checkbox', true);

                if ($rainbowit_own_product_checkbox == 'yes') {

                    $envato_product_preview_url         =  get_post_meta(get_the_ID(), '_own_product_preview_url', true);
                    $envato_product_total_sales         =  get_post_meta(get_the_ID(), '_own_product_total_sales', true);
                    $rating                             = get_post_meta(get_the_ID(), '_wc_average_rating', true);
                    $review_count                       =  $product->get_review_count();
                } else {

                    $envato_product_preview_url     =  get_post_meta(get_the_ID(), '_envato_product_preview_url', true);
                    $envato_product_total_sales     =  get_post_meta(get_the_ID(), '_envato_product_total_sales', true);
                    $rating                         =  get_post_meta(get_the_ID(), '_envato_product_avg_rating', true);
                    $review_count                   =  get_post_meta(get_the_ID(), '_envato_product_total_rating', true);
                }

                $tags = wp_get_post_terms($product->get_id(), 'product_tag');

                if (!empty($tags) && isset($tags[0])) {
                    $tag = $tags[0];
                    $tag_link = get_term_link($tag);
                }

                $preview_btn_text    =  isset($rainbowit_options['preview_btn_text']) ? $rainbowit_options['preview_btn_text'] : '';
?>
                <div data-catcount="<?php echo esc_attr($cat_count);?>" class="col-12 col-md-6 col-xl-4 mb--25 rbt-tab-item-2 <?php echo esc_attr(strtolower($termsAssignedCat)); ?> <?php echo esc_attr(strtolower($parentCat)); ?>">
                    <div class="rbt-card">
                        <div>
                            <a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
                        </div>
                        <div class="rbt-card-body p--24">
                            <h3 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo wp_trim_words(get_the_title(), 5, '... '); ?>
                                </a>
                            </h3>
                            <div class="rbt-card-meta woocommerce">
                                <div class="rbt-categories">
                                    <?php if (!empty($tags) && isset($tags[0])) { ?>
                                        <a href="<?php echo esc_url(esc_url($tag_link)); ?>" class="category"><?php echo esc_html($tags[0]->name); ?></a>
                                    <?php } ?>
                                </div>
                                <?php if ($rating > 0) { ?>
                                    <div class="review">
                                        <?php if ($rating) : ?>
                                            <?php echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $rating) . '"><span style="width:' . (($rating / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $rating . '</strong> ' . __('out of 5', 'woocommerce') . '</span></div>'; ?>
                                        <?php endif; ?>
                                        <?php if ($rating > 0) { ?>
                                            <span class="rating-count">(<?php echo $review_count ?>)
                                            </span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="rbt-card-bottom">
                                <div class="sales">
                                    <div class="price">
                                        <?php
                                        $regular_price = $product->get_regular_price();
                                        $sale_price = $product->get_sale_price();
                                        if ($sale_price) {
                                            echo '<div class="off-price">' . wc_price($sale_price) . '</div>';
                                            echo '<div class="current-price">' . wc_price($regular_price) . '</div>';
                                        } else {
                                            echo '<div class="current-price">' . wc_price($regular_price) . '</div>';
                                        }
                                        ?>
                                    </div>

                                    <?php if (!empty($envato_product_total_sales)) { ?>
                                        <span class="sales-count"><?php echo esc_html($envato_product_total_sales); ?> <?php echo esc_html__("sales", "rainbowit"); ?></span>
                                    <?php } ?>
                                </div>
                                <div class="rbt-card-btn">
                                    <a href="<?php echo esc_url($envato_product_preview_url); ?>" target="_blank" class="rbt-btn rbt-btn-sm hover-effect-1 btn-border-secondary">
                                        <span><i class="fa-sharp fa-regular fa-eye"></i></span>
                                        <?php echo esc_html($preview_btn_text); ?>
                                    </a>
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }

            wp_reset_postdata();
        }

        wp_die();
    }

    public function rbt_ajax_product_order_now_func()
    {

        $nonce = isset($_POST['orderNonce']) ? $_POST['orderNonce'] : 0;
        if (!wp_verify_nonce($nonce, 'rainbowit-feature-plugin')) {
            die(__('Security check', 'rainbowit'));
        }
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
        if ($productId > 0) {
            WC()->cart->add_to_cart($productId, 1);
        }
        // Redirect to the cart page
        return true;
        die();
    }

    public function rbt_ajax_envato_api_product_func()
    {

        $nonce = isset($_POST['orderNonce']) ? $_POST['orderNonce'] : 0;

        $apiToken = 'AxNy23RTmWIlDXO3E0Cad6075IHpEciQ';
        $products = wp_remote_get('https://api.envato.com/v1/discovery/search/search/item?site=themeforest.net&username=rainbow-themes', array(
            'headers' => array(
                'timeout' => 30,
                'Authorization' => 'Bearer ' . $apiToken
            )
        ));

        $product_info = isset($products['body']) ? json_decode($products['body']) : '';
        $matches_products = isset($product_info) && !empty($product_info) ? $product_info->matches : '';

        $set_option = json_encode($matches_products);

        $check = update_option('rainbowit_envato_product_save_update', $set_option);

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => '_product_url',
                    'compare' => 'EXISTS',
                ),
            ),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'external',
                ),
            ),
        );

        // Custom query to get external products
        $query = new WP_Query($args);

        $get_option = get_option('rainbowit_envato_product_save_update', true);

        $matches_products = json_decode($get_option, true);

        // Check if we have products
        if ($query->have_posts()) {
            // Loop through the products
            while ($query->have_posts()) {
                $query->the_post();
                $woo_product_id =  get_the_ID();
                $envato_product_preview_url = get_post_meta($woo_product_id, '_envato_product_preview_url', true);

                if (!empty($matches_products)) :
                    foreach ($matches_products as $product) :
                        $avg_rating           = isset($product['rating']['rating']) ? $product['rating']['rating'] : '';
                        $total_rating         = isset($product['rating']['count']) ? $product['rating']['count'] : '';
                        $preview_url          = isset($product['previews']['live_site']['url']) ? $product['previews']['live_site']['url'] : '';
                        $price_cents          = isset($product['price_cents']) ? $product['price_cents'] : '';
                        $number_of_sales      = isset($product['number_of_sales']) ? $product['number_of_sales'] : '';
                        $product_price        = $this->centsToUSD($price_cents);
                        $updated_at           = isset($product['updated_at']) ? $product['updated_at'] : '';

                        if ($envato_product_preview_url == $preview_url) {

                            update_post_meta($woo_product_id, '_envato_product_total_sales', $number_of_sales);
                            update_post_meta($woo_product_id, '_envato_product_last_update', $updated_at);
                            update_post_meta($woo_product_id, '_envato_product_avg_rating', $avg_rating);
                            update_post_meta($woo_product_id, '_envato_product_total_rating', $total_rating);
                            update_post_meta($woo_product_id, '_regular_price', $product_price);
                        }

                    endforeach;

                endif;

                $product = wc_get_product(get_the_ID());
                $product->save();
            }

            // Reset post data
            wp_reset_postdata();

        } else {
            echo '<p>No external products found.</p>';
        }


        if ($set_option) {
            echo "success";
        } else {
            return false;
        }

        exit();
    }

    public function centsToUSD($cents)
    {
        // Validate input to ensure it's a number
        if (!is_numeric($cents)) {
            throw new InvalidArgumentException('Input must be a number');
        }
        // Convert cents to USD by dividing by 100
        $usd = $cents / 100;
        // Format the USD value with two decimal places
        return number_format($usd, 2, '.', '');
    }
}

new ajax_requests();
