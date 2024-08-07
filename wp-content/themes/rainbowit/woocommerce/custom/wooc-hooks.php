<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */


/*-------------------------------------
#. Theme supports for WooCommerce
---------------------------------------*/
add_action('after_setup_theme', 'rainbowit_shop_support');

/* Breadcrumb */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/* Shop hide default page title */
add_filter('woocommerce_show_page_title', 'rainbowit_shop_hide_page_title');

/* Shop products per page */
add_filter('loop_shop_per_page', 'rainbowit_shop_loop_shop_per_page');

/* Shop/Archive Wrapper */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'rainbowit_shop_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'rainbowit_shop_wrapper_end', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/* Shop top tab */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'rainbowit_shop_shop_topbar', 20);

/* Shop loop */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_filter('loop_shop_columns', 'rainbowit_shop_loop_shop_columns');
add_action('woocommerce_before_shop_loop_item_title', 'rainbowit_shop_shop_thumb_area', 11);
add_action('woocommerce_before_shop_loop_item_title', 'rainbowit_shop_shop_info_wrap_start', 12);
add_action('woocommerce_after_shop_loop_item', 'rainbowit_shop_shop_info_wrap_end', 12);

/* Product */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/* Single Product */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'rainbowit_shop_render_sku', 15);
add_action('woocommerce_single_product_summary', 'rainbowit_shop_render_meta', 40);
add_action('init', 'rainbowit_shop_show_or_hide_related_products');

// Hide product data tabs
add_filter('woocommerce_product_tabs', 'rainbowit_shop_hide_product_data_tab');
add_filter('woocommerce_product_review_comment_form_args', 'rainbowit_shop_product_review_form');

/* Cart */
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');
add_action('init', 'rainbowit_shop_show_or_hide_cross_sells');



/* Change the breadcrumb separator */
add_filter( 'woocommerce_breadcrumb_defaults', 'rainbowit_change_breadcrumb_delimiter' );

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

