<?php
add_action( 'plugins_loaded', 'rainbowit_register_custom_product_type' );

function rainbowit_register_custom_product_type () {
	// declare the product class
    class WC_Product_Envato_Product extends WC_Product {
		public $product_type = '';
        public function __construct( $product ) {
           $this->product_type = 'envato_product';
           parent::__construct( $product );
           // add additional functions here
        }
    }
}

add_filter( 'product_type_selector', 'rainbowit_add_custom_product_type' );

function rainbowit_add_custom_product_type ( $type ) {

	// Key should be exactly the same as in the class product_type
	$type[ 'envato_product' ] = __( 'Envato Product' );
	
	return $type;
}

add_filter( 'woocommerce_product_data_tabs', 'envato_product_tab' );

function envato_product_tab( $tabs) {
	
	$tabs['envato_product'] = array(
		'label'	 => __( 'Envato Product', 'rainbowit' ),
		'target' => 'envato_product_options',
		'class'  => ('show_if_envato_product'),
	);

	return $tabs;
}

add_action( 'woocommerce_product_data_panels', 'rainbowit_options_product_tab_content' );

function rainbowit_options_product_tab_content() {

	// Dont forget to change the id in the div with your target of your product tab
	global $post;
    $envato_product = (array) get_post_meta( $post->ID, '_envato_product_in_stores', true );
	?>
	<div id='envato_product_options' class='panel woocommerce_options_panel'>
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
			$product_info = isset( $products['body'] ) ? json_decode($products['body']): '';
			$matches_products = isset($product_info) && !empty($product_info) ? $product_info->matches : '';
			?>
			<p class='form-field _envato_product_in_stores'>
                <label for='_envato_product_in_stores'><?php _e( 'Envato Product Select', 'rainbowit' );?></label>
				<?php if(!empty($matches_products)) : ?>
                <select name='_envato_product_in_stores[]' class='wc-enhanced-select rainbow-theme-envato-product-select' style='width: 80%;'>
					<option value="" selected><?php echo esc_html_x( 'Select Product', 'This will be by default', 'rainbowit' ); ?></option>
					<?php 
					function centsToUSD($cents) {
						// Validate input to ensure it's a number
						if (!is_numeric($cents)) {
							throw new InvalidArgumentException('Input must be a number');
						}
						// Convert cents to USD by dividing by 100
						$usd = $cents / 100;
						// Format the USD value with two decimal places
						return number_format($usd, 2, '.', '');
					}
					foreach( $matches_products as $product ) : 
						$product_name = isset( $product->name ) ? $product->name: '';
						$product_id = isset( $product->id ) ? $product->id: '';
						$product_desc_html = isset( $product->description_html ) ? $product->description_html: '';
						$product_desc_raw = isset( $product->description ) ? $product->description: '';
						$price_cents = isset( $product->price_cents ) ? $product->price_cents: '';
						$product_tags = isset( $product->tags ) ? $product->tags: '';
						$product_image = isset( $product->previews->icon_with_landscape_preview->landscape_url ) ? $product->previews->icon_with_landscape_preview->landscape_url: '';
						$product_price = centsToUSD($price_cents);
						$product_other_info = array(
							'product_img' => $product_image,
							'product_tags' => $product_tags
						);
					?>
						<option data-product_other_info="<?php echo base64_encode(serialize($product_other_info)); ?>" data-product_image=<?php echo esc_url($product_image); ?> data-product_price="<?php echo esc_attr( $product_price ); ?>" data-product_name="<?php echo esc_attr( $product_name ); ?>" data-product_desc_raw = "<?php echo esc_attr( ($product_desc_raw) ); ?> " data-product_desc_html = "<?php echo esc_attr( $product_desc_html ) ?>" data-envato_product_id=<?php echo esc_attr( $product_id  ); ?> value = "<?php echo esc_attr( $product_id ); ?>"><?php echo esc_html( $product_name ); ?></option>
					<?php endforeach; ?>
                </select>
				<?php endif; ?>
                <img class='help_tip' data-tip="<?php _e( 'Select the stores where this envato product is redeemable.', 'rainbowit' );?>" src='<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png' height='16' width='16'>
        	</p>
			<?php
		?>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_process_product_meta', 'save_envato_product_options_field' );

function save_envato_product_options_field( $post_id ) {

	$enable_envato_product = isset( $_POST['_enable_envato_product'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_enable_envato_product', $enable_envato_product );

	if ( isset( $_POST['_envato_product_price'] ) ) :
		update_post_meta( $post_id, '_envato_product_price', sanitize_text_field( $_POST['_envato_product_price'] ) );
	endif;

	if ( isset( $_POST['_envato_product_preview_url'] ) ) :
		update_post_meta( $post_id, '_envato_product_preview_url', sanitize_text_field( $_POST['_envato_product_preview_url'] ) );
	endif;

	if ( isset( $_POST['_envato_product_template_type'] ) ) :
		update_post_meta( $post_id, '_envato_product_template_type', sanitize_text_field( $_POST['_envato_product_template_type'] ) );
	endif;

	if ( isset( $_POST['_envato_product_in_stores'] ) ) :
		update_post_meta( $post_id, '_envato_product_in_stores', sanitize_text_field( $_POST['_envato_product_in_stores'] ) );
	endif;

}

add_action( 'woocommerce_single_product_summary', 'envato_product_template', 60 );

function envato_product_template () {

	global $product;
	if ( 'envato_product' == $product->get_type() ) {

		$template_path = plugin_dir_path( __FILE__ ) . 'templates/';
		// Load the template
		wc_get_template( 'single-product/add-to-cart/envato_product.php',
			'',
			'',
			trailingslashit( $template_path ) );
	}
}


