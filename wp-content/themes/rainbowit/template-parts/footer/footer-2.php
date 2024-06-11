<?php
/**
 * Template part for displaying footer layout Two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options          = Rainbowit_Helper::rainbowit_get_options();
$footer_bottom_menu_args    = Rainbowit_Helper::footer_bottom_menu_args();
$rainbowit_socials          = Rainbowit_Helper::rainbow_socials();
?>

<footer class="rainbow-footer footer-style-default variation-two footer-style-two">
    <div class="copyright-area copyright-style-one variation-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-7 col-sm-12 col-12">
                    <div class="copyright-left">
                        <?php if (has_nav_menu('footerbottom')) { ?>
                            <?php wp_nav_menu($footer_bottom_menu_args); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 mt_sm--20">
                    <?php if ($rainbowit_socials && $rainbowit_options['rainbowit_footer_bottom_social_icons']): ?>
                        <div class="copyright-center text-center">
                            <ul class="social-icon social-default color-lessdark justify-content-center">
                                <?php foreach ($rainbowit_socials as $rbsocial): ?>
                                    <li><a target="_blank" href="<?php echo esc_url($rbsocial['url']); ?>" title="<?php echo esc_attr($rbsocial['title']); ?>"><i
                                                    class="<?php echo esc_attr($rbsocial['icon']); ?>"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 mt_md--20 mt_sm--20">
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