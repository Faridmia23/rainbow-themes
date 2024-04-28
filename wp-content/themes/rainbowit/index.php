<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

get_header();
// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();

$blog_bottom_template_id = ($rainbowit_options['blog_bottom_template_id']) ? $rainbowit_options['blog_bottom_template_id'] : '';
$blog_bottom_client_template_id = ($rainbowit_options['blog_bottom_client_template_id']) ? $rainbowit_options['blog_bottom_client_template_id'] : '';

?>

<div class="rbt-section-wrapper mt_dec--190">
    <div class="container">
        <div class="row row--12 row-gap-5">
            <?php
            if (have_posts()) :

                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */
                    get_template_part('template-parts/post/content', get_post_format());

                endwhile;
            else :

                get_template_part('template-parts/post/content', 'none');

            endif;
            ?>
        </div>
        <?php

        if (class_exists("\\Elementor\\Plugin")) {
            $pluginElementor = \Elementor\Plugin::instance();
            $contentElementor = $pluginElementor->frontend->get_builder_content($blog_bottom_template_id);

            echo do_shortcode($contentElementor);
        }
        ?>

    </div>
</div>
<?php
    if (class_exists("\\Elementor\\Plugin")) {
        $pluginElementor = \Elementor\Plugin::instance();
        $contentElementor2 = $pluginElementor->frontend->get_builder_content($blog_bottom_client_template_id);

        echo do_shortcode($contentElementor2);
    }
    ?>
<?php
get_footer();

?>