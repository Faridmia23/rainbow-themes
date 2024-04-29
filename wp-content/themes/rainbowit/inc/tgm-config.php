<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */

class TGM_Config {
    public $prefix = RAINBOWIT_THEME_PREFIX;
    public $path = "https://rainbowit.net/themes/rainbowit/demo/plugins/";

	public function __construct() {
		add_action( 'tgmpa_register', array( $this, 'rainbowit_tgn_plugins' ) );
	}

	public function rainbowit_tgn_plugins(){
		$plugins = array(	
			array(
                'name'     => esc_attr__('WooCommerce', 'rainbowit'),
                'slug'     => 'woocommerce',
                'required' => true,
				'force_activation'   => true,
            ),
            array(
                'name'         => esc_html__('Rainbowit Demo Importer','rainbowit'),
                'slug'         => 'rainbowit-demo-importer',
                'source'       => 'rainbowit-demo-importer.2.0.zip',
                'required'     =>  true,
                'version'      => '2.0'
            ),
            array(
                'name'      => esc_html__('Advanced Custom Fields Pro', 'rainbowit'),
                'slug'      => 'advanced-custom-fields-pro',
                'source'	=> 'advanced-custom-fields-pro.zip',
                'required'  => true,
            ),
					
			// Repository
			array(
				'name'     => esc_html__('Redux Framework','rainbowit'),
				'slug'     => 'redux-framework',
				'required' => true,
			),
			array(
				'name'     => esc_html__('Elementor Page Builder','rainbowit'),
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => esc_html__('Contact Form 7','rainbowit'),
				'slug'     => 'contact-form-7',
				'required' => false,
			)

		);

		$config = array(
			'id'           => $this->prefix,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->prefix . '-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                    // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}

new TGM_Config;