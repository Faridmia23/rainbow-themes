<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Base;
use Elementor\REPEA;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

function rbt_elementor_init()
{

    /**
     * Initialize EAE_Helper
     */
    new rbt_Helper;
}

add_action('elementor/init', 'Elementor\rbt_elementor_init');
/**
 * Get All Post Types
 */
function rbt_get_post_types()
{

    $rbt_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
    $rbt_exclude_cpts = array('elementor_library', 'attachment');
    foreach ($rbt_exclude_cpts as $exclude_cpt) {
        unset($rbt_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($rbt_cpts);
    foreach ($post_types as $type) {
        $types[$type->name] = $type->label;
    }
    return $types;
}

/**
 * Get all types of post.
 */
function rbt_get_all_types_post($post_type)
{

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => 20,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}

/**
 * Get all Pages
 */
if (!function_exists('rbt_get_all_pages')) {
    function rbt_get_all_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

/**
 * Post Settings Parameter
 */
function rbt_get_post_settings($settings)
{
    foreach ($settings as $key => $value) {
        $post_args[$key] = $value;
    }
    $post_args['post_status'] = 'publish';

    return $post_args;
}

/**
 * Get Post Thumbnail Size
 */
function rbt_get_thumbnail_sizes()
{
    $sizes = get_intermediate_image_sizes();
    foreach ($sizes as $s) {
        $ret[$s] = $s;
    }
    return $ret;
}

/**
 * Post Orderby Options
 */
function rbt_get_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    return $orderby;
}

/**
 * Get Post Categories
 */
function rbt_get_categories($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    $options = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

/**
 * Get all Pages
 */
if (!function_exists('rbt_get_pages')) {
    function rbt_get_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}


/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function rbt_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [
            'class' => [],
        ],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    if ($level === 'advance') {
        $allowed_html['ul'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['ol'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['li'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
            'target' => [],
        ];
    }

    return $allowed_html;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function rbt_kses_advance($string = '')
{
    return wp_kses($string, rbt_get_allowed_html_tags('advance'));
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function rbt_kses_intermediate($string = '')
{
    return wp_kses($string, rbt_get_allowed_html_tags('intermediate'));
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function rbt_kses_basic($string = '')
{
    return wp_kses($string, rbt_get_allowed_html_tags('basic'));
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function rbt_get_allowed_html_desc($level = 'basic')
{
    if (!in_array($level, ['basic', 'intermediate', 'advance'])) {
        $level = 'basic';
    }

    $tags_str = '<' . implode('>,<', array_keys(rbt_get_allowed_html_tags($level))) . '>';
    return sprintf(__('This input field has support for the following HTML tags: %1$s', 'rainbowit'), '<code>' . esc_html($tags_str) . '</code>');
}

/**
 * Element Common Functions
 */
trait RainbowitElementCommonFunctions
{

    /**
     * Create section title fields
     *
     * @param null $control_id
     * @param string $before_title
     * @param string $title
     * @param string $default_title_tag
     * @param string $description
     */
    protected function rbt_section_title($control_id = null, $section_name = 'Section Title',  $before_title = 'Before Title', $title = 'Your Section Title', $default_title_tag = 'h2', $description = 'There are many variations of passages of Lorem Ipsum available, <br /> but the majority have suffered alteration.', $align = 'text-center',  $enable_title_show_hide = true, $default_enable = 'yes')
    {
        $this->start_controls_section(
            'rbt_' . $control_id . '_section_title',
            [
                'label' => esc_html__($section_name, 'rainbowit'),
            ]
        );
        if ($enable_title_show_hide) {
            $this->add_control(
                'rbt_' . $control_id . '_section_title_show',
                [
                    'label' => esc_html__('Section Title & Content', 'rainbowit'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'rainbowit'),
                    'label_off' => esc_html__('Hide', 'rainbowit'),
                    'return_value' => 'yes',
                    'default' => $default_enable,
                ]
            );
        }

        $this->add_control(
            'rbt_' . $control_id . '_before_title',
            [
                'label' => esc_html__('Before Title', 'rainbowit'),
                'description' => rbt_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => $before_title,
                'placeholder' => esc_html__('Type Before Heading Text', 'rainbowit'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rbt_' . $control_id . '_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'description' => rbt_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => $title,
                'placeholder' => esc_html__('Type Heading Text', 'rainbowit'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'rbt_' . $control_id . '_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'rainbowit'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'rainbowit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'rainbowit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'rainbowit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'rainbowit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'rainbowit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'rainbowit'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => $default_title_tag,
                'toggle' => false,
            ]
        );

        $this->add_control(
            'rbt_' . $control_id . '_desctiption',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'description' => rbt_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $description,
                'placeholder' => esc_html__('Type section description here', 'rainbowit'),
            ]
        );
        if ($align) {
            $this->add_responsive_control(
                'rbt_' . $control_id . '_align',
                [
                    'label' => esc_html__('Alignment', 'rainbowit'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'text-left' => [
                            'title' => esc_html__('Left', 'rainbowit'),
                            'icon' => 'fa fa-align-left',
                        ],
                        'text-center' => [
                            'title' => esc_html__('Center', 'rainbowit'),
                            'icon' => 'fa fa-align-center',
                        ],
                        'text-right' => [
                            'title' => esc_html__('Right', 'rainbowit'),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'default' => $align,
                    'toggle' => false,
                ]
            );
        }
        $this->end_controls_section();
    }

    /**
     * Render Section Title
     *
     * @param null $control_id
     * @param $settings
     */
    protected function rbt_section_title_render($control_id = null, $settings = null)
    {

        if (!$settings['rbt_' . $control_id . '_section_title_show']) {
            return;
        }
        $this->add_render_attribute('title_args', 'class', 'title rbt-section-title');
?>
        <?php if (!empty($settings['rbt_' . $control_id . '_before_title'])) { ?>
            <span class="sub-title"><?php echo rbt_kses_basic($settings['rbt_' . $control_id . '_before_title']); ?></span>
        <?php } ?>
        <?php
        if ($settings['rbt_' . $control_id . '_title_tag']) :
            printf(
                '<%1$s %2$s><span>%3$s</span></%1$s>',
                tag_escape($settings['rbt_' . $control_id . '_title_tag']),
                $this->get_render_attribute_string('title_args'),
                rbt_kses_intermediate($settings['rbt_' . $control_id . '_title'])
            );
        endif;
        ?>
        <?php if (!empty($settings['rbt_' . $control_id . '_desctiption'])) { ?>
            <p><?php echo rbt_kses_intermediate($settings['rbt_' . $control_id . '_desctiption']); ?></p>
        <?php } ?>
<?php
    }

    /**
     * @param null $control_id
     * @param $settings
     */
    protected function rbt_link_control_render($control_id = null, $settings = null)
    {

        // Link
        if ('2' == $settings['rbt_' . $control_id . '_link_type']) {
            $this->add_render_attribute('rbt_' . $control_id . '_link', 'href', get_permalink($settings['rbt_' . $control_id . '_page_link']));
            $this->add_render_attribute('rbt_' . $control_id . '_link', 'target', '_self');
            $this->add_render_attribute('rbt_' . $control_id . '_link', 'rel', 'nofollow');
        } else {
            if (!empty($settings['rbt_' . $control_id . '_link']['url'])) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'href', $settings['rbt_' . $control_id . '_link']['url']);
            }
            if ($settings['rbt_' . $control_id . '_link']['is_external']) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'target', '_blank');
            }
            if (!empty($settings['rbt_' . $control_id . '_link']['nofollow'])) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'rel', 'nofollow');
            }
        }

        // Button
        if (!empty($settings['rbt_' . $control_id . '_link']['url']) || isset($settings['rbt_' . $control_id . '_link_type'])) {

            $this->add_render_attribute('rbt_' . $control_id . '_link', 'class', ' rbt-button ');
            // Style
            if (!empty($settings['rbt_' . $control_id . '_style_button_style'])) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'class', '' . $settings['rbt_' . $control_id . '_style_button_style'] . '');
            }
            // Size
            if (!empty($settings['rbt_' . $control_id . '_style_button_size'])) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'class', $settings['rbt_' . $control_id . '_style_button_size']);
            }
            // Color
            if (!empty($settings['rbt_' . $control_id . '_style_button_color'])) {
                $this->add_render_attribute('rbt_' . $control_id . '_link', 'class', $settings['rbt_' . $control_id . '_style_button_color']);
            }
            // Link
            $button_html = '<a ' . $this->get_render_attribute_string('rbt_' . $control_id . '_link') . '>' . '<span class="button-text">' . $settings['rbt_' . $control_id . '_text'] . '</span></a>';
        }
        if (!empty($settings['rbt_' . $control_id . '_text'])) {
            echo $button_html;
        }
    }

    /**
     * [rbt_query_controls description]
     * @param  [type] $control_id     [description]
     * @param  [type] $control_name   [description]
     * @param string $post_type [description]
     * @param string $taxonomy [description]
     * @param string $posts_per_page [description]
     * @param string $offset [description]
     * @param string $orderby [description]
     * @param string $order [description]
     * @return [type]                 [description]
     */
    protected function rbt_query_controls($control_id = null, $control_name = null, $post_type = 'any', $taxonomy = 'category', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc')
    {

        $this->start_controls_section(
            'rainbowit' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'rainbowit'), $control_name),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'rainbowit'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'rainbowit'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'rainbowit'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => rbt_get_categories($taxonomy),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'rainbowit'),
                'description' => esc_html__('Select a category to exclude', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => rbt_get_categories($taxonomy),
                'label_block' => true
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'options' => rbt_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'rainbowit'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => rbt_get_orderby_options(),
                'default' => $orderby,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc'     => esc_html__('Ascending', 'rainbowit'),
                    'desc'     => esc_html__('Descending', 'rainbowit')
                ],
                'default' => $order,

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__('Ignore Sticky Posts', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rainbowit'),
                'label_off' => esc_html__('No', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }


    /**
     * @param string $control_id
     * @param string $control_name
     * @param string $default_for_lg
     * @param string $default_for_md
     * @param string $default_for_sm
     * @param string $default_for_all
     */
    protected function rbt_columns($control_id = 'columns_options', $control_name = 'Select Columns', $default_for_lg = '4', $default_for_md = '6', $default_for_sm = '6', $default_for_all = '12')
    {
        $this->start_controls_section(
            'rbt_' . $control_id . 'columns_section',
            [
                'label' => esc_html__($control_name, 'rainbowit'),
            ]
        );

        $this->add_control(
            'rbt_' . $control_id . '_for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'rainbowit'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'rainbowit'),
                    6 => esc_html__('2 Columns', 'rainbowit'),
                    4 => esc_html__('3 Columns', 'rainbowit'),
                    3 => esc_html__('4 Columns', 'rainbowit'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'rainbowit'),
                    2 => esc_html__('6 Columns', 'rainbowit'),
                    1 => esc_html__('12 Columns', 'rainbowit'),
                ],
                'separator' => 'before',
                'default' => $default_for_lg,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'rbt_' . $control_id . '_for_laptop',
            [
                'label' => esc_html__('Columns for Laptop', 'rainbowit'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'rainbowit'),
                    6 => esc_html__('2 Columns', 'rainbowit'),
                    4 => esc_html__('3 Columns', 'rainbowit'),
                    3 => esc_html__('4 Columns', 'rainbowit'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'rainbowit'),
                    2 => esc_html__('6 Columns', 'rainbowit'),
                    1 => esc_html__('12 Columns', 'rainbowit'),
                ],
                'separator' => 'before',
                'default' => $default_for_md,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'rbt_' . $control_id . '_for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'rainbowit'),
                'description' => esc_html__('Screen width equal to or greater than 576px', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'rainbowit'),
                    6 => esc_html__('2 Columns', 'rainbowit'),
                    4 => esc_html__('3 Columns', 'rainbowit'),
                    3 => esc_html__('4 Columns', 'rainbowit'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'rainbowit'),
                    2 => esc_html__('6 Columns', 'rainbowit'),
                    1 => esc_html__('12 Columns', 'rainbowit'),
                ],
                'separator' => 'before',
                'default' => $default_for_sm,
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'rbt_' . $control_id . '_for_mobile',
            [
                'label' => esc_html__('Columns for Mobile', 'rainbowit'),
                'description' => esc_html__('Screen width less than 576px', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'rainbowit'),
                    6 => esc_html__('2 Columns', 'rainbowit'),
                    4 => esc_html__('3 Columns', 'rainbowit'),
                    3 => esc_html__('4 Columns', 'rainbowit'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'rainbowit'),
                    2 => esc_html__('6 Columns', 'rainbowit'),
                    1 => esc_html__('12 Columns', 'rainbowit'),
                ],
                'separator' => 'before',
                'default' => $default_for_all,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function rbt_product_control( $control_id = null, $control_name = null, $post_type = 'product', $taxonomy = 'product_cat', $posts_per_page = '6', $offset = '0', $orderby = 'date', $order = 'desc' )
    {
       
        $this->start_controls_section(
            'rainbowit' . $control_id . '_query',
            [
                'label' => sprintf(esc_html__('%s Query', 'rainbowit'), $control_name),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'rainbowit'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'rainbowit'),
                'type' => Controls_Manager::NUMBER,
                'default' => $posts_per_page,
            ]
        );
        $this->add_control(
            'product_grid_type',
            [
                'label' => esc_html__('Product Type', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'featured_products',
                'options' => [
                    'featured_products' => esc_html__('Featured Products', 'rainbowit'),
                    'sale_products' => esc_html__('Sale Products', 'rainbowit'),
                    'best_selling_products' => esc_html__('Best Selling Products', 'rainbowit'),
                    'recent_products' => esc_html__('Recent Products', 'rainbowit'),
                    'top_rated_products' => esc_html__('Top Rated Products', 'rainbowit'),
                    'product_category' => esc_html__('Product Category', 'rainbowit'),
                ]
            ]
        );

        // Product categories.
        $this->add_control(
            'product_cat',
            [
               'type' => Controls_Manager::SELECT2,
                'label' => esc_html__('Include Category', 'rainbowit'),
                'multiple' => true,
                'description' => esc_html__('Leave blank or enter -1 for all.', 'rainbowit'),
                'options' => rbt_get_categories($taxonomy),
                'condition' => [
                    'product_grid_type' => 'product_category',
                ],
            ]
        );
        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'rainbowit'),
                'description' => esc_html__('Select a category to exclude', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => rbt_get_categories($taxonomy),
                'label_block' => true,
                'condition' => [
                    'product_grid_type' => 'product_category',
                ],
            ]
        );
        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'rainbowit'),
                'type' => Controls_Manager::SELECT2,
                'options' => rbt_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'rainbowit'),
                'type' => Controls_Manager::NUMBER,
                'default' => $offset,
            ]
        );

        $this->add_control(
            'product_orderby',
            [
                'label' => esc_html__('Order By', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'rainbowit'),
                    'ID' => esc_html__('ID', 'rainbowit'),
                    'author' => esc_html__('Author', 'rainbowit'),
                    'title' => esc_html__('Title', 'rainbowit'),
                    'modified' => esc_html__('Modified', 'rainbowit'),
                    'rand' => esc_html__('Random', 'rainbowit'),
                    'comment_count' => esc_html__('Comment count', 'rainbowit'),
                    'menu_order' => esc_html__('Menu order', 'rainbowit'),
                ],
                'default' => $orderby,
            ]
        );

        $this->add_control(
            'product_order',
            [
                'label' => esc_html__('Product Order', 'rainbowit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('desc', 'rainbowit'),
                    'asc' => esc_html__('asc', 'rainbowit')
                ],
                'default' => $order,
            ]
        );

        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__('Ignore Sticky Posts', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rainbowit'),
                'label_off' => esc_html__('No', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

}

/**
 * rbt_Helper
 */
class RBT_Helper
{

    public static function get_query_args($posttype = 'post', $taxonomy = 'category', $settings = '')
    {

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if (!empty($settings['exclude_category'])) {
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (!empty($settings['ignore_sticky_posts']) && 'yes' == $settings['ignore_sticky_posts']) ? true : false;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if (!empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'    => $taxonomy,
                    'field'         => 'slug',
                    'terms'        => $exclude_category_list_value,
                    'operator'    => 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'    => $taxonomy,
                    'field'        => 'slug',
                    'terms'        => $category_list_value,
                    'operator'    => 'IN'
                );
            }
        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }



        return $args;
    }

    public static function getProductInfo($product_per_page, $product_grid_type, $product_cat, $exclude_category, $post__not_in, $offset, $product_order_by, $product_order,  $ignore_sticky_posts, $posttype = 'product', $taxonomy = 'product_cat',$settings )
    {

      
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }



        // include_categories
        $category_list = '';
        if (!empty($product_cat)) {
           $category_list = implode(", ", $product_cat);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if (!empty($settings['exclude_category'])) {
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($post__not_in)) {
            $post__not_in = $post__not_in;
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($product_per_page)) ? $product_per_page : '-1';
        $orderby = (!empty($product_order_by)) ? $product_order_by : 'post_date';
        $order = (!empty($product_order)) ? $product_order : 'desc';
        $offset_value = (!empty($offset)) ? $offset : '0';
        $ignore_sticky_posts = (!empty($ignore_sticky_posts) && 'yes' == $ignore_sticky_posts) ? true : false;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if (!empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'    => $taxonomy,
                    'field'         => 'slug',
                    'terms'        => $exclude_category_list_value,
                    'operator'    => 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if (!empty($product_cat)) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'    => $taxonomy,
                    'field'        => 'slug',
                    'terms'        => $category_list_value,
                    'operator'    => 'IN'
                );
            }
        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($product_cat)) {
                $args['tax_query'][] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }


        if ($product_grid_type == 'sale_products') {
            // Meta query arguments
            $meta_query = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                ),
                array( // Variable products type
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric'
                )
            );

            // Add the meta query to the common arguments
            $args['meta_query'] = $meta_query;
        }

        if ($product_grid_type == 'best_selling_products') {

            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';

            
        }
        
        if ($product_grid_type == 'featured_products') {
            $tax_query = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                ),
            );

            // Add the tax query to the common arguments
            $args['tax_query'] = $tax_query;
        }
        if ($product_grid_type == 'top_rated_products') {

            $args['no_found_rows'] = 1;
            $args['meta_key'] = '_wc_average_rating';
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'] = WC()->query->get_tax_query();
        }

        return $args;
    }
}
