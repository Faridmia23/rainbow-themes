<?php
/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$footer_bottom_menu_args = Rainbowit_Helper::footer_bottom_menu_args();

?>
<footer class="rainbow-footer footer-style-default no-border">

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

    <div class="newsletter-area rainbow-newsletter-default">
        <div class="container">
            <div class="row row--0 newsletter-wrapper align-items-center border-top-bottom">
                <div class="col-lg-5">
                    <div class="newsletter-section-title">

                        <?php if(!empty($rainbowit_options['cta_pre_title'])){ ?>
                            <div class="subtitle mb--10"><span class="theme-gradient"><?php echo rainbowit_escaping($rainbowit_options['cta_pre_title']) ?></span></div>
                        <?php } ?>
                        <?php if(!empty($rainbowit_options['cta_title'])){ ?>
                            <h3 class="title"><?php echo rainbowit_escaping($rainbowit_options['cta_title']) ?></h3>
                        <?php } ?>
                        <?php if(!empty($rainbowit_options['cta_desc'])){ ?>
                            <p class="description"><?php echo rainbowit_escaping($rainbowit_options['cta_desc']) ?></p>
                        <?php } ?>

                    </div>
                </div>
                <?php if(!empty($rainbowit_options['cta_newsletter'])){ ?>
                    <div class="col-lg-7">
                        <div class="rainbow-newsletter-wrapper text-end">
                            <?php echo do_shortcode($rainbowit_options['cta_newsletter']) ?>
                        </div>
                    </div>
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



