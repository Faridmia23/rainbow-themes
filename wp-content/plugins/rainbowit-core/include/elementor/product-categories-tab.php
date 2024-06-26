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

        $this->rbt_product_control('product', 'Product - ', 'product', 'product_cat');
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
            'filter_label_text',
            [
                'label' => esc_html__('Filter Label Text', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('All Themes', 'rainbowit'),
                'condition' => ['product_filter' => 'yes']
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
                'label' => esc_html__('Show Pagination?', 'rainbowit'),
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

        $posts_per_page = $settings['posts_per_page'];
        $product_grid_type = $settings['product_grid_type'];
        $product_cat = $settings['product_cat'];
        $exclude_category = $settings['exclude_category'];
        $post__not_in = $settings['post__not_in'];
        $offset = $settings['offset'];
        $product_orderby = $settings['product_orderby'];
        $product_order = $settings['product_order'];
        $ignore_sticky_posts = $settings['ignore_sticky_posts'];

        $exclude_catlist = '';
        if (!empty($exclude_category)) {
            $exclude_catlist = implode(",", $exclude_category);
        }

        $postnot_in = '';
        if (!empty($post__not_in)) {
            $postnot_in = implode(",", $post__not_in);
        }

        $data_attribute = [
            'product_grid_type' => $product_grid_type,
            'exclude_category'  => $exclude_catlist,
            'post__not_in'      => $postnot_in,
            'offset'            => $offset,
            'product_orderby'   => $product_orderby,
            'product_order'     => $product_order,
            'ignore_sticky_posts'     => $ignore_sticky_posts,
        ];

        $json_data = json_encode($data_attribute);
        $html_attribute = htmlspecialchars($json_data, ENT_QUOTES, 'UTF-8');

        /**
         * Setup the post arguments.
         */
        $args = RBT_Helper::getProductInfo($posts_per_page, $product_grid_type, $product_cat, $exclude_category, $post__not_in, $offset, $product_orderby, $product_order,  $ignore_sticky_posts, $posttype = 'product', $taxonomy = 'product_cat', $settings);

        $products_query = new \WP_Query($args);

        $category_list = '';
        if (!empty($product_cat)) {
            $category_list = implode(",", $product_cat);
        }

        $category_list_value = explode(" ", $category_list);

        if (!empty($settings['product_cat'])) {
            $all_cat = [];
            foreach ($settings['product_cat'] as $category) {

                $categoryName = get_term_by('slug', $category, 'product_cat');

                // echo "<pre>";
                // print_r($product_cat);
                // echo "</pre>";
                // die;
                $get_category = get_term_by('id', $categoryName->term_id, 'product_cat');
                $get_cat       = isset($_GET['category']) ? $_GET['category'] : '';
                $all_cat[]      = isset($categoryName->slug) ? strtolower($categoryName->slug) : '';
            }
        } else {
            if (!empty($exclude_category)) {
                $terms = get_terms(array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'exclude'    => array_map(function ($slug) {
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

            $all_cat = [];
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    // $categoryName = get_term_by('slug', $term, 'product_cat');
                    $get_category = get_term_by('id', $term->term_id, 'product_cat');
                    $all_cat[] = $get_category->slug;
                }
            }
        }

        $explode_cat = implode(",", $all_cat);

       


?>
        <div class="mt_dec--225 product-tab-categories">
            <div class="container">
                <!-- tabs -->
                <?php
                if ($settings['product_filter'] == 'yes') {

                    $category_list = '';
                    if (!empty($product_cat)) {
                        $category_list = implode(" ", $product_cat);
                    }

                    $category_list_value = explode(" ", $category_list);

                    if ($category_list_value && !is_wp_error($category_list_value)) :
                ?>
                        <div class="rbt-tabs-wrapper">
                            <ul class="rbt-tabs tabs-2">
                                <?php
                                if (!empty($settings['filter_label_text'])) {


                                    $get_cat = isset($_GET['category']) ? $_GET['category'] : '';
                                    $active = '';
                                    if (empty($get_cat)) {
                                        $active = 'active';
                                    }

                                    $category_list2 = '';
                                    if (!empty($product_cat)) {
                                        $category_list2 = implode(",", $product_cat);
                                    }
                                ?>
                                    <li class="rbt-tab-link <?php echo esc_attr($active); ?>" data-filter2="<?php echo esc_attr($explode_cat); ?>" data-countfilter="<?php echo esc_html($products_query->found_posts); ?>">
                                        <?php echo esc_html($settings['filter_label_text']); ?>
                                        <span class="count"><?php echo esc_html($products_query->found_posts); ?></span>
                                    </li>
                                <?php } ?>
                                <?php
                                if (!empty($settings['product_cat'])) {
                                    $i = 1;
                                    foreach ($category_list_value as $category) {

                                        $categoryName = get_term_by('slug', $category, 'product_cat');
                                        $get_category = get_term_by('id', $categoryName->term_id, 'product_cat');
                                        $get_cat       = isset($_GET['category']) ? $_GET['category'] : '';
                                        $cat_name      = isset($categoryName->name) ? strtolower($categoryName->name) : '';

                                        $active = '';
                                        if ($get_cat == $cat_name) {
                                            $active = 'active';
                                        }

                                        if ( ($get_cat != $cat_name && empty($settings['filter_label_text']) && $i == 1 ) ) {
                                            $active = 'active';
                                        }


                                        if ($get_category->count >= 10) {
                                            $cat_count = $get_category->count;
                                        } else {
                                            $cat_count = "0" . $get_category->count;
                                        }

                                        if (isset($categoryName->name)) {
                                ?>
                                            <li class="rbt-tab-link <?php echo esc_attr($active); ?>" data-filter2=".<?php echo esc_attr(strtolower($categoryName->slug)); ?>" data-countfilter="<?php echo esc_html($cat_count); ?>">
                                                <?php echo esc_html($categoryName->name); ?>
                                                <span class="count"><?php echo esc_html($cat_count); ?></span>
                                            </li>
                                        <?php
                                        }
                                    $i++; }
                                } else {
                                    if (!empty($exclude_category)) {
                                        $terms = get_terms(array(
                                            'taxonomy'   => 'product_cat',
                                            'hide_empty' => true,
                                            'exclude'    => array_map(function ($slug) {
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



                                            $get_category = get_term_by('id', $term->term_id, 'product_cat');
                                            if ($get_category->count >= 10) {
                                                $cat_count = $get_category->count;
                                            } else {
                                                $cat_count = "0" . $get_category->count;
                                            }
                                            $active2 = '';
                                            if (empty($settings['filter_label_text']) && $i == 1) {
                                                $active2 = 'active';
                                            }

                                            
                                        ?>
                                            <li  class="rbt-tab-link <?php echo esc_attr($active2); ?>" data-catcount="<?php echo esc_attr($cat_count); ?>" data-filter2=".<?php echo esc_attr(strtolower($term->slug)); ?>" data-countfilter="<?php echo esc_html($cat_count); ?>"><?php echo esc_html(ucwords($term->name)); ?> <span class="count"><?php echo esc_html($cat_count); ?></span></li>
                                <?php
                                            $i++;
                                        }
                                    }
                                } ?>

                            </ul>
                        </div>
                    <?php endif;
                }

                if ($products_query->have_posts()) {
                    $current_page = max(1, get_query_var('paged'));

                    ?>
                    <input type="hidden" class="rainbowit-load-more" data-page="<?php echo esc_attr($current_page); ?>" data-cate="<?php echo esc_attr($explode_cat); ?>" data-perpage="<?php echo esc_attr($posts_per_page); ?>" data-productby="<?php echo esc_attr($html_attribute); ?>" />
                    <div class="row row--12 rbt-tab-items">
                    <div class="load-more-spinner" id="loading-spinner-load-more"></div>


                    </div>
                    <!-- pagination -->
                    <?php
                    if ($settings['product_blog_pagination'] == 'yes' && '-1' != $posts_per_page) {
                        $big = 999999999; // need an unlikely integer

                    ?>
                        <div class="rainbowit-load-more-button">
                            <button type="button" id="rainbowit-load-more" class="rainbowit-load-more" data-page="<?php echo esc_attr($current_page); ?>" data-cate="<?php echo esc_attr($explode_cat); ?>" data-perpage="<?php echo esc_attr($posts_per_page); ?>" data-productby="<?php echo esc_attr($html_attribute); ?>"><?php echo esc_html__("Load More", "rainbowit"); ?></button>
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

Plugin::instance()->widgets_manager->register(new Rainbowit_Product_Categories_Tab());
