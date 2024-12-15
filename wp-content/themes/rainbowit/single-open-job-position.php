<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

get_header();
// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_blog_sidebar_class =  !is_active_sidebar( 'sidebar-1' )  ? 'col-lg-10 offset-lg-1 col-md-12 col-12':'col-lg-8 col-md-12 col-12';
?>
<div class="rbt-section-bgCommon">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb text-center pt--175">
                    <div class="rbt-section-title">
                        <h2 class="title title-xl">
                            <?php the_title(); ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Start Blog Area  -->
    <div class="rainbowit-blog-area mt--120 mb--120">
        <div class="container">
            <div class="row row--40 justify-content-center">
                <div class="col-lg-8 col-md-8 col-xl-8 mb--25 jobs-post-single-content-area" >
                <?php 
                    while ( have_posts() ) :
                        the_post();
                        
                        $apply_link = get_field('apply_link', get_the_ID() );
                
                        the_content(); ?>

                        <div class="rbt-btn-group single-page-apply-link">
                            <a href="<?php echo esc_url( $apply_link);?>" class="rbt-btn rbt-btn-primary show-more">Apply Now</a>
                        </div>
                    <?php
                    endwhile; // End of the loop.
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area  -->
<?php
get_footer();