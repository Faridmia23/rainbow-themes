<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package rainbowit
 */

get_header();
// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_blog_sidebar_class = !is_active_sidebar('sidebar-1')  ? 'col-lg-10 offset-lg-1 col-md-12 col-12' : 'col-lg-8 col-md-12 col-12';
?>
<!-- End Blog Area  -->
<div class="rbt-section-wrapper mt_dec--190 blog-search-page">
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
                    get_template_part('template-parts/content', 'search');

                endwhile;
            else :

                get_template_part('template-parts/post/content', 'none');

            endif;
            ?>
        </div>
    </div>
</div>
<?php
get_footer();