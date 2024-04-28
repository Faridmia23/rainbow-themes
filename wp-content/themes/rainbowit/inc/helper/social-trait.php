<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */

trait RainbowSocialTrait
{

    public static function rainbow_socials()
    {
        $rainbow_get_options = self::rainbowit_get_options();
        $rainbow_socials = array(
            'social_facebook' => array(
                'icon' => 'fa-brands fa-facebook-f',
                'url' => $rainbow_get_options['social_facebook'],
                'title' => esc_html__('Facebook', 'rainbowit'),
            ),
            'social_twitter' => array(
                'icon' => 'fa-brands fa-twitter',
                'url' => $rainbow_get_options['social_twitter'],
                'title' => esc_html__('Twitter', 'rainbowit'),
            ),
            'social_linkedin' => array(
                'icon' => 'fa-brands fa-linkedin-in',
                'url' => $rainbow_get_options['social_linkedin'],
                'title' => esc_html__('Linkedin', 'rainbowit'),
            ),
            'social_youtube' => array(
                'icon' => 'fa-brands fa-youtube',
                'url' => $rainbow_get_options['social_youtube'],
                'title' => esc_html__('Youtube', 'rainbowit'),
            ),
            'social_instagram' => array(
                'icon' => 'fa-brands fa-instagram',
                'url' => $rainbow_get_options['social_instagram'],
                'title' => esc_html__('Instagram', 'rainbowit'),
            ),
            'social_tiktok' => array(
                'icon' => 'fa-brands fa-tiktok',
                'url' => $rainbow_get_options['social_tiktok'],
                'title' => esc_html__('Tiktok', 'rainbowit'),
            ),
            'social_telegram' => array(
                'icon' => 'fa-brands fa-telegram',
                'url' => $rainbow_get_options['social_telegram'],
                'title' => esc_html__('Telegram', 'rainbowit'),
            ),
            'social_snapchat' => array(
                'icon' => 'fab fa-snapchat',
                'url' => $rainbow_get_options['social_snapchat'],
                'title' => esc_html__('Snapchat', 'rainbowit'),
            ),
            'social_whatsapp' => array(
                'icon' => 'fa-brands fa-whatsapp',
                'url' => $rainbow_get_options['social_whatsapp'],
                'title' => esc_html__('WhatsApp', 'rainbowit'),
            ),
            'social_pinterest' => array(
                'icon' => 'fa-brands fa-pinterest-p',
                'url' => $rainbow_get_options['social_pinterest'],
                'title' => esc_html__('Pinterest', 'rainbowit'),
            ),
            'social_reddit' => array(
                'icon' => 'fa-brands fa-reddit',
                'url' => $rainbow_get_options['social_reddit'],
                'title' => esc_html__('Reddit', 'rainbowit'),
            ),
            'social_vimeo' => array(
                'icon' => 'fab fa-vimeo',
                'url' => $rainbow_get_options['social_vimeo'],
                'title' => esc_html__('Vimeo', 'rainbowit'),
            ),
            'social_qq' => array(
                'icon' => 'fab fa-qq',
                'url' => $rainbow_get_options['social_qq'],
                'title' => esc_html__('QQ', 'rainbowit'),
            ),
            'social_skype' => array(
                'icon' => 'fab fa-skype',
                'url' => $rainbow_get_options['social_skype'],
                'title' => esc_html__('Skype', 'rainbowit'),
            ),
            'social_viber' => array(
                'icon' => 'fab fa-viber',
                'url' => $rainbow_get_options['social_viber'],
                'title' => esc_html__('Viber', 'rainbowit'),
            ),
            'social_wordpress' => array(
                'icon' => 'fab fa-wordpress',
                'url' => $rainbow_get_options['social_wordpress'],
                'title' => esc_html__('WordPress', 'rainbowit'),
            ),
            'social_discord' => array(
                'icon' => 'fab fa-discord',
                'url' => $rainbow_get_options['social_discord'],
                'title' => esc_html__('Discord', 'rainbowit'),
            ),
            'social_stack_overflow' => array(
                'icon' => 'fab fa-stack-overflow',
                'url' => $rainbow_get_options['social_stack_overflow'],
                'title' => esc_html__('Stack Overflow', 'rainbowit'),
            ),
            'social_stack_dribbble' => array(
                'icon' => 'fab fa-dribbble',
                'url' => $rainbow_get_options['social_stack_dribbble'],
                'title' => esc_html__('Dribbble', 'rainbowit'),
            ),
            'social_stack_behance' => array(
                'icon' => 'fab fa-behance',
                'url' => $rainbow_get_options['social_stack_behance'],
                'title' => esc_html__('Behance', 'rainbowit'),
            ),

        );
        return array_filter($rainbow_socials, array(__CLASS__, 'rainbow_filter_social'));
    }

    public static function rainbow_filter_social($args)
    {
        return ($args['url'] != '');
    }

} 
