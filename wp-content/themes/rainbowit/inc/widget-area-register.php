<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if(!function_exists('rainbowit_widgets_init')){

    /**
     * Widget area initialization function
     *
     * @return void
     */
    function rainbowit_widgets_init() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'rainbowit'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'rainbowit'),
            'before_widget' => '<div id="%1$s" class="rbt-single-widget %2$s mb--30 mb_sm--20 mb_md--30 mb_lg--30">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="title mb--20">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Blog Single Left Sidebar', 'rainbowit'),
            'id' => 'blog-single-left-sidebar',
            'description' => esc_html__('Add widgets here.', 'rainbowit'),
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="sidebar-title">',
            'after_title' => '</h6>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Blog Single Right Sidebar', 'rainbowit'),
            'id' => 'blog-single-right-sidebar',
            'description' => esc_html__('Add widgets here.', 'rainbowit'),
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h6 class="sidebar-title">',
            'after_title' => '</h6>',
        ));

        if ( class_exists( 'WooCommerce' ) ) {
            register_sidebar(array(
                'name' => esc_html__('Shop Sidebar', 'rainbowit'),
                'id' => 'sidebar-shop',
                'description' => esc_html__('Add widgets here.', 'rainbowit'),
                'before_widget' => '<div id="%1$s" class="rbt-single-widget %2$s mt--50 mt_sm--30 mt_md--30 mt_lg--40">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title mb--20">',
                'after_title' => '</h4>',
            ));
        }

        $number_of_widget 	= 5;
        $rainbowit_widget_titles = array(
            '1' => esc_html__( 'Footer Widget Area 1', 'rainbowit' ),
            '2' => esc_html__( 'Footer Widget Area 2', 'rainbowit' ),
            '3' => esc_html__( 'Footer Widget Area 3', 'rainbowit' ),
            '4' => esc_html__( 'Footer Widget Area 4', 'rainbowit' ),
            '5' => esc_html__( 'Footer Widget Area 5', 'rainbowit' ),
        );
        for ( $i = 1; $i <= $number_of_widget; $i++ ) {
            register_sidebar( array(
                'name'          => $rainbowit_widget_titles[$i],
                'id'            => 'footer-'. $i,
                'before_widget' => '<div id="%1$s" class="rainbow-footer-widget widget %2$s"><div class="inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h6 class="rbt-col-title">',
                'after_title'   => '</h6>',
            ) );
        }
    }

}
add_action( 'widgets_init', 'rainbowit_widgets_init' );
