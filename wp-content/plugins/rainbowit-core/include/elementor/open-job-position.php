<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Open_Job_Position extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-open-job-position';
    }

    public function get_title()
    {
        return esc_html__('Open Job Position', 'rainbowit');
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
        return ['job', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('JOb Section', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'btn_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('View Details', 'rainbowit'),
            ]
        );

        $this->add_control(
            'post_per_page',
            [
                'label' => esc_html__('Per Page', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('3', 'rainbowit'),
            ]
        );


        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings       = $this->get_settings_for_display();
        $heading_title  = $settings['heading_title'] ?? '';
        $sub_title      = $settings['sub_title'] ?? '';
        
        $post_per_page      = $settings['post_per_page'] ?? '';


        $args = array(
            'post_type'             => 'open-job-position',
            'post_status'           => 'publish',
            'order' => 'DESC',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $post_per_page,
        );

        $job_query = new \WP_Query($args);

?>

    <div class="rbt-section-gapTop">
        <div class="container">
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
            </div>

            <div class="row mt--40">
                <?php
                if ($job_query->have_posts()) {
                    while ($job_query->have_posts()) {
                        $job_query->the_post();
                        global $post;
                        if (class_exists('acf')) {
                            $address = get_field('address', $post->ID);
                            $job_status = get_field('job_status', $post->ID);
                            $job__expire_date = get_field('job__expire_date2', $post->ID);
                            $apply_link = get_field('apply_link', $post->ID);
                            $formatted_date = '';
                            if (!empty( $job__expire_date ) ) {
                                $timestamp = strtotime(str_replace('/', '-', $job__expire_date ) );
                            
                                if ($timestamp) {
                                    $formatted_date = date('F j, Y', $timestamp); 
                                } 

                                $current_time = time();
                            }

                        }

                        $apply_link = !empty( $apply_link ) ? $apply_link : get_the_permalink();

                        if( $job_status == 'enable' && empty( $settings['btn_title'] ) && ( $timestamp >= $current_time ) ) {
                            $btn_title      = $settings['btn_title'] ?? '';
                            $btn_disable_class = '';
                            $permalink = $apply_link;
                        }
                        else if( $job_status == 'enable' && !empty( $settings['btn_title'] ) && ( $timestamp >= $current_time ) ) {
                            $btn_title      = $settings['btn_title'] ?? '';
                            $btn_disable_class = '';
                            $permalink = $apply_link;
                        } else {
                            $btn_title      = 'Expired';
                            $btn_disable_class = 'apply-disable';
                            $permalink = '#';
                        }

                        $open_job = get_the_terms( $post->ID , 'open-job' );
                        $number_vacancies = get_the_terms( $post->ID , 'number-of-vacancies' );
                        

                    ?>
                        <!-- single card -->
                        <div class="col-12 col-md-6 col-lg-10 mx-auto mb--30" data-sal="slide-up" data-sal-duration="400">
                            <div class="rbt-career-card">
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-xl-6">
                                        <div class="card-left">
                                            <h5 class="title title-sm"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                            <div class="card-meta">
                                                <p class="single-meta">
                                                    <span><i class="fa-regular fa-briefcase"></i></span>
                                                    <?php 
                                                    foreach ( $open_job as $term ) {
                                                        echo $term->name;
                                                    }
                                                     ?>
                                                </p>
                                                <p class="single-meta">
                                                    <span><i class="fa-sharp fa-regular fa-location-dot"></i></span>
                                                    <?php echo esc_html($address); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 col-xl-3">
                                        <div class="card-middile">
                                            <h6 class="rbt-apply-deadline"><?php echo  $formatted_date; ?></h6>
                                            <span class="rbt-vacancy"><?php echo esc_html__("No of vacancies:", "rainbowit"); ?> 
                                            
                                            <?php 
                                            foreach ( $number_vacancies as $term ) {
                                                echo $term->name;
                                            }
                                             
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 col-xl-3">
                                        <div class="card-end apply-btn-class">
                                            <a href="<?php echo esc_url( $permalink ); ?>" class="rbt-btn btn-primary-outline hover-effect-1 <?php echo esc_attr($btn_disable_class);?>"><?php echo esc_html($btn_title ); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>

                            jQuery(document).ready(function($) {
                                // Function to check if button has apply-disable class and disable it
                                function checkAndDisable() {
                                    $('.apply-btn-class').each(function() {
                                        if ($(this).hasClass('apply-disable')) {
                                            $(this).prop('disabled', true);
                                        } else {
                                            $(this).prop('disabled', false);
                                        }
                                    });
                                }

                                // Initial check
                                checkAndDisable();

                                // Toggle button state
                                $('#toggle-btn').click(function() {
                                    $('.apply-btn-class').toggleClass('apply-disable');
                                    checkAndDisable();
                                });
                            });
                        </script>
                <?php

                    }
                    // reset original post data
                    wp_reset_postdata();
                } else {
                    // If no products found
                    echo 'No Jobs found';
                }
                ?>

            </div>
        </div>
    </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Open_Job_Position());
