<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Meeting_With_Us extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-meeting-with-us';
    }

    public function get_title()
    {
        return esc_html__('Client Meeting Section', 'rainbowit');
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
				'label' => esc_html__( 'Client Image', 'rainbowit' ),
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
			'active_status',
			[
				'label' => esc_html__( 'Active Status', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'isactive',
				'options' => [
					'isactive' => esc_html__( 'isactive', 'rainbowit' ),
					'isaway' => esc_html__( 'isaway', 'rainbowit' ),
					'isoffline'  => esc_html__( 'isoffline', 'rainbowit' ),
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

        <div class="meeting-with-us">
            <h6 class="title title-xm text-center color-white mb--30">
                <?php echo esc_html($heading_title);?>
            </h6>
            <div class="rbt-avatar-group">
                <?php 
                    if(!empty($settings['list'])) { 
                        foreach( $settings['list'] as $item ) { 
                            $active_status      = $item['active_status'];
                            $client_image       = $item['client_image']['url'];

                            $client_image_id = $item['client_image']['id'];

                            $client_image_title = get_post_meta($client_image_id, '_wp_attachment_image_alt', true);
    
                            // If title is not found, fallback to the post title
                            if (empty($client_image_title)) {
                                $client_image_title = get_the_title($client_image_id);
                            }

                            ?>
                <div class="rbt-avatar <?php echo esc_attr($active_status);?>">
                    <div class="inner">
                        <img src="<?php echo esc_url($client_image);?>" alt="<?php echo esc_attr($client_image_title);?>">
                    </div>
                </div>
                <?php } } ?>
            </div>
            <p class="description mt--20 mb--25">
                <?php echo wp_kses($desc,$allowed_html);?>
            </p>
            <?php if ( ! empty( $settings['btn_link']['url'] ) ) { ?>
            <div class="rbt-btn-group">
                <a <?php echo $attr;?> class="rbt-btn rbt-btn-blueshade rbt-btn-sm">
                    <?php echo wp_kses($btn_title,$allowed_html);?>
                    <i class="fa-regular fa-chevron-right"></i>
                </a>
            </div>
            <?php  } ?>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Meeting_With_Us());