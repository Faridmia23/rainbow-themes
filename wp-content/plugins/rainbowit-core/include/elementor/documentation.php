<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Documentation extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-documentation-widget';
    }

    public function get_title()
    {
        return esc_html__('Documentation', 'rainbowit');
    }

    public function get_icon()
    {
        return 'rt-icon';
    }

    public function get_categories()
    {
        return ['rainbowit'];
    }

    public function get_keywords()
    {
        return ['documentation', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Documentation', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Layout Style', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Layout 1', 'rainbowit'),
                    '2'  => esc_html__('Layout 2', 'rainbowit'),
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Development', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Custom web services we are offering', 'rainbowit'),
            ]
        );
        $this->add_control(
            'sec_title_tag',
            [
                'label' => __('Title HTML Tag', 'rainbowit'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'rainbowit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'rainbowit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'rainbowit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'rainbowit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'rainbowit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'rainbowit'),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'div' => [
                        'title' => __('div', 'rainbowit'),
                        'icon' => 'eicon-font'
                    ]
                ],
                'default' => 'h3',
                'separator' => 'before',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'doc_title',
            [
                'label' => esc_html__('Doc Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Data Solution', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'sec_title_tag_item',
            [
                'label' => __('Title HTML Tag', 'rainbowit'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'rainbowit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'rainbowit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'rainbowit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'rainbowit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'rainbowit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'rainbowit'),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'div' => [
                        'title' => __('div', 'rainbowit'),
                        'icon' => 'eicon-font'
                    ]
                ],
                'default' => 'h6',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'project_image',
            [
                'label' => esc_html__('Project Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings       = $this->get_settings_for_display();
        $style          = $settings['style'] ?? '';
        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';
?>
        <?php if ($style  == '1') { ?>
            <div class="rbt-section-wrapper mt_dec--205">
                <div class="container">
                    <div class="section-wide">
                        <div class="row row--12">
                            <?php
                            if (!empty($settings['list'])) {
                                foreach ($settings['list'] as $item) {

                                    $doc_title  = $item['doc_title'] ?? '';
                                    $img_url    = $item['project_image']['url'];
                                    $btn_link   = $item['btn_link']['url'];

                                    $portfolio_image_id = $item['project_image']['id'];

                                    $portfolio_image_title = get_post_meta($portfolio_image_id, '_wp_attachment_image_alt', true);
            
                                    // If title is not found, fallback to the post title
                                    if (empty($portfolio_image_title)) {
                                        $portfolio_image_title = get_the_title($portfolio_image_id);
                                    }
                                ?>
                                    <!-- single item -->
                                    <div class="col-12 col-md-6 col-xl-4" data-sal="slide-up" data-sal-duration="400">
                                        <a href="<?php echo esc_url($btn_link); ?>">
                                            <div class="rbt-doc-card">
                                                <span class="link-icon"><i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i></span>
                                                <?php if (isset($img_url)) { ?>
                                                    <img class="doc-thumbnail" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($portfolio_image_title);?>">
                                                <?php } ?>
                                                <<?php echo esc_html($item['sec_title_tag_item']); ?> class="doc-card-title"><?php echo esc_html($doc_title); ?></<?php echo esc_html($item['sec_title_tag_item']); ?>>
                                            </div>
                                        </a>
                                    </div>
                            <?php
                                }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>

        <?php } elseif ($style == '2') { ?>

            <div class="rbt-section-gapTop0 ptb--5">
                <div class="container">
                    <div class="section-wide">
                        <div class="rbt-section-title section-title-center">
                            <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                            <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                        </div>
                        <div class="row row--12 mt--40">
                            <?php
                            if (!empty($settings['list'])) {
                                foreach ($settings['list'] as $item) {

                                    $doc_title  = $item['doc_title'] ?? '';
                                    $img_url    = $item['project_image']['url'];
                                    $btn_link   = $item['btn_link']['url'];

                                    $portfolio_image_id = $item['project_image']['id'];
                                    $portfolio_image_title = get_post_meta($portfolio_image_id, '_wp_attachment_image_alt', true);
            
                                    // If title is not found, fallback to the post title
                                    if (empty($portfolio_image_title)) {
                                        $portfolio_image_title = get_the_title($portfolio_image_id);
                                    }
                                ?>

                             <!-- single item -->
                             <div class="col-12 col-md-6 col-xl-4" data-sal="slide-up" data-sal-duration="400">
                                    <a href="<?php echo esc_url($btn_link); ?>">
                                        <div class="rbt-doc-card">
                                            <span class="link-icon"><i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i></span>
                                            <?php if (isset($img_url)) { ?>
                                                <img class="doc-thumbnail" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($portfolio_image_title);?>">
                                            <?php } ?>
                                            <<?php echo esc_html($item['sec_title_tag_item']); ?> class="doc-card-title"><?php echo esc_html($doc_title); ?></<?php echo esc_html($item['sec_title_tag_item']); ?>>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Documentation());
