<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package histudy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if (function_exists('wp_body_open')) {
     wp_body_open();
}
?>
<div class="rbt-progress-parent back-to-top-btn rbt-backto-top-active">
    <span class="d-md-none back-top-icon"></span>
    <!-- back to top button for large device -->
    <div class="back-to-top-text d-none d-md-block ">
        <?php echo esc_html__("Scroll to top","rainbowit"); ?>
    </div>
    <span class="d-none d-md-block back-top-bar">
        <svg xmlns="http://www.w3.org/2000/svg" width="2" height="82" viewBox="0 0 2 82" fill="none">
            <path d="M1 1L0.999997 75" stroke="#FF4551" stroke-width="2" stroke-linecap="round" />
            <path d="M1 1L0.999998 0" stroke="black" stroke-width="2" stroke-linecap="round" />
            <path d="M1 1L0.999998 0" stroke="url(#paint0_linear_3521_15)" stroke-width="2" stroke-linecap="round" />
            <defs>
                <linearGradient id="paint0_linear_3521_15" x1="0.855768" y1="1.13812" x2="-30.8219" y2="10.6861"
                    gradientUnits="userSpaceOnUse">
                    <stop  offset="1" stop-color="#FE2A5E" />
                    <stop offset="1" stop-color="#FFA61B" />
                </linearGradient>
            </defs>
        </svg>
    </span>
</div>
    <?php get_template_part('template-parts/header/header', 'main'); ?>