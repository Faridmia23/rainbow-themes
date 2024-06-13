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


if ( ! function_exists('rainbowit_testimonial_func') ) {
	function rainbowit_testimonial_func() {

        $labels = array(
			'name'                  => esc_html_x( 'Testimonial', 'Post Type General Name', 'rainbowit' ),
			'singular_name'         => esc_html_x( 'Testimonial', 'Post Type Singular Name', 'rainbowit' ),
			'menu_name'             => esc_html__( 'Testimonial', 'rainbowit' ),
			'name_admin_bar'        => esc_html__( 'Testimonial', 'rainbowit' ),
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
			'featured_image'        => esc_html__( 'Marketplace Image', 'rainbowit' ),
			'set_featured_image'    => esc_html__( 'Set Marketplace image', 'rainbowit' ),
			'remove_featured_image' => esc_html__( 'Remove Marketplace image', 'rainbowit' ),
			'use_featured_image'    => esc_html__( 'Use as Marketplace image', 'rainbowit' ),
			'inserbt_into_item'     => esc_html__( 'Insert into item', 'rainbowit' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'rainbowit' ),
			'items_list'            => esc_html__( 'Items list', 'rainbowit' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'rainbowit' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'rainbowit' ),
		);
		$args = array(
			'label'                 => esc_html__( 'Testimonial', 'rainbowit' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-index-card',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
            'show_in_rest'          => true, // To use Gutenberg editor.
			'capability_type'       => 'page',
            'rewrite'               => array('slug' => esc_html__('testimonial' , 'rainbowit')),
		);
		register_post_type( 'testimonial', $args );

		
			register_taxonomy( 'testimonial-cat', array(
			0 => 'testimonial',
		), array(
			'labels' => array(
				'name' => 'Add Testimonial Category',
				'singular_name' => 'Testimonial Category',
				'menu_name' => 'Testimonial Category',
				'all_items' => 'All Testimonial Category',
				'edit_item' => 'Edit  Category',
				'view_item' => 'View  Category',
				'update_item' => 'Update  Category',
				'add_new_item' => 'Add New  Category',
				'new_item_name' => 'New Testimonial Category Name',
				'search_items' => 'Search Testimonial Category',
				'popular_items' => 'Testimonial Category',
				'separate_items_with_commas' => 'Separate Testimonial',
				'add_or_remove_items' => 'remove Testimonial Category',
				'choose_from_most_used' => 'Choose Testimonial Category',
				'not_found' => 'No Testimonial Category found',
				'no_terms' => 'No Testimonial Category',
				'items_list_navigation' => 'Category list',
				'items_list' => 'Job Type list',
				'back_to_items' => '← Go to Testimonial Category',
				'item_link' => 'Testimonial Category Link',
				'item_link_description' => 'A link to a Testimonial Category',
			),
			'public' => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
		)  );


	}
	add_action( 'init', 'rainbowit_testimonial_func', 0 );
}


add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_66308260a43b2',
	'title' => 'Testimonial Extra Option',
	'fields' => array(
		array(
			'key' => 'field_663082615f321',
			'label' => 'Marketplace Name',
			'name' => 'marketplace_name',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'THEMEFOREST CUSTOMER',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_66308342cdf11',
			'label' => 'Rating Select',
			'name' => 'rating_select',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
			'default_value' => 5,
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'testimonial',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

add_action( 'init', function() {
	register_post_type( 'open-job-position', array(
	'labels' => array(
		'name' => 'Job  Position',
		'singular_name' => 'Job Position',
		'menu_name' => 'Job  Position',
		'all_items' => 'All Job Position',
		'edit_item' => 'Edit Job Position',
		'view_item' => 'View Job Position',
		'view_items' => 'View v',
		'add_new_item' => 'Add New Job Position',
		'add_new' => 'Add New Job Position',
		'new_item' => 'New Job Position',
		'parent_item_colon' => 'Parent Job Position:',
		'search_items' => 'Search Job Position',
		'not_found' => 'No Job Position found',
		'not_found_in_trash' => 'No Job Position found in Trash',
		'archives' => 'Job Position Archives',
		'attributes' => 'Job Position Attributes',
		'insert_into_item' => 'Insert into Job Position',
		'uploaded_to_this_item' => 'Uploaded to this Job Position',
		'filter_items_list' => 'Filter Job Position list',
		'filter_by_date' => 'Filter Job Position by date',
		'items_list_navigation' => 'Job Position list navigation',
		'items_list' => 'Job Position list',
		'item_published' => 'Job Position published.',
		'item_published_privately' => 'Job Position published privately.',
		'item_reverted_to_draft' => 'Job Position reverted to draft.',
		'item_scheduled' => 'Job Position scheduled.',
		'item_updated' => 'Job Position updated.',
		'item_link' => 'Job Position Link',
		'item_link_description' => 'A link to a Job Position.',
	),
	'public' => true,
	'show_in_rest' => true,
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'thumbnail',
	),
	'delete_with_user' => false,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'open-job', array(
	0 => 'open-job-position',
), array(
	'labels' => array(
		'name' => 'Job Type',
		'singular_name' => 'Job Type',
		'menu_name' => 'Job Type',
		'all_items' => 'All Job Type',
		'edit_item' => 'Edit Job Type',
		'view_item' => 'View Job Type',
		'update_item' => 'Update Job Type',
		'add_new_item' => 'Add New Job Type',
		'new_item_name' => 'New Job Type Name',
		'search_items' => 'Search Job Type',
		'popular_items' => 'Popular Job Type',
		'separate_items_with_commas' => 'Separate Job Type with commas',
		'add_or_remove_items' => 'Add or remove Job Type',
		'choose_from_most_used' => 'Choose from the most used Job Type',
		'not_found' => 'No Job Type found',
		'no_terms' => 'No Job Type',
		'items_list_navigation' => 'Job Type list navigation',
		'items_list' => 'Job Type list',
		'back_to_items' => '← Go to Job Type',
		'item_link' => 'Job Type Link',
		'item_link_description' => 'A link to a Job Type',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'number-of-vacancies', array(
	0 => 'open-job-position',
), array(
	'labels' => array(
		'name' => 'Number Vacancies',
		'singular_name' => 'Number Vacancies',
		'menu_name' => 'Number Vacancies',
		'all_items' => 'All Number Vacancies',
		'edit_item' => 'Edit Number Vacancies',
		'view_item' => 'View Number Vacancies',
		'update_item' => 'Update Number Vacancies',
		'add_new_item' => 'Add New Number Vacancies',
		'new_item_name' => 'New Number Vacancies ',
		'search_items' => 'Search Number Vacancies',
		'popular_items' => 'Popular Number Vacancies',
		'separate_items_with_commas' => 'Separate Number Vacancies with commas',
		'add_or_remove_items' => 'Add or remove Number Vacancies',
		'choose_from_most_used' => 'Choose from the most used Number Vacancies',
		'not_found' => 'No Number Vacancies found',
		'no_terms' => 'No Number Vacancies',
		'items_list_navigation' => 'Number Vacancies list navigation',
		'items_list' => 'Number Vacancies list',
		'back_to_items' => '← Go to Number Vacancies',
		'item_link' => 'Number Vacancies Link',
		'item_link_description' => 'A link to a Number Vacancies',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );
} );

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_6638af925e513',
	'title' => 'Open Job Extra Field',
	'fields' => array(
		array(
			'key' => 'field_6638afe57ad8e',
			'label' => 'Address',
			'name' => 'address',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Dhaka, Bangladesh',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),

		array(
			'key' => 'field_666ac9b77b505',
			'label' => 'Job Status',
			'name' => 'job_status',
			'aria-label' => '',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'enable' => 'enable',
				'disable' => 'disable',
			),
			'default_value' => 'disable',
			'return_format' => 'value',
			'allow_null' => 0,
			'other_choice' => 0,
			'layout' => 'vertical',
			'save_other_choice' => 0,
		),

	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'open-job-position',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );


add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_663b485f20537',
	'title' => 'Single Product Content Template',
	'fields' => array(
		array(
			'key' => 'field_663b48603d731',
			'label' => 'Product Single Content Template',
			'name' => 'product_content_template',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => get_elementor_template_library(),
			'default_value' => false,
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_663cb88e533bc',
			'label' => 'Envato Product Change Log',
			'name' => 'envato_product_change_log',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'product',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );

} );




