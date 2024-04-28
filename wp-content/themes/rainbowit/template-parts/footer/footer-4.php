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
<footer class="rainbow-footer footer-style-default variation-two footer-style-two">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <?php if (is_active_sidebar('footer-1')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-2')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-3')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div><!-- End Single Widget -->
                <?php } ?>

                <?php if (is_active_sidebar('footer-4')) { ?>
                    <!-- Start Single Widget -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <?php dynamic_sidebar('footer-4'); ?>
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



