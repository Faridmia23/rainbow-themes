<?php
/*
***************************************************************
*  Social sharing icons
***************************************************************
*/

if (!function_exists('rbt_sharing_icon_links')) {
    function rbt_sharing_icon_links()
    {

        global $post;

        // Check if the rainbowit_Helper class exists
        if (class_exists('Rainbowit_Helper')) {
            $rbt_options = new \Rainbowit_Helper();
            $rbt_options = $rbt_options->rainbowit_get_options();
        } else {
            // Handle the case where the class doesn't exist
            return;
        }
?>

        <div class="social-area d-none d-xl-block">
            <h6 class="sidebar-title mb--10"> <?php echo esc_html($rbt_options['rbt_blog_details_social_share_label']); ?></h6>
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
<?php

    }
}

/*
***************************************************************
*  Portfolio sharing icons
***************************************************************
*/

if (!function_exists('rbt_portfolio_sharing_icon_links')) {
    function rbt_portfolio_sharing_icon_links()
    {
        $Helper = new \Helper();
        $rainbowit_options = $Helper->rainbowit_get_options();


        $html = '<div class="portfolio-share-link mt--20 pb--70 pb_sm--40">';
        $html .= '<ul class="social-share rn-lg-size d-flex justify-content-start liststyle mt--15">';

        if ($rainbowit_options['rainbowit_enable_portfolio_share_facebook'] == 'yes') {
            // facebook
            $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink();
            $html .= '<li><a href="' . esc_url($facebook_url) . '" target="_blank" class="aw-facebook"><i class="feather-facebook"></i></a></li>';
        }
        if ($rainbowit_options['rainbowit_enable_portfolio_share_twitter'] == 'yes') {
            // twitter
            $twitter_url = 'https://twitter.com/share?' . esc_url(get_permalink()) . '&amp;text=' . get_the_title();
            $html .= '<li><a href="' . esc_url($twitter_url) . '" target="_blank" class="aw-twitter"><i class="feather-twitter"></i></a></li>';
        }
        if ($rainbowit_options['rainbowit_enable_portfolio_share_linkedin'] == 'yes') {
            // linkedin
            $linkedin_url = 'http://www.linkedin.com/shareArticle?url=' . esc_url(get_permalink()) . '&amp;title=' . get_the_title();
            $html .= '<li><a href="' . esc_url($linkedin_url) . '" target="_blank" class="aw-linkdin"><i class="feather-linkedin"></i></a></li>';
        }

        $html .= '</ul></div>';

        if ($rainbowit_options['rainbowit_enable_portfolio_share'] == 'yes') {
            echo wp_kses_post($html);
        }
    }
}
