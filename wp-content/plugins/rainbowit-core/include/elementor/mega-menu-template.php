<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Elementor_Widget_Megamenu_Template extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-megamenu-template';
    }

    public function get_title()
    {
        return esc_html__('Megamenu Template', 'rainbowit');
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
            '_about_thumbnail',
            [
                'label' => esc_html__('General Info', 'rainbowit'),
            ]
        );
        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__('Icon Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'category_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('CATEGORY', 'rainbowit'),
            ]
        );

        $this->add_control(
            'product_title',
            [
                'label' => esc_html__('Product Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Products', 'rainbowit'),
            ]
        );

        $this->add_control(
            'banner_title',
            [
                'label' => esc_html__('Banner Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Products', 'rainbowit'),
            ]
        );
        $this->add_control(
            'banner_badge',
            [
                'label' => esc_html__('Banner Badge', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
            ]
        );


        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View All Items', 'rainbowit'),
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'purchase_btn_title',
            [
                'label' => esc_html__('Purchase Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Purchase Now', 'rainbowit'),
            ]
        );

        $this->add_control(
            'purchase_btn_link',
            [
                'label' => esc_html__('Purchase Button Link', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Image Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_per_page',
            [
                'label' => esc_html__('Product Per Page', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('5', 'rainbowit'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'cat_image',
            [
                'label' => esc_html__('Category Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
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
            'list',
            [
                'label' => esc_html__('Repeater List', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'banner_shape_me',
            [
                'label' => esc_html__('Banner Shape', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_png',
            [
                'label' => esc_html__('Mega Menu Banner', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'banner_png_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .banner-content-wrapper .content',
            ]
        );

        $this->add_control(
            'banner_shape',
            [
                'label' => esc_html__('Mega Menu Shape', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'banner_shape_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .banner-content-wrapper',
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings           = $this->get_settings_for_display();
        $category_title     = $settings['category_title'] ?? '';
        $product_title      = $settings['product_title'] ?? '';
        $btn_title          = $settings['btn_title'] ?? '';
        $banner_title       = $settings['banner_title'] ?? '';
        $banner_badge       = $settings['banner_badge'] ?? '';
        $purchase_btn_title = $settings['purchase_btn_title'] ?? '';
        $product_per_page   = $settings['product_per_page'] ?? '5';
        $allowed_html       = wp_kses_allowed_html('post');

        $btn_link = $settings['btn_link']['url'];


        if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}

        if ( ! empty( $settings['purchase_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'purchase_btn_link', $settings['purchase_btn_link'] );
		}

?>

        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <div class="mega-item ">
                            <h4 class="rbt-short-title"><?php echo esc_html($category_title); ?></h4>
                            <ul class="mega-menu-items nav" id="products-tab" role="tablist" data-mouse="hover">
                                <!-- Tab 1 -->
                                <?php
                                if (!empty($settings['list'])) {
                                    foreach ($settings['list'] as $key => $item) {

                                        $cat_single_list = $item['cat_single_list'];
                                        $cat_id = $cat_single_list[0];
                                        $category = get_term($cat_id, 'product_cat');

                                        $this->add_render_attribute('cat_image', 'src', $item['cat_image']['url']);
                                        $this->add_render_attribute('cat_image', 'alt', Control_Media::get_image_alt($item['cat_image']));
                                        $this->add_render_attribute('cat_image', 'title', Control_Media::get_image_title($item['cat_image']));
                                        if ($category && !is_wp_error($category)) {
                                            $category_name = $category->name;
                                        }

                                        $active = '';

                                        if ($key == 0) {
                                            $active = 'active';
                                        }

                                        $cat_image_id = $item['cat_image']['id'];
                                        $cat_image_title = get_post_meta( $cat_image_id, '_wp_attachment_image_alt', true);

                                        if (empty($cat_image_title)) {
                                            $cat_image_title = get_the_title( $cat_image_id );
                                        }
                                       

                                ?>
                                        <li class="single-item">
                                            <a class="rbt-nav-link <?php echo esc_attr($active); ?>" id="pill<?php echo strtolower($category_name); ?>" href="#<?php echo strtolower($category_name); ?>" role="tab" aria-selected="true">
                                                
                                                <img class="tech-icon" src="<?php echo esc_url( $item['cat_image']['url'] ); ?>" alt="<?php echo esc_attr($cat_image_title);?>">
                                                <?php
                                                if ($category && !is_wp_error($category)) { ?>
                                                    <span><?php echo esc_html($category_name); ?></span>
                                                <?php } ?>

                                                <span class="rbt-chevron-right"><i class="fa-regular fa-chevron-right"></i></span>
                                            </a>
                                        </li>
                                        <!-- Tab 2 -->
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tab-content">
                            <h4 class="rbt-short-title"><?php echo esc_html($product_title); ?></h4>
                            <!-- Tab content 1 -->
                            <?php
                            if (!empty($settings['list'])) {
                                foreach ($settings['list'] as $key => $item) {

                                    $cat_single_list = $item['cat_single_list'];
                                    $cat_id = $cat_single_list[0];
                                    $category = get_term($cat_id, 'product_cat');

                                    if ($category && !is_wp_error($category)) {
                                        $category_name = $category->name;
                                    }
                                    $active = '';
                                    if ($key == 0) {
                                        $active = 'show active';
                                    }

                            ?>
                                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="<?php echo strtolower($category_name); ?>" role="tabpanel" aria-labelledby="pill<?php echo strtolower($category_name); ?>">
                                        <ul class="individual-content">
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
                                                        'terms'         => $cat_id,
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

                                            if ($products_query->have_posts()) {
                                                while ($products_query->have_posts()) {
                                                    $products_query->the_post();
                                                    $product_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 

                                                    $product_title = get_the_title();
                                                   
                                                    $envato_product_preview_icon_url  =  get_post_meta(get_the_ID(), '_envato_product_preview_icon_url', true);


                                            ?>
                                                    <li class="product-item">
                                                        <a href="<?php the_permalink(); ?>" class="rbt-nav-link">
                                                            <?php 
                                                            if( isset( $envato_product_preview_icon_url ) && !empty( $envato_product_preview_icon_url ) ) { ?>
                                                            <img class="tech-icon" src="<?php echo esc_url( $envato_product_preview_icon_url );?>" alt="hiStudy tempalte Logo">
                                                            <?php  } ?>
                                                            <span><?php echo wp_kses_post( $product_title );?></span>
                                                        </a>
                                                    </li>
                                            <?php
                                                           
                                                }
                                                // reset original post data
                                                wp_reset_postdata();
                                            } else {
                                                // If no products found
                                                echo 'No products found';
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-product-btn">
                                            <a class="rbt-btn rbt-btn-xm rbt-outline-none hover-effect-3" href="<?php echo esc_url( $btn_link ); ?>?category=<?php echo strtolower($category_name); ?>">
                                                <?php echo esc_html($btn_title); ?>
                                                <span class="default-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                                                <span class="hover-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                                            </a>

                                        </div>
                                    </div>
                                    <!-- Tab content 2 -->
                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- megamenu banner -->
            <div class="col-6">
                <div class="megamenu-banner-bg">
                    <div class="banner-content-wrapper">
                        <div class="content">
                            <span class="nav-badge"><?php echo esc_html($banner_badge); ?></span>
                            <h3 class="title">
                                <?php echo esc_html($banner_title); ?>
                            </h3>
                            <a <?php $this->print_render_attribute_string( 'purchase_btn_link' ); ?> class="rbt-btn rbt-btn-secondary rbt-btn-round rbt-btn-xm">
                                <?php echo esc_html($purchase_btn_title); ?>
                                <span><i class="fa-solid fa-arrow-up-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Elementor_Widget_Megamenu_Template());