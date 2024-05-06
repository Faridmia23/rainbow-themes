<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Team_Member extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-team-member';
    }

    public function get_title()
    {
        return esc_html__('Team Member', 'rainbowit');
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
        return ['service', 'rainbowit', 'offer'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Services', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Team', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Heading', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__(' Dedicated Team Behind US', 'rainbowit'),
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
            'item_title',
            [
                'label' => esc_html__('Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Product Users', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('36000', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'team_image',
            [
                'label' => esc_html__('Team Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list2',
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

        $settings            = $this->get_settings_for_display();
        $heading_title       = $settings['heading_title'] ?? '';
        $sub_title           = $settings['sub_title'] ?? '';

?>
    <div class="rbt-section-gap2Top rbt-section-gapBottom">
        <div class="container">
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
            </div>

            <div class="rbt-team-wrapper-2">
                <?php
                if (!empty($settings['list2'])) {
                    foreach ($settings['list2'] as $item) {
                        $item_title = $item['item_title'];
                        $designation = $item['designation'];
                        $team_image = $item['team_image']['url'];

                ?>
                        <!-- single member -->
                        <div class="rbt-team-card" data-sal="slide-up" data-sal-duration="400">
                            <div class="rbt-member-img">
                                <img src="<?php echo esc_url($team_image); ?>" alt="Team member image">
                                <div class="member-img-bg"></div>
                            </div>
                            <div class="rbt-member-info">
                                <h6 class="member"><?php echo esc_html($item_title); ?></h6>
                                <span class="member-role"><?php echo esc_html($designation); ?></span>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Team_Member());
