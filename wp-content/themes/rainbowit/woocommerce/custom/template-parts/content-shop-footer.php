<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
?>
				
				</div>
			</div>
            <?php if ( is_active_sidebar( 'sidebar-shop' ) && $rainbowit_options['wc_general_sidebar'] == 'right' && is_shop() ) { ?>
                <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                </div>
            <?php } ?>
            <?php if ( is_active_sidebar( 'sidebar-shop' ) && isset($rainbowit_options['wc_single_sidebar']) && $rainbowit_options['wc_single_sidebar']== 'right' && is_single() ) { ?>
                <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                </div>
            <?php } ?>
		</div>
	</div>
</div>