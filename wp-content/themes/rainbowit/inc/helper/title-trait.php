<?php

/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */
trait BannerTrait
{
    
    /**
     * @return array
     * Banner Layout
     */
    public static function rainbowit_banner_layout()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $condition_prefix = Rainbowit_Helper::layout_settings();

        /**
         * Get Page Options value
         */
        $banner_area = rainbowit_get_acf_data("rainbowit_title_wrapper_show");
        $banner_style = rainbowit_get_acf_data("rainbowit_select_banner_style");

        /**
         * Set Condition
         */
        if(empty($banner_area)){
            $banner_style = $rainbowit_options['rainbowit_select_banner_template'];
        }else{
            $banner_style = (empty($banner_style) ||  $banner_style == "0") ? $rainbowit_options['rainbowit_select_banner_template'] : $banner_style;
        }
        $banner_area = (empty($banner_area)) ? $rainbowit_options['rainbowit_banner_enable'] : $banner_area;
        /**
         * Load Value
         */
        $banner_layout = [
            'banner_area' => $banner_area,
            'banner_style' => $banner_style,
        ];
        return $banner_layout;

    }

    
    /**
     * @return array
     * Banner Layout
     */
    public static function rainbowit_page_breadcrumb()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        $theme_prefix = RAINBOWIT_THEME_PREFIX;
        $condition_prefix = Rainbowit_Helper::layout_settings();

        /**
         * Get Page Options value
         */
        $breadcrumbs = rainbowit_get_acf_data($theme_prefix .  '_breadcrumbs_enable');
        /**
         * Set Condition
         */
        $breadcrumbs = (empty($breadcrumbs)) ? $rainbowit_options['rainbowit_breadcrumb_enable'] : $breadcrumbs;
        /**
         * Load Value
         */
        $breadcrumbs_enable = [
            'breadcrumbs' => $breadcrumbs,
        ];
        return $breadcrumbs_enable;

    }
}
