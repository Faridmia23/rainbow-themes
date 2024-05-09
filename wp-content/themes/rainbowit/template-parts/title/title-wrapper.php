<?php
/**
 * Template part for displaying header page title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$banner_layout = Rainbowit_Helper::rainbowit_banner_layout();
$banner_area = $banner_layout['banner_area'];
$banner_style = $banner_layout['banner_style'];
$rainbowit_title_wrapper_show = rainbowit_get_acf_data("rainbowit_title_wrapper_show");
global $product;

if ( is_home() ) {
    get_template_part('/template-parts/title/blog-title');
} elseif( is_search() ) {
   get_template_part('/template-parts/title/blog-title');
} elseif( !is_front_page() && is_page() ) {
    if ("no" !== $rainbowit_title_wrapper_show && "0" !== $rainbowit_title_wrapper_show) {
        get_template_part('/template-parts/title/layout', $banner_style);
    }
} elseif(is_archive()) {
    get_template_part('/template-parts/title/blog-title');
} elseif( is_product() && ! $product->is_type('external') ) {
     get_template_part('/template-parts/title/single-post-title');
} else {
    // Nothing
}