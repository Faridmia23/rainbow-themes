<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$images = rainbowit_get_acf_data('rainbowit_gallery_image');
$rainbowit_blog_thumb = ( is_active_sidebar( 'sidebar-1' ) && $rainbowit_options['rainbowit_blog_sidebar'] != 'no') ? 'rainbowit-thumbnail-lg':'rainbowit-thumbnail-single';
?>
<!-- Start Single Blog  -->
<div id="post-<?php the_ID(); ?>" <?php post_class('rainbowit-blog-list gallery-post mt--50 mt_md--30 mt_sm--30 mt_lg--50'); ?>>
    <?php
    if( $images ): ?>
        <div class="thumbnail rainbowit-slick-active rainbowit-carousel-gallery slick-dot-bottom slick-arrow-left-to-right rainbow-slick-arrow  rainbow-slick-dot ">
            <?php foreach( $images as $image ): ?>
                <div class="thumb-inner">
                    <a href="<?php the_permalink(); ?>">
                        <img class="w-100"  src="<?php echo esc_url($image['sizes'][$rainbowit_blog_thumb]); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="blog-content-wrapper">
        <div class="blog-top">
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php Rainbowit_Helper::postmeta(); ?>
        </div>
        <div class="content">
            <?php the_excerpt(); ?>
            <?php Rainbowit_Helper::rainbowit_read_more(); ?>
        </div>
    </div>
</div>
<!-- End Single Blog  -->