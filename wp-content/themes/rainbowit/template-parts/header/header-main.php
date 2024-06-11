<?php

/**
 * Template part for displaying main header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$rainbowit_options      = Rainbowit_Helper::rainbowit_get_options();
$header_layout          = Rainbowit_Helper::rainbowit_header_layout();
$header_area            = $header_layout['header_area'];
$mobile_logo            = isset($rainbowit_options['rainbowit_mobile_logo']['url']) ? $rainbowit_options['rainbowit_mobile_logo']['url'] : '';
$main_logo              = isset($rainbowit_options['rainbowit_head_logo']['url']) ? $rainbowit_options['rainbowit_head_logo']['url'] : '';
$large_logo             = isset($rainbowit_options['rainbowit_head_logo_large']['url']) ? $rainbowit_options['rainbowit_head_logo_large']['url'] : '';
$mobile_large_logo      = isset($rainbowit_options['rainbowit_mobile_large_logo']['url']) ? $rainbowit_options['rainbowit_mobile_large_logo']['url'] : '';


// Menu
$nav_menu_args      = Rainbowit_Helper::nav_menu_args();
$onepage_menu_args  = Rainbowit_Helper::onepage_menu_args();
$nav_menu           = rainbowit_get_acf_data("rainbowit_select_nav_menu");
$menu_type          = rainbowit_get_acf_data("rainbowit_menu_type");

$header_buttontext = isset($rainbowit_options['rainbowit_header_buttontext']) ? $rainbowit_options['rainbowit_header_buttontext'] : '';
$hire_us_btn_text  = isset($rainbowit_options['rainbowit_header_hire_us_btn_text']) ? $rainbowit_options['rainbowit_header_hire_us_btn_text'] : '';
$hire_us_buttonUrl = isset($rainbowit_options['rainbowit_header_hire_us_buttonUrl']) ? $rainbowit_options['rainbowit_header_hire_us_buttonUrl'] : '';
$select_menu        = $nav_menu_args;

$rainbowit_mobile_menu_args = Rainbowit_Helper::mobile_menu_args();

?>

<header class="rbt-header">
    <div class="rbt-header-wrapper">
        <div class="backdrop-shadow"></div>
        <div class="container">
            <div class="mainbar">
                <div class="header-left">
                    <div class="header-info">
                        <div class="logo d-none d-md-block">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php
                                if (get_custom_logo()) {
                                    the_custom_logo();
                                } elseif (!empty($rainbowit_options['rainbowit_head_logo']['url'])) { ?>
                                    <img class="logo-img" src="<?php echo esc_url($main_logo); ?>" srcset="<?php echo esc_url($large_logo); ?> 2x" alt="Rainbow Themes Logo">
                                    
                                <?php } else { ?>
                                    <img class="logo-img" src="<?php echo RAINBOWIT_IMG_URL; ?>/logo.png" srcset="<?php echo RAINBOWIT_IMG_URL; ?>/logo2x.png 2x" alt="Rainbow Themes Logo">
                                <?php }
                                ?>
                            </a>
                        </div>
                        <?php if(!empty($mobile_logo)) { ?>
                        <div class="logo d-md-none">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img class="logo-img" src="<?php echo esc_url($mobile_logo); ?>" srcset="<?php echo esc_url($mobile_large_logo); ?> 2x" alt="Rainbow Themes Logo">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="d-none d-xl-block">
                    <?php if (has_nav_menu('primary') || $nav_menu) {
                        // Start Mainmanu Nav
                        wp_nav_menu($select_menu);
                    } ?>
                </div>
                <?php if( isset($hire_us_buttonUrl) && !empty($hire_us_buttonUrl) ) { ?>
                <div class="header-right">
                    <div class="rbt-btn-group">
                        <?php 
                            if(is_user_logged_in() ) { ?>
                        <a class="nav-login-btn d-none d-xl-block" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <?php echo esc_html_e("Dashboard","rainbowit"); ?>
                        </a>
                           <?php } else {
                        ?>
                        <a class="nav-login-btn d-none d-xl-block" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <?php echo esc_html($header_buttontext); ?>
                        </a>
                        <?php } ?>
                        <a class="rbt-btn rbt-btn-dark rbt-btn-sm" href="<?php echo esc_url($hire_us_buttonUrl); ?>">
                            <i><img src="<?php echo RAINBOWIT_IMG_URL; ?>/hand.png" alt="Handshake icon"></i>
                            <?php echo esc_html($hire_us_btn_text); ?>
                        </a>
                        <div class="rbt-humberger d-xl-none">
                            <button class="hamberger-button" type="submit">
                                <i class="fa-regular fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</header>

<div class="popup-mobile-menu rbt-mobile-menu">
    <div class="inner-wrapper">
        <div class="inner-top">
            <div class="header-info justify-content-between ">
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img class="logo-img" src="<?php echo RAINBOWIT_IMG_URL; ?>/rbt-logo-icon.png" srcset="<?php echo RAINBOWIT_IMG_URL; ?>/rbt-logo-icon2x.png 2x" alt="Rainbow Themes Logo">
                    </a>
                </div>
                <div class="rbt-humberger d-xl-none">
                    <button class="hamberger-button close-menu-btn">
                        <i class="fa-regular fa-xmark"></i>
                    </button>
                </div>
            </div>
        </div>

        <?php if (has_nav_menu('primary') || $nav_menu) {
            // Start Mainmanu Nav
            wp_nav_menu($rainbowit_mobile_menu_args);
        } ?>

        <div class="mobile-menu-bottom">
            <div class="rbt-btn-group">
                <?php 
                    if(is_user_logged_in() ) { ?>
                        <a class="nav-login-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <?php echo esc_html_e("Dashboard","rainbowit"); ?>
                        </a>
                           <?php } else {
                        ?>
                        <a class="nav-login-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <?php echo esc_html($header_buttontext); ?>
                        </a>
                    <?php } ?>
                <a class="rbt-btn rbt-btn-dark rbt-btn-sm" href="<?php echo esc_url($hire_us_buttonUrl); ?>">
                    <i><img src="<?php echo RAINBOWIT_IMG_URL; ?>/hand.png" alt="Handshake icon"></i>
                    <?php echo esc_html($hire_us_btn_text); ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php
/**
 * Load Page Title Wrapper
 */
get_template_part('template-parts/title/title-wrapper');
