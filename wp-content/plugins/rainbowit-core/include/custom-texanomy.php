<?php
/*=======================================================
*    Register Custom Taxonomy
* =======================================================*/
/**
 * Portfolio Cat
 */
if ( ! function_exists('rbt_portfolio_taxonomy') ) {
	function rbt_portfolio_taxonomy() {
		/**
		 * Events
		 */
		$labels = array(
			'name'                       => esc_html_x( 'Portfolio Categories', 'Taxonomy General Name', 'rainbowit' ),
			'singular_name'              => esc_html_x( 'Portfolio Categories', 'Taxonomy Singular Name', 'rainbowit' ),
			'menu_name'                  => esc_html__( 'Portfolio Categories', 'rainbowit' ),
			'all_items'                  => esc_html__( 'All Portfolio Category', 'rainbowit' ),
			'parent_item'                => esc_html__( 'Parent Item', 'rainbowit' ),
			'parent_item_colon'          => esc_html__( 'Parent Item:', 'rainbowit' ),
			'new_item_name'              => esc_html__( 'New Portfolio Category Name', 'rainbowit' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Category', 'rainbowit' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Category', 'rainbowit' ),
			'update_item'                => esc_html__( 'Update Portfolio Category', 'rainbowit' ),
			'view_item'                  => esc_html__( 'View Portfolio Category', 'rainbowit' ),
			'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'rainbowit' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove items', 'rainbowit' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'rainbowit' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Category', 'rainbowit' ),
			'search_items'               => esc_html__( 'Search Portfolio Category', 'rainbowit' ),
			'not_found'                  => esc_html__( 'Not Found', 'rainbowit' ),
			'no_terms'                   => esc_html__( 'No Portfolio Category', 'rainbowit' ),
			'items_list'                 => esc_html__( 'Portfolio Category list', 'rainbowit' ),
			'items_list_navigation'      => esc_html__( 'Portfolio Category list navigation', 'rainbowit' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'portfolio-cat', array( 'portfolio' ), $args );

	}
	add_action( 'init', 'rbt_portfolio_taxonomy', 0 );
}