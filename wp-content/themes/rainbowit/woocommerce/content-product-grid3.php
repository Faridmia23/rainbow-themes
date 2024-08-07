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
$rainbowit_options          		= Rainbowit_Helper::rainbowit_get_options();
$review_count 						=  $product->get_review_count();
$preview_btn_text 					=	isset( $rainbowit_options['preview_btn_text'] ) ? $rainbowit_options['preview_btn_text'] : '';
$envato_product_compatable_with 	=  get_post_meta( get_the_ID(), '_own_product_compatable_with', true);
$envato_product_column 				=  get_post_meta( get_the_ID(), '_onw_product_column', true);
$envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
$envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);
$product_documentation_link 		=  get_post_meta( get_the_ID(), '_onw_product_documentation_link', true);
$rating                         	= get_post_meta( get_the_ID(), '_wc_average_rating', true );  

$tags = wp_get_post_terms($product->get_id(), 'product_tag');

if (!empty($tags) && isset($tags[0])) {
    $tag = $tags[0];
    $tag_link = get_term_link($tag);
}

?>
<div <?php wc_product_class('col-12 col-md-6 col-xl-4 single-item mb--24', $product); ?>>
	<div class="rbt-card">
		<div>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('rainbowit-product-grid'); ?></a>
		</div>
		<div class="rbt-card-body p--24">
			<h3 class="title">
				<a href="<?php the_permalink(); ?>">

				<?php 
					if( isset( $title_length2 ) && !empty( $title_length2 ) ) { 
						echo wp_trim_words( get_the_title(), $title_length2,'... '); 
					} else {
						echo wp_trim_words( get_the_title(), '10','... '); 
					}
				?>
				</a>
			</h3>
			<div class="rbt-card-meta woocommerce">
				<?php if (!empty($tags) && isset($tags[0])) { ?>
				<a  href="<?php echo esc_url( esc_url($tag_link) ); ?>" class="category"><?php echo esc_html( $tags[0]->name );?></a>
				<?php } ?>
				<div class="review  woocommerce">
					<?php 
						woocommerce_template_loop_rating(); 
					?>
					<?php if( $rating > 0 ) { ?>
					<span class="rating-count">
						<?php echo esc_html( $rating ); ?>
						<span class="rbt-review-total">(Total<?php echo " ";?>
						<?php 
							echo do_shortcode( "[reviews_count id='".get_the_ID() ."']");
							?>)
						</span>
					</span>
					<?php } ?>
				</div>
				
			</div>
			<div class="rbt-card-bottom">
			<?php
				$regular_price = $product->get_regular_price();
				$sale_price = $product->get_sale_price();
				if ($regular_price > 0) {
				?>
					<div class="sales">

						<div class="price">
							<?php
							if (!empty($sale_price) &&  $sale_price > 0) {
								echo '<div class="off-price">' . wc_price($regular_price) . '</div>';
								echo '<div class="current-price">' . wc_price($sale_price) . '</div>';
							} else {
								if ($regular_price > 0) {

									echo '<div class="current-price">' . wc_price($regular_price) . '</div>';
								}
							}
							?>
						</div>

						<?php if (!empty($envato_product_total_sales)) { ?>
							<span class="sales-count"><?php echo esc_html($envato_product_total_sales); ?> <?php echo esc_html__("sales", "rainbowit"); ?></span>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="rbt-card-btn">
					<a href="<?php echo esc_url( $envato_product_preview_url );?>" target="_blank" class="rbt-btn rbt-btn-sm hover-effect-1 btn-border-secondary">
						<span><i class="fa-sharp fa-regular fa-eye"></i></span>
						<?php echo esc_html( $preview_btn_text ); ?>
					</a>
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>
		</div>
	</div>
</div>