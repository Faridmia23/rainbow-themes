<?php

/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */

trait PostMeta
{
    // Post Meta
    public static function postmeta()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
?>
        <div class="author">

            <div class="info">
                <ul class="blog-meta">
                    <?php
                    if ($rainbowit_options['rainbowit_show_post_author_meta'] != 'no') { ?>
                        <li><i data-feather="user"></i><?php the_author(); ?></li>
                    <?php } ?>
                    <?php if ($rainbowit_options['rainbowit_show_post_publish_date_meta'] !== 'no') { ?>
                        <li><i data-feather="clock"></i><?php echo get_the_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <?php if ($rainbowit_options['rainbowit_show_post_updated_date_meta'] !== 'no') { ?>
                        <li><i data-feather="edit"></i><?php echo the_modified_time(get_option('date_format')); ?></li>
                    <?php } ?>
                    <?php if ($rainbowit_options['rainbowit_show_post_reading_time_meta'] !== 'no') { ?>
                        <li><i data-feather="watch"></i><?php echo rainbowit_content_estimated_reading_time(get_the_content()); ?></li>
                    <?php } ?>
                    <?php if ($rainbowit_options['rainbowit_show_post_comments_meta'] !== 'no') { ?>
                        <li class="single-post-meta-comment"><i data-feather="message-circle"></i><?php comments_popup_link(esc_html__('No Comments', 'rainbowit'), esc_html__('1 Comment', 'rainbowit'), esc_html__('% Comments', 'rainbowit'), 'post-comment', esc_html__('Comments off', 'rainbowit')); ?></li>
                    <?php } ?>
                    <?php if (($rainbowit_options['rainbowit_show_post_categories_meta'] !== 'no') && has_category()) { ?>
                        <li class="single-post-meta-categories"><i data-feather="folder"></i><?php the_category(' '); ?></li>
                    <?php } ?>
                    <?php if (($rainbowit_options['rainbowit_show_post_tags_meta'] !== 'no') && has_tag()) { ?>
                        <li class="single-post-meta-tag"><i data-feather="tag"></i><?php the_tags(' ', ' '); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php }


    // Single post meta
    public static function singlepostmeta()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
    ?>
        <?php
        if ($rainbowit_options['rainbowit_show_blog_details_author_meta'] != 'no') { ?>
            <div class="single-meta rbt-blog-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                <a href="<?php echo esc_url(get_the_author_link()); ?>" class="author-name"><?php the_author(); ?></a>
            </div>
        <?php } ?>
        <?php if ($rainbowit_options['rainbowit_show_blog_details_updated_date_meta'] !== 'no') { ?>
            <div class="single-meta">
                <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                <span><?php echo the_modified_time(get_option('date_format')); ?></span>
            </div>
        <?php } ?>
        <?php if ($rainbowit_options['rainbowit_show_blog_details_reading_time_meta'] !== 'no') { ?>
            <div class="single-meta">
                <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                <span><?php echo rainbowit_content_estimated_reading_time(get_the_content()); ?></span>
            </div>
        <?php } ?>
        <?php if ($rainbowit_options['rainbowit_show_blog_details_comments_meta'] !== 'no') { ?>
            <div class="single-meta">
                <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                <span><?php comments_popup_link(esc_html__('No Comments', 'rainbowit'), esc_html__('1 Comment', 'rainbowit'), esc_html__('% Comments', 'rainbowit'), 'post-comment', esc_html__('Comments off', 'rainbowit')); ?></span>
            </div>
        <?php } ?>
        <?php if (($rainbowit_options['rainbowit_show_blog_details_categories_meta'] !== 'no') && has_category()) { ?>
            <a href="#" class="rbt-btn rbt-btn-xm border-1 hover-effect-5"><?php the_category(','); ?></a>
        <?php } ?>

        <?php }

    public static function rainbowit_read_more()
    {
        $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
        if ($rainbowit_options['rainbowit_enable_readmore_btn'] !== 'no') { ?>
            <a class="btn-read-more" href="<?php the_permalink(); ?>"><span class="button-text"><?php echo esc_html($rainbowit_options['rainbowit_readmore_text'], 'rainbowit') ?></span><span class="button-icon"></span></a>
<?php }
    }
}
