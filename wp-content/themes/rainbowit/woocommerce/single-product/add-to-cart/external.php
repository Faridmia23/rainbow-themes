<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
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

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart envato-form-cart" action="<?php echo esc_url( $product_url ); ?>" method="get">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<button type="submit" class="envato-external-btn rbt-btn rbt-btn-md rbt-btn-success single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
	<span>
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g id="envato1">
				<path id="Vector" d="M17.6384 3.1385C17.103 2.84581 15.5686 3.02679 13.7258 3.58902C10.5006 5.76166 7.77868 8.96262 7.58859 14.103C7.55407 14.226 7.23608 14.0862 7.17307 14.0482C6.30209 12.403 5.95706 10.6706 6.68434 8.17145C6.81993 7.94906 6.37654 7.67543 6.2971 7.75332C6.13737 7.91114 5.47208 8.60967 5.03014 9.36517C2.83938 13.1105 4.27188 17.9094 8.10478 20.0097C11.9366 22.1131 16.7755 20.7562 18.9091 16.9784C21.3775 12.6184 19.0854 3.9348 17.6384 3.1385Z" fill="white"></path>
			</g>
		</svg>
	</span>
		<?php echo esc_html( "Buy on Envato","rainbowit" ); ?>
	</button>

	<?php wc_query_string_form_fields( $product_url ); ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
