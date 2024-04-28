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
        $category_dropdown = array('0' => esc_html__('All Categories', 'rainbow-elements'));

        foreach ($terms as $id => $name) {
            $category_dropdown[$id] = $name;
        }

        return $category_dropdown;
    }

    protected function register_controls()
    {




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
            'product_filter_all_button_label',
            [
                'label' => esc_html__('All Button Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All', 'rainbowit'),
                'placeholder' => esc_html__('Type all project button label here', 'rainbowit'),
            ]
        );

        $this->add_control(
            'cat_single_list',
            [
                'label' => __('Categories', 'rainbow-elements'),
                'type' => Controls_Manager::SELECT2,
                'default' => '0',
                'multiple' => true,
                'options' => $this->category_dropdown(),
            ]
        );

        $this->add_control(
            'product_per_page',
            [
                'label' => esc_html__('Product Per Page', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('-1', 'rainbowit'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $heading_title    = $settings['heading_title'] ?? '';
        $product_per_page = $settings['product_per_page'];



?>
        <div class="container mt--80 product-custom-service-tab">
            <div class="rbt-section-title text-center" data-sal="slide-up" data-sal-duration="400">
                <h4 class="title title-md"><?php echo wp_kses_post($heading_title); ?></h4>
            </div>
            <!-- tabs -->
            <?php

            $category_list = '';
            if (!empty($settings['cat_single_list'])) {
                $category_list = implode(" ", $settings['cat_single_list']);
            }

            $category_list_value = explode(" ", $category_list);
            ?>
            <?php 
            if ($category_list_value && !is_wp_error($category_list_value)) : ?>
            <div class="rbt-tabs-wrapper" data-sal="slide-up" data-sal-duration="400">
                <ul class="rbt-tabs">
                    <?php 
                    if (!empty($settings['product_filter_all_button_label'])) {
                        $active = 'active';

                    ?>
                    <li class="rbt-tab-link <?php echo esc_attr($active); ?>" data-filter="*"><?php echo esc_html($settings['product_filter_all_button_label']); ?></li>
                    <?php } ?>
                    <?php if (!empty($settings['cat_single_list'])) {
                        $i = 1;
                        foreach ($category_list_value as $category) {
                            $categoryName = get_term($category, 'product_cat');

                            $active = '';
                            if (empty($settings['product_filter_all_button_label']) && $i == 1) {
                                $active = 'active';
                            }
                    ?>
                            <li class="rbt-tab-link <?php echo esc_attr($active); ?>" data-filter=".<?php echo esc_attr(strtolower( $categoryName->name) ); ?>"><?php echo esc_html($categoryName->name); ?> </li>
                    <?php
                            $i++;
                        }
                    } ?>

                </ul>
            </div>
            <?php endif; ?>
            <!-- tab content -->
            <div class="row row--12 rbt-tabs-active">
                <!-- single card -->
                <?php
                $args = array(
                    'post_type'             => 'product',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'posts_per_page'        => $product_per_page,
                    'tax_query'             => array(
                        array(
                            'taxonomy'      => 'product_cat',
                            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                            'terms'         => $settings['cat_single_list'],
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

                $products_query = new \WP_Query($args);

                if ( $products_query->have_posts() ) {
                    while ( $products_query->have_posts() ) {
                        global $post;
                        $products_query->the_post();
                        $product_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $terms = get_the_terms ( $post->ID, 'product_cat' );

                        if ($terms && !is_wp_error($terms)) {
                            $termsList = array();
                            foreach ($terms as $category) {
                                if( isset($category->slug) ) {
                                    $termsList[] = $category->slug;
                                }
                               
                            }
                            $termsAssignedCat = join(" ", $termsList);
                        } 
                        else {
                            $termsAssignedCat = '';
                        }

                        $service_order_btn_title        = get_post_meta( $post->ID, '_service_order_btn_title', true );
                        if( empty($service_order_btn_title)) {
                            $service_order_btn_title = 'Order Now';
                        }
                        $product_order_btn_url          = get_post_meta( $post->ID, '_service_product_order_btn_url', true );
                        $product_details_button_text    = get_post_meta( $post->ID, '_service_product_details_button_text', true );
                        if( empty($product_details_button_text)) {
                            $product_details_button_text = 'Details';
                        }
                        $product_delivery_time          = get_post_meta( $post->ID, '_service_product_delivery_time', true );
                        $product_total_jobs             = get_post_meta( $post->ID, '_service_product_total_jobs', true );
                        $product_queue_item             = get_post_meta( $post->ID, '_service_product_queue_item', true );
                       
                ?>
                    <div class="col-12 col-lg-6 mb--32 rbt-tab-item <?php echo esc_attr(strtolower( $termsAssignedCat ) ); ?>">
                        <div class="rbt-card-3">
                            <div class="card-body">
                                <div class="card-left">
                                    <?php
                                    if (isset($product_img_url) && !empty($product_img_url)) { ?>
                                        <?php the_post_thumbnail('rainbowit-product-order-grid'); ?>

                                    <?php  } ?>
                                </div>
                                <div class="card-right">
                                    <div class="card-content">
                                        <h6 class="title title-xm">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h6>
                                        <div class="price">
                                            <?php woocommerce_template_loop_price(); ?>
                                        </div>
                                    </div>
                                    <div class="rbt-btn-group btn-gap-12">
                                        <a href="<?php echo esc_url(  $product_order_btn_url ); ?>" class="rbt-btn rbt-btn-xm rbt-btn-primary rbt-btn-round  btn-primary-outline rbt-btn-xm hover-effect-1">
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
                                 
                                    <?php if( isset( $product_queue_item )) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-regular fa-forward"></i></span>
                                        <span class="mark-with-primary"><?php echo esc_html( $product_queue_item ); ?></span> <?php echo esc_html__("in Queue","rainbowit-core"); ?>
                                    </p>
                                    <?php  } ?>
                                    <?php if( isset($product_delivery_time )) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-sharp fa-regular fa-alarm-clock"></i></span>
                                        <?php echo esc_html( $product_delivery_time ); ?>
                                    </p>
                                    <?php  } ?>
                                    
                                    <?php if( isset( $product_total_jobs )) { ?>
                                    <p class="single-meta">
                                        <span><i class="fa-regular fa-suitcase"></i></span>
                                        <?php echo esc_html( $product_total_jobs ); ?>
                                    </p>
                                    <?php  } ?>
                                    <div class="review single-meta woocommerce">
                                        <?php woocommerce_template_loop_rating(); ?>
                                        <span class="rating-count">
                                            4.0
                                            <span class="rbt-review-total">(Total 23)</span>
                                        </span>
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
}

Plugin::instance()->widgets_manager->register(new rainbowit_Custom_Service_Tab());
