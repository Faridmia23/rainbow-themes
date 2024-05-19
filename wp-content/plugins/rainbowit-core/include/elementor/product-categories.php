<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Product_Categories extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-product-categories';
    }

    public function get_title()
    {
        return esc_html__('Product Categories', 'rainbowit');
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
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

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

        ?>
                <li class="has-dropdown">
                    <a href="#" class="">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'full', 'cat_image'); ?>
                        <?php
                        if ($category && !is_wp_error($category)) { ?>
                            <span><?php echo esc_html($category_name); ?></span>
                        <?php } ?>
                        <span class="rbt-chevron-right"><i class="fa-sharp fa-solid fa-chevron-down"></i></span>
                    </a>
                    <ul class="submenu" style="display: none;">
                        <?php
                        $args = array(
                            'post_type'             => 'product',
                            'post_status'           => 'publish',
                            'ignore_sticky_posts'   => 1,
                            'posts_per_page'        => -1,
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
                                $product_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        ?>
                                <li>
                                    <a href="<?php the_permalink();?>">
                                        <?php
                                        if (isset($product_img_url) && !empty($product_img_url)) { ?>
                                            <img src="<?php echo esc_url($product_img_url); ?>" alt="hiStudy tempalte Logo">

                                        <?php  } ?>
                                        <span><?php echo wp_trim_words( get_the_title(), '5',' '); ?></span>
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
                </li>

        <?php
            }
        }
        ?>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Product_Categories());
