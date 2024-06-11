<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rainbowit
 */

$rainbowit_options          = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_socials          = Rainbowit_Helper::rainbow_socials();
$background_shape           = '';

if( empty($rainbowit_options['rainbowit_footer_shape_enable'] )){
    $background_shape = "footer-shape-enable";
}

$padding_top = 'pt--80';

if( empty($rainbowit_options['rainbowit_footer_enable']) ){
    $padding_top = '';
}

$subscribe_shortcode                = isset( $rainbowit_options['rainbowit_footer_subscribe_shortcode'] ) ? $rainbowit_options['rainbowit_footer_subscribe_shortcode'] : '';
$rainbowit_footer_subscribe_title   = isset( $rainbowit_options['rainbowit_footer_subscribe_title'] ) ? $rainbowit_options['rainbowit_footer_subscribe_title'] : '';

?>

<div class="rbt-footer-wrapper <?php echo esc_attr($padding_top);?>">
    <?php if(!empty($rainbowit_options['rainbowit_footer_enable'])){ ?>
    <div class="footer-light-shape"></div>
    <div class="container">
        <div class="rbt-footer-top">
            <div class="row row-gap-4 ">
                <div class="col-12 col-md-6">
                    <div class="rbt-section-title section-title-left mb--0">
                        <h3 class="title title-md text-white mb--0"><?php echo wp_kses_post( $rainbowit_footer_subscribe_title ); ?>
                        </h3>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <?php echo  do_shortcode( $subscribe_shortcode ); ?>
                </div>
            </div>
        </div>
        <div class="footer-content">
            <div class="row row--15">
            <?php if (is_active_sidebar('footer-1')) { ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-4 mb--40">
                    
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <?php } ?>
                <?php if (is_active_sidebar('footer-2')) { ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-2 mb--40">
                    
                        <?php dynamic_sidebar('footer-2'); ?>
                    
                </div>
                <?php } ?>
                <?php if (is_active_sidebar('footer-3')) { ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-2 mb--40">
                   
                        <?php dynamic_sidebar('footer-3'); ?>
                    
                </div>
                <?php } ?>
                <?php if (is_active_sidebar('footer-4')) { ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-2 mb--40">
                    
                        <?php dynamic_sidebar('footer-4'); ?>
                    
                </div>
                <?php } ?>
                <?php if (is_active_sidebar('footer-5')) { ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-2 mb--40">
                   
                    <?php dynamic_sidebar('footer-5'); ?>
                    
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="rbt-copyright-area <?php echo esc_attr($background_shape);?>" >
        <div class="container">
            <div class="rbt-copyright-content">
            <?php if ($rainbowit_socials && $rainbowit_options['rainbowit_footer_bottom_social_icons']) { ?>
                <ul class="rbt-social-media">
                <?php foreach ($rainbowit_socials as $rbsocial): ?>
                    <li>
                        <a class="social-icon rbt-btn rbt-btn-round-full hover-effect-1" href="<?php echo esc_url($rbsocial['url']); ?>">
                            <i class="<?php echo esc_attr($rbsocial['icon']); ?>"></i>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php } ?>
                <?php if(!empty($rainbowit_options['rainbowit_copyright_contact'])){ ?>
                <p class="copyright"><?php echo wp_kses_post($rainbowit_options['rainbowit_copyright_contact']); ?></p>
                <?php } ?>
                <?php if($rainbowit_options['rainbowit_scroll_to_top_enable'] != 'no'){ ?>
                <div class="rbt-progress-parent">
                        <span class="back-to-top">
                        <?php echo esc_html__("Back To Top","rainbowit"); ?>
                        <span><i class="fa-regular fa-circle-chevron-up"></i></span>
                        </span>
                    </div>
                
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- End main page -->
<?php wp_footer(); ?>
</body>
</html>
