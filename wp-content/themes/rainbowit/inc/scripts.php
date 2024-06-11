<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rainbowit
 */


if (!function_exists('rainbowit_scripts')){
    /**
     * Enqueue scripts and styles.
     */
    function rainbowit_scripts() {

        wp_deregister_style('font-awesome');

        // Fonts
        wp_enqueue_style('rainbowit-fonts', rainbowit_fonts_url());

       
        wp_enqueue_style( 'bootstrap', RAINBOWIT_CSS_URL . 'vendor/bootstrap.min.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'bootstrap-select', RAINBOWIT_CSS_URL . 'vendor/bootstrap-select.min.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'swiper-bundle', RAINBOWIT_CSS_URL . 'plugins/swiper-bundle.min.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'fontawesome-all', RAINBOWIT_CSS_URL . 'plugins/fontawesome-all.min.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'odometer-theme-train-station', RAINBOWIT_CSS_URL . 'plugins/odometer-theme-train-station.min.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'sal', RAINBOWIT_CSS_URL . 'plugins/sal.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'rainbowit-woocommerce', RAINBOWIT_CSS_URL . 'woocommerce.css', array(), RAINBOWIT_VERSION );
        wp_enqueue_style( 'rainbowit-main-style', RAINBOWIT_CSS_URL . 'style.css', array(), RAINBOWIT_VERSION );
        
        wp_enqueue_style('rainbowit-style', get_stylesheet_uri() );
        wp_style_add_data( 'rainbowit-style', 'rtl', 'replace' );
        
        // Scripts
        wp_enqueue_script('modernizr', RAINBOWIT_JS_URL . 'vendor/modernizr.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('bootstrap', RAINBOWIT_JS_URL . 'vendor/bootstrap.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('backtotop', RAINBOWIT_JS_URL . 'vendor/backtotop.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('jquery-appear', RAINBOWIT_JS_URL . 'vendor/jquery-appear.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('odometer', RAINBOWIT_JS_URL . 'vendor/odometer.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('imagesloaded-pkgd', RAINBOWIT_JS_URL . 'vendor/imagesloaded.pkgd.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('isotope-pkgd', RAINBOWIT_JS_URL . 'vendor/isotope.pkgd.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('masonry-pkgd', RAINBOWIT_JS_URL . 'vendor/masonry.pkgd.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('swiper-bundle', RAINBOWIT_JS_URL . 'vendor/swiper-bundle.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('jquery-one-page-nav', RAINBOWIT_JS_URL . 'vendor/jquery-one-page-nav.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('paralax-scroll', RAINBOWIT_JS_URL . 'vendor/paralax-scroll.js', array('jquery'), time(), true);
        wp_enqueue_script('bootstrap-select', RAINBOWIT_JS_URL . 'vendor/bootstrap-select.min.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('jquery-serialshuffle', RAINBOWIT_JS_URL . 'vendor/jquery.serialshuffle.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('sal', RAINBOWIT_JS_URL . 'vendor/sal.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('text-type', RAINBOWIT_JS_URL . 'vendor/text-type.js', array('jquery'), RAINBOWIT_VERSION, true);
        wp_enqueue_script('rainbowit-main', RAINBOWIT_JS_URL . 'main.js', array('jquery'), time(), true);
        wp_enqueue_script('rainbowit-has-elementor', RAINBOWIT_JS_URL . 'has-elementor.js', array('jquery'), RAINBOWIT_VERSION, true);

       


        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'rainbowit_scripts' ); 




?>