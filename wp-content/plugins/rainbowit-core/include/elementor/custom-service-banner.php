<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Custom_Service_Banner extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-service-details-banner';
    }

    public function get_title()
    {
        return esc_html__('Details Service Banner', 'rainbowit');
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
            'banner_general',
            [
                'label' => esc_html__('Banner', 'rainbowit'),
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
            'subtitle',
            [
                'label' => esc_html__('Sub Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Development Solutions', 'rainbowit'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('We Are Engaging The Best performant Websites.', 'rainbowit'),
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

        $this->add_control(
            'service_image',
            [
                'label' => esc_html__('Banner Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings     = $this->get_settings_for_display();
        $subtitle    = $settings['subtitle'] ?? '';
        $title       = $settings['title'] ?? '';
        $description = $settings['description'] ?? '';
        $btn_title   = $settings['btn_title'] ?? '';
        $btn_link    = $settings['btn_link']['url'];

        $style       = $settings['style'];

        $this->add_render_attribute('service_image', 'src', $settings['service_image']['url']);
        $this->add_render_attribute('service_image', 'alt', Control_Media::get_image_alt($settings['service_image']));
        $this->add_render_attribute('service_image', 'title', Control_Media::get_image_title($settings['service_image']));

?>
<?php if(  $style == '1' ) { ?>
    <div class="rbt-section-wrapper-8"> 
        <div class="container">
            <div class="row row--12 align-items-center">
                <div class="col-12 col-md-6 mb-5 mb-md-0">
                    <div class="rbt-section-title ">
                        <span class="subtitle mb--25" data-sal="slide-up" data-sal-duration="400"><?php echo esc_html( $subtitle );?></span>
                        <h3 class="title title-xl mb--25" data-sal="slide-up" data-sal-duration="500"><?php echo esc_html( $title );?></h3>
                        <p class="description mb--40" data-sal="slide-up" data-sal-duration="700">
                        <?php echo esc_html( $description );?>
                        </p>
                        <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="rbt-btn rbt-btn-primary rbt-btn-icon-reverse" data-sal="slide-up" data-sal-duration="400">
                            <span class="btn-icon-reverse">
                            <span class="btn-icon-left"><i class="fa-regular fa-arrow-right"></i></span>
                            <span class="btn-text"><?php echo esc_html($btn_title); ?></span>
                            <span class="btn-icon-right"><i class="fa-regular fa-arrow-right"></i></span>
                            </span>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-md-6 overflow-x-hidden ">
                    <div class="banner-img overflow-x-hidden " data-sal="slide-left" data-sal-duration="400">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'service_image' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php } else { ?>
    <div class="rbt-section-wrapper-4 rbt-section-gap2Bottom rbt-section-gap2Top">
        <div class="container">
            <div class="row row--12 align-items-center">
                <div class="col-12 col-md-6 mb-5 mb-md-0 ">
                    <div class="rbt-section-title">
                        <span class="subtitle mb--25" data-sal="slide-up" data-sal-duration="400"><?php echo esc_html( $subtitle );?></span>
                        <h3 class="title title-md mb--25" data-sal="slide-up" data-sal-duration="500"><?php echo esc_html( $title );?>
                        </h3>
                        <p class="description mb--40" data-sal="slide-up" data-sal-duration="700">
                            <?php echo esc_html( $description );?>
                        </p>
                        <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                        <a href="<?php echo esc_url($btn_link); ?>" class="rbt-btn rbt-btn-primary" data-sal="slide-up" data-sal-duration="400">
                        <?php echo esc_html($btn_title); ?>
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-12 col-md-6 overflow-x-hidden ">
                    <div class="banner-img overflow-x-hidden " data-sal="slide-left" data-sal-duration="400">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'service_image' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Custom_Service_Banner());
