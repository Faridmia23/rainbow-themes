<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (!class_exists('Redux')) {
    return;
}

Redux::disable_demo();

$opt_name = RAINBOWIT_THEME_PREFIX . '_options';
$theme = wp_get_theme();
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'disable_tracking' => true,
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'submenu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__('Rainbowit Theme Options', 'rainbowit'),
    'page_title' => esc_html__('Rainbowit Theme Options', 'rainbowit'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    //'google_api_key'       => 'AIzaSyC2GwbfJvi-WnYpScCPBGIUyFZF97LI0xs',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-menu',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    'forced_dev_mode_off' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => RAINBOWIT_THEME_PREFIX . '_options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => true,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    'footer_credit' => '&nbsp;',
    // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'hide_expand' => true,
    // This variable determines if the ‘Expand Options’ buttons is visible on the options panel.
    'system_info' => true

);

Redux::setArgs($opt_name, $args);


/*
 * ---> END ARGUMENTS
 */

// -> START Basic Fields

/**
 * General
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'rainbowit'),
    'id' => 'rainbowit-general-setting-wrap',
    'icon' => 'el el-cog',
));

Redux::setSection($opt_name, array(
    'title' => esc_html__('General', 'rainbowit'),
    'id' => 'rainbowit-general-setting',
    'icon' => 'el el-adjust-alt',
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'active_dark_mode',
            'type' => 'switch',
            'title' => esc_html__('Switch to Dark Mode', 'rainbowit'),
            'on' => esc_html__('Yes', 'rainbowit'),
            'off' => esc_html__('No', 'rainbowit'),
            'default' => true,
        ),
        array(
            'id' => 'base_theme_css',
            'type' => 'switch',
            'title' => esc_html__('Base theme Css', 'rainbowit'),
            'on' => esc_html__('Yes', 'rainbowit'),
            'off' => esc_html__('No', 'rainbowit'),
            'default' => false,
        ),

      
        array(
            'id' => 'rainbowit_head_logo',
            'title' => esc_html__('Default Logo', 'rainbowit'),
            'subtitle' => esc_html__('Upload the main logo of your site. Note: Its work for header layout 1', 'rainbowit'),
            'type' => 'media',
            'default' => array(
                'url' => RAINBOWIT_IMG_URL . 'logo.png'
            ),
           
        ),
        array(
            'id' => 'rainbowit_mobile_logo',
            'title' => esc_html__('Mobile Logo', 'rainbowit'),
            'subtitle' => esc_html__('Upload the mobile Logo of your site.', 'rainbowit'),
            'type' => 'media',
            'default' => array(
                'url' => RAINBOWIT_IMG_URL . 'rbt-logo-icon.png'
            ),
            
        ),
        
        // End logo
        array(
            'id' => 'rainbowit_scroll_to_top_enable',
            'type' => 'button_set',
            'title' => esc_html__('Enable Back To Top', 'rainbowit'),
            'subtitle' => esc_html__('Enable the back to top button that appears in the bottom right corner of the screen.', 'rainbowit'),
            'options' => array(
                'yes' => esc_html__('Yes', 'rainbowit'),
                'no' => esc_html__('No', 'rainbowit'),
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'rainbowit_preloader',
            'type' => 'button_set',
            'title' => esc_html__('Enable Preloader', 'rainbowit'),
            'options' => array(
                'yes' => esc_html__('Yes', 'rainbowit'),
                'no' => esc_html__('No', 'rainbowit'),
            ),
            'default' => 'no'
        ),
    )
));

Redux::setSection($opt_name,
    array(
        'title' => esc_html__('Contact & Socials', 'rainbowit'),
        'id' => 'socials_section',
        'heading' => esc_html__('Contact & Socials', 'rainbowit'),
        'desc' => esc_html__('In case you want to hide any field, just keep that field empty', 'rainbowit'),
        'icon' => 'el el-twitter',


        'fields' => array(


            array(
                'id' => 'social_title',
                'type' => 'text',
                'title' => esc_html__('Social Title', 'rainbowit'),
                'default' => esc_html__('Follow us', 'rainbowit'),
            ),
            array(
                'id' => 'rainbowit_social_share_title',
                'type' => 'text',
                'title' => esc_html__('Social Title For Headers', 'rainbowit'),
                'default' => esc_html__('find with me', 'rainbowit'),
            ),
            array(
                'id' => 'social_facebook',
                'type' => 'text',
                'title' => esc_html__('Facebook', 'rainbowit'),
                'default' => '#',
            ),
            array(
                'id' => 'social_twitter',
                'type' => 'text',
                'title' => esc_html__('Twitter', 'rainbowit'),
                'default' => '#',
            ),

            array(
                'id' => 'social_linkedin',
                'type' => 'text',
                'title' => esc_html__('Linkedin', 'rainbowit'),
                'default' => '#',
            ),
            array(
                'id' => 'social_youtube',
                'type' => 'text',
                'title' => esc_html__('Youtube', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_instagram',
                'type' => 'text',
                'title' => esc_html__('Instagram', 'rainbowit'),
                'default' => '',
            ), 

            array(
                'id' => 'social_tiktok',
                'type' => 'text',
                'title' => esc_html__('TikTok', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_telegram',
                'type' => 'text',
                'title' => esc_html__('Telegram', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_snapchat',
                'type' => 'text',
                'title' => esc_html__('Snapchat', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_whatsapp',
                'type' => 'text',
                'title' => esc_html__('WhatsApp', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_pinterest',
                'type' => 'text',
                'title' => esc_html__('Pinterest', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_reddit',
                'type' => 'text',
                'title' => esc_html__('Reddit', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_qq',
                'type' => 'text',
                'title' => esc_html__('QQ', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_vimeo',
                'type' => 'text',
                'title' => esc_html__('Vimeo', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_skype',
                'type' => 'text',
                'title' => esc_html__('Skype', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_viber',
                'type' => 'text',
                'title' => esc_html__('Viber', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_wordpress',
                'type' => 'text',
                'title' => esc_html__('WordPress', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_discord',
                'type' => 'text',
                'title' => esc_html__('discord', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_stack_overflow',
                'type' => 'text',
                'title' => esc_html__('Stack Overflow', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_stack_dribbble',
                'type' => 'text',
                'title' => esc_html__('Dribbble', 'rainbowit'),
                'default' => '',
            ),
            array(
                'id' => 'social_stack_behance',
                'type' => 'text',
                'title' => esc_html__('Behance', 'rainbowit'),
                'default' => '',
            ),



        )
    )
);

/**
 * Header area
 */
Redux::setSection($opt_name, array(
        'title' => esc_html__('Header', 'rainbowit'),
        'id' => 'header_id',
        'icon' => 'el el-minus',
        'fields' => array(
            array(
                'id' => 'rainbowit_enable_header',
                'type' => 'switch',
                'title' => esc_html__('Header', 'rainbowit'),
                'subtitle' => esc_html__('Enable or disable the header area.', 'rainbowit'),
                'on' => esc_html__('Enabled', 'rainbowit'),
                'off' => esc_html__('Disabled', 'rainbowit'),
                'default' => true
            ),

            array(
                'id' => 'rainbowit_header_btn',
                'type' => 'switch',
                'title' => esc_html__('Header Button', 'rainbowit'),
                'on' => esc_html__('Enabled', 'rainbowit'),
                'off' => esc_html__('Disabled', 'rainbowit'),
                'default' => true,
                'required' => array('rainbowit_enable_header', 'equals', true),
            ),
            array(
                'id' => 'rainbowit_header_buttontext',
                'type' => 'text',
                'title' => esc_html__('Header button Text', 'rainbowit'),
                'default' => esc_html__('Log In', 'rainbowit'),
                'required' => array('rainbowit_header_btn', 'equals', true),
            ),
            array(
                'id' => 'rainbowit_header_buttonUrl',
                'type' => 'text',
                'default' => '#',
                'title' => esc_html__('Button Url', 'rainbowit'),
                'required' => array('rainbowit_header_btn', 'equals', true),

            ),

            array(
                'id' => 'rainbowit_header_hire_us_btn_text',
                'type' => 'text',
                'title' => esc_html__('Header button Text', 'rainbowit'),
                'default' => esc_html__('Hire Us', 'rainbowit'),
                'required' => array('rainbowit_header_btn', 'equals', true),
            ),
            array(
                'id' => 'rainbowit_header_hire_us_buttonUrl',
                'type' => 'text',
                'default' => '#',
                'title' => esc_html__('Button Url', 'rainbowit'),
                'required' => array('rainbowit_header_btn', 'equals', true),

            ),
            array(
                'id' => 'rainbowit_header_sticky',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky', 'rainbowit'),
                'subtitle' => esc_html__('Enable to activate the sticky header.', 'rainbowit'),
                'on' => esc_html__('Enabled', 'rainbowit'),
                'off' => esc_html__('Disabled', 'rainbowit'),
                'default' => false,
                'required' => array('rainbowit_enable_header', 'equals', true),
            ),

        )
    )
);

/**
 * Footer area
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer', 'rainbowit'),
    'id' => 'rainbowit_footer_section',
    'icon' => 'el el-photo',
    'fields' => array(
        array(
            'id' => 'rainbowit_footer_enable',
            'type' => 'switch',
            'title' => esc_html__('Footer', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the footer area without copyright.', 'rainbowit'),
            'on' => esc_html__('Enabled', 'rainbowit'),
            'off' => esc_html__('Disabled', 'rainbowit'),
            'default' => true,
        ),

        array(
            'id' => 'rainbowit_footer_shape_enable',
            'type' => 'switch',
            'title' => esc_html__('Footer Shape', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the footer shape.', 'rainbowit'),
            'on' => esc_html__('Enabled', 'rainbowit'),
            'off' => esc_html__('Disabled', 'rainbowit'),
            'default' => false,
        ),

        array(
            'id' => 'rainbowit_footer_subscribe_title',
            'type' => 'text',
            'title' => esc_html__('Subscribe Title', 'rainbowit'),
            'default' => esc_html__('Want to Get Discount & Product Updates From Us?', 'rainbowit'),
        ),

        array(
            'id' => 'rainbowit_footer_subscribe_shortcode',
            'type' => 'textarea',
            'title' => esc_html__('Subscribe Shortcode', 'rainbowit'),
            'args' => array(
                'textarea_rows' => 5,
            ),
        ),
        // Header Custom Style

        array(
            'id' => 'rainbowit_footer_bottom_social_icons',
            'type' => 'switch',
            'title' => esc_html__('Footer Social Enable?', 'rainbowit'),
            'on' => esc_html__('Enabled', 'rainbowit'),
            'off' => esc_html__('Disabled', 'rainbowit'),
            'default' => true,
        ),

        // Footer Bottom
        array(
            'id' => 'rainbowit_copyright_contact',
            'type' => 'editor',
            'title' => esc_html__('Copyright Content', 'rainbowit'),
            'args' => array(
                'teeny' => true,
                'textarea_rows' => 5,
            ),
            'default' => esc_html__('Copyright © 2024 Rainbowit WordPress Theme.', 'rainbowit'),
        ),

    )
));

/**
 * Page Banner/Title section
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('
    Page Banner', 'rainbowit'),
    'id' => 'rainbowit_banner_section',
    'icon' => 'el el-website',
    'fields' => array(
        array(
            'id' => 'rainbowit_banner_enable',
            'type' => 'switch',
            'title' => esc_html__('Banner', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the banner area.', 'rainbowit'),
            'on' => esc_html__('Enabled', 'rainbowit'),
            'off' => esc_html__('Disabled', 'rainbowit'),
            'default' => true,
        ),
        // Header Custom Style
        array(
            'id' => 'rainbowit_select_banner_template',
            'type' => 'image_select',
            'title' => esc_html__('Select banner Layout', 'rainbowit'),
            'options' => array(
                '1' => array(
                    'alt' => esc_html__('Banner Layout 1', 'rainbowit'),
                    'title' => esc_html__('Banner Layout 1', 'rainbowit'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/banner/1.png',
                ),
                '2' => array(
                    'alt' => esc_html__('Banner Layout 2', 'rainbowit'),
                    'title' => esc_html__('Banner Layout 2', 'rainbowit'),
                    'img' => get_template_directory_uri() . '/assets/images/optionframework/banner/2.png',
                ),
            ),
            'default' => '1',
            'required' => array('rainbowit_banner_enable', 'equals', true),
        ),
        array(
            'id' => 'rainbowit_breadcrumb_enable',
            'type' => 'switch',
            'title' => esc_html__('Breadcrumb', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the breadcrumb area.', 'rainbowit'),
            'default' => true,
            'required' => array('rainbowit_select_banner_template', 'equals', '1'),
        ),
        array(
            'id' => 'rainbowit_select_banner_image',
            'title' => esc_html__('Upload Banner Background Image', 'rainbowit'),
            'subtitle' => esc_html__('Upload the banner background image of your banner layout one & two.', 'rainbowit'),
            'type' => 'media',
            'required' => array('rainbowit_banner_enable', 'equals', true),
        ),
        array(
            'id'       => 'rainbowit_banner_image_overlay_gradient_color_opt',
            'type'     => 'color_gradient',
            'title'    => esc_html__('Banner Background Image Overlay', 'rainbowit'),
            'validate' => 'color',
            'output'  =>  array('.breadcrumb-area:before, .rn-page-title-area:before'),
            'default'        => array(
                'preview' => false,
                'from'           => '',
                'to'             => '',
            ),
            'required' => array('rainbowit_banner_enable', 'equals', true),
        ),

    )
));

/**
 * Blog Panel
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Blog', 'rainbowit'),
    'id' => 'rainbowit_blog',
    'icon' => 'el el-file-edit',
));

// Blog Options
Redux::setSection($opt_name, array(
        'title' => esc_html__('Archive', 'rainbowit'),
        'id' => 'rainbowit_blog_genaral',
        'icon' => 'el el-folder-open',
        'subsection' => true,
        'fields' => array(
            
            array(
                'id' => 'rainbowit_blog_text',
                'type' => 'text',
                'title' => esc_html__('Default Title', 'rainbowit'),
                'subtitle' => esc_html__('Controls the Default title of the page which is displayed on the page title are on the blog page.', 'rainbowit'),
                'default' => esc_html__('Blog', 'rainbowit'),
            ),
            array(
                'id' => 'rainbowit_blog_sidebar',
                'type' => 'image_select',
                'title' => esc_html__('Select Blog Sidebar', 'rainbowit'),
                'subtitle' => esc_html__('Choose your favorite blog layout', 'rainbowit'),
                'options' => array(
                    'left' => array(
                        'alt' => esc_html__('Left Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                        'title' => esc_html__('Left Sidebar', 'rainbowit'),
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                        'title' => esc_html__('Right Sidebar', 'rainbowit'),
                    ),
                    'no' => array(
                        'alt' => esc_html__('No Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                        'title' => esc_html__('No Sidebar', 'rainbowit'),
                    ),
                ),
                'default' => 'right',
            ),
            array(
                'id' => 'rainbowit_show_post_author_meta',
                'type' => 'button_set',
                'title' => esc_html__('Author', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the author of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_post_publish_date_meta',
                'type' => 'button_set',
                'title' => esc_html__('Publish Date', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the publish date of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_post_updated_date_meta',
                'type' => 'button_set',
                'title' => esc_html__('Updated Date', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the updated date of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_show_post_reading_time_meta',
                'type' => 'button_set',
                'title' => esc_html__('Reading Time', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the publish content reading time.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_post_comments_meta',
                'type' => 'button_set',
                'title' => esc_html__('Comments', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the comments of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_show_post_categories_meta',
                'type' => 'button_set',
                'title' => esc_html__('Categories', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the categories of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_show_post_tags_meta',
                'type' => 'button_set',
                'title' => esc_html__('Tags', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the tags of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_enable_readmore_btn',
                'type' => 'button_set',
                'title' => esc_html__('Read More Button', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the read more button of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_readmore_text',
                'type' => 'text',
                'title' => esc_html__('Read More Text', 'rainbowit'),
                'subtitle' => esc_html__('Set the Default title of read more button.', 'rainbowit'),
                'default' => esc_html__('Read More', 'rainbowit'),
                'required' => array('rainbowit_enable_readmore_btn', 'equals', 'yes'),
            ),
        )
    )
);

Redux::set_field( $opt_name, 'rainbowit_blog_genaral', array(
    'id'       => 'blog_bottom_template_id',
    'type'     => 'select',
    'title'    => esc_html__('Select Blog Bottom Template ', 'rainbowit'), 
    'subtitle' => esc_html__('No validation can be done on this field type', 'rainbowit'),
    'desc'     => esc_html__('Select Blog Bottom Template', 'rainbowit'),
    'options'  => get_elementor_template_library(),
    'default' => '0'
) );


Redux::set_field( $opt_name, 'rainbowit_blog_genaral', array(
    'id'       => 'blog_bottom_client_template_id',
    'type'     => 'select',
    'title'    => esc_html__('Select Blog Bottom Client Template ', 'rainbowit'), 
    'subtitle' => esc_html__('No validation can be done on this field type', 'rainbowit'),
    'desc'     => esc_html__('Select Blog Bottom Client Template', 'rainbowit'),
    'options'  => get_elementor_template_library(),
    'default' => '0'
) );


/**
 * Single Post
 */
Redux::setSection($opt_name, array(
        'title' => esc_html__('Single', 'rainbowit'),
        'id' => 'rainbowit_blog_details_id',
        'icon' => 'el el-website',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'rainbowit_show_blog_details_author_meta',
                'type' => 'button_set',
                'title' => esc_html__('Author', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the author of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_blog_details_publish_date_meta',
                'type' => 'button_set',
                'title' => esc_html__('Publish Date', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the publish date of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_blog_details_updated_date_meta',
                'type' => 'button_set',
                'title' => esc_html__('Updated Date', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the updated date of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_show_blog_details_reading_time_meta',
                'type' => 'button_set',
                'title' => esc_html__('Reading Time', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the publish content reading time.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_show_blog_details_comments_meta',
                'type' => 'button_set',
                'title' => esc_html__('Comments', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the comments of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_show_blog_details_categories_meta',
                'type' => 'button_set',
                'title' => esc_html__('Categories', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the categories of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_related_post_subtitle',
                'type' => 'text',
                'title' => esc_html__('Related Post Subtitle', 'rainbowit'),
                'subtitle' => esc_html__('Set the Default subtitle.', 'rainbowit'),
                'default' => esc_html__('Related Articles', 'rainbowit'),
            ),
            array(
                'id' => 'rainbowit_related_post_title',
                'type' => 'text',
                'title' => esc_html__('Related Post title', 'rainbowit'),
                'default' => esc_html__('You might also like', 'rainbowit'),
            ),
            array(
                'id' => 'rainbowit_related_post_desc',
                'type' => 'textarea',
                'title' => esc_html__('Related Post Description', 'rainbowit'),
                'default' => esc_html__('Reviews from our customers of themeforest who already bought rainbow themes items form themeforest', 'rainbowit'),
            ),

            array(
                'id' => 'rbt_blog_details_social_share_label',
                'type' => 'text',
                'title' => esc_html__('Social Share Label Text', 'rainbowit'),
                'default' => esc_html__('Share', 'rainbowit'),
            ),

            

        )
    )
);
/**
 * Portfolio Panel
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Portfolio', 'rainbowit'),
    'id' => 'rainbowit_portfolio',
    'icon' => 'el el-th',
));
/**
 * Single Archive
 */
Redux::setSection($opt_name, array(
        'title' => esc_html__('Archive', 'rainbowit'),
        'id' => 'rainbowit_portfolio_archive_id',
        'icon' => 'el el-folder-open',
        'subsection' => true,
        'fields' => array(
            // Client Name

            array(
                'id' => 'rainbowit_show_project_category',
                'type' => 'button_set',
                'title' => esc_html__('Category', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the category of blog post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_enable_case_study_button',
                'type' => 'button_set',
                'title' => esc_html__('Portfolio Button (View Details)', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the portfolio case study (View Details) button of portfolio archive and addons', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'no',
            ),
            array(
                'id' => 'rainbowit_enable_case_study_button_text',
                'type' => 'text',
                'title' => esc_html__('Portfolio Button Text', 'rainbowit'),
                'default' => esc_html__('Case Study', 'rainbowit'),
                'required' => array('rainbowit_enable_case_study_button', 'equals', 'yes'),
            ),
            array(
                'id' => 'rainbowit_project_image_size',
                'type' => 'select',
                'title' => esc_html__('Select Thumbnail Size', 'rainbowit'),
                'options' => rainbowit_get_thumbnail_sizes(),
                'default' => 'rainbowit-thumbnail-sm',
            ),
            array(
                'id' => 'rainbowit_project_archive_sidebar',
                'type' => 'image_select',
                'title' => esc_html__('Select Project Archive Sidebar', 'rainbowit'),
                'subtitle' => esc_html__('Choose your favorite layout', 'rainbowit'),
                'options' => array(
                    'left' => array(
                        'alt' => esc_html__('Left Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                        'title' => esc_html__('Left Sidebar', 'rainbowit'),
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                        'title' => esc_html__('Right Sidebar', 'rainbowit'),
                    ),
                    'no' => array(
                        'alt' => esc_html__('No Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                        'title' => esc_html__('No Sidebar', 'rainbowit'),
                    ),
                ),
                'default' => 'no',
            ),
            array(
                'id'       => 'rainbowit_project_archive_col_lg',
                'type'     => 'select',
                'title'    => esc_html__('Select Column for Desktops', 'rainbowit'),
                'subtitle' => esc_html__('Desktops: ≥ 1200px', 'rainbowit'),
                'options'  => array(
                    '12' => esc_html__('1 Col', 'rainbowit'),
                    '6' => esc_html__('2 Col', 'rainbowit'),
                    '4' => esc_html__('3 Col', 'rainbowit'),
                    '3' => esc_html__('4 Col', 'rainbowit'),
                ),
                'default'  => '4',
            ),
            array(
                'id'       => 'rainbowit_project_archive_col_md',
                'type'     => 'select',
                'title'    => esc_html__('Select Column for Tabs', 'rainbowit'),
                'subtitle'    => esc_html__('Tabs: ≥ 992px', 'rainbowit'),
                'options'  => array(
                    '12' => esc_html__('1 Col', 'rainbowit'),
                    '6' => esc_html__('2 Col', 'rainbowit'),
                    '4' => esc_html__('3 Col', 'rainbowit'),
                    '3' => esc_html__('4 Col', 'rainbowit'),
                ),
                'default'  => '6',
            ),
            array(
                'id'       => 'rainbowit_project_archive_col_sm',
                'type'     => 'select',
                'title'    => esc_html__('Select Column for Large Mobiles', 'rainbowit'),
                'subtitle'    => esc_html__('Large Mobiles: ≥ 576px', 'rainbowit'),
                'options'  => array(
                    '12' => esc_html__('1 Col', 'rainbowit'),
                    '6' => esc_html__('2 Col', 'rainbowit'),
                    '4' => esc_html__('3 Col', 'rainbowit'),
                    '3' => esc_html__('4 Col', 'rainbowit'),
                ),
                'default'  => '12',
            ),
            array(
                'id'       => 'rainbowit_project_archive_col',
                'type'     => 'select',
                'title'    => esc_html__('Select Column for Small Mobiles', 'rainbowit'),
                'subtitle'    => esc_html__('Small Mobiles: < 576px', 'rainbowit'),
                'options'  => array(
                    '12' => esc_html__('1 Col', 'rainbowit'),
                    '6' => esc_html__('2 Col', 'rainbowit'),
                    '4' => esc_html__('3 Col', 'rainbowit'),
                    '3' => esc_html__('4 Col', 'rainbowit'),
                ),
                'default'  => '12',
            ),
            array(
                'id' => 'projects_slug',
                'type' => 'text',
                'title' => esc_html__('Project Slug', 'rainbowit'),
                'subtitle' => esc_html__('Change the project url slug', 'rainbowit'),
                'description' => esc_html__('After saving your custom portfolio slug, flush the permalinks from "Wordpress Settings > Permalinks" for the changes to take effect.', 'rainbowit'),
                'default' => 'portfolio',
            ),
            array(
                'id' => 'projects_cat_slug',
                'type' => 'text',
                'title' => esc_html__('Projects Categories Slug', 'rainbowit'),
                'subtitle' => esc_html__('Change the projects Categories url slug', 'rainbowit'),
                'description' => esc_html__('After saving your custom portfolio slug, flush the permalinks from "Wordpress Settings > Permalinks" for the changes to take effect.', 'rainbowit'),
                'default' => 'portfolio-cat',
            ),

        )
    )
);
/**
 * Single Portfolio
 */
Redux::setSection($opt_name, array(
        'title' => esc_html__('Single', 'rainbowit'),
        'id' => 'rainbowit_portfolio_details_id',
        'icon' => 'el el-website',
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'select_title_bellow_content',
                'type'     => 'select',
                'title'    => esc_html__('Select Title Bellow Content', 'rainbowit'),
                'desc'     => esc_html__('Select Excerpt or Breadcrumbs. If you want to empty this please select none.', 'rainbowit'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    'excerpt' => 'Excerpt',
                    'breadcrumbs' => 'Breadcrumbs',
                    'both' => 'Excerpt and Breadcrumbs',
                    'none' => 'None'
                ),
                'default'  => 'excerpt',
            ),

            array(
                'id' => 'rainbowit_project_single_image_size',
                'type' => 'select',
                'title' => esc_html__('Select Thumbnail Size', 'rainbowit'),
                'options' => rainbowit_get_thumbnail_sizes(),
                'default' => 'rainbowit-thumbnail-single',
            ),


            // Client Name
            array(
                'id' => 'rainbowit_enable_client_name_meta',
                'type' => 'button_set',
                'title' => esc_html__('Client Name', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the portfolio client name of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_client_name_text',
                'type' => 'text',
                'title' => esc_html__('Client Name Text', 'rainbowit'),
                'default' => esc_html__('Client Name', 'rainbowit'),
                'required' => array('rainbowit_enable_client_name_meta', 'equals', 'yes'),
            ),

            // Release Date
            array(
                'id' => 'rainbowit_enable_release_date_meta',
                'type' => 'button_set',
                'title' => esc_html__('Release Date', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the portfolio release date of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_release_date_text',
                'type' => 'text',
                'title' => esc_html__('Release Date Text', 'rainbowit'),
                'default' => esc_html__('Release Date', 'rainbowit'),
                'required' => array('rainbowit_enable_release_date_meta', 'equals', 'yes'),
            ),

            // Project Types
            array(
                'id' => 'rainbowit_enable_project_types_meta',
                'type' => 'button_set',
                'title' => esc_html__('Project Types', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the portfolio project types of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_project_types_text',
                'type' => 'text',
                'title' => esc_html__('Project Types Text', 'rainbowit'),
                'default' => esc_html__('Project Types', 'rainbowit'),
                'required' => array('rainbowit_enable_project_types_meta', 'equals', 'yes'),
            ),

            // Live Preview
            array(
                'id' => 'rainbowit_enable_live_preview_meta',
                'type' => 'button_set',
                'title' => esc_html__('Live Preview', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the portfolio live preview of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_live_preview_text',
                'type' => 'text',
                'title' => esc_html__('Live Preview Text', 'rainbowit'),
                'default' => esc_html__('Live Preview', 'rainbowit'),
                'required' => array('rainbowit_enable_live_preview_meta', 'equals', 'yes'),
            ),
            array(
                'id' => 'rainbowit_live_preview_button_text',
                'type' => 'text',
                'title' => esc_html__('Live Preview Button Text', 'rainbowit'),
                'default' => esc_html__('Visit Live Site', 'rainbowit'),
                'required' => array('rainbowit_enable_live_preview_meta', 'equals', 'yes'),
            ),


            /**
             * Portfolio Share option
             */
            array(
                'id' => 'rainbowit_enable_portfolio_share',
                'type' => 'button_set',
                'title' => esc_html__('Share options', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the social share button of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            // Facebook
            array(
                'id' => 'rainbowit_enable_portfolio_share_facebook',
                'type' => 'button_set',
                'title' => esc_html__('Facebook', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the facebook share button of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
                'required' => array('rainbowit_enable_portfolio_share', 'equals', 'yes'),
            ),
            // Twitter
            array(
                'id' => 'rainbowit_enable_portfolio_share_twitter',
                'type' => 'button_set',
                'title' => esc_html__('Twitter', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the twitter share button of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
                'required' => array('rainbowit_enable_portfolio_share', 'equals', 'yes'),
            ),
            // Linkedin
            array(
                'id' => 'rainbowit_enable_portfolio_share_linkedin',
                'type' => 'button_set',
                'title' => esc_html__('Linkedin', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the linkedin share button of portfolio single post.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
                'required' => array('rainbowit_enable_portfolio_share', 'equals', 'yes'),
            ),

            /**
             * Related portfolio
             */
            array(
                'id' => 'rainbowit_enable_related_portfolio',
                'type' => 'button_set',
                'title' => esc_html__('Related Portfolio', 'rainbowit'),
                'subtitle' => esc_html__('Show or hide the related portfolio area of portfolio single post bellow section.', 'rainbowit'),
                'options' => array(
                    'yes' => esc_html__('Show', 'rainbowit'),
                    'no' => esc_html__('Hide', 'rainbowit'),
                ),
                'default' => 'yes',
            ),
            array(
                'id' => 'rainbowit_related_portfolio_section_title_before_text',
                'type' => 'text',
                'title' => esc_html__('Section Title Before Text', 'rainbowit'),
                'default' => esc_html__('Related Work', 'rainbowit'),
                'required' => array('rainbowit_enable_related_portfolio', 'equals', 'yes'),
            ),
            array(
                'id' => 'rainbowit_related_portfolio_section_title_text',
                'type' => 'text',
                'title' => esc_html__('Section Title Text', 'rainbowit'),
                'default' => esc_html__('Our More Projects', 'rainbowit'),
                'required' => array('rainbowit_enable_related_portfolio', 'equals', 'yes'),
            ),

        )
    )
);
/**
 * Typography
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography', 'rainbowit'),
    'id' => 'rainbowit_fonts',
    'icon' => 'el el-fontsize',
    'fields' => array(
        array(
            'id' => 'rainbowit_b_typography',
            'type' => 'typography',
            'title' => esc_html__('Body Typography (Paragraph)', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the body.', 'rainbowit'),
            'google' => true,
            'color' => false,
            'subsets' => false,
            'word-spacing' => false,
            'letter-spacing' => false,
            'text-align' => false,
            'all_styles' => false,
            'output' => array('body, p'),
            'units' => 'px',
        ),
        array(
            'id' => 'rainbowit_h1_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H1 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H1 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'word-spacing' => false,
            'letter-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h1, .h1'),
        ),
        array(
            'id' => 'rainbowit_h2_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H2 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H2 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'letter-spacing' => false,
            'word-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h2, .h2'),
        ),
        array(
            'id' => 'rainbowit_h3_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H3 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H3 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'letter-spacing' => false,
            'word-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h3, .h3'),
        ),
        array(
            'id' => 'rainbowit_h4_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H4 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H4 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'word-spacing' => false,
            'letter-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h4, .h4'),
        ),
        array(
            'id' => 'rainbowit_h5_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H5 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H5 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'word-spacing' => false,
            'letter-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h5, .h5'),
        ),
        array(
            'id' => 'rainbowit_h6_typography',
            'type' => 'typography',
            'always_display' => false,
            'color' => false,
            'title' => esc_html__('H6 Heading Typography', 'rainbowit'),
            'subtitle' => esc_html__('Controls the typography settings of the H6 heading.', 'rainbowit'),
            'google' => true,
            'text-transform' => false,
            'word-spacing' => false,
            'letter-spacing' => false,
            'subsets' => false,
            'text-align' => false,
            'all_styles' => false,
            'units' => 'px',
            'output' => array('h6, .h6'),
        ),

    )
));

/**
 * 404 error page
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('404 Page', 'rainbowit'),
    'id' => 'rainbowit_error_page',
    'icon' => 'el el-eye-close',
    'fields' => array(
        array(
            'id' => 'rainbowit_404_title',
            'type' => 'text',
            'title' => esc_html__('Title', 'rainbowit'),
            'subtitle' => esc_html__('Add your Default title.', 'rainbowit'),
            'default' => esc_html__('404!', 'rainbowit'),
        ),
        array(
            'id' => 'rainbowit_404_subtitle',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'rainbowit'),
            'subtitle' => esc_html__('Add your custom subtitle.', 'rainbowit'),
            'default' => esc_html__('Page not found', 'rainbowit'),
        ),
        array(
            'id' => 'rainbowit_404_desc',
            'type' => 'text',
            'title' => esc_html__('Description', 'rainbowit'),
            'subtitle' => esc_html__('Add your custom description.', 'rainbowit'),
            'default' => esc_html__('The page you were looking for could not be found.', 'rainbowit'),
        ),
        array(
            'id' => 'rainbowit_enable_go_back_btn',
            'type' => 'button_set',
            'title' => esc_html__('Button', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the go to home page button.', 'rainbowit'),
            'options' => array(
                'yes' => 'Enable',
                'no' => 'Disable'
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'rainbowit_404_enable_search',
            'type' => 'button_set',
            'title' => esc_html__('Search Form', 'rainbowit'),
            'subtitle' => esc_html__('Enable or disable the blog search form', 'rainbowit'),
            'options' => array(
                'yes' => 'Enable',
                'no' => 'Disable'
            ),
            'default' => 'yes'
        ),
        array(
            'id' => 'rainbowit_404_search_form_placeholder',
            'type' => 'text',
            'title' => esc_html__('Search placeholder', 'rainbowit'),
            'default' => esc_html__('Search Here...', 'rainbowit'),
            'required' => array('rainbowit_404_enable_search', 'equals', 'yes'),
        ),
        array(
            'id' => 'rainbowit_404_button_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'rainbowit'),
            'subtitle' => esc_html__('Set the custom text of go to home page button.', 'rainbowit'),
            'default' => esc_html__('Back To Homepage', 'rainbowit'),
            'required' => array('rainbowit_enable_go_back_btn', 'equals', 'yes'),
        ),
    )
));


/**
 * WooCommerce
 */
if ( class_exists( 'WooCommerce' ) ) {

    Redux::setSection($opt_name, array(
        'title' => esc_html__('WooCommerce', 'rainbowit'),
        'id' => 'woo_Settings_section',
        'icon' => 'el el-shopping-cart',
    ));
    /**
     * WooCommerce Archive
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('General', 'rainbowit'),
        'id' => 'wc_sec_general',
        'icon' => 'el el-folder-open',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'wc_general_sidebar',
                'type' => 'image_select',
                'title' => esc_html__('Select Shop Sidebar', 'rainbowit'),
                'subtitle' => esc_html__('Choose your favorite shop layout', 'rainbowit'),
                'options' => array(
                    'left' => array(
                        'alt' => esc_html__('Left Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                        'title' => esc_html__('Left Sidebar', 'rainbowit'),
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                        'title' => esc_html__('Right Sidebar', 'rainbowit'),
                    ),
                    'no' => array(
                        'alt' => esc_html__('No Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                        'title' => esc_html__('No Sidebar', 'rainbowit'),
                    ),
                ),
                'default' => 'no',
            ),
            array(
                'id'       => 'wc_num_product_per_row',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Row', 'rainbowit' ),
                'default'  => '3',
            ),
            array(
                'id'       => 'wc_num_product',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Page', 'rainbowit' ),
                'default'  => '12',
            ),
            array(
                'id'       => 'order_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Order Button Title', 'rainbowit' ),
                'default'  => 'Order Now',
            ),
            array(
                'id'       => 'details_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Details Button Title', 'rainbowit' ),
                'default'  => 'Details',
            ),
            array(
                'id'       => 'preview_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Live Preview Text', 'rainbowit' ),
                'default'  => 'Live Preview',
            ),
        )
    ));
    /**
     * WooCommerce Single Page
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Product Single Page', 'rainbowit'),
        'id' => 'wc_sec_product',
        'icon' => 'el el-folder-open',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'wc_single_sidebar',
                'type' => 'image_select',
                'title' => esc_html__('Select Single Sidebar', 'rainbowit'),
                'subtitle' => esc_html__('Choose your favorite shop Single layout', 'rainbowit'),
                'options' => array(
                    'left' => array(
                        'alt' => esc_html__('Left Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/left-sidebar.png',
                        'title' => esc_html__('Left Sidebar', 'rainbowit'),
                    ),
                    'right' => array(
                        'alt' => esc_html__('Right Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/right-sidebar.png',
                        'title' => esc_html__('Right Sidebar', 'rainbowit'),
                    ),
                    'no' => array(
                        'alt' => esc_html__('No Sidebar', 'rainbowit'),
                        'img' => get_template_directory_uri() . '/assets/images/optionframework/layout/no-sidebar.png',
                        'title' => esc_html__('No Sidebar', 'rainbowit'),
                    ),
                ),
                'default' => 'no',
            ),
            array(
                'id'       => 'wc_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description Tab', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_reviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'Reviews Tab', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_additional_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Additional Information Tab', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
        )
    ));
    /**
     * WooCommerce Cart Page
     */
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Cart page', 'rainbowit'),
        'id' => 'wc_sec_cart',
        'icon' => 'el el-folder-open',
        'subsection' => true,
        'fields' => array(
            array(
                'id'       => 'wc_cross_sell',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross Sell Products', 'rainbowit' ),
                'on'       => esc_html__( 'Show', 'rainbowit' ),
                'off'      => esc_html__( 'Hide', 'rainbowit' ),
                'default'  => true,
            ),
        )
    ));
} // End WooCommerce
