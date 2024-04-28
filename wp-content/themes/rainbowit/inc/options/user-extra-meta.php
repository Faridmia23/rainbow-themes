<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e4b96c080917',
        'title' => esc_html__('User Social Media', 'rainbowit'),
        'fields' => array(
            array(
                'key' => 'field_5e4b96f6dc7f8',
                'label' => esc_html__('Add Social Icons', 'rainbowit'),
                'name' => 'rainbowit_add_social_icons',
                'type' => 'repeater',
                'instructions' => 'Please follow the documentation to add social network icons and link.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_5e4bbd75dc7fa',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add New Network',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e4bbcaddc7f9',
                        'label' => esc_html__('Enter Social Icon Markup', 'rainbowit'),
                        'name' => 'rainbowit_enter_social_icon_markup',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '<i class="fab fa-facebook-f"></i>',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_5e4bbd75dc7fa',
                        'label' => esc_html__('Enter Social Icon Link', 'rainbowit'),
                        'name' => 'rainbowit_enter_social_icon_link',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'all',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;