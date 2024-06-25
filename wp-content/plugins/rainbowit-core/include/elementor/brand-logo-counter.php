<?php
namespace Elementor;
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Elementor_Widget_Brand_Logo extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-brand-logo-counter';
    }

    public function get_title()
    {
        return esc_html__('Brand Logo Counter', 'rainbowit');
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
        return ['about', 'rainbowit'];
    }

    protected function register_controls()
    {




        $this->start_controls_section(
            '_about_thumbnail',
            [
                'label' => esc_html__('Counter Info', 'rainbowit'),
            ]
        );
        $this->add_control(
			'counter_on_off',
			[
				'label' => esc_html__( 'Counter ON/OFF', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rainbowit' ),
				'label_off' => esc_html__( 'Hide', 'rainbowit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('We Are Trusted by', 'rainbowit'),
                'condition' => ['counter_on_off' => 'yes']
            ]
        );
        $this->add_control(
            'subtitle_title',
            [
                'label' => esc_html__('Subtitle Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Customers', 'rainbowit'),
                'condition' => ['counter_on_off' => 'yes']
            ]
        );
        $this->add_control(
            'counter_number',
            [
                'label' => esc_html__('Counter Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('16890', 'rainbowit'),
                'condition' => ['counter_on_off' => 'yes']
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Logo Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'client_image',
            [
                'label' => esc_html__('Client Image', 'rainbowit'),
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

        $settings = $this->get_settings_for_display();


        $heading_title = $settings['heading_title'] ?? '';
        $subtitle_title = $settings['subtitle_title'] ?? '';
        $counter_number = $settings['counter_number'] ?? '';

        $counter_on_off = $settings['counter_on_off'];


?>

    <div class="brand-wrapper rbt-section-gapTop rbt-section-gapBottom">
        <!-- trusted customer -->
        <div class="brand-wrapper-preloader">
            <?php if( $counter_on_off == 'yes' ) { ?>
                <div id="rainbowit-preloader">
                <div class="spinner"></div>
            </div>
            <div id="rainbowit-main-content" style="display: none;">
                <div class="rbt-counter d-none d-md-flex">
                    <span class="count-info"><?php echo esc_attr($heading_title); ?></span>
                    <div class="counter-wrapper">
                        <span class="odometer odometer-auto-theme count" data-count="<?php echo esc_attr($counter_number); ?>">00</span>
                    </div>
                    <span class="count-info"><?php echo esc_attr($subtitle_title); ?></span>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class="container overflow-hidden ">
            <div class="rbt-brand-group">
                <div class="swiper-wrapper rbt-brand-wrapper">
                    <!-- single slider -->
                    <?php
                    if (!empty($settings['list'])) {
                        foreach ($settings['list'] as $item) {
                            $client_image = $item['client_image']['url'];

                            $client_image_id = $item['client_image']['id'];

                            $client_image_title = get_post_meta($client_image_id, '_wp_attachment_image_alt', true);

                            // If title is not found, fallback to the post title
                            if (empty($client_image_title)) {
                                $client_image_title = get_the_title($client_image_id);
                            }

                    ?>
                            <div class="swiper-slide">
                                <img class="brand-img" src="<?php echo esc_url($client_image); ?>" alt="<?php echo esc_attr($client_image_title); ?>">
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>
        </div>
    </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Elementor_Widget_Brand_Logo());
