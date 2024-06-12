<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $post;
if ( ! $product->is_purchasable() ) {
	return;
}


$service_product_checkbox = get_post_meta(get_the_ID(), "rainbowit_service_product_checkbox", true);
$custom_class ='custom-checkout-btn';
if($service_product_checkbox == 'yes' ){
	$custom_class ='';
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart <?php echo esc_attr( $custom_class  ); ?>" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		if( $service_product_checkbox  == 'yes' ){

		
		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

	}

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
		<?php if ($service_product_checkbox == 'yes') { ?>
		<a data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-xm w-100 rbt-btn-primary rbt-btn-round  btn-primary-outline rbt-btn-xm hover-effect-1 ajax-order-now-product" style="cursor:pointer;" aria-describedby="some text">
			<?php  esc_attr_e("Order Now","rainbowit"); ?>
		</a>
		<?php }  else { ?>
			<a  data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-md rbt-btn-success woocommerce-own-product ajax-order-now-product"><span><span><i class="fa-regular fa-cart-shopping"></i></span>
				<?php echo esc_html__("Purchase Now","woocommerce"); ?>
			</a>
			<?php } 
		
		 do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>