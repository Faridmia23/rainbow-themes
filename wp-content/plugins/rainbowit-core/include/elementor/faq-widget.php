<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Faq_Widget extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-faq-widget';
    }

    public function get_title()
    {
        return esc_html__('Faq Widget', 'rainbowit');
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
        return ['faq', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Faq Section', 'rainbowit'),
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

        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'rainbowit'),
            ]
        );
        $this->add_control(
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'faq_title',
            [
                'label' => esc_html__('Faq Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Do you offer e-commerce website design & development?', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'faq_desc',
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
        $btn_title      = $settings['btn_title'] ?? '';

        $btn_link = $settings['btn_link']['url'];

?>

    <div class="rbt-section-gapTop rbt-section-gap2Bottom">
        <div class="container">
        <?php if( !empty( $sub_title ) || !empty( $heading_title ) || !empty( $btn_link ) ) { ?>
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <?php if( !empty( $sub_title ) ) { ?>
                <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                <?php } ?>
                <?php if( !empty( $heading_title ) ) { ?>
                <<?php echo esc_html( $settings['sec_title_tag'] ); ?> class="title"><?php echo esc_html( $heading_title ); ?></<?php echo esc_html( $settings['sec_title_tag'] ); ?>>
                <?php } ?>
                <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                    <a class="rbt-btn rbt-btn-round rbt-btn-xm rbt-outline-none hover-effect-3" href="<?php echo esc_url($btn_link); ?>">
                        <?php echo esc_html($btn_title); ?>
                        <span class="default-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                        <span class="hover-btn-icon"><i class="fa-solid fa-arrow-up-right"></i></span>
                    </a>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-12 col-md-9 col-lg-6 mx-auto">
                    <div class="accordion " id="accordionExample">
                        <!-- FAQ item -->
                        <?php
                        if (!empty($settings['list'])) {
                            $count = 1;
                            foreach ($settings['list'] as $item) {

                                $faq_title      = $item['faq_title'] ?? '';
                                $faq_desc       = $item['faq_desc'] ?? '';
                                $show = '';
                                if( $count == 1 ) {
                                    $show = 'show';
                                }

                        ?>
                                <div class="rbt-accordion-item" data-sal="slide-up" data-sal-duration="400">
                                    <h3 class="title">
                                        <button class="accordion-button rbt-accordion-btn border-0" type="button" data-bs-toggle="collapse" data-bs-target="#rbt-faq-<?php echo $count; ?>" aria-expanded="true" aria-controls="rbt-faq-<?php echo $count; ?>">
                                            <span class="accordion-title"><?php echo esc_html($faq_title); ?></span>
                                            <span class="rbt-accordion-icon"><i class="fa-sharp fa-solid fa-arrow-down"></i></span>
                                        </button>
                                    </h3>
                                    <div id="rbt-faq-<?php echo $count; ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" data-bs-parent="#accordionExample">
                                        <div class="rbt-accordion-body">
                                            <p class="description">
                                                <?php echo wp_kses_post($faq_desc); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ item -->

                        <?php
                                $count++;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Faq_Widget());
