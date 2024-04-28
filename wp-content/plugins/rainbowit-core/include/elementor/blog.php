<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class rainbowit_Elementor_Widget_Blog extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-top-categories-blog';
    }

    public function get_title()
    {
        return esc_html__('Top Categories Blog', 'rainbowit');
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
        return ['blog', 'news', 'post', 'rainbowit'];
    }

    protected function register_controls()
    {




        // layout Panel
        $this->start_controls_section(
            'rainbowit_blog',
            [
                'label' => esc_html__('Blog - Layout', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Top Categories', 'rainbowit'),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('-1', 'rainbowit'),
            ]
        );


        
        $this->add_control(
            'blog_filter',
            [
                'label'        => esc_html__('Filter ?', 'rainbowit'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'rainbowit'),
                'label_off'    => esc_html__('No', 'rainbowit'),
                'return_value' => 'yes',
                'separator'    => 'before',
                'default'      => 'no',


            ]
        );
        $this->add_control(
            'blog_filter_all_button_label',
            [
                'label' => esc_html__('All Button Label', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All', 'rainbowit'),
                'placeholder' => esc_html__('Type all project button label here', 'rainbowit'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'blog_thumb_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'default' => 'rainbowit-thumbnail-single',
            ]
        );

        $this->add_control(
            'rainbowit_blog_category',
            [
                'label' => esc_html__('Category', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'rainbowit_blog_button',
            [
                'label' => esc_html__('Button', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'rainbowit_blog_date',
            [
                'label' => esc_html__('Date', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'rainbowit_blog_pagination',
            [
                'label' => esc_html__('Pagination', 'rainbowit'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rainbowit'),
                'label_off' => esc_html__('Hide', 'rainbowit'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Columns Panel
        $this->rbt_columns('blog_columns', 'Blog - Columns', '4', '6', '6', '12');
        // Style Component
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        // Check if the rainbowit_Helper class exists
        if (class_exists('Rainbowit_Helper')) {
            $rainbowit_Helper = new \Rainbowit_Helper();
            $rainbowit_options = $rainbowit_Helper->rainbowit_get_options();
        } else {
            // Handle the case where the class doesn't exist
            return;
        }


        /**
         * Setup the post arguments.
         */
        $query_args = RBT_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);

        $this->add_render_attribute('rainbowit-blog', 'class', 'rn-blog-area rn-section-gap bg_color--1');
        $this->add_render_attribute('rainbowit-blog', 'id', 'rainbowit-blog-' . esc_attr($this->get_id()));
        $post_author_meta = ($rainbowit_options['rainbowit_show_post_author_meta']) ? $rainbowit_options['rainbowit_show_post_author_meta'] : 'no';

        $blog_filter = $settings['blog_filter'];
        $heading_title = $settings['heading_title'];

?>

        <div class="row row--12 mt--95">
            <div class="container">
                <span class="subtitle d-block mb--15 fw-bold"><?php echo $heading_title; ?></span>
                <!-- tabs -->
                <?php
                $category_list = '';
                if (!empty($settings['category'])) {
                    $category_list = implode(" ", $settings['category']);
                }
                $category_list_value = explode(" ", $category_list);


                if ($blog_filter == 'yes') {
                ?>
                    <?php if ($category_list_value && !is_wp_error($category_list_value)) : ?>
                        <div class="rbt-tabs-wrapper justify-content-between">
                            <ul class="rbt-tabs tabs-3">
                                <?php if (!empty($settings['blog_filter_all_button_label'])) {
                                    $active = 'active';

                                ?>
                                    <li class="rbt-tab-link3 <?php echo esc_attr($active); ?>" data-filter2="*">
                                        <button class="filter-btn"><?php echo esc_html($settings['blog_filter_all_button_label']); ?></button>
                                    </li>
                                <?php } ?>
                                <?php if (!empty($settings['category'])) {
                                    $i = 1;
                                    foreach ($category_list_value as $category) {
                                        $categoryName = get_term_by('slug', $category, 'category');

                                        $active = '';
                                        if (empty($settings['blog_filter_all_button_label']) && $i == 1) {
                                            $active = 'active';
                                        }
                                        ?>

                                            <li class="rbt-tab-link3 <?php echo esc_attr($active); ?>" data-filter2=".<?php echo esc_attr($category); ?>">
                                                <button class="filter-btn"><?php echo esc_html($categoryName->name); ?></button>
                                            </li>
                                            <?php }
                                        $i++;
                                  
                                } else {
                                    $terms = get_terms(array(
                                        'taxonomy' => 'category',
                                        'hide_empty' => true,
                                    ));
                                    if ($terms && !is_wp_error($terms)) {
                                        $m = 1;
                                        foreach ($terms as $term) {
                                            if (empty($settings['blog_filter_all_button_label']) && $m == 1) {
                                                $active = 'active';
                                            }
                                            ?>

                                                <li class="rbt-tab-link3" data-filter2=".<?php echo esc_attr($term->slug); ?>">
                                                    <button class="filter-btn"><?php echo esc_html($term->name); ?></button>
                                                </li>
                                <?php
                                            
                                            $m++;
                                        }
                                    }
                                } ?>

                            </ul>
                        </div>
                        <!-- tab content -->
                <?php endif;
                } ?>

                <?php if ($query->have_posts()) { ?>
                    <div class="row row--12 rbt-tabs-active-2">
                        <?php while ($query->have_posts()) {
                            $query->the_post();
                            global $post;
                            $terms = get_the_terms($post->ID, 'category');

                            if ($terms && !is_wp_error($terms)) {
                                $termsList = array();
                                foreach ($terms as $category) {
                                    $termsList[] = $category->slug;
                                }
                                $termsAssignedCat = join(" ", $termsList);
                            } else {
                                $termsAssignedCat = '';
                            }

                        ?>
                            <!-- single blog -->
                            <div class="col-md-<?php echo esc_attr($settings['rbt_blog_columns_for_laptop']); ?> col-sm-<?php echo esc_attr($settings['rbt_blog_columns_for_tablet']); ?> col-<?php echo esc_attr($settings['rbt_blog_columns_for_mobile']); ?> col-xl-<?php echo esc_attr($settings['rbt_blog_columns_for_desktop']); ?> mb--25 rbt-tab-item-2 <?php echo esc_attr($termsAssignedCat); ?>">
                                <div class="rbt-card-6 pt--25 pb--25 ">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="card-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_the_post_thumbnail($post->ID, $settings['blog_thumb_size_size']); ?>
                                            </a>
                                            <?php if ($settings['rainbowit_blog_category'] == 'yes') { ?>
                                                <?php if ($terms && !is_wp_error($terms)) : ?>
                                                    <?php foreach ($terms as $term) { ?>
                                                        <?php if ('uncategorized' != strtolower($term->name)) { ?>
                                                            <a href="<?php echo get_category_link($term->term_id); ?>" class="inspired-badge rbt-btn rbt-btn-white rbt-btn-xm hover-effect-5"><?php echo esc_html($term->name); ?></a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php endif ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body">
                                        <div class="blog-card-meta">
                                            <?php if ($post_author_meta == 'yes') { ?>
                                                <a href="<?php echo esc_url(get_the_author_link()); ?>">
                                                    <div class="single-meta rbt-blog-author">
                                                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                                        <span class="author-name"><?php echo ucwords(get_the_author()); ?></span>
                                                    </div>
                                                </a>
                                            <?php } ?>
                                            <?php if (!empty($settings['rainbowit_blog_date'])) : ?>
                                                <?php if ($settings['rainbowit_blog_date'] == 'yes') { ?>
                                                    <div class="single-meta">
                                                        <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                                                        <span><?php the_time(get_option('date_format')); ?></span>
                                                    </div>
                                                <?php } ?>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="title title-sm">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <p class="description">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                        </p>
                                        <?php if ($rainbowit_options['rainbowit_enable_readmore_btn'] == 'yes') { ?>
                                            <?php if ($settings['rainbowit_blog_button'] == 'yes') { ?>
                                                <a href="<?php the_permalink(); ?>" class="rbt-btn rbt-btn-round btn-primary-outline mt--25 hover-effect-1">
                                                    <?php echo esc_html($rainbowit_options['rainbowit_readmore_text']); ?>
                                                    <span><i class="fa-solid fa-arrow-up-right"></i></span>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>
                <?php if ($settings['rainbowit_blog_pagination'] == 'yes' && '-1' != $settings['posts_per_page']) { ?>
                    <!-- pagination -->
                    <div class="rbt-pagination mt--10 custom-blog-pagination">
                        <div class="rbt-pagination-group justify-content-center">
                            <div class="pagination-wrapper-custom">
                            <?php
                            $big = 999999999; // need an unlikely integer

                            if (get_query_var('paged')) {
                                $paged = get_query_var('paged');
                            } else if (get_query_var('page')) {
                                $paged = get_query_var('page');
                            } else {
                                $paged = 1;
                            }

                            echo paginate_links(array(
                                'base'       => str_replace($big, '%#%', get_pagenum_link($big)),
                                'format'     => '?paged=%#%',
                                'current'    => $paged,
                                'total'      => $query->max_num_pages,
                                'type'       => 'page-numbers',
                                'prev_text'  => '<i class="fa-solid fa-chevron-left"></i>',
                                'next_text'  => '<i class="fa-solid fa-chevron-right"></i>',
                                'show_all'   => false,
                                'end_size'   => 1,
                                'mid_size'   => 4,
                            ));
                            ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new rainbowit_Elementor_Widget_Blog());
