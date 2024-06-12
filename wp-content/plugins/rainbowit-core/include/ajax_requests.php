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
        // if ( ! wp_verify_nonce( $nonce, 'rainbowit-feature-plugin' ) ) {
        //     die( __( 'Security check', 'rainbowit' ) ); 
        // } 

        $apiToken = 'AxNy23RTmWIlDXO3E0Cad6075IHpEciQ';
		$products = wp_remote_get('https://api.envato.com/v1/discovery/search/search/item?site=themeforest.net&username=rainbow-themes', array(
			'headers' => array(
				'timeout' => 30,
				'Authorization' => 'Bearer ' . $apiToken
			)
		));

		$product_info = isset($products['body']) ? json_decode($products['body']) : '';
		$matches_products = isset($product_info) && !empty($product_info) ? $product_info->matches : '';

        echo "<pre>";
        print_r($matches_products);
        echo "</pre>";

        $set_option = json_encode($matches_products);

        $check = update_option( 'rainbowit_envato_product_save_update', $set_option );

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
                        $product_price        = $this->centsToUSD($price_cents);
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

    public function centsToUSD($cents)
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

}

new ajax_requests();
