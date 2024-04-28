<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */
trait MenuAreaTrait
{

    // Nav Menu Call
    public static function nav_menu_args()
    {
        $nav_menu = rainbowit_get_acf_data( "rainbowit_select_nav_menu");
        $nav_menu_args = array(
            'menu' => $nav_menu,
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'rbt-mainmenu ',
            'menu_class' => 'mainmenu',
            'menu_id' => 'mainmenu',
            'fallback_cb' => false,
            'walker' => new RainbowitNavWalker(),
        );

        return $nav_menu_args;
    }

    // Mobile Menu
    public static function mobile_menu_args()
    {
        $nav_menu = rainbowit_get_acf_data( "rainbowit_select_nav_menu");
        $nav_menu_args = array(
            'menu' => $nav_menu,
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'mainmenu-nav',
            'menu_class' => 'mainmenu',
            'menu_id' => 'mobile-menu',
            'fallback_cb' => false,
            'walker' => new RainbowitMobileWalker(),
        );

        return $nav_menu_args;
    }
    // One Page Menu
    public static function onepage_menu_args()
    {
        $nav_menu = rainbowit_get_acf_data( "rainbowit_select_nav_menu");
        $nav_menu_args = array(
            'menu' => $nav_menu,
            'theme_location' => 'primary',
            'container' => 'nav',
            'container_class' => 'mainmenu-nav onepagenav',
            'menu_class' => 'mainmenu justify-content-center',
            'menu_id' => 'mainmenu',
            'fallback_cb' => false,
            'walker' => new RainbowitOnepageNavWalker(),
        );

        return $nav_menu_args;
    }

    // Footer bottom Menu args
    public static function footer_bottom_menu_args()
    {
        $footer_bottom_menu_args = array(
            'theme_location' => 'footerbottom',
            'container' => 'nav',
            'container_class' => '',
            'menu_class' => "rbt-list has-link",
            'depth' => 1,
            'fallback_cb' => false
        );

        return $footer_bottom_menu_args;
    }



}
