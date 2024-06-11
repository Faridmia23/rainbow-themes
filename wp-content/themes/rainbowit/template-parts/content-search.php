<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$rbt_options            = Rainbowit_Helper::rainbowit_get_options();
$rainbowit_blog_thumb   = is_active_sidebar( 'sidebar-1' ) ? 'rainbowit-thumbnail-lg':'rainbowit-thumbnail-single';
$readmore_btn           = isset( $rbt_options['rainbowit_enable_readmore_btn'] ) ? $rbt_options['rainbowit_enable_readmore_btn'] : 'no';
$post_author_meta       = isset( $rbt_options['rainbowit_show_post_author_meta'] ) ? $rbt_options['rainbowit_show_post_author_meta'] : 'no';
$readmore_text          = isset( $rbt_options['rainbowit_readmore_text'] ) ? $rbt_options['rainbowit_readmore_text'] : '';
$post_categories        = get_the_category();

?>

 <!-- single card -->
<div  <?php post_class('col-12 col-md-6'); ?> id="post-<?php the_ID(); ?>">
    <div class="rbt-card-6 p-5">
    <?php if(has_post_thumbnail()){ ?>
        <div class="card-thumbnail">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($rainbowit_blog_thumb, ['class' => 'w-100']) ?></a>
            <?php 
            if ( $post_categories ) {
                $current_category = $post_categories[0];
                $category_name = $current_category->name;
                $category_link = get_category_link( $current_category->term_id );
                if( 'Uncategorized' != $category_name ) { 
                ?>
            <a href="<?php echo esc_url($category_link ); ?>" class="inspired-badge rbt-btn rbt-btn-white rbt-btn-xm hover-effect-5"><?php echo esc_html( $category_name ); ?></a>
            <?php  } } ?>
        </div>
        <?php } ?>
        <div class="card-body">
            <div class="blog-card-meta">
                <?php if($post_author_meta == 'yes') { ?>
                <a href="<?php echo esc_url(get_the_author_link()); ?>">
                    <div class="single-meta rbt-blog-author">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 32 ); ?>
                        <span class="author-name"><?php echo ucwords(get_the_author());?></span>
                    </div>
                </a>
                <?php } ?>
                <div class="single-meta">
                    <span class="icon d-none d-md-block"><i class="fa-sharp fa-regular fa-circle"></i></span>
                    <span><?php the_time( get_option('date_format') ); ?></span>
                </div>
            </div>
            <h3 class="title title-sm">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <p class="description">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </p>
            <?php if($readmore_btn == 'yes') { ?>
            <a href="<?php the_permalink(); ?>" class="rbt-btn rbt-btn-round btn-primary-outline mt--25 hover-effect-1">
                <?php echo esc_html($readmore_text);?>
                <span><i class="fa-solid fa-arrow-up-right"></i></span>
            </a>
            <?php } ?>
        </div>
    </div>
</div>