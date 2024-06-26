<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rainbowit
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rainbowit_body_classes( $classes ) {

    $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

    $service_product_checkbox = get_post_meta(get_the_ID(), "rainbowit_service_product_checkbox", true);

    if( $service_product_checkbox == 'yes' ) {
        $classes[] = 'service-single-product';
    }


    // Scroll to top
    $classes[] = ($rainbowit_options['rainbowit_scroll_to_top_enable'] != 'no') ? "active-scroll-to-top" : "";
    $classes[] = ($rainbowit_options['rainbowit_preloader'] != 'no') ? "active-preloader" : "";
    $classes[] = isset($rainbowit_options['base_theme_css']) == '0' ? " base-theme-css" : "";

    $menu_type = rainbowit_get_acf_data( "rainbowit_menu_type");
    
    if ($menu_type){
        $classes[] = ($menu_type == 'onepage') ? "spybody rainbowit-active-onepage-navigation" : "";
    }

	return $classes;
}


add_filter( 'body_class', 'rainbowit_body_classes' );



/**
 * Get unique ID.
 */
function rainbowit_unique_id($prefix = '')
{
    static $id_counter = 0;
    if (function_exists('wp_unique_id')) {
        return wp_unique_id($prefix);
    }
    return $prefix . (string)++$id_counter;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function rainbowit_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action('wp_head', 'rainbowit_pingback_header');

/**
 * Comment navigation
 */
function rainbowit_get_post_navigation()
{
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
        require(get_template_directory() . '/inc/comment-nav.php');
    endif;
}
require get_template_directory() . '/inc/comment-form.php';
