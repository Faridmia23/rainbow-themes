<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Elementor_Widget_Employee_Info extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-employee-info';
    }

    public function get_title()
    {
        return esc_html__('Employee Info', 'rainbowit');
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
                'label' => esc_html__('General Info', 'rainbowit'),
            ]
        );
        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__('Icon Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12+ Professionals are waiting for you', 'rainbowit'),
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );


        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact Us Now', 'rainbowit'),
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

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Image Item', 'rainbowit' ),
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

        $repeater->add_control(
			'triangle',
			[
				'label' => esc_html__( 'triangle enable?', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rainbowit' ),
				'label_off' => esc_html__( 'Hide', 'rainbowit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $repeater->add_control(
			'sm_layout_show_hide',
			[
				'label' => esc_html__( 'Hide Small Layout', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rainbowit' ),
				'label_off' => esc_html__( 'Hide', 'rainbowit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $repeater->add_control(
			'animation_select',
			[
				'label' => esc_html__( 'Animation Select', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide-up',
				'options' => [
					'slide-up' => esc_html__( 'Slide Up', 'rainbowit' ),
					'slide-down' => esc_html__( 'Slide Down', 'rainbowit' ),
					'zoom-out'  => esc_html__( 'Zoom Out', 'rainbowit' ),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

       
		$this->end_controls_section();

    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('icon_image', 'src', $settings['icon_image']['url']);
        $this->add_render_attribute('icon_image', 'alt', Control_Media::get_image_alt($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'title', Control_Media::get_image_title($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'class', 'impower-icon');
        $this->add_render_attribute('icon_image', 'data-sal', 'slide-up');
        $this->add_render_attribute('icon_image', 'data-sal-duration', '900');
        $this->add_render_attribute('icon_image', 'data-sal-delay', '100');

        $heading_title = $settings['heading_title'] ?? '';
        $desc = $settings['desc'] ?? '';
        $btn_title = $settings['btn_title'] ?? '';
        $allowed_html = wp_kses_allowed_html('post');

        if ( !empty( $settings['btn_link']['url'] ) ) {
            $attr  = 'href="' . $settings['btn_link']['url'] . '"';
            $attr .= !empty( $settings['btn_link']['is_external'] ) ? ' target="_blank"' : '';
            $attr .= !empty( $settings['btn_link']['nofollow'] ) ? ' rel="nofollow"' : '';
            
        }

?>

        <div class="rbt-section-gapTop rbt-section-gap2Bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="content icon-image-employee">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'icon_image'); ?>
                            <div class="rbt-section-title section-title-left text-start">
                                <h3 class="title title-xxl mb--25" data-sal="slide-up" data-sal-duration="400"><?php echo esc_html($heading_title);?></h3>
                                <p class="description mb--35" data-sal="slide-up" data-sal-duration="400">
                                <?php echo wp_kses($desc,$allowed_html);?>
                                </p>
                                <?php if ( ! empty( $settings['btn_link']['url'] ) ) { ?>
                                <a class="rbt-btn rbt-btn-md rbt-btn-primary mb--25" <?php echo $attr;?> data-sal="slide-up" data-sal-duration="800">
                                <?php echo wp_kses($btn_title,$allowed_html);?>
                                </a>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <ul class="rbt-team-wrapper">
                            <?php 
                            if(!empty($settings['list'])) { 
                                foreach( $settings['list'] as $item ) { 
                                    $triangle           = $item['triangle'] == 'yes' ? 'triangle' : '';
                                    $hide_sm            = $item['sm_layout_show_hide'] == 'yes' ? 'hide-sm-layout' : '';
                                    $client_image       = $item['client_image']['url'];
                                    $animation_select   = $item['animation_select'] ?? 'slide-up';

                                    ?>
                            <li class="rbt-team-member <?php echo esc_attr($triangle);?> <?php echo esc_attr($hide_sm);?>">
                                <img src="<?php echo esc_url($client_image);?>" alt="team" data-sal="<?php echo esc_attr( $animation_select ); ?>" data-sal-duration="400">
                            </li>
                            <?php } } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Elementor_Widget_Employee_Info());

?>