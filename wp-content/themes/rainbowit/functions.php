<?php

/**
 * Rainbowit functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rainbowit
 */
define('RAINBOWIT_THEME_URI', get_template_directory_uri());
define('RAINBOWIT_THEME_DIR', get_template_directory());
define('RAINBOWIT_CSS_URL', get_template_directory_uri() . '/assets/css/');
define('RAINBOWIT_JS_URL', get_template_directory_uri() . '/assets/js/');
define('RAINBOWIT_FREAMWORK_DIRECTORY', RAINBOWIT_THEME_DIR . '/inc/');
define('RAINBOWIT_FREAMWORK_HELPER', RAINBOWIT_THEME_DIR . '/inc/helper/');
define('RAINBOWIT_FREAMWORK_OPTIONS', RAINBOWIT_THEME_DIR . '/inc/options/');
define('RAINBOWIT_FREAMWORK_CUSTOMIZER', RAINBOWIT_THEME_DIR . '/inc/customizer/');
define('RAINBOWIT_THEME_PREFIX', 'rainbowit');
define('RAINBOWIT_WIDGET_PREFIX', 'rainbowit');
define('RAINBOWIT_FREAMWORK_LAB', RAINBOWIT_THEME_DIR . '/inc/lab/');
define('RAINBOWIT_FREAMWORK_TP', RAINBOWIT_THEME_DIR . '/template-parts/');
define('RAINBOWIT_IMG_URL', RAINBOWIT_THEME_URI . '/assets/images/');
define('RAINBOWIT_WOOCMMERCE', RAINBOWIT_THEME_DIR . '/woocommerce/custom/');


$rainbowit_theme_data = wp_get_theme();
define('RAINBOWIT_VERSION', (WP_DEBUG) ? time() : $rainbowit_theme_data->get('Version'));


if (!function_exists('rainbowit_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function rainbowit_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on rainbowit, use a find and replace
         * to change 'rainbowit' to the name of your theme in all the template files.
         */
        load_theme_textdomain('rainbowit', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'rainbowit'),
            'footerbottom' => esc_html__('Footer Bottom Menu (No depth supported)', 'rainbowit'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        $defaults = array(
            'height'               => 100,
            'width'                => 400,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array('site-title', 'site-description'),
            'unlink-homepage-logo' => true,
        );
        add_theme_support('custom-logo', $defaults);

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Post Format
         */
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));


        add_theme_support('responsive-embeds');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Fonts Support for block editor
        add_editor_style(array('style-editor.css', rainbowit_fonts_url()));

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Enqueue editor styles.
        add_editor_style('style-editor.css');

        add_theme_support('editor-color-palette', array(
            array(
                'name' => esc_html__('primary', 'rainbowit'),
                'slug' => 'primary',
                'color' => '#f9004d',
            ),
            array(
                'name' => esc_html__('Secondary', 'rainbowit'),
                'slug' => 'secondary',
                'color' => '#00D09C',
            ),
            array(
                'name' => esc_html__('Dark', 'rainbowit'),
                'slug' => 'dark',
                'color' => '#1f1f25',
            ),
            array(
                'name' => esc_html__('Gray', 'rainbowit'),
                'slug' => 'gray',
                'color' => '#717173',
            ),
            array(
                'name' => esc_html__('Light', 'rainbowit'),
                'slug' => 'light',
                'color' => '#f8f9fc',
            ),
            array(
                'name' => esc_html__('White', 'rainbowit'),
                'slug' => 'white',
                'color' => '#ffffff',
            ),
        ));

        add_theme_support('editor-font-sizes', array(
            array(
                'name' => esc_html__('Small', 'rainbowit'),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__('Normal', 'rainbowit'),
                'size' => 16,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__('Large', 'rainbowit'),
                'size' => 36,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__('Huge', 'rainbowit'),
                'size' => 50,
                'slug' => 'huge'
            )
        ));

        /**
         * Add Custom Image Size
         */
        add_image_size('rainbowit-thumbnail-sm', 407, 304, true);
        add_image_size('rainbowit-thumbnail-md', 627, 469, true);
        add_image_size('rainbowit-thumbnail-lg', 830, 430, true);
        add_image_size('rainbowit-thumbnail-portrait', 700, 1000, true);
        add_image_size('rainbowit-thumbnail-single', 1270, 950, true);
    }
endif;
add_action('after_setup_theme', 'rainbowit_setup');




add_filter('image_size_names_choose', 'rainbowit_new_image_sizes');
if (!function_exists('rainbowit_new_image_sizes')) {
    /**
     * Image Size Name Choose
     *
     * @param $sizes
     * @return array
     */
    function rainbowit_new_image_sizes($sizes)
    {
        return array_merge($sizes, array(
            'rainbowit-thumbnail-sm' => esc_html__('Thumbnail Small - (407x304)', 'rainbowit'),
            'rainbowit-thumbnail-md' => esc_html__('Thumbnail Medium - (627x469)', 'rainbowit'),
            'rainbowit-thumbnail-lg' => esc_html__('Thumbnail large - (791x420)', 'rainbowit'),
            'rainbowit-thumbnail-portrait' => esc_html__('Thumbnail Portrait - (700X1000)', 'rainbowit'),
            'rainbowit-thumbnail-single' => esc_html__('Thumbnail Single - (1270x950)', 'rainbowit'),
        ));
    }
}



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rainbowit_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('rainbowit_content_width', 640);
}

add_action('after_setup_theme', 'rainbowit_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
require_once(RAINBOWIT_FREAMWORK_DIRECTORY . 'scripts.php');
/**
 * Global Functions
 */
require_once(RAINBOWIT_FREAMWORK_DIRECTORY . 'global-functions.php');

/**
 * Register Custom Widget Area
 */
require_once(RAINBOWIT_FREAMWORK_DIRECTORY . 'widget-area-register.php');

/**
 * Register Custom Fonts
 */
require_once(RAINBOWIT_FREAMWORK_DIRECTORY . 'register-custom-fonts.php');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/underscore/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/underscore/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/underscore/customizer.php';
// woo others




/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/underscore/jetpack.php';
}


/**
 * Rainbowit_Helper Template
 */
require_once(RAINBOWIT_FREAMWORK_HELPER . 'menu-area-trait.php');
require_once(RAINBOWIT_FREAMWORK_HELPER . 'layout-trait.php');
require_once(RAINBOWIT_FREAMWORK_HELPER . 'option-trait.php');
require_once(RAINBOWIT_FREAMWORK_HELPER . 'meta-trait.php');
require_once(RAINBOWIT_FREAMWORK_HELPER . 'title-trait.php');
require_once(RAINBOWIT_FREAMWORK_HELPER . 'social-trait.php');
// Rainbowit_Helper
require_once(RAINBOWIT_FREAMWORK_HELPER . 'helper.php');

/**
 * Options
 */
require_once(RAINBOWIT_FREAMWORK_OPTIONS . 'theme/option-framework.php');
require_once(RAINBOWIT_FREAMWORK_OPTIONS . 'menu-options.php');
require_once(RAINBOWIT_FREAMWORK_OPTIONS . 'page-options.php');
require_once(RAINBOWIT_FREAMWORK_OPTIONS . 'post-format-options.php');
require_once(RAINBOWIT_FREAMWORK_OPTIONS . 'user-extra-meta.php');


// -- Nav Walker
require_once(RAINBOWIT_FREAMWORK_LAB . 'nav-menu-walker.php');
require_once(RAINBOWIT_FREAMWORK_LAB . 'mobile-menu-walker.php');
require_once(RAINBOWIT_FREAMWORK_LAB . 'onepage-nav-menu-walker.php');
require_once(RAINBOWIT_FREAMWORK_LAB . 'footer-menu-walker.php');
require_once(RAINBOWIT_FREAMWORK_TP . 'title/breadcrumb.php');


// WooCommerce
if (class_exists('WooCommerce')) {
    require_once(RAINBOWIT_WOOCMMERCE . "wooc-functions.php");
    require_once(RAINBOWIT_WOOCMMERCE . "wooc-hooks.php");
    require_once(RAINBOWIT_WOOCMMERCE . "woo-single.php");
}

// Elementor template library function
function get_elementor_template_library()
{

    $posts_args = get_posts(array(
        'post_type' => 'elementor_library',
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));

    $posts[0] = "Select Template";

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}

function redirect_empty_cart_to_shop()
{
    if (is_cart() && WC()->cart->is_empty()) {
        wp_safe_redirect(wc_get_page_permalink('shop'));
        exit;
    }
}

add_action('template_redirect', 'redirect_empty_cart_to_shop');

function exclude_plan_products_from_shop($query)
{
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
        $meta_query = $query->get('meta_query');

        if (empty($meta_query)) {
            $meta_query = array();
        }

        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => 'plan_product_enable',
                'value'   => 'enable',
                'compare' => '!='
            ),
            array(
                'key'     => 'plan_product_enable',
                'compare' => 'NOT EXISTS'
            )
        );

        $query->set('meta_query', $meta_query);
    }
}


add_action('pre_get_posts', 'exclude_plan_products_from_shop');


//short code to get the woocommerce recently viewed products
function custom_track_product_view()
{
    if (!is_singular('product')) {
        return;
    }

    global $post;

    if (empty($_COOKIE['woocommerce_recently_viewed']))
        $viewed_products = array();
    else
        $viewed_products = (array) explode('|', $_COOKIE['woocommerce_recently_viewed']);

    if (!in_array($post->ID, $viewed_products)) {
        $viewed_products[] = $post->ID;
    }

    if (sizeof($viewed_products) > 15) {
        array_shift($viewed_products);
    }

    // Store for session only
    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}

/**
 * Recently viewed  product functionality
 * 
 * This will work for when view product
 * 
 * @since
 * @return void
 */

add_action('template_redirect', 'custom_track_product_view', 20);
function rc_woocommerce_recently_viewed_products($atts, $content = null)
{
    global $post;
    // Get shortcode parameters
    extract(shortcode_atts(array(
        "per_page" => '5'
    ), $atts));

    // Get WooCommerce Global
    global $woocommerce;
    // Get recently viewed product cookies data
    $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();
    $viewed_products = array_filter(array_map('absint', $viewed_products));

    // If no data, quit
    if (empty($viewed_products))
        return __('You have not viewed any product yet!', 'rc_wc_rvp');
    // Create the object
    ob_start();

    // Get products per page
    if (!isset($per_page) ? $number = 5 : $number = $per_page)
        // Create query arguments array
        $query_args = array(
            'posts_per_page' => $number,
            'no_found_rows'  => 1,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'post__in'       => $viewed_products,
            'orderby'        => 'rand'
        );

        // Add meta_query to query args
        $query_args['meta_query'] = array();

        // Check products stock status
        $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

        // Create a new query
        $query_post = new WP_Query($query_args);

        // ----
        if (empty($query_post)) {
            return __('You have not viewed any product yet!', 'rainbowit');
        }


        while ($query_post->have_posts()) : $query_post->the_post();
            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

            $located = locate_template('woocommerce/content-product-grid4.php', false, false);
            if ($located) {
                include($located);
            }
        // end html loop  
        endwhile;

        wp_reset_postdata();
        // ----
        // Get clean object
        $content .= ob_get_clean();
        // Return whole content
        return $content;
    }
    // Register the shortcode
    add_shortcode("woocommerce_recently_viewed_products", "rc_woocommerce_recently_viewed_products");


    function rtb_wc_refresh_mini_cart_count($fragments)
    {
        ob_start();
        
    ?>
       <span class="rbt-cart-count">
            <?php echo WC()->cart->get_cart_contents_count(); ?>
       </span>
    <?php
        $fragments['.rbt-cart-count'] = ob_get_clean();
        return $fragments;
    }
    add_filter('woocommerce_add_to_cart_fragments', 'rtb_wc_refresh_mini_cart_count');
