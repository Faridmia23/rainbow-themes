<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Gallery_Portfolio extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-gallery-portfolio';
    }

    public function get_title()
    {
        return esc_html__('Gallery Portfolio', 'rainbowit');
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
        return ['gallery', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Portfolio Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'title_logo',
            [
                'label' => esc_html__('Title Logo', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();
       
        $repeater->add_control(
            'portfolio_image',
            [
                'label' => esc_html__('Portfolio Image', 'rainbowit'),
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
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();
        $heading_title = $settings['heading_title'] ?? '';

?>

<div class="rbt-theme-gallery rbt-section-gapBottom rbt-section-gapTop scroll-view-section rbt-theme-gallery-custom" data-scrollTextColor="#fff">
    <div class="container">
        <div class="rbt-masonary-wrapper">
            <div class="rbt-section-title rbt-sticky-section" data-sal="slide-up" data-sal-duration="400">
                <?php 
                if( isset( $settings['title_logo']['url'] ) && !empty( $settings['title_logo']['url'] ) ) { ?>
                <img class="rbt-icon" src="<?php echo esc_url( $settings['title_logo']['url'] ); ?>" alt="Rainbow theme logo icon">
                <?php } ?>
                <h3 class="title sticky-title mb--0"><?php echo esc_html( $heading_title ); ?></h3>
            </div>
            <div class="row row--20 rbt-theme-masonary">
            <?php
                if ( !empty( $settings['list'] ) ) {
                    foreach ( $settings['list'] as $item ) {

                        $portfolio_image_id = $item['portfolio_image']['id'];

                        $portfolio_image_title = get_post_meta($portfolio_image_id, '_wp_attachment_image_alt', true);

                        // If title is not found, fallback to the post title
                        if (empty($portfolio_image_title)) {
                            $portfolio_image_title = get_the_title($portfolio_image_id);
                        }

                    ?>
                    <div class="col-12 col-md-6 col-lg-4 rbt-masonary-item mb--40" data-sal="slide-up" data-sal-duration="400">
                        <img class="theme-gallery-img" src="<?php echo esc_url( $item['portfolio_image']['url'] ); ?>" alt="<?php echo esc_attr( $portfolio_image_title); ?>">
                    </div>
                    <?php
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</div>     
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Gallery_Portfolio());