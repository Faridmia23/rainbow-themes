<?php
/**
 * Template part for displaying footer layout Seven
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
?>

<footer class="rainbow-footer footer-style-default variation-two footer-style-two">
    <div class="copyright-area copyright-style-one variation-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="copyright-right text-center text-lg-right">
                        <?php if(!empty($rainbowit_options['rainbowit_copyright_contact'])){ ?>
                            <p class="copyright-text"><?php echo wp_kses_post($rainbowit_options['rainbowit_copyright_contact']); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>