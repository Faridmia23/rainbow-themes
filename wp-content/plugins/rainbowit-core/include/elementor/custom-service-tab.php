<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class rainbowit_Custom_Service_Tab extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-custom-service-tab';
    }

    public function get_title()
    {
        return esc_html__('Custom Service Tab', 'rainbowit');
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
        return ['service', 'tab'];
    }

    public function category_dropdown()
    {
        $terms  = get_terms(array('taxonomy' => 'product_cat', 'fields' => 'id=>name'));
        $category_dropdown[0] = 'All Category';
        foreach ($terms as $id => $name) {
            $category_dropdown[$id] = $name;
        }

        return $category_dropdown;
    }

    protected function register_controls()
    {

        $this->rbt_product_control('product', 'Product - ', 'product', 'product_cat');
        // layout Panel
        $this->start_controls_section(
            'rainbowit_blog',
            [
                'label' => esc_html__('General', 'rainbowit'),
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Heading Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('heading title', 'rainbowit'),
                'placeholder' => esc_html__('Type heading Title here ', 'rainbowit'),
            ]
        );

        $this->add_control(
            'sec_title_tag',
            [
                'label' => __('Title HTML Tag', 'rainbowit'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'rainbowit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'rainbowit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'rainbowit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'rainbowit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'rainbowit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'rainbowit'),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'div' => [
                        'title' => __('div', 'rainbowit'),
                        'icon' => 'eicon-font'
                    ]
                ],
                'default' => 'h4',
                'separator' => 'before',
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
            'product_filter_all_button_label',
            [
                'label' => esc_html__('All Button Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All', 'rainbowit'),
                'placeholder' => esc_html__('Type all project button label here', 'rainbowit'),
                'condition' => ['product_filter' => 'yes']
            ]
        );

        $this->add_control(
            'product_title_limit',
            [
                'label' => esc_html__('Product Title Limit', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5', 'rainbowit'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings              = $this->get_settings_for_display();
        $heading_title         = $settings['heading_title'] ?? '';
        $product_title_limit   = $settings['product_title_limit'];

        // Check if the rainbowit_Helper class exists
        if (class_exists('Rainbowit_Helper')) {

            $rainbowit_Helper  = new \Rainbowit_Helper();
            $rainbowit_options = $rainbowit_Helper->rainbowit_get_options();

        } else {
            // Handle the case where the class doesn't exist
            return;
        }

        add_filter ('add_to_cart_redirect', [ $this, 'redirect_to_checkout' ] );
        add_shortcode( 'reviews_count', [ $this, 'reviews_count_func'], 10, 1 );

        $posts_per_page = $settings['posts_per_page'];
        $product_grid_type = $settings['product_grid_type'];
        $product_cat = $settings['product_cat'];
        $exclude_category = $settings['exclude_category'];
        $post__not_in = $settings['post__not_in'];
        $offset = $settings['offset'];
        $product_orderby = $settings['product_orderby'];
        $product_order = $settings['product_order'];
        $ignore_sticky_posts = $settings['ignore_sticky_posts'];

         /**
         * Setup the post arguments.
         */
        $args = RBT_Helper::getProductInfo($posts_per_page, $product_grid_type, $product_cat, $exclude_category, $post__not_in, $offset, $product_orderby, $product_order,  $ignore_sticky_posts, $posttype = 'product', $taxonomy = 'product_cat',$settings);

        $products_query = new \WP_Query($args);

       

?>
        <div class="container mt--80 product-custom-service-tab">
            <div class="rbt-section-title text-center" data-sal="slide-up" data-sal-duration="400">
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title mb--0"><?php echo wp_kses_post($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
            </div>
            <!-- tabs -->
            <?php

            $category_list = '';
            if (!empty($product_cat)) {
                $category_list = implode(" ", $product_cat);
            }

            $category_list_value = explode(" ", $category_list);


            ?>
            <?php 
            if ($settings['product_filter'] == 'yes') { 
            if ($category_list_value && !is_wp_error($category_list_value)) : ?>
            <div class="rbt-tabs-wrapper" data-sal="slide-up" data-sal-duration="400">
                <ul class="rbt-tabs">
                    <?php 
                    if (!empty($settings['product_filter_all_button_label'])) {
                        $active = 'active';

                    ?>
                    <li class="rbt-tab-link <?php echo esc_attr($active); ?>" data-filter="*"><?php echo esc_html($settings['product_filter_all_button_label']); ?></li>
                    <?php } ?>
                    <?php if (!empty($product_cat)) {
                        $i = 1;
                        foreach ( $category_list_value as $category ) {
                            $categoryName = get_term_by('slug', $category, 'product_cat');

                            $active = '';
                            if ( empty( $settings['product_filter_all_button_label'] ) && $i == 1 ) {
                                $active = 'active';
                            }

                            if( !empty($categoryName->slug)) {
                    ?>
                            <li class="rbt-tab-link <?php echo esc_attr( $active ); ?>" data-filter=".<?php echo esc_attr( strtolower( $categoryName->slug ) ); ?>"><?php echo esc_html( ucwords( $categoryName->name ) ); ?> </li>
                    <?php
                            }
                            $i++;
                        }
                    } 

                    else {
                        if( !empty($exclude_category)) {
                            $terms = get_terms(array(
                                'taxonomy'   => 'product_cat',
                                'hide_empty' => true,
                                'exclude'    => array_map(function($slug) {
                                    $term = get_term_by('slug', $slug, 'product_cat');
                                    return $term ? $term->term_id : 0;
                                }, $exclude_category),
                            ));
                        } else {
                            $terms = get_terms(array(
                                'taxonomy'   => 'product_cat',
                                'hide_empty' => true,
                            ));
                        }
                        if ($terms && !is_wp_error($terms)) {
                            $i = 1;
                            foreach ($terms as $term) { 
                                $active = '';
                                if ( empty( $settings['product_filter_all_button_label'] ) && $i == 1 ) {
                                    $active = 'active';
                                }
                                ?>
                            <li class="rbt-tab-link <?php echo esc_attr( $active ); ?>" data-filter=".<?php echo esc_attr( strtolower( $term->slug ) ); ?>"><?php echo esc_html( ucwords( $term->name ) ); ?> </li>
                            <?php
                           $i++; }
                        }
                    } ?>
                </ul>
            </div>
            <?php endif; 
            }
            ?>
            <!-- tab content -->
            <div class="row row--12 rbt-tabs-active">
                <!-- single card -->
                <?php
                

                if ( $products_query->have_posts() ) {

                    while ( $products_query->have_posts() ) {

                        global $post;
                       
                        $products_query->the_post();
                        $product_img_url = get_the_post_thumbnail_url(get_the_ID(), '');
                        $terms = get_the_terms ( $post->ID, 'product_cat' );

                        if ( $terms && !is_wp_error( $terms )) {
                            $termsList = array();
                            foreach ( $terms as $category ) {
                                if( isset($category->slug) ) {
                                    $termsList[] = $category->slug;
                                }
                            }
                            $termsAssignedCat = join(" ", $termsList);
                        } 
                        else {
                            $termsAssignedCat = '';
                        }

                        $service_order_btn_title        = ( $rainbowit_options['order_btn_text'] ) ? $rainbowit_options['order_btn_text'] : '';
                        $product_details_button_text    = ($rainbowit_options['details_btn_text']) ? $rainbowit_options['details_btn_text'] : '';
                        $product_delivery_time          = get_post_meta( $post->ID, '_service_product_delivery_time', true );
                        $product_total_jobs             = get_post_meta( $post->ID, '_service_product_total_jobs', true );
                        $product_queue_item             = get_post_meta( $post->ID, '_service_product_queue_item', true );
                        global $product;
                        $product_id                     = $product->get_id();
                        $rating                         = get_post_meta( $product_id, '_wc_average_rating', true );          
                      
                ?>
                    <div class="col-12 col-lg-6 mb--32 rbt-tab-item <?php echo esc_attr( strtolower( $termsAssignedCat ) ); ?>">
                        <div class="rbt-card-3">
                            <div class="card-body">
                                <div class="card-left">
                                    <?php
                                    if ( isset( $product_img_url ) && !empty( $product_img_url ) ) { ?>
                                        <?php the_post_thumbnail('rainbowit-product-order-grid'); ?>

                                    <?php  } ?>
                                </div>
                                <div class="card-right">
                                    <div class="card-content">
                                        <h6 class="title title-xm">
                                            <a href="<?php the_permalink();?>">
                                                <?php echo wp_trim_words( get_the_title(), $product_title_limit,'... '); ?>
                                            </a>
                                        </h6>
                                        <div class="price rainbowit-price-custom">
                                            <?php woocommerce_template_loop_price(); ?>
                                        </div>
                                    </div>
                                    <div class="rbt-btn-group btn-gap-12">
                                        <a data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-xm rbt-btn-primary rbt-btn-round  btn-primary-outline rbt-btn-xm hover-effect-1 ajax-order-now-product" style="cursor:pointer;">
                                            <span><i class="fa-regular fa-cart-shopping"></i></span>
                                            <?php echo esc_html( $service_order_btn_title ); ?>
                                        </a>
                                        <a href="<?php the_permalink();?>" class="rbt-btn rbt-btn-xm rbt-btn-round rbt-btn-xm hover-effect-2">
                                            <span><i class="fa-regular fa-circle-info"></i></span>
                                            <?php echo esc_html( $product_details_button_text );?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-bottom">
                                <div class="card-meta">
                                 
                                    <?php if( isset( $product_queue_item ) && !empty( $product_queue_item ) ) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-regular fa-forward"></i></span>
                                        <span class="mark-with-primary"><?php echo esc_html( $product_queue_item ); ?></span> <?php echo esc_html__("in Queue","rainbowit-core"); ?>
                                    </p>
                                    <?php  } ?>
                                    <?php if( isset( $product_delivery_time ) && !empty( $product_delivery_time ) ) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-sharp fa-regular fa-alarm-clock"></i></span>
                                        <?php echo esc_html( $product_delivery_time ); ?>
                                    </p>
                                    <?php  } ?>
                                    
                                    <?php if( isset( $product_total_jobs ) && !empty( $product_total_jobs ) ) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-regular fa-suitcase"></i></span>
                                        <?php echo esc_html( $product_total_jobs ); ?>
                                    </p>
                                    <?php  } ?>
                                    <div class="review single-meta woocommerce">
                                        <?php 
                                            woocommerce_template_loop_rating(); 
                                        ?>
                                        <?php if( $rating > 0 ) { ?>
                                        <span class="rating-count">
                                        <?php echo esc_html( $rating ); ?>
                                        <span class="rbt-review-total">(Total<?php echo " ";?><?php 
                                            echo do_shortcode( "[reviews_count id='".$product_id ."']");
                                         ?>)</span>
                                         
                                        </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
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

    public function redirect_to_checkout() {
        global $woocommerce;
        $checkout_url = $woocommerce->cart->get_checkout_url();
        return $checkout_url;
    }

    public function reviews_count_func( $atts = '') {
        // Make sure an ID was passed,
        if ( ! empty( $atts['id'] && function_exists( 'wc_get_product' ) ) ) {
            // Get a WC_Product object for the product.
            $product = wc_get_product( (int) $atts['id'] );
            // Return the review count.
            $total_rating = $product->get_review_count();

            if( $total_rating < 10 ) {
                $total_rating = '0'.$total_rating;
                return $total_rating;
            }

            return $total_rating;
        }
    }
}

Plugin::instance()->widgets_manager->register( new rainbowit_Custom_Service_Tab() );