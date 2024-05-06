<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Our_History extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-our-history';
    }

    public function get_title()
    {
        return esc_html__('Our History', 'rainbowit');
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
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Rainbow Themes Story', 'rainbowit'),
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
                'label' => esc_html__('Description 1', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );

        $this->add_control(
            'description2',
            [
                'label' => esc_html__('Description 2', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );

        $this->add_control(
            'achivement_title',
            [
                'label' => esc_html__('Achivement Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Our Achievements', 'rainbowit'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'achievement_image',
            [
                'label' => esc_html__('Achievement Image', 'rainbowit'),
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

        $this->start_controls_section(
            'contact_info',
            [
                'label' => esc_html__('Contact Info', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Item Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Product Users', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'users',
            [
                'label' => esc_html__('Product Users', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('36000', 'rainbowit'),
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
            'animation_duration',
            [
                'label' => esc_html__('Animation duration', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('300', 'rainbowit'),
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
        $this->add_control(
            'button_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View The Envato Profile', 'rainbowit'),
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

        $settings            = $this->get_settings_for_display();
        $heading_title       = $settings['heading_title'] ?? '';
        $description         = $settings['description'] ?? '';
        $description2        = $settings['description2'] ?? '';
        $achivement_title    = $settings['achivement_title'] ?? '';
        $btn_link            = $settings['btn_link']['url'];
        $button_title = $settings['button_title'] ?? '';
?>

<div class="rbt-section-bgCommon about-page-wrapper">
    <div class="container">
        <div class="row row--12">
            <div class="col-12 col-lg-8">
                <div class="rbt-section-title rbt-banner-section-title">
                    <<?php echo esc_html($settings['sec_title_tag']); ?> class="title" data-sal="slide-up" data-sal-duration="400"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                    <p class="description" data-sal="slide-up" data-sal-duration="400">
                        <?php echo wp_kses_post($description); ?>
                    </p>
                    <p class="description" data-sal="slide-up" data-sal-duration="400">
                        <?php echo wp_kses_post($description2); ?>
                    </p>
                    <h6 class="title title-xm fw-bold mb--25 mt--20" data-sal="slide-up" data-sal-duration="1100"><?php echo wp_kses_post($achivement_title); ?></h6>
                    <ul class="icon-list">

                    <?php
                    if (!empty($settings['list'])) {
                        foreach ($settings['list'] as $item) {
                            $achievement_image     = $item['achievement_image']['url'];

                    ?>
                        <li data-sal="slide-up" data-sal-duration="700"><img class="icon" src="<?php echo esc_url( $achievement_image ); ?>" alt="icon"></li>
                        <?php
                        }
                    } ?>

                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="rbt-banner-card">
                <?php
                    if (!empty($settings['list2'])) {
                        foreach ($settings['list2'] as $item) {
                            $icon_choose = $item['icon_choose'];
                            $item_title = $item['item_title'];
                            $users = $item['users'];
                            $icon_class = $item['icon_class'];
                            $animation_duration = $item['animation_duration'];
                        
                    ?>
                    <div class="rbt-profile-info" data-sal="slide-up" data-sal-duration="400">
                        <span class="icon">
                            
                        <?php if( $icon_choose == 'icon_input') { ?>
                                <i class="<?php echo esc_attr( $icon_class );?>"></i>
                            <?php } else { ?>
                                <i class="<?php echo esc_attr( $item['item_icon']['value'] ); ?>"></i>
                            <?php } ?>
                        </span>
                        <div>
                            <h3 class="title"><?php echo esc_html($users);?></h3>
                            <span class="description lh-1 "><?php echo esc_html($item_title);?></span>
                        </div>
                    </div>
                    <?php
                        }
                    } ?>
                    <a href="<?php echo esc_url($btn_link); ?>" class="rbt-btn rbt-btn-primary rbt-btn-icon-reverse w-100 mt--15" data-sal="slide-up" data-sal-duration="<?php echo esc_html( $animation_duration ); ?>">
                        <span class="btn-icon-reverse">
                        <span class="btn-icon-left"><i class="fa-regular fa-arrow-right"></i></span>
                        <span class="btn-text"><?php echo esc_html($button_title); ?></span>
                        <span class="btn-icon-right"><i class="fa-regular fa-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Our_History());