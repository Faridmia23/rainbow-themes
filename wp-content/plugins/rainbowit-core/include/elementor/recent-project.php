<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Recent_Project extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-recent-project-widget';
    }

    public function get_title()
    {
        return esc_html__('Recent Project', 'rainbowit');
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
            'description',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'project_title',
            [
                'label' => esc_html__('Project Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('General Electric', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'project_image',
            [
                'label' => esc_html__('Project Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

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

        $repeater->add_control(
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

        $repeater->add_control(
            'service_label_text',
            [
                'label' => esc_html__('Service Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('service', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'service_name',
            [
                'label' => esc_html__('Service Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Wordpress Development', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'website_label_text',
            [
                'label' => esc_html__('Website Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('service', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'website_name',
            [
                'label' => esc_html__('Website Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Labso.thyrocare.cloud', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'location_label_text',
            [
                'label' => esc_html__('Location Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Location', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'location_name',
            [
                'label' => esc_html__('Location Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Russia', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'flag_image',
            [
                'label' => esc_html__('Country Flag Image', 'rainbowit'),
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

        $settings            = $this->get_settings_for_display();
        $heading_title       = $settings['heading_title'] ?? '';
        $sub_title           = $settings['sub_title'] ?? '';
        $description         = $settings['description'] ?? '';
?>

        <div class="rbt-section-wrapper-6 rbt-section-gapTop rbt-section-gapBottom">
            <div class="container">
                <div class="rbt-section-title section-title-center mb--30" data-sal="slide-up" data-sal-duration="400">
                    <span class="subtitle text-white ps-4"><?php echo esc_html($sub_title); ?></span>
                    <<?php echo esc_html($settings['sec_title_tag']); ?> class="title text-white ps-4"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                    <div class="description description-light">
                        <?php echo wp_kses_post( $description ); ?>
                    </div>
                </div>
                <div class="row row--12">

                    <?php
                    if (!empty($settings['list'])) {
                        foreach ($settings['list'] as $item) {

                            $project_title           = $item['project_title'] ?? '';
                            $service_label_text      = $item['service_label_text'] ?? '';
                            $service_name            = $item['service_name'] ?? '';
                            $website_label_text      = $item['website_label_text'] ?? '';
                            $website_name            = $item['website_name'] ?? '';
                            $location_label_text     = $item['location_label_text'] ?? '';
                            $location_name           = $item['location_name'] ?? '';
                            $project_image           = $item['project_image']['url'];
                            $technology_image        = $item['technology_image']['url'];
                            $btn_link                = $item['btn_link']['url'];
                            $flag_image              = $item['flag_image']['url'];
                            $flag_image_id           = $item['flag_image']['id'];
                            $project_image_id        = $item['project_image']['id'];
                            $technology_image_id     = $item['technology_image']['id'];

                            $flag_image_title = get_post_meta( $flag_image_id, '_wp_attachment_image_alt', true);

                            if (empty($flag_image_title)) {
                                $flag_image_title = get_the_title( $flag_image_id );
                            }

                            $techonology_image_title = get_post_meta( $technology_image_id, '_wp_attachment_image_alt', true);

                            if (empty($techonology_image_title)) {
                                $techonology_image_title = get_the_title( $technology_image_id );
                            }

                            $project_image_title = get_post_meta( $project_image_id, '_wp_attachment_image_alt', true);

                            if (empty($project_image_title)) {
                                $project_image_title = get_the_title( $project_image_id );
                            }

                    ?>
                    <!-- single card -->
                    <div class="col-12 col-md-6 col-xl-4 mb--25" data-sal="slide-up" data-sal-duration="400">
                        <div class="rbt-card card-dark ">
                            <?php if( isset($project_image) && !empty($project_image)) { ?>
                            <img class="card-thumbnail" src="<?php echo esc_url( $project_image ); ?>" alt="<?php echo esc_attr($project_image_title); ?>">
                            <?php } ?>
                            <div class="rbt-card-body pt--25">
                                <div class="technology-icon">
                                    <img src="<?php echo esc_url( $technology_image ); ?>" alt="<?php echo esc_attr($techonology_image_title); ?>">
                                </div>
                                <a href="<?php echo esc_url( $btn_link ); ?>">
                                    <h5 class="title text-white mb-0 ps-4"><?php echo esc_html( $project_title); ?></h5>
                                </a>
                                <div class="card-meta">
                                    <div class="single-meta">
                                        <span class="meta-name"><i class="fa-regular fa-gear"></i><?php echo esc_html( $service_label_text); ?> <i class="fa-solid fa-colon"></i></span>
                                        <span class="meta-info"><?php echo esc_html( $service_name); ?></span>
                                    </div>
                                    <div class="single-meta">
                                        <span class="meta-name"><i class="fa-regular fa-globe"></i><?php echo esc_html( $website_label_text); ?> <i class="fa-solid fa-colon"></i></span>
                                        <a class="meta-info" href="#">
                                        <?php echo esc_html( $website_name); ?>
                                            <span><i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i></span>
                                        </a>
                                    </div>
                                    <div class="single-meta">
                                        <span class="meta-name"><i class="fa-regular fa-location-crosshairs"></i><?php echo esc_html( $location_label_text); ?> <i class="fa-solid fa-colon"></i></span>
                                        <span class="meta-info"><?php echo esc_html( $location_name); ?></span>
                                        <?php if( isset($flag_image) && !empty($flag_image)) { ?>
                                        <img class="flag" src="<?php echo esc_url( $flag_image ); ?>" alt="<?php echo esc_attr($flag_image_title); ?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
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

Plugin::instance()->widgets_manager->register(new Rainbowit_Recent_Project());
