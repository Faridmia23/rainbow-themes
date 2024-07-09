<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

$unique_id = esc_attr(rainbowit_unique_id('header-search-'));

$post_type = get_post_type();

if ('post' !== $post_type) {
    $post_type = 'product';
}
$post_args = wp_count_posts($post_type);
$published_post = isset($post_args->publish) ? $post_args->publish : 0;

$rainbow_search_courses_title = "Showing Results for " . $post_type;

$rainbowit_options      = Rainbowit_Helper::rainbowit_get_options();
$product_perpage        = isset($rainbowit_options['product_perpage']) ? $rainbowit_options['product_perpage'] : '';
$product_grid_type      = isset($rainbowit_options['product_grid_type']) ? $rainbowit_options['product_grid_type'] : '';
$product_order          = isset($rainbowit_options['product_order']) ? $rainbowit_options['product_order'] : '';
$product_orderby        = isset($rainbowit_options['product_order']) ? $rainbowit_options['product_orderby'] : '';
$popular_product_title        = isset($rainbowit_options['popular_product_title']) ? $rainbowit_options['popular_product_title'] : '';


$viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
$viewed_products = array_filter(array_map('absint', $viewed_products));

$notview_product = '';
if( empty( $viewed_products ) ) {
    $notview_product = 'no-view-product';
}

?>
<!-- Start Search Dropdown  -->
<div class="rbt-search-dropdown">
    <div class="ajax-search-close-icon">
        <a class="search-trigger-close-icon rbt-round-btn" href="#">
            <i class="feather-search"></i>
        </a>
    </div>

    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <form class="ajax_search_rainbowit_product" id="<?php echo esc_attr($unique_id); ?>" action="<?php echo esc_url(home_url('/')); ?>" method="GET">
                    <button type="submit" class="search-button"><i class="rbt feather-search"></i></button>
                    <input type="text" data-post_type="<?php echo esc_attr($post_type); ?>" name="s" placeholder="What are you looking for?" value="<?php echo esc_html(get_search_query(false)); ?>">
                </form>
            </div>
        </div>

        <div class="rbt-separator-mid">
            <hr class="rbt-separator m-0">
        </div>
        <div class="rbt-search-all-product">
            <div class='rbt-no-search-results-found' style="display:none;"></div>
            <div class="section-title pt--30">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="rbt-title-style-2 rainbowit-search-title"><?php echo esc_html($popular_product_title );?></h5>
                    </div>
                </div>
            </div>
            <div class="row row--12 popular-product-items g-4 pb--10 rainbow-header-popular-item-ajax <?php echo esc_attr( $notview_product ); ?>">

                <?php

                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => $product_perpage,
                    'orderby' => $product_orderby,
                    'order' => $product_order,
                    'ignore_sticky_posts' => true
                );

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

                $query = new \WP_Query($args);

                if( $query->have_posts() ) {
                    
                    while($query->have_posts()) {
                        $query->the_post();
                    
                        $located = locate_template('woocommerce/content-product-grid4.php', false, false);
                        if ($located) {
                            include($located);
                        }

                        $product_ids = get_the_ID();

                    }

                    wp_reset_postdata();
                    
                } else {
                    echo 'No Product Found';
                }

                ?>

            </div>

        <?php 
                $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
                $viewed_products = array_filter(array_map('absint', $viewed_products));
            
                // If no data, quit
                if (!empty($viewed_products)) {
        ?>

            <div class="section-title recently-viewed-product-title">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="rbt-title-style-2">Recently Viewed</h5>
                    </div>
                </div>
            </div>
            <div class="row row--12 popular-product-items g-4  pb--15 recently-viewed-product">
                <?php 
                echo do_shortcode('[woocommerce_recently_viewed_products]');
                ?>
            </div>
        <?php } ?>
       </div>
    </div>
</div>
<!-- End Search Dropdown  -->