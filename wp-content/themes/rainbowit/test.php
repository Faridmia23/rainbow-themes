<?php 
add_action('woocommerce_after_single_product_summary', 'rainbowit_related_after_single_product_summary', 10);

			function rainbowit_related_after_single_product_summary()
			{
	?>
		<?php
				global $product;
				$related = wc_get_related_products($product->get_id());
		?>
		<?php
				if (count($related) > 0) {
		?>
			<div class="related-product">
				<div class="sec-title style-two centred">
					<h4><?php esc_html_e('Related Products', 'rainbowit'); ?></h4>
				</div>
				<div class="row clearfix">
					<?php //rainbowit_output_related_products(); ?>
				</div>
			</div>
		<?php } ?>

	<?php
			}

			add_filter('woocommerce_output_related_products', 'rainbowit_output_related_products', 10, 1);

			function rainbowit_output_related_products()
			{
				global $product;

				$related_products = array_filter(array_map('wc_get_product', wc_get_related_products($product->get_id(), 4, $product->get_upsell_ids())), 'wc_products_array_filter_visible');
	?>
		<?php foreach ($related_products as $related_product) : ?>
			<div class="col-lg-3 col-md-6 col-sm-12 product-block">
				<?php
					$post_object = get_post($related_product->get_id());

					setup_postdata($GLOBALS['post'] = &$post_object);

					//wc_get_template_part('content', 'relproduct');
				?>
			</div>
		<?php endforeach; ?>

	<?php
			}