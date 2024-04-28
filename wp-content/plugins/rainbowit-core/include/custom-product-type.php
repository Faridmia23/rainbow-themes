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
		<?php

		?>
		<div class='options_group'>
			<?php
			woocommerce_wp_checkbox( array(
				'id' 	=> '_enable_envato_product',
				'label' => __( 'Enable Envato Product', 'rainbowit' ),
			) );

			woocommerce_wp_text_input( array(
				'id'          => '_envato_product_price',
				'label'       => __( 'Price', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Enter Envato Product Price.', 'rainbowit' ),
		       )
			);
			woocommerce_wp_text_input( array(
				'id'          => '_envato_product_preview_url',
				'label'       => __( 'Preview URL', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Envato Product Preview Url', 'rainbowit' ),
		       )
			);
			woocommerce_wp_text_input( array(
				'id'          => '_envato_product_template_type',
				'label'       => __( 'Product Template Type', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Envato Product Template Type', 'rainbowit' ),
		       )
			);
			?>
			<p class='form-field _envato_product_in_stores'>
                <label for='_envato_product_in_stores'><?php _e( 'Envato Product Select', 'rainbowit' );?></label>
                <select name='_envato_product_in_stores[]' class='wc-enhanced-select' multiple='multiple' style='width: 80%;'>
                    <option <?php selected( in_array( 'AL', $envato_product ) );?> value='AL'>Alabama</option>
                    <option <?php selected( in_array( 'NY', $envato_product ) );?> value='NY'>New York</option>
                    <option <?php selected( in_array( 'TX', $envato_product ) );?> value='TX'>Texas</option>
                    <option <?php selected( in_array( 'WY', $envato_product ) );?> value='WY'>Wyoming</option>
                </select>
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


