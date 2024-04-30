<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Counter_Completed extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-completed-project';
    }

    public function get_title()
    {
        return esc_html__('Counter Done Project', 'rainbowit');
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
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Completed Projects', 'rainbowit'),
            ]
        );

        $this->add_control(
            'meta_title',
            [
                'label' => esc_html__('Meta Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Still Counting', 'rainbowit'),
            ]
        );

        $this->add_control(
            'counter_number',
            [
                'label' => esc_html__('Counter Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('200', 'rainbowit'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $heading_title = $settings['heading_title'] ?? '';
        $meta_title = $settings['meta_title'] ?? '';
        $counter_number = $settings['counter_number'] ?? '';


?>

<div class="rbt-counter-2 rbt-section-shape pt--185" data-sal="slide-up" data-sal-duration="400">
    <div class="counter-wrapper counter-wrapper-2 ">
        <span class="odometer odometer-auto-theme count" data-count="<?php echo esc_attr( $counter_number );?>">00</span>
        <span class="plus">+</span>
    </div>
    <div class="rbt-section-title section-title-center">
        <h4 class="title mt--30"><?php echo esc_html($heading_title);?></h4>
        <span class="section-meta"><?php echo esc_html($meta_title);?></span>
    </div>
</div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Counter_Completed());