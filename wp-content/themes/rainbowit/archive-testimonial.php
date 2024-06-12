<?php
get_header(); ?>

<div class="rbt-section-wrapper rbt-section-gapTop  " id="customer-success">
    <div class="container  ">
            <div class="rbt-layout">
                <?php

                if (have_posts()) :

                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        $marketplace_name  = '';
                        $rating_select     = '';
                        if (class_exists('acf')) {
                            $marketplace_name = get_field('marketplace_name', $post->ID);
                            $rating_select    = get_field('rating_select', $post->ID);
                        }
                ?>

                        <div class="rbt-layout-item" data-sal="slide-up" data-sal-duration="400">
                            <div class="rbt-review-card">
                                <h5 class="user"><?php the_title(); ?></h5>
                                <?php
                                if (!empty($post->post_excerpt)) { ?>
                                    <p class="opinion">
                                        <?php echo wp_trim_words(get_the_excerpt(), '400'); ?>
                                    </p>
                                <?php } else {
                                    the_content();
                                } ?>
                                <div class="marketplace">
                                    <?php echo get_the_post_thumbnail(); ?>
                                    <div class="market-name">
                                        <?php echo $marketplace_name; ?>
                                        <div class="review">
                                            <div class="rating">
                                                <?php
                                                $max_rating = 5;
                                                for ($count = 1; $count <= $max_rating; $count++) {
                                                    if ($count <= $rating_select) {
                                                ?>
                                                        <span class="rating-icon"><i class="fa-solid fa-star"></i></span>
                                                    <?php } else { ?>
                                                        <span class="rating-icon icon-xm ration-off"><i class="fa-solid fa-star"></i></span>
                                                <?php }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endwhile;
                   
                endif;
                ?>
            </div>
            <?php  rainbowit_blog_pagination(); ?>
        </div>
    </div>
<?php
get_footer(); ?>