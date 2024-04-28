<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rainbowit
 */

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('rainbowit_content_estimated_reading_time')) {
    /**
     * Function that estimates reading time for a given $content.
     * @param string $content Content to calculate read time for.
     * @paramint $wpm Estimated words per minute of reader.
     * @returns int $time Esimated reading time.
     */
    function rainbowit_content_estimated_reading_time($content = '', $wpm = 200)
    {
        $clean_content = strip_shortcodes($content);
        $clean_content = strip_tags($clean_content);
        $word_count = str_word_count($clean_content);
        $time = ceil($word_count / $wpm);
        $output = $time . esc_attr__(' min read', 'rainbowit');
        return $output;
    }
}
/**
 * Escaping
 */
if ( !function_exists('rainbowit_escaping') ) {
    function rainbowit_escaping($html){
        return $html;
    }
}

/**
 *  Convert Get Theme Option global to function
 */
if(!function_exists('rainbowit_get_opt')){
    function rainbowit_get_opt(){
        global $rainbowit_option;
        return $rainbowit_option;
    }
}
/**
 * Get terms
 */
if (function_exists('rainbowit_get_terms_gb')){
    function rainbowit_get_terms_gb( $term_type = null, $hide_empty = false ) {
        if(!isset( $term_type )){
            return;
        }
        $rainbowit_custom_terms = array();
        $terms = get_terms( $term_type, array( 'hide_empty' => $hide_empty ) );
        array_push( $rainbowit_custom_terms, esc_html__( '--- Select ---', 'rainbowit' ) );
        if ( is_array( $terms ) && ! empty( $terms ) ) {
            foreach ( $terms as $single_term ) {
                if ( is_object( $single_term ) && isset( $single_term->name, $single_term->slug ) ) {
                    $rainbowit_custom_terms[ $single_term->slug ] = $single_term->name;
                }
            }
        }
        return $rainbowit_custom_terms;
    }
}
/**
 * Blog Pagination
 */
if(!function_exists('rainbowit_blog_pagination')){
    function rainbowit_blog_pagination(){
        GLOBAL $wp_query;
        if ($wp_query->post_count < $wp_query->found_posts) {
            ?>
            <div class="rn-pagination text-center justify-content-center mt--60 mt_sm--30"> <?php
                the_posts_pagination(array(
                    'prev_text'          => '<i class="rbt feather-arrow-left"></i>',
                    'next_text'          => '<i class="rbt feather-arrow-right"></i>',
                    'type'               => 'list',
                    'show_all'  	     => false,
                    'end_size'           => 1,
                    'mid_size'           => 8,
                )); ?>
            </div>
            <?php
        }
    }
}
/**
 * Short Title
 */
if (!function_exists('rainbowit_short_title')){
    function rainbowit_short_title($title, $length = 30) {
        if (strlen($title) > $length) {
            return substr($title, 0, $length) . ' ...';
        }else {
            return $title;
        }
    }
}
/**
 * Get ACF data conditionally
 */
if( !function_exists('rainbowit_get_acf_data') ){
    function rainbowit_get_acf_data($fields){
        return (class_exists('ACF') && get_field_object($fields)) ? get_field($fields) : false;
    }

}
/**
 * rainbowit_get_nav_menus
 */
if (!function_exists('rainbowit_get_nav_menus')){
    function rainbowit_get_nav_menus(){

        $menus = wp_get_nav_menus();
        $menus_data = array(
                '0' => esc_html__('Select a Menu', 'rainbowit')
        );
        if (!empty($menus) && !is_wp_error($menus)){
            foreach ( $menus as $item ) {
                $menus_data[ $item->slug ] = $item->name;
            }
        }
        return $menus_data;
    }
}

/**
 * Convert hexdec color string to rgb(a) string
 * @param $color
 * @param bool $opacity
 * @return string
 */
if(!function_exists('rainbowit_hex2rgba')){
    function rainbowit_hex2rgba($color, $opacity = false) {

        $default = 'rgba(249, 0, 77, 0.1)';

        //Return default if no color provided
        if(empty($color)) {
            return $default;
        }

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }
}

if(!function_exists('insertArrayAtPosition')){
    function insertArrayAtPosition( $array, $insert, $position ) {
        /*
        $array : The initial array i want to modify
        $insert : the new array i want to add, eg array('key' => 'value') or array('value')
        $position : the position where the new array will be inserted into. Please mind that arrays start at 0
        */
        return array_slice($array, 0, $position, TRUE) + $insert + array_slice($array, $position, NULL, TRUE);
    }
}

/**
 * Get Post Thumbnail Size
 */

if(!function_exists('rainbowit_get_thumbnail_sizes')){
    function rainbowit_get_thumbnail_sizes()
    {
        $sizes = get_intermediate_image_sizes();

        $sizes = insertArrayAtPosition($sizes, array('default' => 'Default'), 0);

        $image_sizes = [];

        foreach ($sizes as $size) {
            $image_sizes[$size] = $size;
        }
        /** This filter is documented in wp-admin/includes/media.php */
        return apply_filters( 'image_size_names_choose', $image_sizes );
    }
}