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
        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';

?>

    <div class="rbt-section-gapTop rbt-section-gap2Bottom">
        <div class="container">
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                <a class="rbt-btn rbt-btn-round rbt-btn-xm rbt-outline-none hover-effect-3" href="#">
                    Let's work together
                    <span class="default-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                    <span class="hover-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                </a>
            </div>

            <div class="row">
                <div class="col-12 col-md-9 col-lg-6 mx-auto">
                    <div class="accordion " id="accordionExample">
                        <!-- FAQ item -->
                        <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                            <h3 class="title">
                                <button class="accordion-button rbt-accordion-btn border-0" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-1" aria-expanded="true" aria-controls="rbt-faq-1">
                                    <span class="accordion-title">Do you offer e-commerce website design & development?</span>
                                    <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                                </button>
                            </h3>
                            <div id="rbt-faq-1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="rbt-accordion-body">
                                    <p class="description">
                                        Yes, we offer design and development services for eCommerce websites. Additionally,
                                        we
                                        provide of our clients achieve their goals by designing and developing eCommerce
                                        websites.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ item -->
                        <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                            <h3 class="title">
                                <button class="accordion-button rbt-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-2" aria-expanded="false" aria-controls="rbt-faq-2">
                                    <span class="accordion-title">What is your expected creating a website?</span>
                                    <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                                </button>
                            </h3>
                            <div id="rbt-faq-2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="rbt-accordion-body">
                                    <p class="description">
                                        Yes, we offer design and development services for eCommerce websites. Additionally,
                                        we
                                        provide of our clients achieve their goals by designing and developing eCommerce
                                        websites.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ item -->
                        <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                            <button class="accordion-button rbt-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-3" aria-expanded="false" aria-controls="rbt-faq-3">
                                <span class="accordion-title">Do you offer e-commerce website design & development?</span>
                                <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                            </button>
                            <div id="rbt-faq-3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="rbt-accordion-body">
                                    <p class="description">
                                        Yes, we offer design and development services for eCommerce websites. Additionally,
                                        we
                                        provide of our clients achieve their goals by designing and developing eCommerce
                                        websites.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ item -->
                        <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                            <button class="accordion-button rbt-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-4" aria-expanded="false" aria-controls="rbt-faq-4">
                                <span class="accordion-title">Do you offer responsive design how it improves experience?</span>
                                <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                            </button>
                            <div id="rbt-faq-4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="rbt-accordion-body">
                                    <p class="description">
                                        Yes, we offer design and development services for eCommerce websites. Additionally,
                                        we
                                        provide of our clients achieve their goals by designing and developing eCommerce
                                        websites.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ item -->
                        <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                            <button class="accordion-button rbt-accordion-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-5" aria-expanded="false" aria-controls="rbt-faq-5">
                                <span class="accordion-title">Can you redesign my outdated website?</span>
                                <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                            </button>
                            <div id="rbt-faq-5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="rbt-accordion-body">
                                    <p class="description">
                                        Yes, we offer design and development services for eCommerce websites. Additionally,
                                        we
                                        provide of our clients achieve their goals by designing and developing eCommerce
                                        websites.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Custom_Web_Service());
