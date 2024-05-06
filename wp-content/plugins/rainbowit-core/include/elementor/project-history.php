<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Project_history extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-project-history';
    }

    public function get_title()
    {
        return esc_html__('Project History', 'rainbowit');
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
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'sub_title2',
            [
                'label' => esc_html__('Sub Title 2', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Team', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title2',
            [
                'label' => esc_html__('Heading 2', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__(' Dedicated Team Behind US', 'rainbowit'),
            ]
        );

        $this->add_control(
            'sec_title_tag2',
            [
                'label' => __('Title HTML Tag 2', 'rainbowit'),
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
            'description2',
            [
                'label' => esc_html__('Description 2', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'history_image',
            [
                'label' => esc_html__('History Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
			'img_y_pos',
			[
				'label' => esc_html__( 'Image Y Position', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '-50',
				'options' => [
					'' => esc_html__( 'Default', 'rainbowit' ),
					'-50' => esc_html__( '-50', 'rainbowit' ),
					'60'  => esc_html__( '60', 'rainbowit' ),
					'100' => esc_html__( '100', 'rainbowit' ),
					'40' => esc_html__( '40', 'rainbowit' ),
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
        $description         = $settings['description'] ?? '';
        $sub_title2          = $settings['sub_title2'] ?? '';
        $heading_title2      = $settings['heading_title2'] ?? '';
        $description2        = $settings['description2'] ?? '';
        

?>

<div class="rbt-section-wrapper-6 rbt-section-gapTop rbt-section-gapBottom">
    <div class="container">
        <div class="row row--12 mb--80">
            <div class="col-12 col-md-6">
                <div class="rbt-section-title rbt-banner-section-title ">
                    <span class="subtitle text-white"><?php echo esc_html($sub_title); ?></span>
                    <<?php echo esc_html($settings['sec_title_tag']); ?> class="title text-white"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                    <p class="description description-light">
                        <?php echo wp_kses_post( $description ); ?>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="rbt-section-title rbt-banner-section-title ">
                <span class="subtitle text-white"><?php echo esc_html($sub_title2); ?></span>
                    <<?php echo esc_html($settings['sec_title_tag2']); ?> class="title text-white"><?php echo esc_html($heading_title2); ?></<?php echo esc_html($settings['sec_title_tag2']); ?>>
                    <p class="description description-light">
                        <?php echo wp_kses_post( $description2 ); ?>
                    </p>
                </div>
            </div>
        </div>


        <div class="rbt-thumbnail-wrapper">
        <?php
            if (!empty($settings['list2'])) {
                $count = 1;
                foreach ($settings['list2'] as $item) {
                    $item_title = $item['item_title'];
                    $img_y_pos = $item['img_y_pos'];
                   
                    $history_image = $item['history_image']['url'];

            ?>
            <div class="rbt-thumbnail image-<?php echo esc_html( $count ); ?>">
                <img data-parallax="{'x': 0, 'y': <?php echo $img_y_pos; ?>}" src="<?php echo esc_url($history_image); ?>" alt="Thumbnail Image">
            </div>
            <?php
                   $count++;  }
                } ?>
        </div>
    </div>
</div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Project_history());
