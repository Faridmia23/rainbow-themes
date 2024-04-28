<?php
/**
 * Template part for displaying header portfolio title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$bg_image_class = has_post_thumbnail() ? '' : 'bg_image--4';
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="breadcrumb-area breadcarumb-style-1 ptb--120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h1 class="title theme-gradient h2"><?php the_title(); ?></h1>
                    <?php
                    if('excerpt' == $rainbowit_options['select_title_bellow_content']){ ?>
                        <?php the_excerpt(); ?>
                    <?php } elseif('breadcrumbs' == $rainbowit_options['select_title_bellow_content']) {
                        rainbowit_breadcrumbs();
                    } elseif('both' == $rainbowit_options['select_title_bellow_content']) {
                        the_excerpt();
                        ?>
                        <hr class="mt--20"><?php
                        rainbowit_breadcrumbs();
                    } else {
                        // Nothing
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
