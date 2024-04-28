<?php
/*=======================================================
*    Register Post type
* =======================================================*/
/**
 * Megamenu
 */
if ( ! function_exists('rbt_megamenu') ) {
    function rbt_megamenu() {

        $labels = array(
            'name'                  => esc_html_x( 'Megamenus', 'Post Type General Name', 'rainbowit' ),
            'singular_name'         => esc_html_x( 'Megamenu', 'Post Type Singular Name', 'rainbowit' ),
            'menu_name'             => esc_html__( 'Megamenu', 'rainbowit' ),
            'name_admin_bar'        => esc_html__( 'Megamenu', 'rainbowit' ),
            'archives'              => esc_html__( 'Item Archives', 'rainbowit' ),
            'parent_item_colon'     => esc_html__( 'Parent Item:', 'rainbowit' ),
            'all_items'             => esc_html__( 'All Items', 'rainbowit' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'rainbowit' ),
            'add_new'               => esc_html__( 'Add New', 'rainbowit' ),
            'new_item'              => esc_html__( 'New Item', 'rainbowit' ),
            'edit_item'             => esc_html__( 'Edit Item', 'rainbowit' ),
            'update_item'           => esc_html__( 'Update Item', 'rainbowit' ),
            'view_item'             => esc_html__( 'View Item', 'rainbowit' ),
            'search_items'          => esc_html__( 'Search Item', 'rainbowit' ),
            'not_found'             => esc_html__( 'Not found', 'rainbowit' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'rainbowit' ),
            'featured_image'        => esc_html__( 'Featured Image', 'rainbowit' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'rainbowit' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'rainbowit' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'rainbowit' ),
            'inserbt_into_item'     => esc_html__( 'Insert into item', 'rainbowit' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'rainbowit' ),
            'items_list'            => esc_html__( 'Items list', 'rainbowit' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'rainbowit' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'rainbowit' ),
        );
        $args = array(
            'label'                 => esc_html__( 'Megamenu', 'rainbowit' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'   			=> 'dashicons-editor-kitchensink',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_in_rest'          => true, // To use Gutenberg editor.
            'capability_type'       => 'page',
            'rewrite'               => array('slug' => esc_html__('megamenu' , 'rainbowit')),
        );
        register_post_type( 'Megamenu', $args );
    }
    add_action( 'init', 'rbt_megamenu', 0 );

}


