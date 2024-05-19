<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Custom_Web_Service extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-custom-web-service';
    }

    public function get_title()
    {
        return esc_html__('Custom Web Service', 'rainbowit');
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
                'default' => 'h4',
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Data Solution', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Service Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Website Design', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'service_info',
            [
                'label' => esc_html__('Service Info', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Start From', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'rainbowit'),
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
            'service_image',
            [
                'label' => esc_html__('Service Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Service Price', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$750.00', 'rainbowit'),
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
        $heading_title = $settings['heading_title'] ?? '';

?>
        <div class="container">
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title title-xl"><?php echo esc_html($heading_title); ?><<?php echo esc_html($settings['sec_title_tag']); ?>>
            </div>
            <div class="rbt-card-group-2 mt--50">
                <?php
                if (!empty($settings['list'])) {
                    foreach ($settings['list'] as $item) {

                        $this->add_render_attribute('service_image', 'src', $item['service_image']['url']);
                        $this->add_render_attribute('service_image', 'alt', Control_Media::get_image_alt($item['service_image']));
                        $this->add_render_attribute('service_image', 'title', Control_Media::get_image_title($item['service_image']));
                        $this->add_render_attribute('service_image', 'class', 'impower-icon');

                        $service_info   = $item['service_info'] ?? '';
                        $service_title  = $item['service_title'] ?? '';
                        $btn_title      = $item['btn_title'] ?? '';
                        $main_title     = $item['main_title'] ?? '';
                        $desc           = $item['desc'] ?? '';
                        $btn_link       = $item['btn_link']['url'];

                ?>
                        <!-- single card -->
                        <div class="rbt-card-2">
                            <div class="card-top">
                                <h4 class="title"><?php echo esc_html($main_title); ?></h4>
                                <p class="description hide-sm-layout">
                                    <?php echo wp_kses_post($desc); ?>
                                </p>
                            </div>
                            <div class="card-image">
                                <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'full', 'service_image'); ?>
                            </div>
                            <div class="card-bottom">
                                <div class="rbt-card-meta">
                                    <div class="meta">
                                        <h6 class="meta-title"><?php echo esc_html($service_title); ?></h6>
                                        <p class="meta-info"><?php echo esc_html($service_info); ?></p>
                                    </div>
                                    <p class="price">
                                        <?php echo wp_kses_post($service_info); ?>
                                        <span>*</span>
                                    </p>
                                </div>
                                <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                                    <a href="<?php echo esc_url($btn_link); ?>" class="rbt-btn rbt-btn-offwhite hover-effect-1 w-100 ">
                                        <?php echo $btn_title; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>
        
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Custom_Web_Service());
