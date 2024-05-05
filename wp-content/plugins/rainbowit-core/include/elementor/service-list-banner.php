<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Service_List_Banner extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-service-list-banner';
    }

    public function get_title()
    {
        return esc_html__('Service List Banner', 'rainbowit');
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
            'title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('We Are Engaging The Best performant Websites.', 'rainbowit'),
            ]
        );

        $this->add_control(
            'title_image',
            [
                'label' => esc_html__('Title Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
              'label'       => esc_html__('Button Title 1', 'rainbowit'),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
              'placeholder' => esc_html__('Contact Support', 'rainbowit'),
            ]
        );
      
        $this->add_control(
            'btn_link',
            [
              'label' => esc_html__('Button Link 1', 'rainbowit'),
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
            'btn_title_2',
            [
              'label'       => esc_html__('Button Title 2', 'rainbowit'),
              'type'        => \Elementor\Controls_Manager::TEXT,
              'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
              'placeholder' => esc_html__('Contact Support', 'rainbowit'),
            ]
        );
      
        $this->add_control(
            'btn_link_2',
            [
              'label' => esc_html__('Button Link 2', 'rainbowit'),
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

        $settings     = $this->get_settings_for_display();
        $title        = $settings['title'] ?? '';
        $description  = $settings['description'] ?? '';
        $btn_title    = $settings['btn_title'] ?? '';
        $btn_title_2    = $settings['btn_title_2'] ?? '';
        $btn_link_2     = $settings['btn_link_2']['url'];
        $btn_link     = $settings['btn_link']['url'];


?>
<div class="rbt-main-banner rbt-banner-two">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- content -->
                <div class="content">
                    <div class="inner">
                        <h1 class="title" data-sal="slide-up" data-sal-duration="400">
                           <?php echo wp_kses_post( $title ); ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'title_image' ); ?>
                        </span>
                        </h1>
                        <p class="description" data-sal="slide-up" data-sal-duration="900" data-sal-delay="200">
                            <?php echo wp_kses_post( $description );?>
                        </p>
                        <div class="rbt-btn-group" data-sal="slide-up" data-sal-duration="400" data-sal-delay="200">
                        <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                            <a href="<?php echo esc_url( $btn_link ); ?>" class="rbt-btn rbt-btn-primary">
                                <?php echo esc_html($btn_title); ?>
                            </a>
                            <?php } ?>
                            <?php if (isset($btn_link_2) && !empty($btn_link_2)) { ?>
                            <a href="<?php echo esc_url( $btn_link_2 ); ?>" class="rbt-btn btn-primary-outline hover-effect-4"><?php echo esc_html($btn_title_2); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Service_List_Banner());
