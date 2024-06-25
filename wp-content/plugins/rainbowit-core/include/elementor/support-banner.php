<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Support_Banner extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-support-banner';
    }

    public function get_title()
    {
        return esc_html__('Support Banner', 'rainbowit');
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
            '_section_actions',
            [
                'label' => esc_html__('Contact Support', 'rainbowit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'support_title',
            [
                'label'       => esc_html__('Support Title', 'rainbowit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
                'placeholder' => esc_html__('Support Title', 'rainbowit'),
            ]
        );

        $this->add_control(
            'support_desc',
            [
                'label'       => esc_html__('Support Description', 'rainbowit'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_title',
            [
                'label'       => esc_html__('Button Title', 'rainbowit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
                'placeholder' => esc_html__('Contact Support', 'rainbowit'),
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

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $btn_link        = $settings['btn_link']['url'];
        $support_title   = $settings['support_title'];
        $support_desc    = $settings['support_desc'];
        $btn_title       = $settings['btn_title'];

?>

        <div class="rbt-sidebar-card card-bg-shape">
            <div class="side-card-content">
                <h6 class="title text-center "><?php echo esc_html($support_title); ?></h6>
                <p class="description text-center ">
                    <?php echo wp_kses_post($support_desc); ?>
                </p>
                <?php if (isset($btn_link)) { ?>
                    <a class="rbt-btn rbt-btn-dark rbt-btn-sm" href="<?php echo esc_url($btn_link); ?>">
                        <?php echo esc_html($btn_title); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Support_Banner());
