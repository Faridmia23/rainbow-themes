<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$images                                  = rainbowit_get_acf_data('rainbowit_gallery_image');
$audio_url                               = rainbowit_get_acf_data("rainbowit_upload_audio");
$custom_link                             = rainbowit_get_acf_data('rainbowit_custom_link');
$link                                    = !empty($custom_link) ? $custom_link : get_the_permalink();
$rainbowit_quote_author_name             = rainbowit_get_acf_data('rainbowit_quote_author_name');
$rainbowit_quote_author                  = !empty($rainbowit_quote_author_name) ? $rainbowit_quote_author_name : get_the_author();
$rainbowit_quote_author_name_designation = rainbowit_get_acf_data('rainbowit_quote_author_name_designation');
$video_url                               = rainbowit_get_acf_data("rainbowit_video_link");
$page_breadcrumb                         = Rainbowit_Helper::rainbowit_page_breadcrumb();
$page_breadcrumb_enable                  = $page_breadcrumb['breadcrumbs'];
$featured_img_url                        = get_the_post_thumbnail_url(get_the_ID(), 'full');

if (has_post_thumbnail()) {
    $style = 'style="background-image: url(' . $featured_img_url . ')"';
} else {
    $style = '';
}

$rainbowit_options              = Rainbowit_Helper::rainbowit_get_options();
$blog_bottom_client_template_id = isset( $rainbowit_options['blog_bottom_client_template_id']) ? $rainbowit_options['blog_bottom_client_template_id'] : '';
$social_share_on_off = isset( $rainbowit_options['rainbowit_show_blog_details_social_share_on_off']) ? $rainbowit_options['rainbowit_show_blog_details_social_share_on_off'] : '';

?>

<div <?php post_class('rbt-section-wrapper single-blog-wrapper'); ?> id="post-<?php the_ID(); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto px-4">
                <div class="blog-detail-breadcrumb">
                    <?php
                    rainbowit_breadcrumbs();
                    ?>
                </div>
                <h2 class="title">
                    <?php the_title(); ?>
                </h2>
                <div class="blog-card-meta mt--25 mb--25">
                    <?php Rainbowit_Helper::singlepostmeta(); ?>
                </div>
                <p class="description">
                    <?php echo wp_trim_words(get_the_excerpt(), 100); ?>
                </p>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <!-- blog banner image -->
                <div class="col-12 col-md-10 mx-auto blog-single-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="rbt-section-wrapper pt--40  rbt-section-gap2Bottom rbt-blogs-details">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 col-xxl-2">
               <div class="rbt-sidebar sticky-top">
               <?php 
                        $rainbowit_tab_title_group = get_post_meta(get_the_ID() , 'rainbowit_tab_title_group', true);
                    if( is_array($rainbowit_tab_title_group) || is_object($rainbowit_tab_title_group)) {
                    ?>
                <nav class="rbt-onepagenav">
                    <h6 class="sidebar-title">
                        <span><?php echo esc_html__("Table of Contents","rainbowit");?></span>
                        <button class="close-btn"><i class="fa-regular fa-xmark"></i></button>
                    </h6>

                    <?php 
                        $rainbowit_tab_title_group = get_post_meta(get_the_ID() , 'rainbowit_tab_title_group', true);
                        
                        $accitem = array();
                        if( is_array( $rainbowit_tab_title_group) || is_object($rainbowit_tab_title_group)) {
                            foreach(  $rainbowit_tab_title_group as $key => $values ) { 

                                $accitem[] =  $values;
                            } 
                        }

                        ?>
                    <ul class="list-style-type h--325 overflow-auto">
                        <?php foreach( $accitem as $key => $value ) { 
                            $active = '';
                            if( $key == 0 ) {
                                $active = 'current';
                            }
                            $tab_title = $value['rainbowit_tab_title'];
                            $rainbowit_tab_id = $value['rainbowit_tab_id'];
                            ?>
                        <li class="<?php echo $active ; ?>">
                            <a href="#<?php echo $rainbowit_tab_id;?>"><?php echo $tab_title;?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <?php } ?>
                <?php if( $social_share_on_off == 'yes') { ?>
                <?php rbt_sharing_icon_links();?>
                <?php } ?>
                </div> 
            </div>
            <div class="col-12 col-lg-8 col-xxl-8 ">
                <div class="rainbowit-single-content-part">
                <?php the_content(); ?>
                <?php wp_link_pages( array(
                    'before'      => '<div class="rn-pagination justify-content-center"><span class="page-link-holder">' . esc_html__( 'Pages:', 'rainbowit' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
                ?>
            </div>
            <?php
                /**
                 *  Output comments wrapper if it's a post, or if comments are open,
                 * or if there's a comment number – and check for password.
                 * */
                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                ?>

                    <div class="comments-wrapper section-inner">

                        <?php comments_template(); ?>

                    </div><!-- .comments-wrapper -->

                <?php
            }
            ?>
            </div>
            <?php if (is_active_sidebar('blog-single-right-sidebar')) { ?>
            <div class="col-12 col-xxl-2 d-xl-none d-xxl-block">
                <div class="rbt-sidebar sticky-top">
                    <?php dynamic_sidebar('blog-single-right-sidebar'); ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
global $post;
$related = new WP_Query(
    array(
        'category__in'   => wp_get_post_categories($post->ID),
        'posts_per_page' => 5,
        'post__not_in'   => array($post->ID)
    )
);


$post_categories        = get_the_category();
$readmore_btn           = isset( $rainbowit_options['rainbowit_enable_readmore_btn'] ) ? $rainbowit_options['rainbowit_enable_readmore_btn'] : 'no';
$post_author_meta       = isset( $rainbowit_options['rainbowit_show_post_author_meta'] ) ? $rainbowit_options['rainbowit_show_post_author_meta'] : 'no';
$readmore_text          = isset( $rainbowit_options['rainbowit_readmore_text'] ) ? $rainbowit_options['rainbowit_readmore_text'] : '';
$related_post_subtitle  = isset( $rainbowit_options['rainbowit_related_post_subtitle'] ) ? $rainbowit_options['rainbowit_related_post_subtitle'] : '';
$related_post_title     = isset( $rainbowit_options['rainbowit_related_post_title'] ) ? $rainbowit_options['rainbowit_related_post_title'] : '';
$related_post_desc      = isset( $rainbowit_options['rainbowit_related_post_desc'] ) ? $rainbowit_options['rainbowit_related_post_desc'] : '';


if ($related->have_posts()) {  ?>
    <div class="rbt-section-wrapper-4 rbt-section-gapTop rbt-section-gapBottom">
        <div class="container">
            <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
                <span class="subtitle"><?php echo esc_html($related_post_subtitle);?></span>
                <h3 class="title"><?php echo esc_html($related_post_title);?></h3>
                <p class="description">
                <?php echo esc_html($related_post_desc);?>
                </p>
            </div>

            <div class="row row--12 mt--40">
                <?php
                while ($related->have_posts()) {
                    $related->the_post();
                ?>
                    <!-- single blog -->
                    <div class="col-12 col-md-6 col-xl-4 mb--25 rbt-tab-item-2 finance" >
                        <div class="rbt-card-6 p-5 ">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="card-thumbnail">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                    <?php
                                    if ($post_categories) {
                                        $current_category = $post_categories[0];
                                        $category_name = $current_category->name;
                                        $category_link = get_category_link($current_category->term_id);
                                        if ('Uncategorized' != $category_name) {
                                    ?>
                                            <a href="<?php echo esc_url($category_link); ?>" class="inspired-badge rbt-btn rbt-btn-white rbt-btn-xm hover-effect-5"><?php echo esc_html($category_name); ?></a>
                                    <?php  }
                                    } ?>
                                </div>
                            <?php } ?>
                            <div class="card-body">
                                <div class="blog-card-meta">
                                    <?php if ($post_author_meta == 'yes') { ?>
                                        <a href="<?php echo esc_url(get_the_author_link()); ?>">
                                            <div class="single-meta rbt-blog-author">
                                                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                                <span class="author-name"><?php echo ucwords(get_the_author()); ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                    <div class="single-meta">
                                        <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                                        <span><?php the_time(get_option('date_format')); ?></span>
                                    </div>
                                </div>
                                <h3 class="title title-sm">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </p>
                                <?php if ($readmore_btn == 'yes') { ?>
                                    <a href="<?php the_permalink(); ?>" class="rbt-btn rbt-btn-round btn-primary-outline hover-effect-1">
                                        <?php echo esc_html($readmore_text); ?>
                                        <span><i class="fa-solid fa-arrow-up-right"></i></span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
<?php
}

if (class_exists("\\Elementor\\Plugin")) {
    $pluginElementor = \Elementor\Plugin::instance();
    $contentElementor2 = $pluginElementor->frontend->get_builder_content($blog_bottom_client_template_id);

    echo do_shortcode($contentElementor2);
}
?>