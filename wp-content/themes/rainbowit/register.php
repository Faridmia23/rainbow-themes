<?php
  /*
   * Template name: Registration Form
   */

if(is_user_logged_in()){
  wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
} 
get_header();

 do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="rbt-section-wrapper-4 pt--140 rbt-section-gap2Bottom">
        <div class="container rbt-section-wrapper-7 pt--25">
            <div class="rbt-form-wrapper-2 mx-auto ">
	<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
        <h4 class="title title-sm mb--35"><?php esc_html_e( 'Create your account', 'woocommerce' ); ?></h4>
		<?php do_action( 'woocommerce_register_form_start' ); ?>
		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
				<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
		<?php endif; ?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
			<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
		</p>
		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide single-field mb--30">
				<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text input-field" name="password" id="reg_password" autocomplete="new-password" />
			</p>
		<?php else : ?>
			<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
		<?php endif; ?>
		<?php do_action( 'woocommerce_register_form' ); ?>
		<p class="woocommerce-form-row form-row single-field">
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit rbt-btn rbt-btn-primary w-100" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
		</p>
		<?php do_action( 'woocommerce_register_form_end' ); ?>
	</form>
    <div class="form-bottom">
                <span class="form-bottom-text"><?php esc_html_e("Already have an account?","woocommerce"); ?> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e("Login","woocommerce"); ?></a></span>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
<?php get_footer();?>