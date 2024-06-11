<?php
  /*
   * Template name: Rainbowit Template
   */ 
get_header(); ?>

<div class="rbt-section-wrapper rbt-section-gapTop rbt-section-gapBottom rainbowit-custom-template">
    <div class="container">
        <div class="row row--12 row-gap-5">
            <?php

            if (have_posts()) :

                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */
                    get_template_part( 'template-parts/content', 'page' );

                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>
<?php  
get_footer();?>