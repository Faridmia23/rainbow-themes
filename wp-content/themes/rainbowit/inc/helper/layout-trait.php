<?php

/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package papr
 */
trait LayoutTrait
{
    public static function rainbowit_left_get_sidebar()
    {
        $layout_abj = Rainbowit_Helper::rainbowit_layout_style_all();
        $layout = $layout_abj['layout'];
        if ($layout == 'left-sidebar') {
            get_sidebar();
        }
        return;
    }

    public static function rainbowit_right_get_sidebar()
    {
        $layout_abj = Rainbowit_Helper::rainbowit_layout_style_all();
        $layout = $layout_abj['layout'];
        if ($layout == 'right-sidebar') {
            get_sidebar();
        }
        return;
    }

    /**
     * @return array
     * Header Layout
     */
    public static function rainbowit_header_layout()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $condition_prefix = Rainbowit_Helper::layout_settings();

        /**
         * Get Page Options value
         */
        $header_area = rainbowit_get_acf_data($theme_prefix .  '_show_header');
        $header_sticky = rainbowit_get_acf_data( $theme_prefix . "_header_sticky");
        $header_transparent = rainbowit_get_acf_data( $theme_prefix . "_header_transparent");

        /**
         * Set Condition
         */
        $header_area = (empty($header_area)) ? $rainbowit_options['rainbowit_enable_header'] : $header_area;
        $header_sticky = (empty($header_sticky)) ? $rainbowit_options['rainbowit_header_sticky'] : $header_sticky;
        /**
         * Load Value
         */
        $header_layout = [
            'header_area' => $header_area,
            'header_sticky' => $header_sticky,
        ];
        return $header_layout;

    }
    /**
     * @return array
     * Footer Layout
     */
    public static function rainbowit_footer_layout()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        /**
         * Get Page Options value
         */
        $footer_area = rainbowit_get_acf_data('rainbowit_show_footer');
        /**
         * Set Condition
         */
        $footer_area = (empty($footer_area)) ? $rainbowit_options['rainbowit_footer_enable'] : $footer_area;

        /**
         * Load Value
         */
        $footer_layout = [
            'footer_area' => $footer_area,
        ];
        return $footer_layout;

    }

    // Sidebar
    public static function rainbowit_sidebar_options()
    {
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $rainbowit_options = self::rainbowit_get_options();
        $condition_prefix = self::layout_settings();
        $sidebar = get_post_meta(get_the_ID(), $theme_prefix . "_sidebar", true);
        $sidebar = (empty($sidebar) || $sidebar == 'default') ? $rainbowit_options[$condition_prefix . '_sidebar'] : $sidebar;
        return $sidebar;
    }

    // Menu Option
    public static function rainbowit_logos()
    {
        $rainbowit_options = self::rainbowit_get_options();
        // Logo
        $rainbowit_dark_logo = empty($rainbowit_options['logo']['url']) ? self::get_img('logo-black.svg') : $rainbowit_options['logo']['url'];
        $rainbowit_light_logo = empty($rainbowit_options['logo_light']['url']) ? self::get_img('logo-white.svg') : $rainbowit_options['logo_light']['url'];
        $rainbowit_logo_symbol = empty($rainbowit_options['logo_symbol']['url']) ? self::get_img('logo-symbol.svg') : $rainbowit_options['logo_symbol']['url'];

        $menu_option = [
            'rainbowit_dark_logo' => $rainbowit_dark_logo,
            'rainbowit_light_logo' => $rainbowit_light_logo,
            'rainbowit_logo_symbol' => $rainbowit_logo_symbol
        ];
        return $menu_option;
    }

    // Page layout style
    public static function rainbowit_layout_style()
    {
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $rainbowit_options = self::rainbowit_get_options();
        $condition_prefix = self::layout_settings();

        if (is_single() || is_page()) {
            $layout = get_post_meta(get_the_ID(), $theme_prefix . "_layout", true);
            $layout = (empty($layout) || $layout == 'default') ? $rainbowit_options[$condition_prefix . "_layout"] : $layout;

        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            $layout = (empty($layout) || $layout == 'default') ? $rainbowit_options[$condition_prefix . "_layout"] : $layout;
        }

        return $layout;
    }

    // layout style
    public static function rainbowit_layout_style_all()
    {
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $rainbowit_options = self::rainbowit_get_options();
        $condition_prefix = self::layout_settings();
        $sidebar 	= Rainbowit_Helper::rainbowit_sidebar_options();
        $has_sidebar_contnet = (is_active_sidebar( $sidebar ) || is_active_sidebar( 'sidebar' )) ? 'col-xl-8 rainbowit-main' : 'col-xl-12 rainbowit-main';

        if (is_single() || is_page()) {
            $layout = get_post_meta(get_the_ID(), $theme_prefix . "_layout", true);
            $layout = (empty($layout) || $layout == 'default') ? $rainbowit_options[$condition_prefix . "_layout"] : $layout;

        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            $layout = (empty($layout) || $layout == 'default') ? $rainbowit_options[$condition_prefix . "_layout"] : $layout;
        }

        // Layout class
        if ($layout == 'full-width') {
            $layout_class = 'col-12';
            $post_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 masonry-item';
        } else {
            $layout_class = $has_sidebar_contnet;
            $post_class = 'col-12';
        }

        $layout = [
            'layout' => $layout,
            'layout_class' => $layout_class,
            'post_class' => $post_class,
        ];
        return $layout;
    }

    // layout style
    public static function rainbowit_layout_custom_taxonomy()
    {
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $rainbowit_options = self::rainbowit_get_options();
        $condition_prefix = self::layout_settings();
        $layout = $rainbowit_options[$condition_prefix . "_layout"];
        $sidebar 	= Rainbowit_Helper::rainbowit_sidebar_options();
        $has_sidebar_contnet = (is_active_sidebar( $sidebar ) || is_active_sidebar( 'sidebar' )) ? 'col-xl-8 rainbowit-main' : 'col-xl-12 rainbowit-main';

        // Layout class
        if ($layout == 'full-width') {
            $layout_class = 'col-12';
            $post_class = 'col-lg-4';
        } else {
            $layout_class = $has_sidebar_contnet;
            $post_class = 'col-lg-6';
        }
        $layout = [
            'layout' => $layout,
            'layout_class' => $layout_class,
            'post_class' => $post_class,
        ];
        return $layout;
    }

    /**  Footer Options */
    public static function rainbowit_active_footer()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        if (!$rainbowit_options['footer_area']) {
            return false;
        }
        $footer_column = $rainbowit_options['footer_column'];
        for ($i = 1; $i <= $footer_column; $i++) {
            if (is_active_sidebar('footer-' . $i)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Custom Sidebar
     */
    public static function get_custom_sidebar_fields()
    {
        $theme_prefix = RAINBOWIT_WIDGET_PREFIX;
        $sidebar_fields = array();
        $sidebar_fields['sidebar'] = esc_html__('Sidebar', 'rainbowit');
        $sidebars = get_option("{$theme_prefix}_custom_sidebars", array());
        if ($sidebars) {
            foreach ($sidebars as $sidebar) {
                $sidebar_fields[$sidebar['id']] = $sidebar['name'];
            }
        }
        return $sidebar_fields;
    }

    /** layout settings */
    public static function layout_settings()
    {
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $condition_prefix = RAINBOWIT_THEME_PREFIX;
        if (is_single() || is_page()) {
            $post_type = get_post_type();
            $post_id = get_the_id();

            switch ($post_type) {
                case 'page':
                    $theme_prefix = 'page';
                    break;
                case 'post':
                    $theme_prefix = 'single_post';
                    break;
                case "team":
                    $theme_prefix = 'team';
                    break;
                case 'product':
                    $theme_prefix = 'product';
                    break;
                default:
                    $theme_prefix = 'single_post';
                    break;
            }
        } elseif (is_home() || is_archive() || is_search() || is_404()) {
            if (is_author()) {
                $theme_prefix = 'author';
            } elseif (is_search()) {
                $theme_prefix = 'search';
            } elseif (is_post_type_archive("team") || is_tax("team_category")) {
                $theme_prefix = 'team_archive';
            } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
                $theme_prefix = 'shop';
            } else {
                $theme_prefix = 'blog';
            }
        }
        return $theme_prefix;
    }

}
