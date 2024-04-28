<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package papr
 */
trait OptionsTrait {

  /**
   * @abstract get theme mod
   * return boolean
   */
  public static function get_rainbowit_options($name) {
      $modval = get_theme_mod($name);
      if (!empty($modval)) {
          if (!is_array($modval))
              $newval = unserialize($modval);
          else
              $newval = $modval;
          //var_dump($modval);
          //unserialize($modval);
          return $newval;
      }
      return false;
      
  }

  /**
   * @abstract get theme options
   * return object
   */
  public static function rainbowit_get_options(){
    
    include RAINBOWIT_FREAMWORK_OPTIONS . 'predefined-data.php';
    $rainbowit_options = json_decode( $predefined_data, true );
    if ( class_exists( 'Redux' ) ) {  
       global $options;
    $rainbowit_options = wp_parse_args( $GLOBALS['rainbowit_options'], $options );
    }
    return $rainbowit_options;
  }

  /**
   * @abstract get post object
   * return object
   */
  public static function rainbowit_get_post_object(){
      global $post;
      return $post;
  }

  /**
   * @abstract get current user info
   * return array
   */

  public static function rainbowit_get_current_user_var(){
      return wp_get_current_user();
  }

}
