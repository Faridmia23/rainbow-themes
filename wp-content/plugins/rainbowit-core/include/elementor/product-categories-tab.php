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


         /**
         * Setup the post arguments.
         */
        $args = RBT_Helper::getProductInfo($posts_per_page, $product_grid_type, $product_cat, $exclude_category, $post__not_in, $offset, $product_orderby, $product_order,  $ignore_sticky_posts, $posttype = 'product', $taxonomy = 'product_cat',$settings);

        $products_query = new \WP_Query($args);


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


                                    $get_cat = isset( $_GET['category'] ) ? $_GET['category'] : '';
                                    $active = '';
                                    if( empty( $get_cat ) ) {
                                        $active = 'active';
                                    }
                                ?>
                                    <li class="rbt-tab-link <?php echo esc_attr($active);?>" data-filter2="*">
                                        <?php echo esc_html($settings['filter_label_text']); ?>
                                        <span class="count"><?php echo esc_html($products_query->found_posts); ?></span>
                                    </li>
                                <?php } ?>
                                <?php
                                if (!empty($settings['product_cat'])) {
                                    foreach ($category_list_value as $category) {
                                     
                                        $categoryName = get_term_by('slug', $category, 'product_cat');
                                        $get_category = get_term_by('id', $categoryName->term_id, 'product_cat');
                                        $get_cat       = isset( $_GET['category'] ) ? $_GET['category'] : '';
                                        $cat_name      = isset( $categoryName->name  ) ? strtolower($categoryName->name) : '';
                                        
                                        $active = '';
                                        if(  $get_cat == $cat_name ) {
                                            $active = 'active';
                                        }


                                        if ($get_category->count >= 10)  {
                                            $cat_count = $get_category->count;
                                        } else {
                                            $cat_count = "0" .$get_category->count;
                                        }

                                        if( isset( $categoryName->name ) ) {
                                ?>
                                            <li class="rbt-tab-link <?php echo esc_attr( $active ); ?>" data-filter2=".<?php echo esc_attr(strtolower($categoryName->slug)); ?>">
                                                <?php echo esc_html($categoryName->name); ?>
                                                <span class="count"><?php echo esc_html($cat_count); ?></span>
                                            </li>
                                <?php
                                        }
                                        
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


                                            // $categoryName = get_term_by('slug', $term, 'product_cat');
                                            $get_category = get_term_by('id', $term->term_id, 'product_cat');
                                            if ($get_category->count >= 10)  {
                                                $cat_count = $get_category->count;
                                            } else {
                                                $cat_count = "0" .$get_category->count;
                                            }
                                            $active = '';
                                            if ( empty( $settings['product_filter_all_button_label'] ) && $i == 1 ) {
                                                $active = 'active';
                                            }
                                            ?>
                                        <li class="rbt-tab-link <?php echo esc_attr( $active ); ?>" data-filter=".<?php echo esc_attr( strtolower( $term->slug ) ); ?>"><?php echo esc_html( ucwords( $term->name ) ); ?> <span class="count"><?php echo esc_html($cat_count); ?></span></li>
                                        <?php
                                       $i++; }
                                    }
                                } ?>
                                
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php } ?>
                <!-- tab content -->

                <!-- service 1 -->
                <?php

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
                            
                            $rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

                            if( $rainbowit_own_product_checkbox == 'yes' ) {

                                $envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
                                $envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);
                                $rating                         	= get_post_meta( get_the_ID(), '_wc_average_rating', true ); 
                                $review_count 					=  $product->get_review_count();

                            } else {

                                $envato_product_preview_url 	=  get_post_meta( get_the_ID(), '_envato_product_preview_url', true );
                                $envato_product_total_sales 	=  get_post_meta( get_the_ID(), '_envato_product_total_sales', true );
                                $rating 					    =  get_post_meta( get_the_ID(), '_envato_product_avg_rating', true );
                                $review_count 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true );
                            }

                            $tags = wp_get_post_terms($product->get_id(), 'product_tag');

                            if (!empty($tags) && isset($tags[0])) {
                                $tag = $tags[0];
                                $tag_link = get_term_link($tag);
                            }


                            $preview_btn_text 				=  isset( $rainbowit_options['preview_btn_text'] ) ? $rainbowit_options['preview_btn_text'] : '';
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
                                            <?php if (!empty($tags) && isset($tags[0])) { ?>
                                                <a  href="<?php echo esc_url( esc_url($tag_link) ); ?>" class="category"><?php echo esc_html( $tags[0]->name );?></a>
                                                <?php } ?>
                                            </div>
                                           <?php if( $rating > 0  ) { ?>
                                            <div class="review">
                                                    <?php if ( $rating ) : ?>
                                                    <?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $rating).'"><span style="width:'.( ( $rating / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$rating.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>'; ?>
                                                <?php endif; ?>
                                                <?php if( $rating > 0 ) { ?>
                                                <span class="rating-count">(<?php 
                                                    echo $review_count?>)
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
                    if ($settings['product_blog_pagination'] == 'yes' && '-1' != $posts_per_page) { ?>
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
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Product_Categories_Tab());