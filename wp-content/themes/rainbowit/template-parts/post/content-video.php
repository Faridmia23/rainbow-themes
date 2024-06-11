<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$rainbowit_options          = Rainbowit_Helper::rainbowit_get_options();
$video_url                  = rainbowit_get_acf_data( "rainbowit_video_link" );
$rainbowit_blog_thumb       = is_active_sidebar( 'sidebar-1' ) ? 'rainbowit-thumbnail-lg':'rainbowit-thumbnail-single';
?>
<!-- Start Single Blog  -->
<div id="post-<?php the_ID(); ?>" <?php post_class('rainbowit-blog-list mt--50 mt_md--30 mt_sm--30 mt_lg--50'); ?>>
    <?php if(has_post_thumbnail()){ ?>
        <div class="thumbnail position-relative">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($rainbowit_blog_thumb, ['class' => 'w-100']) ?>
            </a>
            <?php if(!empty($video_url)){ ?>
                <div class="video-button position-to-top">
                    <a class="video-popup position-top-center size-large white-color" href="<?php the_permalink(); ?>"><span
                                class="triangle"></span></a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
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
