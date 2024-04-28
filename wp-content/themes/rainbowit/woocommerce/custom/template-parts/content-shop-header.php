<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_shop_wrapper_class = ($rainbowit_options['wc_general_sidebar'] === 'no') || !is_active_sidebar( 'sidebar-shop' ) ? 'col-12':'col-lg-8 col-md-12 col-12';
$rainbowit_shop_single_wrapper_class = (isset($rainbowit_options['wc_single_sidebar']) && $rainbowit_options['wc_single_sidebar'] === 'no') || !is_active_sidebar( 'sidebar-shop' ) ? 'col-12':'col-lg-8 col-md-12 col-12';
?>
<div class="rainbowit-container rainbow-section-gap">
	<div class="container">
		<div class="row row--25">
            <!-- Left Sidebar here-->

            <?php if ( is_active_sidebar( 'sidebar-shop' ) && $rainbowit_options['wc_general_sidebar'] == 'left' && is_shop() ) { ?>
                <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                </div>
            <?php } ?>
            <?php if ( is_active_sidebar( 'sidebar-shop' ) && isset($rainbowit_options['wc_single_sidebar'])  && $rainbowit_options['wc_single_sidebar'] == 'left' && is_single()) { ?>
                <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                    <?php dynamic_sidebar('sidebar-shop'); ?>
                </div>
            <?php } ?>
            <?php if(is_shop()) { ?>
			<div class="<?php echo esc_attr($rainbowit_shop_wrapper_class); ?>">
            <?php } ?>
            <?php if(is_single()) { ?>
			<div class="<?php echo esc_attr($rainbowit_shop_single_wrapper_class); ?>">
            <?php } ?>
				<div class="rainbowit-container-content">