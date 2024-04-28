<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
global $post;
$enable_envato_product 			=  get_post_meta( $post->ID, '_enable_envato_product', true );
$envato_product 				=  get_post_meta( $post->ID, '_envato_product_in_stores', true );
$envato_product_price 			=  get_post_meta( $post->ID, '_envato_product_price', true );
$envato_product_preview_url 	= get_post_meta( $post->ID, '_envato_product_preview_url', true );
$envatoproduct_template_type 	=  get_post_meta( $post->ID, '_envato_product_template_type', true );
$review_count = $product->get_review_count();

?>
<div <?php wc_product_class('col-12 col-md-6 col-xl-6 single-item mb--24', $product); ?> data-sal="slide-up" data-sal-duration="400">
<div class="rbt-card">

		<div>
		<a href="<?php the_permalink(); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
		</div>
		<div class="rbt-card-body p--24">
			<h3 class="title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="rbt-card-meta woocommerce">
				<?php if( isset( $envatoproduct_template_type ) && !empty( $envatoproduct_template_type ) ) { ?>
				<a  class="category"><?php echo esc_html( $envatoproduct_template_type );?></a>
				<?php } ?>
				<?php woocommerce_template_loop_rating(); ?>
			</div>
			<div class="rbt-card-bottom">
				<div class="sales">
					<?php woocommerce_template_loop_price(); ?>
					<span class="sales-count">62 Sales</span>
				</div>
				<div class="rbt-card-btn">
					<a href="<?php echo esc_url( $envato_product_preview_url );?>" target="_blank" class="rbt-btn rbt-btn-sm hover-effect-1 btn-border-secondary">
						<span><i class="fa-sharp fa-regular fa-eye"></i></span>
						<?php echo esc_html__("live preview","rainbowit"); ?>
					</a>
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
		</div>
	</div>
</div>