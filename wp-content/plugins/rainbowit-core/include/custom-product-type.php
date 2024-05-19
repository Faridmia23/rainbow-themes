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

		$get_option = get_option( 'rainbowit_envato_product_save_update', true );

		global $post;

		$product_id = $post->ID;

		$matches_products = json_decode($get_option,true);

		$product = wc_get_product( $product_id  );

		$product_title = $product->get_title();
		?>
		<p class='form-field _envato_product_in_stores'>
			<label for='_envato_product_in_stores'><?php _e('Envato Product Select', 'rainbowit'); ?></label>
			<?php if (!empty($matches_products)) : 
			
				?>
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

						$product_name 		= isset($product['name']) ? $product['name'] : '';
						$updated_at 		= isset($product['updated_at']) ? $product['updated_at'] : '';
						$published_at 		= isset($product['published_at']) ? $product['published_at'] : '';
						$columns 			= isset($product['attributes'][0]['value']) ? $product['attributes'][0]['value'] : '';
						$avg_rating 		= isset($product['rating']['rating']) ? $product['rating']['rating'] : '';
						$total_rating 		= isset($product['rating']['count']) ? $product['rating']['count'] : '';
						$product_id 		= isset($product['id']) ? $product['id'] : '';
						$preview_url 		= isset($product['previews']['live_site']['url']) ? $product['previews']['live_site']['url'] : '';
						$icon_url 			= isset($product['previews']['icon_with_landscape_preview']['icon_url']) ? $product['previews']['icon_with_landscape_preview']['icon_url'] : '';
						$product_desc_html  = isset($product['description_html']) ? $product['description_html'] : '';
						$product_desc_raw 	= isset($product['description']) ? $product['description'] : '';
						$price_cents 		= isset($product['price_cents']) ? $product['price_cents'] : '';
						
						$url 				= isset($product['url']) ? $product['url'] : '';
						$number_of_sales 	= isset($product['number_of_sales']) ? $product['number_of_sales'] : '';
						$product_tags 		= isset($product['tags']) ? $product['tags'] : '';
						$product_image 		= isset($product['previews']['icon_with_landscape_preview']['landscape_url']) ? $product['previews']['icon_with_landscape_preview']['landscape_url'] : '';
						$product_price 		= centsToUSD($price_cents);

						$classification     = isset($product['classification']) ? $product['classification'] : '';
						$classification 	= explode("/", $classification);
						$template_cat       = isset($classification['2']) ? $classification['2'] : '';

						$template_type 		= $classification['1'] . " ". $template_cat;

						
						$product_other_info = array(
							'product_img' => $product_image,
							'product_tags' => $product_tags
						);
					?>
						<option <?php if ( $product_name == $product_title  ) echo ' selected="selected"'; ?> data-product_other_info="<?php echo base64_encode(serialize($product_other_info)); ?>" data-product_image=<?php echo esc_url($product_image); ?> data-product_price="<?php echo esc_attr($product_price); ?>" data-product_name="<?php echo esc_attr($product_name); ?>" data-product_desc_raw="<?php echo esc_attr(($product_desc_raw)); ?> " data-product_desc_html="<?php echo esc_attr($product_desc_html) ?>" data-envato_product_id="<?php echo esc_attr($product_id); ?>" value="<?php echo esc_attr($product_id); ?>" data-envato_preview_url="<?php echo esc_attr($preview_url); ?>" data-envato_product_sale="<?php echo esc_attr($number_of_sales);?>" data-envato_product_url="<?php echo esc_attr($url);?>" data-updated_at="<?php echo esc_attr($updated_at);?>" data-published_at="<?php echo esc_attr($published_at);?>" data-columns="<?php echo esc_attr($columns);?>" data-avg_rating="<?php echo esc_attr($avg_rating);?>" data-total_rating="<?php echo esc_attr($total_rating);?>" data-icon_url="<?php echo esc_attr($icon_url);?>" data-template_type="<?php echo esc_attr( $template_type );?>">><?php echo esc_html($product_name); ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>
			<img class='help_tip' data-tip="<?php _e('Select the stores where this envato product is redeemable.', 'rainbowit'); ?>" src='<?php echo esc_url(WC()->plugin_url()); ?>/assets/images/help.png' height='16' width='16'>
		</p>
		<?php 
		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_total_sales',
				'label'       => __('Total Sales', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);
		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_preview_url',
				'label'       => __('Preview URL', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_template_type',
				'label'       => __('Template Category', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_last_update',
				'label'       => __('Last Update', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_published_date',
				'label'       => __('Published Date', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_compatable_with',
				'label'       => __('Compatable With', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_column',
				'label'       => __('Column', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_avg_rating',
				'label'       => __('Average Rating', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_total_rating',
				'label'       => __('Total Rating', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'          => '_envato_product_preview_icon_url',
				'label'       => __('Preview Icon URL', 'rainbowit'),
				'placeholder' => '',
				'desc_tip'    => 'true',
			)
		);
		
		?>
	</div>

<?php
}



add_action('woocommerce_product_data_panels', 'rainbowit_custom_service_options_product_tab_content');

function rainbowit_custom_service_options_product_tab_content()
{
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

	if (isset($_POST['_envato_product_total_sales'])) :
		update_post_meta($post_id, '_envato_product_total_sales', sanitize_text_field($_POST['_envato_product_total_sales']));
	endif;

	if (isset($_POST['_envato_product_preview_url'])) :
		update_post_meta($post_id, '_envato_product_preview_url', sanitize_text_field($_POST['_envato_product_preview_url']));
	endif;

	if (isset($_POST['_envato_product_template_type'])) :
		update_post_meta($post_id, '_envato_product_template_type', sanitize_text_field($_POST['_envato_product_template_type']));
	endif;

	if (isset($_POST['_envato_product_last_update'])) :
		update_post_meta($post_id, '_envato_product_last_update', sanitize_text_field($_POST['_envato_product_last_update']));
	endif;

	if (isset($_POST['_envato_product_published_date'])) :
		update_post_meta($post_id, '_envato_product_published_date', sanitize_text_field($_POST['_envato_product_published_date']));
	endif;

	if (isset($_POST['_envato_product_compatable_with'])) :
		update_post_meta($post_id, '_envato_product_compatable_with', sanitize_text_field($_POST['_envato_product_compatable_with']));
	endif;

	if (isset($_POST['_envato_product_column'])) :
		update_post_meta($post_id, '_envato_product_column', sanitize_text_field($_POST['_envato_product_column']));
	endif;

	if (isset($_POST['_envato_product_avg_rating'])) :
		update_post_meta($post_id, '_envato_product_avg_rating', sanitize_text_field($_POST['_envato_product_avg_rating']));
	endif;

	if (isset($_POST['_envato_product_total_rating'])) :
		update_post_meta($post_id, '_envato_product_total_rating', sanitize_text_field($_POST['_envato_product_total_rating']));
	endif;

	if (isset($_POST['_envato_product_preview_icon_url'])) :
		update_post_meta($post_id, '_envato_product_preview_icon_url', sanitize_text_field($_POST['_envato_product_preview_icon_url']));
	endif;


	
}


// cron job

function rainbowit_envato_api_call() {
	/**
	 * Fetch Products from Envato
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	*/

	$apiToken 	= 'AxNy23RTmWIlDXO3E0Cad6075IHpEciQ';
	$products 	= wp_remote_get('https://api.envato.com/v1/discovery/search/search/item?site=themeforest.net&username=rainbow-themes', array(
		'headers' => array(
			'timeout' => 30,
			'Authorization' => 'Bearer ' . $apiToken
		)
	));

	$product_info 		= isset($products['body']) ? json_decode($products['body']) : '';
	$matches_products 	= isset($product_info) && !empty($product_info) ? $product_info->matches : '';
	$set_option 		= json_encode($matches_products);
	$check 				= update_option( 'rainbowit_envato_product_save_update', $set_option );

	if( $check ) {
		echo "success";
	} else {
		return false;
	}

	// weekly run js enqueue

	wp_enqueue_script('rainbowit-envato-api-run', RAINBOWIT_ADDONS_URL . 'assets/js/envato-apirun.js', array('jquery'), '1.0', true);

	exit();
}

/**
 * wordpress cron job schedule init function
 * 
 * @since 1.0.0
 * 
 * @return void
*/
  
add_action( 'init', 'schedule_daily_api_call' );
  
function schedule_daily_api_call() {

	if ( ! wp_next_scheduled( 'rainbowit_envato_api_hook_run' ) ) {

		wp_schedule_event( time(), 'weekly', 'rainbowit_envato_api_hook_run' );

	}

}

add_action( 'rainbowit_envato_api_hook_run', 'rainbowit_envato_api_call' );