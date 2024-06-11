<?php

add_filter('woocommerce_product_data_tabs', 'envato_product_tab');

function envato_product_tab($tabs)
{

	$tabs['service_product'] = array(
		'label'	 => __('Service Product', 'rainbowit'),
		'target' => 'service_product_options',
		'class'  => ('show_if_simple_product hide_if_external'),
	);
	$tabs['own_product'] = array(
		'label'	 => __('Own Product', 'rainbowit'),
		'target' => 'own_product_options',
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


		$field2 = array(
			'id' => '_envato_featured_product_checkbox_item',
			'label' => __( 'Enable Featured Product', 'rainbowit' ),
			'cbvalue' => 'yes', // Submits 'enabled' when checked
		);
		woocommerce_wp_checkbox( $field2 );

		woocommerce_wp_text_input(
			array(
				'id'          => '_envator_product_documentation_link',
				'label'       => __('Documentation LInk', 'rainbowit'),
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
	global $product;
?>
	<div id='service_product_options' class='panel woocommerce_options_panel'>
		<div class='options_group'>
			<?php
			// Custom Product Checkbox Field

			$field = array(
				'id' => 'rainbowit_service_product_checkbox',
				'label' => __( 'Enable Service Product', 'rainbowit' ),
				'cbvalue' => 'yes', // Submits 'enabled' when checked
			);
			woocommerce_wp_checkbox( $field );
			
	
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
	<div id='own_product_options' class='panel woocommerce_options_panel'>
		<div class='options_group'>
			<?php
			// Custom Product Checkbox Field
			$field = array(
				'id' => 'rainbowit_own_product_checkbox',
				'label' => __( 'Enable Main Website Product', 'rainbowit' ),
				'cbvalue' => 'yes', // Submits 'enabled' when checked
			);
			woocommerce_wp_checkbox( $field );
			woocommerce_wp_text_input(
				array(
					'id'          => '_own_product_total_sales',
					'label'       => __('Total Sale', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'          => '_own_product_preview_url',
					'label'       => __('Preview Url', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
				)
			);

			woocommerce_wp_text_input( array(
				'id'          => '_own_product_published_date',
				'label'       => __( 'Product Published Date', 'rainbowit' ),
				'placeholder' => 'YYYY-MM-DD',
				'description' => __( 'Enter a custom date for this product.', 'rainbowit' ),
				'type'        => 'date',
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_own_product_last_update',
				'label'       => __( 'Product Last Update Date', 'rainbowit' ),
				'placeholder' => 'YYYY-MM-DD',
				'description' => __( 'Enter a custom date for this product.', 'rainbowit' ),
				'type'        => 'date',
			) );

			
			woocommerce_wp_text_input(
				array(
					'id'          => '_own_product_compatable_with',
					'label'       => __('Compatable With', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
				)
			);
			woocommerce_wp_text_input(
				array(
					'id'          => '_onw_product_column',
					'label'       => __('Column With', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
				)
			);

			woocommerce_wp_text_input(
				array(
					'id'          => '_onw_product_documentation_link',
					'label'       => __('Documentation LInk', 'rainbowit'),
					'placeholder' => '',
					'desc_tip'    => 'true',
				)
			);

			woocommerce_wp_textarea_input( 
				array( 
					'id'          => 'own_product_feature_list', 
					'label'       => __('Product Feature List', 'woocommerce'), 
					'placeholder' => __('Enter custom text here', 'woocommerce'),
					'description' => __('This is a feature item input here.', 'woocommerce'),
					'default' => '',
				)
			);

			echo '<div class="options_group">';

			woocommerce_wp_text_input( array(
				'id'          => '_own_product_image_file',
				'label'       => __( 'Product Icon Thumbnail Image', 'rainbowit' ),
				'description' => __( 'Upload an image and enter the URL here.', 'rainbowit' ),
				'desc_tip'    => true,
				'type'        => 'text',
			) );

			echo '<p class="form-field">
					<label for="main_website_sale_product">' . __( 'Upload Image', 'rainbowit' ) . '</label>
					<button id="main_website_sale_product" class="button">' . __( 'Upload', 'rainbowit' ) . '</button>
				</p>';

			echo '</div>';
			
			
			?>
		</div>
	</div>
<?php
}


add_action('woocommerce_process_product_meta', 'save_envato_product_options_field');

function save_envato_product_options_field($post_id)
{

	// service post meta update

	if ( isset( $_POST['_own_product_image_file'] ) ) {
        update_post_meta( $post_id, '_own_product_image_file', esc_url_raw( $_POST['_own_product_image_file'] ) );
    }

	if (isset($_POST['_onw_product_documentation_link'])) :
		update_post_meta($post_id, '_onw_product_documentation_link', sanitize_text_field($_POST['_onw_product_documentation_link']));
	endif;

	if (isset($_POST['_envator_product_documentation_link'])) :
		update_post_meta($post_id, '_envator_product_documentation_link', sanitize_text_field($_POST['_envator_product_documentation_link']));
	endif;

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

	if ( isset( $_POST['_envato_featured_product_checkbox_item'] ) ) {
        $feature_product = $_POST['_envato_featured_product_checkbox_item'];
        update_post_meta( $post_id, '_envato_featured_product_checkbox_item', $feature_product );
    } else {
        // Checkbox not checked, store a default value (optional)
        update_post_meta( $post_id, '_envato_featured_product_checkbox_item', 'no' );
    }


	if ( isset( $_POST['rainbowit_service_product_checkbox'] ) ) {
        $special_feature_enabled = $_POST['rainbowit_service_product_checkbox'];
        update_post_meta( $post_id, 'rainbowit_service_product_checkbox', $special_feature_enabled );
		update_post_meta( $post_id, 'rainbowit_own_product_checkbox', 'no' );
    } else {
        // Checkbox not checked, store a default value (optional)
        update_post_meta( $post_id, 'rainbowit_service_product_checkbox', 'no' );
    }

	if ( isset( $_POST['rainbowit_own_product_checkbox'] ) ) {
        $rainbowit_own_product_checkbox = $_POST['rainbowit_own_product_checkbox'];
        update_post_meta( $post_id, 'rainbowit_own_product_checkbox', $rainbowit_own_product_checkbox );
		update_post_meta( $post_id, 'rainbowit_service_product_checkbox', 'no' );
    } else {
        // Checkbox not checked, store a default value (optional)
        update_post_meta( $post_id, 'rainbowit_own_product_checkbox', 'no' );
    }

	if (isset($_POST['_own_product_total_sales'])) :
		update_post_meta($post_id, '_own_product_total_sales', sanitize_text_field($_POST['_own_product_total_sales']));
	endif;

	if (isset($_POST['_own_product_preview_url'])) :
		update_post_meta($post_id, '_own_product_preview_url', sanitize_text_field($_POST['_own_product_preview_url']));
	endif;

	if (isset($_POST['_own_product_last_update'])) :
		update_post_meta($post_id, '_own_product_last_update', sanitize_text_field($_POST['_own_product_last_update']));
	endif;

	if (isset($_POST['_own_product_published_date'])) :
		update_post_meta($post_id, '_own_product_published_date', sanitize_text_field($_POST['_own_product_published_date']));
	endif;

	if (isset($_POST['_own_product_compatable_with'])) :
		update_post_meta($post_id, '_own_product_compatable_with', sanitize_text_field($_POST['_own_product_compatable_with']));
	endif;

	if (isset($_POST['_onw_product_column'])) :
		update_post_meta($post_id, '_onw_product_column', sanitize_text_field($_POST['_onw_product_column']));
	endif;


	if (isset($_POST['_own_product_preview_icon_url'])) :
		update_post_meta($post_id, '_own_product_preview_icon_url', sanitize_text_field($_POST['_own_product_preview_icon_url']));
	endif;

	if (isset($_POST['own_product_feature_list'])) :
		update_post_meta($post_id, 'own_product_feature_list', custom_sanitize_html($_POST['own_product_feature_list']));
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

	update_option( 'rainbowit_envato_product_save_update', $set_option );

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'meta_query'     => array(
			array(
				'key'     => '_product_url',
				'compare' => 'EXISTS',
			),
		),
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => 'external',
			),
		),
	);

	// Custom query to get external products
	$query = new WP_Query($args);

	$get_option = get_option('rainbowit_envato_product_save_update', true);

	$matches_products = json_decode($get_option, true);

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

	// Check if we have products
	if ($query->have_posts()) {
		// Loop through the products
		while ($query->have_posts()) {
			$query->the_post();
			$woo_product_id =  get_the_ID();
			$envato_product_preview_url = get_post_meta( $woo_product_id, '_envato_product_preview_url', true);

			if (!empty($matches_products)) :
				foreach ($matches_products as $product) :
					$avg_rating           = isset($product['rating']['rating']) ? $product['rating']['rating'] : '';
					$total_rating         = isset($product['rating']['count']) ? $product['rating']['count'] : '';
					$preview_url          = isset($product['previews']['live_site']['url']) ? $product['previews']['live_site']['url'] : '';
					$price_cents          = isset($product['price_cents']) ? $product['price_cents'] : '';
					$number_of_sales      = isset($product['number_of_sales']) ? $product['number_of_sales'] : '';
					$product_price        = centsToUSD($price_cents);
					$updated_at 		  = isset($product['updated_at']) ? $product['updated_at'] : '';

					if ($envato_product_preview_url == $preview_url) {

						update_post_meta( $woo_product_id, '_envato_product_total_sales', $number_of_sales);
						update_post_meta( $woo_product_id, '_envato_product_last_update', $updated_at );
						update_post_meta( $woo_product_id, '_envato_product_avg_rating', $avg_rating );
						update_post_meta( $woo_product_id, '_envato_product_total_rating', $total_rating );
						update_post_meta( $woo_product_id, '_regular_price', $product_price );

					}

				endforeach;

			endif;

			$product = wc_get_product(get_the_ID());
			$product->save();
		}
	} else {
		echo '<p>No external products found.</p>';
	}

	// Reset post data
	wp_reset_postdata();

	if( $set_option ) {
		echo "success";
	} else {
		return false;
	}

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
	
	$data = get_option("choose_schedule_rainbowit", true );
	$value = isset($data) && !empty($data) ? $data : 'daily';

	if ( ! wp_next_scheduled( 'rainbowit_envato_api_hook_run' ) ) {
		wp_schedule_event( time(), $value, 'rainbowit_envato_api_hook_run' );
	}

}

add_action( 'rainbowit_envato_api_hook_run', 'rainbowit_envato_api_call' );


// Add the JavaScript for the upload button
add_action( 'admin_footer', 'rainbowit_main_website_sale_product_image_script' );

function rainbowit_main_website_sale_product_image_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var file_frame;
            $('#main_website_sale_product').on('click', function(event) {
                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( file_frame ) {
                    file_frame.open();
                    return;
                }

                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: '<?php _e( 'Select or Upload an Image', 'rainbowit' ); ?>',
                    button: {
                        text: '<?php _e( 'Use this image', 'rainbowit' ); ?>',
                    },
                    multiple: false
                });

                // When an image is selected, run a callback.
                file_frame.on( 'select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#_own_product_image_file').val(attachment.url);
                });

                // Finally, open the modal.
                file_frame.open();
            });
        });
    </script>
    <?php
}

function custom_sanitize_html($input) {
    $allowed_tags = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'strong' => array(),
        'em' => array(),
        'ul' => array(),
        'li' => array()
    );

    return wp_kses($input, $allowed_tags);
}