<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Contact_Info extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-contact-info';
    }

    public function get_title()
    {
        return esc_html__('Contact Info', 'rainbowit');
    }

    public function get_icon()
    {
        return 'rt-icon';
    }

    public function get_categories()
    {
        return ['rainbowit'];
    }

    public function get_keywords()
    {
        return ['about', 'rainbowit'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            '_contact_info',
            [
                'label' => esc_html__('Contact Info', 'rainbowit'),
            ]
        );
       
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Start Chatting', 'rainbowit'),
            ]
        );
        $this->add_control(
            'sec_title_tag',
            [
                'label' => __('Title HTML Tag', 'rainbowit'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'rainbowit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'rainbowit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'rainbowit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'rainbowit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'rainbowit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'rainbowit'),
                        'icon' => 'eicon-editor-h6'
                    ],
                    'div' => [
                        'title' => __('div', 'rainbowit'),
                        'icon' => 'eicon-font'
                    ]
                ],
                'default' => 'h3',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'social_image',
            [
                'label' => esc_html__('Social Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
			'social_select',
			[
				'label' => esc_html__( 'Social Select', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skype',
				'options' => [
					'skype' => esc_html__( 'Skype', 'rainbowit' ),
					'whatsapp'  => esc_html__( 'Whatsapp', 'rainbowit' ),
					'email' => esc_html__( 'E-Mail', 'rainbowit' ),
				],
			]
		);

        $this->add_control(
            'whatsapp_number',
            [
                'label' => esc_html__('Whatsapp Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('880100692380', 'rainbowit'),
                'condition' => ['social_select' => 'whatsapp']
            ]
        );

        $this->add_control(
            'skype_number',
            [
                'label' => esc_html__('Skype Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('live:.cid.b837c9447c6223', 'rainbowit'),
                'condition' => ['social_select' => 'skype']
            ]
        );

        $this->add_control(
            'email_number',
            [
                'label' => esc_html__('E-Mail Number', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('no-reply@gmail.com', 'rainbowit'),
                'condition' => ['social_select' => 'email']
            ]
        );

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings           = $this->get_settings_for_display();
        $heading_title      = $settings['heading_title'] ?? '';
        $social_select      = $settings['social_select'] ?? '';
        $whatsapp_number      = $settings['whatsapp_number'] ?? '';
        $skype_number      = $settings['skype_number'] ?? '';
        $email_number      = $settings['email_number'] ?? '';
        $social_image       = $settings['social_image']['url'];

        $social_image_id = $settings['social_image']['id'];

        $social_image_title = get_post_meta($social_image_id, '_wp_attachment_image_alt', true);

        // If title is not found, fallback to the post title
        if (empty($social_image_title)) {
            $social_image_title = get_the_title($social_image_id);
        }
        $social_link = '';
        
        if( $social_select == 'skype') {
            $social_link = "skype:$skype_number?chat";
        }
        elseif( $social_select == 'whatsapp') {
            $social_link = "https://wa.me/$whatsapp_number?text=urlencodedtext";
        }
        else {
            $social_link = "mailto:$email_number";
        }
?>
<div class="rbt-contact-box-wrapper">
    <?php if(!empty($social_image )) { ?>
    <figure class="rbt-contact-box-img"><img decoding="async" src="<?php echo esc_url( $social_image ); ?>" title="" alt="<?php echo esc_attr($social_image_title);?>" loading="lazy">
    </figure>
    <?php } ?>
    <<?php echo esc_html($settings['sec_title_tag']); ?> class="rbt-contact-box-title">
            <a  href="<?php echo esc_attr( $social_link); ?>">
        <?php echo wp_kses_post($heading_title); ?>
        </a>
    </<?php echo esc_html($settings['sec_title_tag']); ?>>
</div>

<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Contact_Info());