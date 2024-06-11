<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Product_Categories_Tab extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-product-tab-categories';
    }

    public function get_title()
    {
        return esc_html__('Product Tab Categories', 'rainbowit');
    }

    public function get_icon()
    {
        return 'rt-icon';
    }

    public function get_categories()
    {
        return ['rainbowit'];
    }

    public function get_keywords()
    {
        return ['about', 'rainbowit'];
    }

    public function category_dropdown()
    {
        $terms  = get_terms(array('taxonomy' => 'product_cat', 'fields' => 'id=>name'));
        $category_dropdown = array('0' => esc_html__('All Categories', 'rainbow-elements'));

        foreach ($terms as $id => $name) {
            $category_dropdown[$id] = $name;
        }

        return $category_dropdown;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Product Option', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_filter',
            [
                'label' => esc_html__('Show Filter?', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'cat_single_list',
            [
                'label' => __('Categories', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'default' => '0',
                'multiple' => true,
                'options' => $this->category_dropdown(),
            ]
        );

        $this->add_control(
            'filter_label_text',
            [
                'label' => esc_html__('Filter Label Text', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All Themes', 'rainbowit'),
            ]
        );

        $this->add_control(
            'product_per_page',
            [
                'label' => esc_html__('Product Per Page', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('6', 'rainbowit'),
            ]
        );

        $this->add_control(
            'product_title_length',
            [
                'label' => esc_html__('Title Length', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5', 'rainbowit'),
            ]
        );

        $this->add_control(
            'product_blog_pagination',
            [
                'label' => esc_html__('Show Filter?', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();
        $product_per_page = $settings['product_per_page'];
        $cat_single_list = $settings['cat_single_list'];

        $title_length2 = $settings['product_title_length'] ?? '';

        // Check if the rainbowit_Helper class exists
        if (class_exists('Rainbowit_Helper')) {
            $rainbowit_Helper = new \Rainbowit_Helper();
            $rainbowit_options = $rainbowit_Helper->rainbowit_get_options();
        } else {
            // Handle the case where the class doesn't exist
            return;
        }

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        add_shortcode('reviews_count', [$this, 'reviews_count_func'], 10, 1);

?>
        <div class="mt_dec--225 product-tab-categories">
            <div class="container">
                <!-- tabs -->
                <?php
                if ($settings['product_filter'] == 'yes') {

                    $category_list = '';
                    if (!empty($settings['cat_single_list'])) {
                        $category_list = implode(" ", $settings['cat_single_list']);
                    }

                    $category_list_value = explode(" ", $category_list);

                    if ($category_list_value && !is_wp_error($category_list_value)) :
                ?>
                        <div class="rbt-tabs-wrapper">
                            <ul class="rbt-tabs tabs-2">
                                <?php
                                if (!empty($settings['filter_label_text'])) {

                                    $args2 = array(
                                        'post_type'             => 'product',
                                        'post_status'           => 'publish',
                                        'ignore_sticky_posts'   => 1,
                                        'posts_per_page'        => $product_per_page,
                                        'paged'                 => $paged,
                                        'tax_query'             => array(
                                            array(
                                                'taxonomy'      => 'product_cat',
                                                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                                'terms'         => $cat_single_list,
                                                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                            ),
                                            array(
                                                'taxonomy'      => 'product_visibility',
                                                'field'         => 'slug',
                                                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                                                'operator'      => 'NOT IN'
                                            )
                                        )
                                    );

                                    $products_arg2 = new \WP_Query($args2);

                                    $get_cat = isset( $_GET['category'] ) ? $_GET['category'] : '';
                                    $active = '';
                                    if( empty( $get_cat ) ) {
                                        $active = 'active';
                                    }
                                ?>
                                    <li class="rbt-tab-link <?php echo esc_attr($active);?>" data-filter2="*">
                                        <?php echo esc_html($settings['filter_label_text']); ?>
                                        <span class="count"><?php echo esc_html($products_arg2->found_posts); ?></span>
                                    </li>
                                <?php } ?>
                                <?php
                                if (!empty($settings['cat_single_list'])) {
                                    foreach ($category_list_value as $category) {
                                        $categoryName = get_term($category, 'product_cat');

                                        $product_arg = array(
                                            'post_type'             => 'product',
                                            'post_status'           => 'publish',
                                           // 'paged'                 => $paged,
                                            'posts_per_page'        => $product_per_page,
                                            'tax_query'             => array(
                                                array(
                                                    'taxonomy'      => 'product_cat',
                                                    'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                                    'terms'         => $category,
                                                    'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                                ),
                                                array(
                                                    'taxonomy'      => 'product_visibility',
                                                    'field'         => 'slug',
                                                    'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                                                    'operator'      => 'NOT IN'
                                                )
                                            )
                                        );

                                        $products_arg  = new \WP_Query($product_arg);
                                        $get_cat       = isset( $_GET['category'] ) ? $_GET['category'] : '';
                                        $cat_name      = isset( $categoryName->name  ) ? strtolower($categoryName->name) : '';
                                        
                                        $active = '';
                                        if(  $get_cat == $cat_name ) {
                                            $active = 'active';
                                        }

                                        if( isset( $categoryName->name ) ) {
                                ?>
                                            <li class="rbt-tab-link <?php echo esc_attr( $active ); ?>" data-filter2=".<?php echo esc_attr(strtolower($categoryName->name)); ?>">
                                                <?php echo esc_html($categoryName->name); ?>
                                                <span class="count"><?php echo esc_html($products_arg->found_posts); ?></span>
                                            </li>
                                <?php
                                        }
                                        
                                    }
                                } ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php } ?>
                <!-- tab content -->

                <!-- service 1 -->
                <?php

                if (isset($cat_single_list) && !empty($cat_single_list)) {
                    $args3 = array(
                        'post_type'             => 'product',
                        'post_status'           => 'publish',
                        'ignore_sticky_posts'   => 1,
                        'posts_per_page'        => $product_per_page,
                        'paged'                 => $paged,
                        'tax_query'             => array(
                            array(
                                'taxonomy'      => 'product_cat',
                                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                                'terms'         => $cat_single_list,
                                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                            ),
                            array(
                                'taxonomy'      => 'product_visibility',
                                'field'         => 'slug',
                                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                                'operator'      => 'NOT IN'
                            )
                        )
                    );
                }

                $products_query = new \WP_Query($args3);

                if ($products_query->have_posts()) { ?>
                    <div class="row row--12 rbt-tab-items rbt-tabs-active-2">
                        <?php
                        while ($products_query->have_posts()) {
                            $products_query->the_post();
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
                            $product_id                     = $product->get_id();
                            $rating                         = get_post_meta($product_id, '_wc_average_rating', true);
                            $envatoproduct_template_type    =  get_post_meta($post->ID, '_envato_product_template_type', true);
                            $envato_product_preview_url     = get_post_meta($post->ID, '_envato_product_preview_url', true);
                            $preview_btn_text               = isset($rainbowit_options['preview_btn_text']) ?  $rainbowit_options['preview_btn_text'] : '';
                            $envato_product_total_sales 	=  get_post_meta( $post->ID, '_envato_product_total_sales', true );
                            $envato_product_total_rating 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true );
                        ?>
                            <div class="col-12 col-md-6 col-xl-4 mb--25 rbt-tab-item-2 <?php echo esc_attr(strtolower($termsAssignedCat)); ?> <?php echo esc_attr(strtolower($parentCat)); ?>">
                                <div class="rbt-card">
                                    <div>
                                        <a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
                                    </div>
                                    <div class="rbt-card-body p--24">
                                        <h3 class="title">
                                            <a href="<?php the_permalink(); ?>">
                                            <?php echo wp_trim_words( get_the_title(), $title_length2,'... '); ?>
                                            </a>
                                        </h3>
                                        <div class="rbt-card-meta woocommerce">
                                            <div class="rbt-categories">
                                                <?php if (isset($envatoproduct_template_type) && !empty($envatoproduct_template_type)) { ?>
                                                    <a class="category"><?php echo esc_html($envatoproduct_template_type); ?></a>
                                                <?php } ?>
                                            </div>
                                            
                                            <?php 
                                            if(  $product->is_type('external') && $envato_product_total_rating > 3 ) { ?>
                                            <div class="review">
                                                <div class="rating">
                                                    <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                </div>
                                                <span class="rating-count">(<?php echo esc_html( $envato_product_total_rating ); ?>)</span>
                                            </div>
                                            <?php } else { 
                                            woocommerce_template_loop_rating(); 
                                            }
                                            ?>
                                            </div>
                                       
                                        <div class="rbt-card-bottom">
                                            <div class="sales">
                                            <div class="price">
                                                <?php
                                                $regular_price = $product->get_regular_price();
                                                $sale_price = $product->get_sale_price();
                                                if ( $sale_price ) {
                                                    echo '<div class="off-price">' . wc_price( $sale_price ) . '</div>';
                                                    echo '<div class="current-price">' . wc_price( $regular_price ) . '</div>';
                                                    } else {
                                                    echo '<div class="current-price">' . wc_price( $regular_price ) . '</div>';
                                                } 
                                                ?>
                                            </div>
                                                
                                                <?php if(!empty($envato_product_total_sales)) { ?>
                                                <span class="sales-count"><?php echo esc_html( $envato_product_total_sales );?> <?php echo esc_html__("sales","rainbowit"); ?></span>
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

                        ?>
                    </div>
                    <!-- pagination -->
                    <?php
                    if ($settings['product_blog_pagination'] == 'yes' && '-1' != $settings['product_per_page']) { ?>
                        <div class="rbt-pagination mt--10">
                            <div class="rbt-pagination-group justify-content-center">
                                <?php
                                $big = 999999999; // need an unlikely integer

                                $current_page = max(1, get_query_var('paged'));
                                echo paginate_links(array(
                                    'base'       => str_replace($big, '%#%', get_pagenum_link($big)),
                                    'format'     => '?paged=%#%',
                                    'current'    => $current_page,
                                    'total'      => $products_query->max_num_pages,
                                    'type'       => 'list',
                                    'prev_text'  => '<i class="fa-solid fa-chevron-left"></i>',
                                    'next_text'  => '<i class="fa-solid fa-chevron-right"></i>',
                                    'show_all'   => false,
                                    'end_size'   => 1,
                                    'mid_size'   => 4,
                                ));
                                ?>
                            </div>
                        </div>
                <?php
                    }
                    // reset original post data
                    wp_reset_postdata();
                } else {
                    // If no products found
                    echo 'No products found';
                }
                ?>
            </div>
        </div>
<?php

    }

    public function reviews_count_func($atts = '')
    {
        // Make sure an ID was passed,
        if (!empty($atts['id'] && function_exists('wc_get_product'))) {
            // Get a WC_Product object for the product.
            $product = wc_get_product((int) $atts['id']);
            // Return the review count.
            $total_rating = $product->get_review_count();

            if ($total_rating < 10) {
                $total_rating = '0' . $total_rating;
                return $total_rating;
            }

            return $total_rating;
        }
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Product_Categories_Tab());