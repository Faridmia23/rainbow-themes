<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Service_Widget extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-overview-service-widget';
    }

    public function get_title()
    {
        return esc_html__('Service Overview', 'rainbowit');
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
			'style',
			[
				'label' => esc_html__( 'Layout Style', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Layout 1', 'rainbowit' ),
					'2'  => esc_html__( 'Layout 2', 'rainbowit' ),
				],
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
            'service_title',
            [
                'label' => esc_html__('Service Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Data Solution', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'sec_title_tag_item',
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
                'default' => 'h6',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
			'icon_choose',
			[
				'label' => esc_html__( 'Icon Choose', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon_manager',
				'options' => [
					'icon_manager' => esc_html__( 'Icon Manager', 'rainbowit' ),
					'icon_input'  => esc_html__( 'Icon Input', 'rainbowit' ),
				],
			]
		);

        $repeater->add_control(
			'item_icon',
			[
				'label' => esc_html__( 'Item Icon', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
                'condition' => ['icon_choose' => 'icon_manager']
			]
		);
        $repeater->add_control(
            'icon_class',
            [
                'label' => esc_html__('Icon', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'condition' => ['icon_choose' => 'icon_input']
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

        $settings       = $this->get_settings_for_display();
        $style          = $settings['style'] ?? '';
        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';
        $main_desc      = $settings['main_desc'] ?? '';
        $section_id     = $settings['section_id'] ?? '';
?>
<?php if( $style  == '1') { ?>
<div class="rbt-section-wrapper pt--50 rbt-section-gapBottom backdrop-bottom" id="<?php echo esc_attr( $section_id ); ?>">
    <div class="container">
        <div class="rbt-parent wider-section">
            <div class="rbt-parent-bg parent-bg-3 "></div>
            <div class="rbt-inner-img rbt-inner-img"></div>
            <div class="rbt-inner-content">
                <div class="inner">
                    <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                        <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
                        <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                        <p class="description">
                            <?php echo wp_kses_post( $main_desc ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="rbt-top-items mt_dec--120 ">
            <div class="row row--8">
                <?php
                if (!empty($settings['list'])) {
                    foreach ($settings['list'] as $item) {

                        $service_title  = $item['service_title'] ?? '';
                        $desc           = $item['desc'] ?? '';
                        $icon_choose    = $item['icon_choose'];
                        $icon_class    = $item['icon_class'];

                ?>
                <!-- item 1 -->
                <div class="col-12 col-md-6 col-xl-3 single-item mb--24" data-sal="slide-up" data-sal-duration="400">
                    <div class="rbt-card-5">
                        <span class="icon">
                            <?php if( $icon_choose == 'icon_input') { ?>
                                <i class="<?php echo esc_attr( $icon_class );?>"></i>
                            <?php } else { ?>
                                <i class="<?php echo esc_attr( $item['item_icon']['value'] ); ?>"></i>
                            <?php } ?>
                        </span>
                        <<?php echo esc_html($item['sec_title_tag_item']); ?> class="title"><?php echo esc_html( $service_title ); ?></<?php echo esc_html($item['sec_title_tag_item']); ?>>
                        <p class="description-text text-center">
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
<?php } elseif( $style  == '2') { ?>
<div class="rbt-section-gapTop rbt-section-gapBottom" id="why-us">
    <div class="container">
        <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
        <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
        <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
        </div>

        <div class="col-10 mx-auto mt--50">
            <div class="rbt-card-group-4 ">
            <?php
                if (!empty($settings['list'])) {
                    foreach ($settings['list'] as $item) {

                        $service_title  = $item['service_title'] ?? '';
                        $desc           = $item['desc'] ?? '';
                        $icon_choose    = $item['icon_choose'];
                        $icon_class    = $item['icon_class'];

                ?>
                <!-- single card -->
                <div class="rbt-card-5" data-sal="slide-up" data-sal-duration="400">
                    <span class="icon bg-none">
                        <?php if( $icon_choose == 'icon_input') { ?>
                            <i class="<?php echo esc_attr( $icon_class );?>"></i>
                        <?php } else { ?>
                            <i class="<?php echo esc_attr( $item['item_icon']['value'] ); ?>"></i>
                        <?php } ?>
                    </span>
                    <<?php echo esc_html($item['sec_title_tag_item']); ?> class="title"><?php echo esc_html( $service_title ); ?></<?php echo esc_html($item['sec_title_tag_item']); ?>>
                    <p class="description-text text-center">
                    <?php echo esc_html( $desc ); ?>
                    </p>
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
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Service_Widget());