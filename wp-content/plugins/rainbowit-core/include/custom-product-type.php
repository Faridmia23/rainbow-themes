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

	class WC_Product_Service_Product extends WC_Product {
		public $product_type = '';
        public function __construct( $product ) {
           $this->product_type = 'service_product';
           parent::__construct( $product );
           // add additional functions here
        }
    }
}

add_filter( 'product_type_selector', 'rainbowit_add_custom_product_type' );

function rainbowit_add_custom_product_type ( $type ) {

	// Key should be exactly the same as in the class product_type
	$type[ 'envato_product' ]  = __( 'Envato Product' );
	$type[ 'service_product' ] = __( 'Service Product' );
	
	return $type;
}

add_filter( 'woocommerce_product_data_tabs', 'envato_product_tab' );

function envato_product_tab( $tabs) {
	
	$tabs['envato_product'] = array(
		'label'	 => __( 'Envato Product', 'rainbowit' ),
		'target' => 'envato_product_options',
		'class'  => ('show_if_envato_product'),
	);
	$tabs['service_product'] = array(
		'label'	 => __( 'Service Product', 'rainbowit' ),
		'target' => 'service_product_options',
		'class'  => ('show_if_service_product'),
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
				'id'          => '_envato_product_template_type',
				'label'       => __( 'Product Template Type', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Envato Product Template Type', 'rainbowit' ),
		       )
			);
			woocommerce_wp_text_input( array(
				'id'          => '_envato_product_preview_button_text',
				'label'       => __( 'Preview Button Text', 'rainbowit' ),
				'placeholder' => '',
				'desc_tip'    => 'true',
				'description' => __( 'Please input the button text', 'rainbowit' ),
				'default' 	  => __('Live Preview',"rainbowit"),
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
				'id'          => '_envato_product_add_to_cart_button_url',
				'label'       => __( 'Add to Cart Button URL', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Please input the button URL', 'rainbowit' ),
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
	<div id='service_product_options' class='panel woocommerce_options_panel'>
		<?php

		?>
		<div class='options_group'>
			<?php
			woocommerce_wp_text_input( array(
				'id'          => '_service_order_btn_title',
				'label'       => __( 'Order Button Title', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Order Button Title', 'rainbowit' ),
		       )
			);
			woocommerce_wp_text_input( array(
				'id'          => '_service_product_order_btn_url',
				'label'       => __( 'Order Button URL', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Envato Product Preview Url', 'rainbowit' ),
		       )
			);
			
			woocommerce_wp_text_input( array(
				'id'          => '_service_product_details_button_text',
				'label'       => __( 'Details Button Text', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Please input the button text', 'rainbowit' ),
		       )
			);

			woocommerce_wp_text_input( array(
				'id'          => '_service_product_queue_item',
				'label'       => __( 'Total Queue', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Please Total Queue Item', 'rainbowit' ),
		       )
			);
			woocommerce_wp_text_input( array(
				'id'          => '_service_product_delivery_time',
				'label'       => __( 'Delivery Time', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Please Input Delivery Time', 'rainbowit' ),
		       )
			);

			woocommerce_wp_text_input( array(
				'id'          => '_service_product_total_jobs',
				'label'       => __( 'Total Jobs', 'rainbowit' ),
		       		'placeholder' => '',
		       		'desc_tip'    => 'true',
		       		'description' => __( 'Please Input Total jobs', 'rainbowit' ),
		       )
			);
			?>
			<?php
		?>
		</div>
	</div>
	<?php
}

add_action( 'woocommerce_process_product_meta', 'save_envato_product_options_field' );

function save_envato_product_options_field( $post_id ) {

	// service post meta updated
	if ( isset( $_POST['_service_order_btn_title'] ) ) :
		update_post_meta( $post_id, '_service_order_btn_title', sanitize_text_field( $_POST['_service_order_btn_title'] ) );
	endif;

	if ( isset( $_POST['_service_product_order_btn_url'] ) ) :
		update_post_meta( $post_id, '_service_product_order_btn_url', sanitize_text_field( $_POST['_service_product_order_btn_url'] ) );
	endif;

	if ( isset( $_POST['_service_product_details_button_text'] ) ) :
		update_post_meta( $post_id, '_service_product_details_button_text', sanitize_text_field( $_POST['_service_product_details_button_text'] ) );
	endif;

	if ( isset( $_POST['_service_product_delivery_time'] ) ) :
		update_post_meta( $post_id, '_service_product_delivery_time', sanitize_text_field( $_POST['_service_product_delivery_time'] ) );
	endif;

	if ( isset( $_POST['_service_product_total_jobs'] ) ) :
		update_post_meta( $post_id, '_service_product_total_jobs', sanitize_text_field( $_POST['_service_product_total_jobs'] ) );
	endif;

	if ( isset( $_POST['_service_product_queue_item'] ) ) :
		update_post_meta( $post_id, '_service_product_queue_item', sanitize_text_field( $_POST['_service_product_queue_item'] ) );
	endif;
	
}




