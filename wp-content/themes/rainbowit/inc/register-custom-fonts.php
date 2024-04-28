<?php
/**
 * Register custom fonts.
 */

if ( !function_exists( 'rainbowit_fonts_url' ) ) :
    function rainbowit_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== esc_attr_x('on', 'Inter font: on or off', 'rainbowit')) {
            $fonts[] = 'Inter:wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw($fonts_url);
    }
endif;

