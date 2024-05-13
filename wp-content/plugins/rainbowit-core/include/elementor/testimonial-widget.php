<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Testimonial_Widget extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-testimonial-widget';
    }

    public function get_title()
    {
        return esc_html__('Testimonial Widget', 'rainbowit');
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
        return ['testimonial', 'rainbowit'];
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
            'extra_class',
            [
                'label' => esc_html__('Extra Class', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );
        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section Id Name', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('customer-success', 'rainbowit'),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Custom web services we are offering', 'rainbowit'),
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
                'default' => esc_html__('View Details', 'rainbowit'),
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'rating_image',
            [
                'label' => esc_html__('Rating Image', 'rainbowit'),
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
        $sub_title = $settings['sub_title'] ?? '';

        $btn_title      = $settings['btn_title'] ?? '';
        $desc           = $settings['desc'] ?? '';
        $extra_class    = $settings['extra_class'] ?? '';
        $section_id    = $settings['section_id'] ?? '';

        if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}

        $args = array(
            'post_type'             => 'testimonial',
            'post_status'           => 'publish',
            'order' => 'DESC',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => -1,
        );

        $testimonial_query = new \WP_Query($args);

?>

    <div class="rbt-section-wrapper rbt-section-gapTop rbt-section-shadow <?php echo esc_attr( $extra_class ); ?>" id="<?php echo esc_attr( $section_id ); ?>">
        <div class="container position-relative ">
            <div class="rbt-section-title section-title-center mb--40" data-sal="slide-up" data-sal-duration="400">
                <div class="section-title-img">
                    <?php
                    if (!empty($settings['list'])) {
                        foreach ($settings['list'] as $item) {

                            $this->add_render_attribute('rating_image', 'src', $item['rating_image']['url']);
                            $this->add_render_attribute('rating_image', 'alt', Control_Media::get_image_alt($item['rating_image']));
                            $this->add_render_attribute('rating_image', 'title', Control_Media::get_image_title($item['rating_image']));
                            $this->add_render_attribute('rating_image', 'class', 'impower-icon');

                    ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'full', 'rating_image'); ?>
                    <?php
                        }
                    } ?>
                </div>
                <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                <h3 class="title"><?php echo esc_html($heading_title); ?></h3>
                <p class="description">
                    <?php echo wp_kses_post($desc); ?>
                </p>
            </div>
            <div class="rbt-layout">
                <!-- review 1 -->
                <?php
                if ($testimonial_query->have_posts()) {
                    while ($testimonial_query->have_posts()) {
                        $testimonial_query->the_post();
                        global $post;
                        $marketplace_name  = '';
                        $rating_select     = '';
                        if (class_exists('acf')) {
                            $marketplace_name = get_field('marketplace_name', $post->ID);
                            $rating_select    = get_field('rating_select', $post->ID );
                        }

                ?>
                        <div class="rbt-layout-item" data-sal="slide-up" data-sal-duration="400">
                            <div class="rbt-review-card">
                                <h5 class="user"><?php the_title(); ?></h5>
                                <p class="opinion">
                                    <?php echo wp_trim_words(get_the_excerpt(), '400'); ?>
                                </p>
                                <div class="marketplace">
                                    <?php echo get_the_post_thumbnail(); ?>
                                    <div class="market-name">
                                        <?php echo $marketplace_name; ?>
                                        <div class="review">
                                            <div class="rating">
                                                <?php
                                                $max_rating = 5;
                                                for ($count = 1; $count <= $max_rating; $count++) {
                                                    if ($count <= $rating_select) {
                                                ?>
                                                        <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <?php } else { ?>
                                                        <span class="rating-icon icon-xm ration-off"><i class="fa-solid fa-star"></i></span>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php

                    }
                    // reset original post data
                    wp_reset_postdata();
                } else {
                    // If no products found
                    echo 'No Testimonial found';
                }
                ?>
            </div>
            <div class="rbt-btn-group btn-position-abosolute z-3 ">
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="rbt-btn rbt-btn-primary show-more"><?php echo esc_html($btn_title); ?></a>
            </div>
        </div>
    </div>

<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Testimonial_Widget());
