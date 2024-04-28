<?php
/**
 * The template for displaying archive for portfolio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rainbowit
 */

get_header();
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_portfolio_sidebar_class = ($rainbowit_options['rainbowit_project_archive_sidebar'] === 'no') || !is_active_sidebar('sidebar-1') ? 'col-lg-12 inbio-post-wrapper' : 'col-lg-8 inbio-post-wrapper';
?>
    <div class="rainbowit-portfolio-area mt--90 mb--120">
        <div class="container">
            <div class="row row--40">
                <?php if (is_active_sidebar('sidebar-1') && $rainbowit_options['rainbowit_project_archive_sidebar'] == 'left') { ?>
                    <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                        <aside class="rainbowit-sidebar-area">
                            <?php dynamic_sidebar(); ?>
                        </aside>
                    </div>
                <?php } ?>

                <div class="<?php echo esc_attr($rainbowit_portfolio_sidebar_class); ?>">
                    <div class="project-archive-wrapper">
                        <div class="row">
                            <?php if ( have_posts() ) : ?>
                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :
                                    the_post();

                                    /*
                                     * Include the Post-Type-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/portfolio' );

                                endwhile;

                                echo '<div class="col-12">';
                                rainbowit_blog_pagination();
                                echo '</div>';

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif;
                            ?>

                        </div>
                    </div>
                </div>

                <?php if (is_active_sidebar('sidebar-1') && $rainbowit_options['rainbowit_project_archive_sidebar'] == 'right') { ?>
                    <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                        <aside class="rainbowit-sidebar-area">
                            <?php dynamic_sidebar(); ?>
                        </aside>
                    </div>
                <?php } ?>



            </div>
        </div>
    </div>
<?php
get_footer();