<?php

class ajax_requests
{

    protected $ajax_onoce;
    public function __construct()
    {
        
        $this->ajax_onoce = 'rainbowit-feature-plugin';
        add_action('wp_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'rainbowit_ajax_enqueue'));


        add_action('admin_enqueue_scripts', array($this, 'rainbowit_scripts'));
        
        add_action('wp_ajax_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_product_order_now', array($this, 'rbt_ajax_product_order_now_func'));

        add_action('wp_ajax_rbt_ajax_envato_api_product', array($this, 'rbt_ajax_envato_api_product_func'));
        add_action('wp_ajax_nopriv_rbt_ajax_envato_api_product', array($this, 'rbt_ajax_envato_api_product_func'));

        
    }
    
    function rainbowit_ajax_enqueue()
    {
        wp_enqueue_script( 'rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/ajax-scripts.js', array('jquery'), null, true );

        wp_enqueue_style("rainbowit-admin-css", RAINBOWIT_ADDONS_URL . 'assets/css/admin.css', time() );
        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce($this->ajax_onoce),
        );
        wp_localize_script('rainbowit-core-ajax', 'rainbowit_portfolio_ajax', $params);
    }

    function rainbowit_scripts() {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script( 'rainbowit-core-ajax', RAINBOWIT_ADDONS_URL . 'assets/js/media_admin.js', array('jquery'), null, true );
        
    }

    public function rbt_ajax_product_order_now_func() {

        $nonce = isset( $_POST['orderNonce'] ) ? $_POST['orderNonce'] : 0;
        if ( ! wp_verify_nonce( $nonce, 'rainbowit-feature-plugin' ) ) {
            die( __( 'Security check', 'rainbowit' ) ); 
        } 
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
        if ($productId > 0) {
            WC()->cart->add_to_cart($productId, 1);
        }
        // Redirect to the cart page
        return true;
        die();
    }

    public function rbt_ajax_envato_api_product_func() {
        $nonce = isset( $_POST['orderNonce'] ) ? $_POST['orderNonce'] : 0;
        if ( ! wp_verify_nonce( $nonce, 'rainbowit-feature-plugin' ) ) {
            die( __( 'Security check', 'rainbowit' ) ); 
        } 

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

        $set_option = json_encode($matches_products);

        $check = update_option( 'rainbowit_envato_product_save_update', $set_option );

        if( $check ) {
            echo "success";
        } else {
            return false;
        }

        exit();
    }

}

new ajax_requests();
