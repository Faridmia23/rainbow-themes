<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Product_Categories_Grid extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-product-categories-grid';
    }

    public function get_title()
    {
        return esc_html__('Product Grid', 'rainbowit');
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
                'label' => esc_html__('Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => esc_html__('Layout Style', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'layout-1',
                'options' => [
                    'layout-1' => esc_html__('layout 1', 'rainbowit'),
                    'layout-2' => esc_html__('layout 2', 'rainbowit'),
                    'layout-3' => esc_html__('layout 3', 'rainbowit'),
                    'layout-4' => esc_html__('layout 4', 'rainbowit'),
                ],
            ]
        );

        $this->add_control(
            'subtitle_title',
            [
                'label' => esc_html__('Subtitle Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Elite Author On Envato Market', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12+ Professionals are waiting for you', 'rainbowit'),
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );


        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button 1 Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Templates', 'rainbowit'),
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button 1 Link', 'rainbowit'),
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
            'icon_image',
            [
                'label' => esc_html__('Title Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        $this->add_render_attribute('icon_image', 'src', $settings['icon_image']['url']);
        $this->add_render_attribute('icon_image', 'alt', Control_Media::get_image_alt($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'title', Control_Media::get_image_title($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'class', 'impower-icon');
        $this->add_render_attribute('icon_image', 'data-sal', 'slide-up');
        $this->add_render_attribute('icon_image', 'data-sal-duration', '900');
        $this->add_render_attribute('icon_image', 'data-sal-delay', '100');

        $layout_style = $settings['layout_style'];

        $heading_title = $settings['heading_title'] ?? '';
        $subtitle_title = $settings['subtitle_title'] ?? '';
        $desc = $settings['desc'] ?? '';
        $btn_title = $settings['btn_title'] ?? '';
        $attr = '';
        if (!empty($settings['btn_link']['url'])) {
            $attr  = 'href="' . $settings['btn_link']['url'] . '"';
            $attr .= !empty($settings['btn_link']['is_external']) ? ' target="_blank"' : '';
            $attr .= !empty($settings['btn_link']['nofollow']) ? ' rel="nofollow"' : '';
        }

        $cat_single_list  = $settings['cat_single_list'];
        $product_per_page = $settings['product_per_page'];

        if (isset($cat_single_list) && !empty($cat_single_list)) {
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => $product_per_page,
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
        } else {
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => $product_per_page,
            );
        }


        $products_query = new \WP_Query($args);


?>
        <?php
        if ($layout_style == 'layout-1') {
        ?>
            <div class="themes-wrapper rbt-section-gapBottom">
                <div class="container">
                    <div class="row row--12">
                        <div class="col-12 col-xl-4">
                            <div class="rbt-parent">
                                <div class="rbt-parent-bg"></div>
                                <div class="rbt-inner-img"></div>
                                <div class="rbt-inner-content">
                                    <div class="inner">
                                        <div class="rbt-section-title section-title-left">
                                            <span class="subtitle"><?php echo esc_html($subtitle_title); ?></span>
                                            <h3 class="title"><?php echo esc_html($heading_title); ?></h3>
                                            <p class="description">
                                                <?php echo wp_kses_post($desc); ?>
                                            </p>
                                            <a class="rbt-btn rbt-btn-xm rbt-outline-none hover-effect-3" <?php echo $attr; ?>>
                                                <?php echo esc_html($btn_title); ?>
                                                <span class="default-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                                                <span class="hover-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php echo wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'icon_image')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8">
                            <div class="row row--12">
                                <?php
                                if ($products_query->have_posts()) {
                                    while ($products_query->have_posts()) {
                                        $products_query->the_post();
                                        get_template_part('woocommerce/content-product', 'grid');

                                ?>
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
                    </div>
                </div>
            </div>
        <?php } elseif ($layout_style == 'layout-2') { ?>
            <div class="rbt-section-wrapper-2 rbt-section-gapTop rbt-section-gap2Bottom rbt-swiper-corousel-wrapper">
                <div class="ml-container swiper-carousel">
                    <div class="rbt-section-title section-title-left">
                        <span class="subtitle"><?php echo esc_html($subtitle_title); ?></span>
                        <h3 class="title"><?php echo esc_html($heading_title); ?></h3>
                        <p class="description">
                        <?php echo wp_kses_post($desc); ?>
                        </p>
                        <div class="nav-btn-group">
                            <a class="rbt-btn rbt-btn-xm rbt-outline-none hover-effect-3 mx-md-auto mx-xl-0 " <?php echo $attr; ?>>
                            <?php echo esc_html($btn_title); ?>
                                <span class="default-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                                <span class="hover-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                            </a>

                            <!-- navigation buttons -->
                            <div class="rbt-navigation-btns">
                                <div class="rbt-navigate-prev">
                                    <i class="arrow-left fa-regular fa-arrow-left"></i>
                                    <i class="arrow-left fa-regular fa-arrow-left"></i>
                                </div>
                                <div class="rbt-navigate-next">
                                    <i class="arrow-right fa-regular fa-arrow-right"></i>
                                    <i class="arrow-right fa-regular fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                        <img class="section-tech-logo" src="<?php echo esc_url( $settings['icon_image']['url']); ?>" alt="Background image">
                    </div>
                    <div class="rbt-swiper-wrapper">
                        <div class="swiper rbt-swiper-carousel">
                            <!-- swiper wrapper -->
                            <div class="swiper-wrapper">
                            <?php
                                if ($products_query->have_posts()) {
                                    while ($products_query->have_posts()) {
                                        $products_query->the_post();
                                        get_template_part('woocommerce/content-product', 'slider');

                                ?>
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
                    </div>
                </div>
            </div>
        <?php } ?>

<?php

    }
}
Plugin::instance()->widgets_manager->register(new Rainbowit_Product_Categories_Grid());
