<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Blog_Single_Content extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-blog-single-content';
    }

    public function get_title()
    {
        return esc_html__('Blog Single Content', 'rainbowit');
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
        return ['single', 'rainbowit'];
    }

    protected function register_controls()
    {




        $this->start_controls_section(
            '_single_overview',
            [
                'label' => esc_html__('Overview', 'rainbowit'),
            ]
        );
        $this->add_control(
            'overview_desc_1',
            [
                'label' => esc_html__('Description 1', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'overview_desc_2',
            [
                'label' => esc_html__('Description 2', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_single_coursecontent',
            [
                'label' => esc_html__('Coursecontent', 'rainbowit'),
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
            'coursecontent_desc_1',
            [
                'label' => esc_html__('Description 1', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'coursecontent_desc_2',
            [
                'label' => esc_html__('Description 2', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_single_details',
            [
                'label' => esc_html__('Details', 'rainbowit'),
            ]
        );
        $this->add_control(
            'single_image',
            [
                'label' => esc_html__('Single Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'single_title',
            [
                'label' => esc_html__('Single Title', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Elevate Your Design Concepts with Elementor-Based Container Variations Bring Your Vision to Life', 'rainbowit'),
            ]
        );
        
        $this->add_control(
            'descdetails',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
			'list_content',
			[
				'label' => esc_html__( 'Description', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Default description', 'rainbowit' ),
				'placeholder' => esc_html__( 'Type your description here', 'rainbowit' ),
			]
		);
        $this->add_control(
            'single_bottom_image',
            [
                'label' => esc_html__('Single Bottom Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_single_instructor',
            [
                'label' => esc_html__('Instructor', 'rainbowit'),
            ]
        );
        $this->add_control(
            'instructor_desc_1',
            [
                'label' => esc_html__('Description 1', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->add_control(
            'instructor_desc_2',
            [
                'label' => esc_html__('Description 2', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('single_image', 'src', $settings['single_image']['url']);
        $this->add_render_attribute('single_image', 'alt', Control_Media::get_image_alt($settings['single_image']));
        $this->add_render_attribute('single_image', 'title', Control_Media::get_image_title($settings['single_image']));
        $this->add_render_attribute('single_image', 'class', 'impower-icon');

        $single_image_id = $settings['single_image']['id'];

        $single_image_id_title = get_post_meta($single_image_id, '_wp_attachment_image_alt', true);

        // If title is not found, fallback to the post title
        if (empty($single_image_id_title)) {
            $single_image_id_title = get_the_title($single_image_id);
        }

        $heading_title = $settings['heading_title'] ?? '';
        $overview_desc_1 = $settings['overview_desc_1'] ?? '';
        $overview_desc_2 = $settings['overview_desc_2'] ?? '';
        $coursecontent_desc_1 = $settings['coursecontent_desc_1'] ?? '';
        $coursecontent_desc_2 = $settings['coursecontent_desc_2'] ?? '';
        $single_title = $settings['single_title'] ?? '';
        $descdetails = $settings['descdetails'] ?? '';
        $list_content = $settings['list_content'] ?? '';
        $instructor_desc_1 = $settings['instructor_desc_1'] ?? '';
        $instructor_desc_2 = $settings['instructor_desc_2'] ?? '';


        $single_bottom_image_id = $settings['single_bottom_image']['id'];

        $single_bottom_image_title = get_post_meta($single_bottom_image_id, '_wp_attachment_image_alt', true);

        // If title is not found, fallback to the post title
        if (empty($single_bottom_image_title)) {
            $single_bottom_image_title = get_the_title($single_bottom_image_id);
        }

?>


    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="rbt-scrollspy blog-details-wrapper" tabindex="0">
        <!-- single contect -->
        <div class="mb--40" id="overview">
            <p class="description">
                <?php echo wp_kses_post($overview_desc_1);?>
            </p>
            <p class="description">
                <?php echo wp_kses_post($overview_desc_2);?>
            </p>
        </div>

        <!-- single contect -->
        <div class="mb--40" id="coursecontent">
            <h4 class="title">
                <?php echo esc_html($heading_title );?>
            </h4>
            <p class="description">
                <?php echo wp_kses_post($coursecontent_desc_1);?>
            </p>
            <p class="description">
                <?php echo wp_kses_post($coursecontent_desc_2);?>
            </p>
        </div>

        <!-- single contect -->
        <div class="mb--40" id="details">
            <img class="mb--40" src="<?php echo esc_url($settings['single_image']['url']);?>" alt="<?php echo esc_attr($single_image_id_title); ?>">
            <h4 class="title">
            <?php echo esc_html($single_title );?>
            </h4>
            <p class="description">
                <?php echo wp_kses_post($descdetails );?>
            </p>
            <?php echo wp_kses_post($list_content);?>
            <img class="mt--25" src="<?php echo esc_url($settings['single_bottom_image']['url']);?>" alt="<?php echo esc_attr($single_bottom_image_title); ?>">
            
        </div>
        
        <!-- single contect -->
        <div  id="intructor">
            <p class="description">
               <?php echo wp_kses_post($instructor_desc_1);
               ?>
            </p>
            <p class="description">
            <?php echo wp_kses_post($instructor_desc_2);
               ?>
            </p>
        </div>
        
    </div>

<?php

    }
}

Plugin::instance()->widgets_manager->register(new Blog_Single_Content());
