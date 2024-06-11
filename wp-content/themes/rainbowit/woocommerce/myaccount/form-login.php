<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$registration_link = $rainbowit_options['my_account_registration_page_link'];

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns row" id="customer_login">

	<div class="u-column1 col-lg-6">

<?php endif; ?>
<form class="woocommerce-form woocommerce-form-login login" method="post">
		<h4 class="title title-sm"><?php esc_html_e( 'Login to your account', 'rainbowit' ); ?></h4>
		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			<label for="username"><?php esc_html_e( 'Username or email address', 'rainbowit' ); ?>&nbsp;<span class="required">*</span></label>
		</div>
		<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
			<input class="woocommerce-Input woocommerce-Input--text input-text input-field" type="password" name="password" id="password" autocomplete="current-password" />
			<label for="password"><?php esc_html_e( 'Password', 'rainbowit' ); ?>&nbsp;<span class="required">*</span></label>
		</div>

		<?php do_action( 'woocommerce_login_form' ); ?>
		<!-- checkbox -->
		
		<div class="form-row rbt-checkbox d-flex justify-content-between align-items-center">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme rbt-checkbox">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'rainbowit' ); ?></span>
			</label>
			<div class="woocommerce-LostPassword lost_password rbt-forgot-pass">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'rainbowit' ); ?></a>
			</div>
		</div>
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="woocommerce-button button woocommerce-form-login__submit rbt-btn rbt-btn-primary w-100" name="login" value="<?php esc_attr_e( 'Log in', 'rainbowit' ); ?>"><?php esc_html_e( 'Log in', 'rainbowit' ); ?></button>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

	</form>
	<div class="form-bottom">
				<span class="form-bottom-text"><?php echo esc_html_e("New to Rainbow-Themes?","rainbowit"); ?> <a href="<?php echo esc_url( $registration_link ); ?>"><?php echo esc_html_e("Create an Account","rainbowit"); ?></a></span>
			</div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-lg-6">

		<h3><?php esc_html_e( 'Register', 'rainbowit' ); ?></h3>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
					<label for="reg_username"><?php esc_html_e( 'Username', 'rainbowit' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'rainbowit' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'rainbowit' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'rainbowit' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'rainbowit' ); ?>"><?php esc_html_e( 'Register', 'rainbowit' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>