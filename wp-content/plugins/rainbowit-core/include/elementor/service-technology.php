<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Service_Technology extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-service-technology';
    }

    public function get_title()
    {
        return esc_html__('Service Technology', 'rainbowit');
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
        return ['technology', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('General Section', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section Id Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('overview', 'rainbowit'),
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
            'main_desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'technology_image',
            [
                'label' => esc_html__('Technology Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'image_list',
            [
                'label' => esc_html__('Repeater List', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'counter_section',
            [
                'label' => esc_html__('Counter Section', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'counter_title',
            [
                'label' => esc_html__('Counter Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Funds were raised', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'counter_number',
            [
                'label' => esc_html__('Counter Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('120', 'rainbowit'),
            ]
        );
        $repeater->add_control(
			'surfix_class',
			[
				'label' => esc_html__( 'Prefix & Surfix Select', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no-prefix',
				'options' => [
					'no-prefix' => esc_html__( 'Default', 'rainbowit' ),
					'counter-text-1' => esc_html__( 'Plus', 'rainbowit' ),
					'counter-text-2'  => esc_html__( 'M', 'rainbowit' ),
					'counter-text-3'  => esc_html__( 'Percentage', 'rainbowit' ),
					'counter-text-4'  => esc_html__( 'Plus & Percentage', 'rainbowit' ),
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
        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';
        $main_desc      = $settings['main_desc'] ?? '';
        $section_id     = $settings['section_id'] ?? '';
?>

<div class="rbt-section-gapTop rbt-section-gat2Bottom mb--80" id="<?php echo esc_attr( $section_id );?>">
    <div class="container">
        <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
            <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
            <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
            <p class="description">
                <?php echo wp_kses_post( $main_desc ); ?>
            </p>
        </div>
        <div class="row">
            <div class="col-12 col-md-10 mx-auto">
                <div class="technologies">
                    <div class="content-wrapper" data-sal="slide-up" data-sal-duration="400">
                    <?php
                    if (!empty($settings['image_list'])) {
                        foreach ($settings['image_list'] as $item) {

                            $image_url = $item['technology_image']['url'];

                            $image_id = $item['technology_image']['id'];

                            $image_title = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                            // If title is not found, fallback to the post title
                            if (empty($image_title)) {
                                $image_title = get_the_title($image_id);
                            }

                        ?>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr($image_title);?>">
                        <?php
                        }
                    } ?>
                    </div>
                </div>
            </div>
            <div class="col-12 mt--80">
                <div class="counter-group">
                    <?php
                    if (!empty($settings['list'])) {
                        $counter = 1;
                        foreach ($settings['list'] as $item) {

                            $counter_title  = $item['counter_title'];
                            $counter_number = $item['counter_number'];
                            $surfix_class   = $item['surfix_class'];

                        ?>
                    <!-- count item -->
                    <div class="count-item">
                        <div class="rbt-counter-3">
                            <h4 class="counter <?php echo esc_attr( $surfix_class ); ?>"><span class="odometer odometer-auto-theme count"
                            data-count="<?php echo esc_html( $counter_number ); ?>">00</span></h4>
                        </div>
                        <span class="counter-meta"><?php echo esc_html( $counter_title ); ?></span>
                    </div>
                    <?php
                       $counter++; }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Service_Technology());