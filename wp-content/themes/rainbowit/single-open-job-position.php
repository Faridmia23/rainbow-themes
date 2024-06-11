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
            <div class="row row--40">
                <h2 class="text-center"><?php echo esc_html__("The Job post expired..","rainbowit"); ?></h2>
            </div>
        </div>
    </div>
    <!-- End Blog Area  -->
<?php
get_footer();