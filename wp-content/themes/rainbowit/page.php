<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */
$account_page = '';
 if ( is_account_page() && is_user_logged_in() && (!isset($_GET['action']) || $_GET['action'] !== 'newaccount') ) {
    $account_page = 'rainbowit-account-login';
 }

get_header();
?>
<?php 
if( !is_account_page() ) {
?>
<div class="rbt-section-wrapper mt_dec--190">
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
<?php }  
if ( 
    is_account_page()  || 
    (is_user_logged_in() && (isset($_GET['action']) && $_GET['action'] == 'newaccount')) 
) {
?>
<div class="rbt-section-wrapper-4 pt--140 rbt-section-gap2Bottom login-page-rainbowit <?php echo esc_attr( $account_page ); ?>">
	<div class=" rbt-section-wrapper-7 pt--25">
		<div class="rbt-form-wrapper-2 mx-auto ">
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
<?php }  ?>
<?php
get_footer();
