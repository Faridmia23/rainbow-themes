<?php
/**
 * Plugin Name: Rainbow Core
 * Plugin URI: Rainbowit core plugin
 * Description: Description here.
 * Version: 1.0
 * Author: Rainbow-Themes
 * Author URI: http://rainbowit.net/
 * Text Domain: rainbowit
 */

use Elementor\Controls_Manager;
/**
 * Define
 */
define('RAINBOWIT_ADDONS_VERSION', '1.0');
define('RAINBOWIT_ADDONS_URL', plugins_url('/', __FILE__));
define('RAINBOWIT_ADDONS_DIR', dirname(__FILE__));
define('RAINBOWIT_ADDONS_PATH', plugin_dir_path(__FILE__));
define('RAINBOWIT_ELEMENTS_PATH', RAINBOWIT_ADDONS_DIR . '/include/elementor');

/**
 * Include all files
 */
include_once(RAINBOWIT_ADDONS_DIR . '/include/ajax_requests.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/custom-post.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/social-share.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/widgets/custom-widget-register.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/common-functions.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/custom-product-type.php');
include_once(RAINBOWIT_ADDONS_DIR . '/include/allow-svg.php');

/**
 * Load Custom Addonss
 */
if (in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function rainbowitLoadCustomElements()
    {
        if (is_dir(RAINBOWIT_ELEMENTS_PATH) && $rainbowit_cc_dirhandle = opendir(RAINBOWIT_ELEMENTS_PATH)) {
            while ($rainbowit_cc_file = readdir($rainbowit_cc_dirhandle)) {
                if (!in_array($rainbowit_cc_file, array('.', '..'))) {
                    $rainbowit_cc_file_contents = file_get_contents(RAINBOWIT_ELEMENTS_PATH . '/' . $rainbowit_cc_file);
                    $rainbowit_cc_php_file_tokens = token_get_all($rainbowit_cc_file_contents);
                    require_once(RAINBOWIT_ELEMENTS_PATH . '/' . $rainbowit_cc_file);
                }
            }
        }
    }

    add_action('elementor/widgets/register', 'rainbowitLoadCustomElements');
}

/**
 * Add Category
 */
if (in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    function rainbowit_elementor_category($elements_manager)
    {
        $elements_manager->add_category(
            'rainbowit',
            array(
                'title' => esc_html__('Rainbowit Addons', 'rainbowit'),
                'icon' => 'eicon-banner',
            )
        );
    }

    add_action('elementor/elements/categories_registered', 'rainbowit_elementor_category');
}

/**
 * Escapeing
 */
if (!function_exists('rainbowit_escapeing')) {
    function rainbowit_escapeing($html)
    {
        return $html;
    }
}

/**
 * Load module's scripts and styles if any module is active.
 */
function rainbowit_element_enqueue()
{
    // wp_enqueue_style('essential_addons_elementor-css',RAINBOWIT_ADDONS_URL.'assets/css/rainbowit.css');
    wp_enqueue_style('rainbowit-feather-icons', RAINBOWIT_ADDONS_URL . 'assets/css/feather.css', null, '1.0');

    if ( is_rtl() ) {
        wp_enqueue_script('rainbowit-element-scripts', RAINBOWIT_ADDONS_URL . 'assets/js/rtl/element-scripts.js', array('jquery'), '1.0', true);
    } else {
        wp_enqueue_script('rainbowit-element-scripts', RAINBOWIT_ADDONS_URL . 'assets/js/element-scripts.js', array('jquery'), '1.0', true);
    }

}

add_action('wp_enqueue_scripts', 'rainbowit_element_enqueue');


function rainbowit_enqueue_editor_scripts()
{
    wp_enqueue_style('rainbowit-element-addons-editor', RAINBOWIT_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
}

add_action('elementor/editor/after_enqueue_scripts', 'rainbowit_enqueue_editor_scripts');


/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function rbt_is_elementor_version($operator = '<', $version = '2.6.0')
{
    return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
}


/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function rbt_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
{
    // Check if its already migrated
    $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty($settings[$old_icon_id]);

    $attributes['aria-hidden'] = 'true';

    if (rbt_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
        \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
    } else {
        if (empty($attributes['class'])) {
            $attributes['class'] = $settings[$old_icon_id];
        } else {
            if (is_array($attributes['class'])) {
                $attributes['class'][] = $settings[$old_icon_id];
            } else {
                $attributes['class'] .= ' ' . $settings[$old_icon_id];
            }
        }
        printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
    }
}

/**
 * Adding custom icon to icon control in Elementor
 */
function rbt_add_custom_icons_tab($tabs = array())
{
    // Append new icons
    $feather_icons = array(
        'feather-activity',
        'feather-airplay',
        'feather-alert-circle',
        'feather-alert-octagon',
        'feather-alert-triangle',
        'feather-align-center',
        'feather-align-justify',
        'feather-align-left',
        'feather-align-right',
        'feather-anchor',
        'feather-aperture',
        'feather-archive',
        'feather-arrow-down',
        'feather-arrow-down-circle',
        'feather-arrow-down-left',
        'feather-arrow-down-right',
        'feather-arrow-left',
        'feather-arrow-left-circle',
        'feather-arrow-right',
        'feather-arrow-right-circle',
        'feather-arrow-up',
        'feather-arrow-up-circle',
        'feather-arrow-up-left',
        'feather-arrow-up-right',
        'feather-at-sign',
        'feather-award',
        'feather-bar-chart',
        'feather-bar-chart-2',
        'feather-battery',
        'feather-battery-charging',
        'feather-bell',
        'feather-bell-off',
        'feather-bluetooth',
        'feather-bold',
        'feather-book',
        'feather-book-open',
        'feather-bookmark',
        'feather-box',
        'feather-briefcase',
        'feather-calendar',
        'feather-camera',
        'feather-camera-off',
        'feather-cast',
        'feather-check',
        'feather-check-circle',
        'feather-check-square',
        'feather-chevron-down',
        'feather-chevron-left',
        'feather-chevron-right',
        'feather-chevron-up',
        'feather-chevrons-down',
        'feather-chevrons-left',
        'feather-chevrons-right',
        'feather-chevrons-up',
        'feather-chrome',
        'feather-circle',
        'feather-clipboard',
        'feather-clock',
        'feather-cloud',
        'feather-cloud-drizzle',
        'feather-cloud-lightning',
        'feather-cloud-off',
        'feather-cloud-rain',
        'feather-cloud-snow',
        'feather-code',
        'feather-codepen',
        'feather-command',
        'feather-compass',
        'feather-copy',
        'feather-corner-down-left',
        'feather-corner-down-right',
        'feather-corner-left-down',
        'feather-corner-left-up',
        'feather-corner-right-down',
        'feather-corner-right-up',
        'feather-corner-up-left',
        'feather-corner-up-right',
        'feather-cpu',
        'feather-credit-card',
        'feather-crop',
        'feather-crosshair',
        'feather-database',
        'feather-delete',
        'feather-disc',
        'feather-dollar-sign',
        'feather-download',
        'feather-download-cloud',
        'feather-droplet',
        'feather-edit',
        'feather-edit-2',
        'feather-edit-3',
        'feather-external-link',
        'feather-eye',
        'feather-eye-off',
        'feather-facebook',
        'feather-fast-forward',
        'feather-feather',
        'feather-file',
        'feather-file-minus',
        'feather-file-plus',
        'feather-file-text',
        'feather-film',
        'feather-filter',
        'feather-flag',
        'feather-folder',
        'feather-folder-minus',
        'feather-folder-plus',
        'feather-gift',
        'feather-git-branch',
        'feather-git-commit',
        'feather-git-merge',
        'feather-git-pull-request',
        'feather-github',
        'feather-gitlab',
        'feather-globe',
        'feather-grid',
        'feather-hard-drive',
        'feather-hash',
        'feather-headphones',
        'feather-heart',
        'feather-help-circle',
        'feather-home',
        'feather-image',
        'feather-inbox',
        'feather-info',
        'feather-instagram',
        'feather-italic',
        'feather-layers',
        'feather-layout',
        'feather-life-buoy',
        'feather-link',
        'feather-link-2',
        'feather-linkedin',
        'feather-list',
        'feather-loader',
        'feather-lock',
        'feather-log-in',
        'feather-log-out',
        'feather-mail',
        'feather-map',
        'feather-map-pin',
        'feather-maximize',
        'feather-maximize-2',
        'feather-menu',
        'feather-message-circle',
        'feather-message-square',
        'feather-mic',
        'feather-mic-off',
        'feather-minimize',
        'feather-minimize-2',
        'feather-minus',
        'feather-minus-circle',
        'feather-minus-square',
        'feather-monitor',
        'feather-moon',
        'feather-more-horizontal',
        'feather-more-vertical',
        'feather-move',
        'feather-music',
        'feather-navigation',
        'feather-navigation-2',
        'feather-octagon',
        'feather-package',
        'feather-paperclip',
        'feather-pause',
        'feather-pause-circle',
        'feather-percent',
        'feather-phone',
        'feather-phone-call',
        'feather-phone-forwarded',
        'feather-phone-incoming',
        'feather-phone-missed',
        'feather-phone-off',
        'feather-phone-outgoing',
        'feather-pie-chart',
        'feather-play',
        'feather-play-circle',
        'feather-plus',
        'feather-plus-circle',
        'feather-plus-square',
        'feather-pocket',
        'feather-power',
        'feather-printer',
        'feather-radio',
        'feather-refresh-ccw',
        'feather-refresh-cw',
        'feather-repeat',
        'feather-rewind',
        'feather-rotate-ccw',
        'feather-rotate-cw',
        'feather-rss',
        'feather-save',
        'feather-scissors',
        'feather-search',
        'feather-send',
        'feather-server',
        'feather-settings',
        'feather-share',
        'feather-share-2',
        'feather-shield',
        'feather-shield-off',
        'feather-shopping-bag',
        'feather-shopping-cart',
        'feather-shuffle',
        'feather-sidebar',
        'feather-skip-back',
        'feather-skip-forward',
        'feather-slack',
        'feather-slash',
        'feather-sliders',
        'feather-smartphone',
        'feather-speaker',
        'feather-square',
        'feather-star',
        'feather-stop-circle',
        'feather-sun',
        'feather-sunrise',
        'feather-sunset',
        'feather-tablet',
        'feather-tag',
        'feather-target',
        'feather-terminal',
        'feather-thermometer',
        'feather-thumbs-down',
        'feather-thumbs-up',
        'feather-toggle-left',
        'feather-toggle-right',
        'feather-trash',
        'feather-trash-2',
        'feather-trending-down',
        'feather-trending-up',
        'feather-triangle',
        'feather-truck',
        'feather-tv',
        'feather-twitter',
        'feather-type',
        'feather-umbrella',
        'feather-underline',
        'feather-unlock',
        'feather-upload',
        'feather-upload-cloud',
        'feather-user',
        'feather-user-check',
        'feather-user-minus',
        'feather-user-plus',
        'feather-user-x',
        'feather-users',
        'feather-video',
        'feather-video-off',
        'feather-voicemail',
        'feather-volume',
        'feather-volume-1',
        'feather-volume-2',
        'feather-volume-x',
        'feather-watch',
        'feather-wifi',
        'feather-wifi-off',
        'feather-wind',
        'feather-x',
        'feather-x-circle',
        'feather-x-square',
        'feather-youtube',
        'feather-zap',
        'feather-zap-off',
        'feather-zoom-in',
        'feather-zoom-out',
    );

    $tabs['rbt-feather-icons'] = array(
        'name' => 'rbt-feather-icons',
        'label' => esc_html__('Rainbowit - Feather Icons', 'rainbowit'),
        'labelIcon' => 'rt-icon',
        'prefix' => '',
        'displayPrefix' => 'rbt',
        'url' => RAINBOWIT_ADDONS_URL . 'assets/css/feather.css',
        'icons' => $feather_icons,
        'ver' => '1.0.0',
    );

    return $tabs;
}

add_filter('elementor/icons_manager/additional_tabs', 'rbt_add_custom_icons_tab');


/**
 * Set Placeholder Image
 */
add_filter( 'elementor/utils/get_placeholder_image_src', 'rbt_set_placeholder_image' );
if (!function_exists('rbt_set_placeholder_image')){
    function rbt_set_placeholder_image() {
        return RAINBOWIT_ADDONS_URL . 'assets/images/placeholder.jpg';
    }
}


/**
 * @param $url
 * @return string
 */
if ( !function_exists('rainbowit_getEmbedUrl') ){
    function rainbowit_getEmbedUrl($url) {
        // function for generating an embed link
        $finalUrl = '';

        if (strpos($url, 'facebook.com/') !== false) {
            // Facebook Video
            $finalUrl.='https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=1&width=200';

        } else if(strpos($url, 'vimeo.com/') !== false) {
            // Vimeo video
            $videoId = isset(explode("vimeo.com/",$url)[1]) ? explode("vimeo.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://player.vimeo.com/video/'.$videoId;

        } else if (strpos($url, 'youtube.com/') !== false) {
            // Youtube video
            $videoId = isset(explode("v=",$url)[1]) ? explode("v=",$url)[1] : null;
            if (strpos($videoId, '&') !== false){
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } else if(strpos($url, 'youtu.be/') !== false) {
            // Youtube  video
            $videoId = isset(explode("youtu.be/",$url)[1]) ? explode("youtu.be/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.youtube.com/embed/'.$videoId;

        } else if (strpos($url, 'dailymotion.com/') !== false) {
            // Dailymotion Video
            $videoId = isset(explode("dailymotion.com/",$url)[1]) ? explode("dailymotion.com/",$url)[1] : null;
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&",$videoId)[0];
            }
            $finalUrl.='https://www.dailymotion.com/embed/'.$videoId;

        } else{
            $finalUrl.=$url;
        }

        return $finalUrl;
    }
}


// Use the following code to get ride of autop (automatic <p> tag) and line breaking tag (<br> tag).
add_filter( 'wpcf7_autop_or_not', '__return_false' );


/**
 * For save post
 */

 function rainbow_save_product_attributes( $product_id ) {

    if(isset($_POST['product_other_info'])) {

        $encode_data = isset($_POST['product_other_info']) ?  $_POST['product_other_info']: '';
        $decode_data = base64_decode($encode_data);

        if(empty($encode_data)) {
            return;
        }
        
        $porduct_info = unserialize( $decode_data );
        $image_url    = $porduct_info['product_img'];

        // Validate image URL
        if (empty( $image_url ) || !filter_var( $image_url, FILTER_VALIDATE_URL ) ) {
            return 'Invalid image URL';
        }

        // Download the image data
        $image_data = @file_get_contents( $image_url );
        if ($image_data === false) {
            return 'Failed to download image';
        }

        $upload_dir = wp_upload_dir();

        $filename = wp_unique_filename( $upload_dir['path'], basename( $image_url ) );

        // Construct the full file path
        $file_path = $upload_dir['path'] . '/' . $filename;

        // Save the image data to the file
        file_put_contents( $file_path, $image_data );

        // Get the file type
        $wp_filetype = wp_check_filetype( $filename, null );

        // Prepare an array of post data for the attachment
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name($filename),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Insert the attachment into the WordPress media library
        $attach_id = wp_insert_attachment( $attachment, $file_path, $product_id );

        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Generate the metadata for the attachment and update the database record
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        // Set the image as the product's featured image
        set_post_thumbnail( $product_id, $attach_id );

    }
}
 
add_action( 'save_post', 'rainbow_save_product_attributes' );

// Add submenu page for WooCommerce products
function add_custom_submenu_page() {

    add_submenu_page(
        'edit.php?post_type=product', // parent_slug
        'Envato Product',         // page_title
        'Envato Product',              // menu_title
        'manage_options',              // capability
        'envato-product-menu-slug',         // menu_slug
        'envato_product_submenu_page_content'  // function
    );

}

add_action('admin_menu', 'add_custom_submenu_page');

add_action( 'admin_post_rainbowit_schedule_event_start', 'rainbowit_schedule_event_func' );

function rainbowit_schedule_event_func() {

    $choose_schedule_rainbowit = isset( $_POST['choose_schedule_rainbowit'] ) ? $_POST['choose_schedule_rainbowit'] : '';
    
    update_option('choose_schedule_rainbowit',$choose_schedule_rainbowit );

    wp_safe_redirect(admin_url( 'admin.php?edit.php?post_type=product&page=envato-product-menu-slug') );
}

// Callback function to display content on the submenu page
function envato_product_submenu_page_content() { 
    $choose_schedule = get_option("choose_schedule_rainbowit", true );
    ?>
   <div class="rainbow-themes-envato-product">
        <div class="rainbowit-api-left-part">
            <h2><?php echo esc_html__("Envato Product Update",'rainbowit'); ?></h2>
            <button type="submit" class="envato-product-update"><?php echo esc_html__("Envato Product","rainbowit");?></button>
        </div>
        <div class="rainbowit-api-right-part">
            <h2><?php echo esc_html__("Product Schedule Update Automatically",'rainbowit'); ?></h2>
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                <input type="hidden" name="action" value="rainbowit_schedule_event_start"/>
                
                <div class="schedule-form-wrap">
                <label for="message"><?php esc_html_e("Schedule Select:","rainbowit"); ?></label>
                <select name="choose_schedule_rainbowit">
                    <option value=""><?php esc_html_e("Select Schedule","rainbowit"); ?></option>
                    <option value="hourly" <?php selected( $choose_schedule, 'hourly' ); ?>><?php esc_html_e("Hourly","rainbowit"); ?></option>
                    <option value="daily" <?php selected( $choose_schedule, 'daily' ); ?>><?php esc_html_e("Daily","rainbowit"); ?></option>
                    <option value="twicedaily" <?php selected( $choose_schedule, 'twicedaily' ); ?>><?php esc_html_e("Twicedaily","rainbowit"); ?></option>
                    <option value="weekly" <?php selected( $choose_schedule, 'weekly' ); ?>><?php esc_html_e("Weekly","rainbowit"); ?></option>
                </select>
                <?php submit_button('Schedule Active'); ?>
                </div>
            </form>
        </div>
    </div>
    <?php
}

add_action('wp_enqueue_scripts', 'enqueue_custom_woocommerce_checkout_script');

function enqueue_custom_woocommerce_checkout_script() {
    if (is_checkout()) {
        wp_enqueue_script(
            'custom-woocommerce-checkout',
            RAINBOWIT_ADDONS_URL . 'assets/js/custom-checkout.js',
            array('wp-blocks', 'wp-element', 'wp-components', 'wc-blocks-checkout'),
            time(),
            true
        );
    }
}




add_action('admin_init', 'eaw_add_meta_boxe_init', 2);

# custom meta admin init
function eaw_add_meta_boxe_init()
{
    add_meta_box('rainbowit_tab_title_group', 'Table of Content', 'rainbowit_tab_title_meta_box_func', 'post', 'normal', 'default');
}

function rainbowit_tab_title_meta_box_func()
{
    global $post;

    wp_nonce_field('rainbowit_tab_title_meta_box_nonce', 'rainbowit_tab_title_meta_box_nonce');

    $rainbowit_tab_title_group   = get_post_meta($post->ID, 'rainbowit_tab_title_group', true);

    ?>
    <table id="eaw-repeatable-fieldset-one">
    <tbody>
        <?php
        if ($rainbowit_tab_title_group) :
            foreach ($rainbowit_tab_title_group as $field) {
        ?>
                <tr class="eaw-tr-extra-field-item">
                    <td class="eaw-input-td-field">
                        <input type="text" placeholder="Tab Title" name="rainbowit_tab_title[]" value="<?php if ($field['rainbowit_tab_title'] != '') echo esc_attr($field['rainbowit_tab_title']); ?>" />
                    </td>
                    <td class="eaw-input-td-field">
                        <input type="text" placeholder="Tab Id" name="rainbowit_tab_id[]" value="<?php if ($field['rainbowit_tab_id'] != '') echo esc_attr($field['rainbowit_tab_id']); ?>" />
                    </td>
                    <td width="15%"><a class="button eaw-remove-row" href="#1"><?php echo esc_html__("Remove", "eaw"); ?></a></td>
                </tr>
            <?php
            }
        else :
            // show a blank one
            ?>
            <tr class="eaw-tr-extra-field-item">
                <td class="eaw-input-td-field">
                    <input type="text" placeholder="Tab Title" title="Label Text" name="rainbowit_tab_title[]" />
                </td>
                <td class="eaw-input-td-field">
                    <input type="text" placeholder="Tab Id" title="Price" name="rainbowit_tab_id[]" />
                </td>
                <td><a class="button  cmb-remove-row-button button-disabled" href="#"><?php echo esc_html__("Remove", "eaw"); ?></a></td>
            </tr>
        <?php endif; ?>

        <!-- empty hidden one for jQuery -->
        <tr class="empty-row screen-reader-text eaw-tr-extra-field-item">
            <td class="eaw-input-td-field">
                <input type="text" placeholder="Extra Item Label Text" title="Label Text" name="rainbowit_tab_title[]" />
            </td>
            <td class="eaw-input-td-field">
                <input type="text" placeholder="Price" title="Price" name="rainbowit_tab_id[]" />
            </td>
            <td><a class="button eaw-remove-row" href="#"><?php echo esc_html__("Remove", "eaw"); ?></a></td>
        </tr>
    </tbody>
</table>
<p><a id="eaw-add-row" class="button" href="#"><?php echo esc_html__("Add another", "eaw"); ?> </a></p>
    <?php
}

add_action('save_post', 'rainbowit_tab_title_meta_box_save');

# custom meta save function
function rainbowit_tab_title_meta_box_save($post_id)
{
    if (
        !isset($_POST['rainbowit_tab_title_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['rainbowit_tab_title_meta_box_nonce'], 'rainbowit_tab_title_meta_box_nonce')
    )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old_meta          = get_post_meta($post_id, 'rainbowit_tab_title_group', true);
    $new_meta          = array();
    $extra_items       = isset($_POST['rainbowit_tab_title']) ? $_POST['rainbowit_tab_title'] : '';
    $extra_items       = array_map('eaw_sanitize_input', $extra_items);
    $prices            = isset($_POST['rainbowit_tab_id']) ? array_map('sanitize_text_field', $_POST['rainbowit_tab_id']) : array();
    $count             = count($extra_items);

    for ($i = 0; $i < $count; $i++) {
        if ($extra_items[$i] != '') :
            $new_meta[$i]['rainbowit_tab_title'] = stripslashes(strip_tags($extra_items[$i]));
            $new_meta[$i]['rainbowit_tab_id'] = stripslashes($prices[$i]); # and however you want to sanitize
        endif;
    }

    if (!empty($new_meta) && $new_meta != $old_meta)
        update_post_meta($post_id, 'rainbowit_tab_title_group', $new_meta);
    elseif (empty($new_meta) && $old_meta)
        delete_post_meta($post_id, 'rainbowit_tab_title_group', $old_meta);

}


function eaw_sanitize_input($input)
{
    return strip_tags($input); // You can customize the sanitization method as needed
}
