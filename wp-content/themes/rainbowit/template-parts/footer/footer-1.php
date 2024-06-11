<?php
/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options       = Rainbowit_Helper::rainbowit_get_options();
$footer_bottom_menu_args = Rainbowit_Helper::footer_bottom_menu_args();

?>
<footer class="rainbow-footer footer-style-default variation-two">
    <div class="rainbow-callto-action clltoaction-style-default style-7">
        <div class="container">
            <div class="row row--0 align-items-center content-wrapper">
                <div class="col-lg-8 col-md-8">
                    <div class="inner">
                        <div class="content text-left">

                            <div class="logo">
                                <?php get_template_part('template-parts/footer/footer-logo'); ?>
                            </div>

                            <?php if(!empty($rainbowit_options['cta_title'])){ ?>
                                <P class="subtitle"><?php echo esc_html($rainbowit_options['cta_title']) ?></P>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php if(!empty($rainbowit_options['cta_btn_title']) && !empty($rainbowit_options['cta_btn_url'])){ ?>
                <div class="col-lg-4 col-md-4">
                    <div class="call-to-btn text-left mt_sm--20 text-lg-right">
                        <a class="btn-default" href="<?php echo esc_url($rainbowit_options['cta_btn_url']) ?>">
                            <?php echo esc_html($rainbowit_options['cta_btn_title']) ?>
                        </a>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <?php if (is_active_sidebar('footer-1')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-2')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-3')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-4')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-5')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-5'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- Start Copy Right Area  -->
    <div class="copyright-area copyright-style-one">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8 col-sm-12 col-12">
                    <div class="copyright-left">
                        <?php if (has_nav_menu('footerbottom')) { ?>
                            <?php wp_nav_menu($footer_bottom_menu_args); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12 col-12">
                    <div class="copyright-right text-center text-lg-end">
                        <?php if(!empty($rainbowit_options['rainbowit_copyright_contact'])){ ?>
                            <p class="copyright-text"><?php echo wp_kses_post($rainbowit_options['rainbowit_copyright_contact']); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copy Right Area  -->
</footer>



