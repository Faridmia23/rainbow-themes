<?php

add_filter('woocommerce_product_data_tabs', 'envato_product_tab');

function envato_product_tab($tabs)
{

	$tabs['service_product'] = array(
		'label'	 => __('Service Product', 'rainbowit'),
		'target' => 'service_product_options',
		'class'  => ('show_if_simple_product hide_if_external'),
	);

	return $tabs;
}

add_action('woocommerce_product_options_external', 'rainbowit_options_product_tab_content');

function rainbowit_options_product_tab_content()
{

	// Dont forget to change the id in the div with your target of your product tab
	global $post;
	$envato_product = (array) get_post_meta($post->ID, '_envato_product_in_stores', true);
?>
	<input type="hidden" name="product_other_info">
	<div class='options_group'>
		<?php
		/**
		 * Fetch Products from Envato
		 * 
		 * @since 1.0.0
		 * 
		 * @return void
		 */
		// Set your Envato API token
		$apiToken = 'AxNy23RTmWIlDXO3E0Cad6075IHpEciQ';
		$page = 1;
		$page_size = 100;
		$products = wp_remote_get('https://api.envato.com/v1/discovery/search/search/item?site=themeforest.net&username=rainbow-themes', array(
			'headers' => array(
				'timeout' => 30,
				'Authorization' => 'Bearer ' . $apiToken
			)
		));
		$product_info = isset($products['body']) ? json_decode($products['body']) : '';
		$matches_products = isset($product_info) && !empty($product_info) ? $product_info->matches : '';
		// echo "<pre>";
		// print_r($product_info);
		// echo "</pre>";
		// die;
		?>
		<p class='form-field _envato_product_in_stores'>
			<label for='_envato_product_in_stores'><?php _e('Envato Product Select', 'rainbowit'); ?></label>
			<?php if (!empty($matches_products)) : ?>
				<select name='_envato_product_in_stores[]' class='wc-enhanced-select rainbow-theme-envato-product-select' style='width: 80%;'>
					<option value="" selected><?php echo esc_html_x('Select Product', 'This will be by default', 'rainbowit'); ?></option>
					<?php
					function centsToUSD($cents)
					{
						// Validate input to ensure it's a number
						if (!is_numeric($cents)) {
							throw new InvalidArgumentException('Input must be a number');
						}
						// Convert cents to USD by dividing by 100
						$usd = $cents / 100;
						// Format the USD value with two decimal places
						return number_format($usd, 2, '.', '');
					}
					foreach ($matches_products as $product) :
					// echo "<pre>";
					// print_r($product);
					// echo "</pre>";
						
						//die;
						// number_of_sales


						$product_name = isset($product->name) ? $product->name : '';
						$product_id = isset($product->id) ? $product->id : '';
						//$preview_url = isset($product->previews->live_site->url) ? $product->previews->live_site->url : '';

						$product_desc_html = isset($product->description_html) ? $product->description_html : '';
						$product_desc_raw = isset($product->description) ? $product->description : '';
						$price_cents = isset($product->price_cents) ? $product->price_cents : '';
						$product_tags = isset($product->tags) ? $product->tags : '';
						$product_image = isset($product->previews->icon_with_landscape_preview->landscape_url) ? $product->previews->icon_with_landscape_preview->landscape_url : '';
						$product_price = centsToUSD($price_cents);
						$product_other_info = array(
							'product_img' => $product_image,
							'product_tags' => $product_tags
						);
					?>
						<option data-product_other_info="<?php echo base64_encode(serialize($product_other_info)); ?>" data-product_image=<?php echo esc_url($product_image); ?> data-product_price="<?php echo esc_attr($product_price); ?>" data-product_name="<?php echo esc_attr($product_name); ?>" data-product_desc_raw="<?php echo esc_attr(($product_desc_raw)); ?> " data-product_desc_html="<?php echo esc_attr($product_desc_html) ?>" data-envato_product_id=<?php echo esc_attr($product_id); ?> value="<?php echo esc_attr($product_id); ?>"><?php echo esc_html($product_name); ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>
			<img class='help_tip' data-tip="<?php _e('Select the stores where this envato product is redeemable.', 'rainbowit'); ?>" src='<?php echo esc_url(WC()->plugin_url()); ?>/assets/images/help.png' height='16' width='16'>
		</p>
		<?php
		?>
	</div>

<?php
}



add_action('woocommerce_product_data_panels', 'wcpt_gift_card_options_product_tab_content');

function wcpt_gift_card_options_product_tab_content()
{
	// Dont forget to change the id in the div with your target of your product tab
	// If is single product page and have the "engrave text option" enabled we display the field
	global $post;
?>
	<div id='service_product_options' class='panel woocommerce_options_panel'>
		<div class='options_group'>
			<?php
			// Custom Product Checkbox Field

			woocommerce_wp_text_input(
				array(
					'id'          => '_service_product_queue_item',
					'label'       => __('Total Queue', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __('Please Total Queue Item', 'rainbowit'),
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'          => '_service_product_delivery_time',
					'label'       => __('Delivery Time', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __('Please Input Delivery Time', 'rainbowit'),
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'          => '_service_product_total_jobs',
					'label'       => __('Total Jobs', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __('Please Input Total jobs', 'rainbowit'),
				)
			);

			?>
		</div>
	</div>
<?php
}


add_action('woocommerce_process_product_meta', 'save_envato_product_options_field');

function save_envato_product_options_field($post_id)
{

	// service post meta update

	if (isset($_POST['_service_product_delivery_time'])) :
		update_post_meta($post_id, '_service_product_delivery_time', sanitize_text_field($_POST['_service_product_delivery_time']));
	endif;

	if (isset($_POST['_service_product_total_jobs'])) :
		update_post_meta($post_id, '_service_product_total_jobs', sanitize_text_field($_POST['_service_product_total_jobs']));
	endif;

	if (isset($_POST['_service_product_queue_item'])) :
		update_post_meta($post_id, '_service_product_queue_item', sanitize_text_field($_POST['_service_product_queue_item']));
	endif;
}
