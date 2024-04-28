<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_blog_thumb = ( is_active_sidebar( 'sidebar-1' ) && $rainbowit_options['rainbowit_blog_sidebar'] != 'no') ? 'rainbowit-thumbnail-lg':'rainbowit-thumbnail-single';
?>
<!-- Start Single Blog  -->
<div id="post-<?php the_ID(); ?>" <?php post_class('rainbowit-blog-list mt--50 mt_md--30 mt_sm--30 mt_lg--50'); ?>>
    <?php if(has_post_thumbnail()){ ?>
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail($rainbowit_blog_thumb, ['class' => 'w-100']) ?>
            </a>
        </div>
    <?php } ?>
    <div class="blog-content-wrapper">
        <div class="blog-top">
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </div>
        <div class="content">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>
<!-- End Single Blog  -->
