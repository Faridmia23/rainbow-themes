<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Work_Process extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-work-process';
    }

    public function get_title()
    {
        return esc_html__('Work Process', 'rainbowit');
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
        return ['service', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Image Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section Id Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('process', 'rainbowit'),
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
            'service_title',
            [
                'label' => esc_html__('Service Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Website Design', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'data_text',
            [
                'label' => esc_html__('Data Text Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('1', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
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

        $settings = $this->get_settings_for_display();

        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';
        $section_id     = $settings['section_id'] ?? '';

?>
        <div class="rbt-section-wrapper-4 rbt-section-gap2Top rbt-section-gap3Bottom" id="<?php echo esc_html( $section_id ); ?>">
            <div class="container">
                <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                </div>
            </div>
            <div class="ml-container">
                <div class="swiper rbt-swiper-corousel-2" data-sal="slide-up" data-sal-duration="400">
                    <div class="slider-top-line"></div>
                    <div class="swiper-wrapper">
                        <!-- single slider -->

                        <?php
                        if (!empty($settings['list'])) {
                            foreach ($settings['list'] as $item) {

                                $service_title   = $item['service_title'] ?? '';
                                $desc            = $item['desc'] ?? '';
                                $data_text       = $item['data_text'] ?? '1';
                        ?>
                        <div class="swiper-slide rbt-slide-marker" data-text="<?php echo esc_html( $data_text ); ?>">
                            <div class="rbt-card-6">
                                <h6 class="title title-xm"><?php echo esc_html( $service_title ); ?></h6>
                                <p class="description">
                                <?php echo esc_html( $desc ); ?>
                                </p>
                            </div>
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

Plugin::instance()->widgets_manager->register(new Rainbowit_Work_Process());
