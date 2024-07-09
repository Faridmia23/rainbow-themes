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
$rainbowit_options          	=  Rainbowit_Helper::rainbowit_get_options();

$rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

if( $rainbowit_own_product_checkbox == 'yes' ) {

	$envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
	$envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);
	$rating                         	= get_post_meta( get_the_ID(), '_wc_average_rating', true ); 
	$review_count 					=  $product->get_review_count();

} else {

	$envato_product_preview_url 	=  get_post_meta( $post->ID, '_envato_product_preview_url', true );
	$envato_product_total_sales 	=  get_post_meta( $post->ID, '_envato_product_total_sales', true );
	$rating 					    =  get_post_meta( $post->ID, '_envato_product_avg_rating', true );
	$review_count 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true );
}

$tags = wp_get_post_terms($product->get_id(), 'product_tag');

if (!empty($tags) && isset($tags[0])) {
	$tag = $tags[0];
	$tag_link = get_term_link($tag);
}

$preview_btn_text 				=  isset( $rainbowit_options['preview_btn_text'] ) ? $rainbowit_options['preview_btn_text'] : '';

?>

<div <?php wc_product_class('col-12 col-md-6 col-xl-4 single-item mb--24', $product); ?>>
	<div class="rbt-card">
		<div>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
		<div class="rbt-card-body p--24">
			<h3 class="title">
				<a href="<?php the_permalink(); ?>">
				<?php 
					the_title();
				?>
				</a>
			</h3>
			<div class="rbt-card-meta woocommerce">
				<?php if (!empty($tags) && isset($tags[0])) { ?>
				<a  href="<?php echo esc_url( esc_url($tag_link) ); ?>" class="category"><?php echo esc_html( $tags[0]->name );?></a>
				<?php } 
				if( $rating > 0  ) { ?>
				<div class="review">
						<?php if ( $rating ) : ?>
						<?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $rating).'"><span style="width:'.( ( $rating / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$rating.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>'; ?>
					<?php endif; ?>
					
					
					<?php if( $rating > 0 ) { ?>
					<span class="rating-count">(<?php 
						echo $review_count?>)
					</span>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>