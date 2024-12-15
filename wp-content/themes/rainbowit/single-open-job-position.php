<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

get_header();
// Get Value
$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();

$open_job = get_the_terms( $post->ID , 'open-job' );
$number_vacancies = get_the_terms( $post->ID , 'number-of-vacancies' );

$job__expire_date = get_field('job__expire_date2', $post->ID);
$apply_link = get_field('apply_link', $post->ID);
$formatted_date = '';
if (!empty( $job__expire_date ) ) {
    $timestamp = strtotime(str_replace('/', '-', $job__expire_date ) );

    if ($timestamp) {
        $formatted_date = date('F j, Y', $timestamp); 
    } 
}


$rainbowit_blog_sidebar_class =  !is_active_sidebar( 'sidebar-1' )  ? 'col-lg-10 offset-lg-1 col-md-12 col-12':'col-lg-8 col-md-12 col-12';
?>
<div <?php post_class('rbt-section-wrapper single-blog-wrapper'); ?> id="post-<?php the_ID(); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto px-4">
                <div class="blog-detail-breadcrumb job-post-breadcrumb">
                    <?php
                    rainbowit_breadcrumbs();
                    ?>
                </div>
                <h2 class="title">
                    <?php the_title(); ?>
                </h2>
                <div class="blog-card-meta mt--25 mb--25 rbt-job-single-post-meta">
                    <span><i class="fa-regular fa-briefcase"></i></span>
                        <?php 
                        foreach ( $open_job as $term ) {
                            echo $term->name;
                        }
                    ?>
                    <span><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                    <?php echo  $formatted_date; ?>
                    <span class="rbt-vacancy"><i class="fa-regular fa-user"></i>
                    </span>
                    <?php echo esc_html__("No of vacancies:", "rainbowit"); ?>               
                        <?php 
                        foreach ( $number_vacancies as $term ) {
                            echo $term->name;
                        } 
                    ?>
                </div>
               
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

<div class="rbt-section-wrapper pt--60  rbt-section-gap2Bottom rbt-blogs-details rbt-job-post-single-career">
    <div class="container">
        <div class="row row--40">
            
            <div class="col-12 col-lg-9 col-xxl-9 ">
                <?php 
                    while ( have_posts() ) :
                        the_post();
                        
                        $apply_link = get_field('apply_link', get_the_ID() );
                
                        the_content(); ?>
                    <?php
                    endwhile; // End of the loop.
                ?>
            </div>
            <?php if (is_active_sidebar('blog-single-right-sidebar')) { ?>
            <div class="col-12 col-xxl-3 col-lg-3">
                <div class="rbt-sidebar sticky-top">
                    <?php  
                        $apply_link = get_field('apply_link', get_the_ID() );
                    ?>
                    <div class="single-page-apply-link">
                        <a href="<?php echo esc_url( $apply_link);?>" class="rbt-btn rbt-btn-primary show-more rbt-btn-lg w-100" target="_blank">Apply Now <span><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>

                    <div class="social-area d-none d-xl-block">
                        <h6 class="sidebar-title mb--10"> <?php echo esc_html($rainbowit_options['rbt_blog_details_social_share_label']); ?></h6>
                        <ul class="rbt-list rbt-social-media">
                            <?php $linkedin_url = 'http://www.linkedin.com/shareArticle?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title(); ?>
                            <li><a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" class="aw-linkdin"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <?php $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(); ?>
                            <li><a href="<?php echo  esc_url($facebook_url); ?>" target="_blank" class="aw-facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <?php $twitter_url = 'https://twitter.com/share?' . esc_url(get_permalink()) . '&amp;text=' . get_the_title(); ?>
                            <li><a href="<?php echo esc_url($twitter_url); ?>" target="_blank" class="aw-twitter"><i class="fab fa-twitter"></i></a></li>
                            <?php 
                            $current_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            $instagram_url = 'https://www.instagram.com/share?url=' . urlencode($current_url);
                            ?>
                            <li><a href="https://www.instagram.com/sharer.php?u=<?php echo esc_url($instagram_url); ?>" target='_blank' class='aw-linkdin'><i class='fa-brands fa-instagram'></i></a></li>
                        </ul>
                    </div>


                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
get_footer();