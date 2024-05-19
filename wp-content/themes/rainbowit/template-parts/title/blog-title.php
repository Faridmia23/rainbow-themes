<?php
/**
 * Template part for displaying header page title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options      = Rainbowit_Helper::rainbowit_get_options();
$banner_layout          = Rainbowit_Helper::rainbowit_banner_layout();
$banner_area = $banner_layout['banner_area'];
$banner_title = rainbowit_get_acf_data("rainbowit_custom_title");
$banner_sub_title = rainbowit_get_acf_data("rainbowit_custom_sub_title");
$rainbowit_breadcrumbs_enable = rainbowit_get_acf_data("rainbowit_breadcrumbs_enable");

$page_breadcrumb = Rainbowit_Helper::rainbowit_page_breadcrumb();
$page_breadcrumb_enable = $page_breadcrumb['breadcrumbs'];


$default_banner_image = get_template_directory_uri() . "/assets/images/bg/bg-image-1.jpg";
$thumbnail_url  = '';

if (is_home() && get_option('page_for_posts') ) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full');
    if($img){
        $thumbnail_url  = $img[0];
    }
}

?>
<div class="rbt-section-bgCommon">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb text-center pt--175">
                    <div class="rbt-section-title">
                        <?php if ( is_archive() ): ?>
                            <h2 class="title title-xl"><?php the_archive_title(); ?></h2>
                        <?php elseif( is_search() ): ?>
                            <h2 class="title title-xl"><?php esc_html_e( 'Search results for: ', 'rainbowit' ) ?><?php echo get_search_query(); ?></h2>
                        <?php else: ?>
                            <h2 class="title title-xl">
                                <?php  if ( isset( $rainbowit_options['rainbowit_blog_text'] ) && !empty( $rainbowit_options['rainbowit_blog_text'] ) ){
                                    echo esc_html( $rainbowit_options['rainbowit_blog_text'] );
                                }
                                else{
                                    echo esc_html__('Latest Posts', 'rainbowit');
                                }  ?>
                            </h2>
                        <?php endif ?>
                        <?php
                        if(! is_home()){
                            rainbowit_breadcrumbs();
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>