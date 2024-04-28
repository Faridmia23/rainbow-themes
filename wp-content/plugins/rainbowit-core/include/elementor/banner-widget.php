<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Elementor_Widget_Banner extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-banner-widget';
    }

    public function get_title()
    {
        return esc_html__('Banner Widget', 'rainbowit');
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
            '_about_thumbnail',
            [
                'label' => esc_html__('General Info', 'rainbowit'),
            ]
        );
        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__('Title Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'subtitle_title',
            [
                'label' => esc_html__('Subtitle Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Elite Author On Envato Market', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('12+ Professionals are waiting for you', 'rainbowit'),
            ]
        );
        $this->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );


        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__('Button 1 Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Templates', 'rainbowit'),
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button 1 Link', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_2_title',
            [
                'label' => esc_html__('Button 2 Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Templates', 'rainbowit'),
            ]
        );
        $this->add_control(
            'btn__2_link',
            [
                'label' => esc_html__('Button 2 Link', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Image Item', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'client_image',
            [
                'label' => esc_html__('Icon Image', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'rainbowit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('icon_image', 'src', $settings['icon_image']['url']);
        $this->add_render_attribute('icon_image', 'alt', Control_Media::get_image_alt($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'title', Control_Media::get_image_title($settings['icon_image']));
        $this->add_render_attribute('icon_image', 'class', 'impower-icon');
        $this->add_render_attribute('icon_image', 'data-sal', 'slide-up');
        $this->add_render_attribute('icon_image', 'data-sal-duration', '900');
        $this->add_render_attribute('icon_image', 'data-sal-delay', '100');

        $heading_title = $settings['heading_title'] ?? '';
        $subtitle_title = $settings['subtitle_title'] ?? '';
        $desc = $settings['desc'] ?? '';
        $btn_title = $settings['btn_title'] ?? '';
        $btn_2title = $settings['btn_2_title'] ?? '';

        if (!empty($settings['btn_link']['url'])) {
            $attr  = 'href="' . $settings['btn_link']['url'] . '"';
            $attr .= !empty($settings['btn_link']['is_external']) ? ' target="_blank"' : '';
            $attr .= !empty($settings['btn_link']['nofollow']) ? ' rel="nofollow"' : '';
        }

        if (!empty($settings['btn__2_link']['url'])) {
            $attr2  = 'href="' . $settings['btn__2_link']['url'] . '"';
            $attr2 .= !empty($settings['btn__2_link']['is_external']) ? ' target="_blank"' : '';
            $attr2 .= !empty($settings['btn__2_link']['nofollow']) ? ' rel="nofollow"' : '';
        }
?>
        <!-- banner second design -->
        <div class="rbt-main-banner">
            <div class="container">
                <div class="content">
                    <ul class="banner-icon-wrapper d-none d-xxl-block">
                        <?php 
                        $count = 1;
                        if (!empty($settings['list'])) {
                            foreach ($settings['list'] as $item) {
                                $client_image = $item['client_image']['url'];
                        ?>
                                <li class="banner-tech-icon icon-<?php echo esc_attr($count);?>">
                                    <img data-sal="flip-down" data-sal-duration="400" src="<?php echo esc_url($client_image ); ?>" alt="Technology icon">
                                </li>
                        <?php $count++; }
                        } ?>
                    </ul>
                    <div class="inner">
                        <div class="subtitle">
                            <i>
                                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3415 0.0829296C9.97175 0.181415 1.36438 5.93843 1.04957 6.29785C0.922611 6.44279 0.704829 6.79729 0.56561 7.08565L0.3125 7.60994V12.0059V16.4019L0.564239 16.9261C0.702651 17.2145 0.938581 17.5834 1.08853 17.7459C1.35511 18.0348 9.35261 23.4396 9.99353 23.7639C10.4422 23.991 10.9856 24.0578 11.4973 23.9489C11.859 23.8718 12.6253 23.3927 16.3075 20.9412C18.7955 19.2848 20.8117 17.8879 20.9749 17.7072C21.133 17.5322 21.3579 17.1851 21.4748 16.9358L21.6873 16.4825V12.0059V7.52928L21.4776 7.08194C21.3621 6.83593 21.1447 6.49458 20.9944 6.32334C20.6285 5.90665 12.125 0.23699 11.6525 0.094706C11.2473 -0.0273323 10.7717 -0.0316073 10.3415 0.0829296ZM12.364 5.06771C16.7414 5.95972 19.1938 10.4245 17.5997 14.5991C16.2427 18.1527 12.1609 19.9834 8.53181 18.6661C6.66527 17.9886 5.0165 16.3385 4.33775 14.4687C3.56696 12.345 3.84782 9.94278 5.0849 8.0789C6.686 5.66669 9.52998 4.49018 12.364 5.06771ZM10.516 5.44358C8.70152 5.59893 6.89813 6.57266 5.8214 7.97839C5.26783 8.70119 4.77444 9.7321 4.58892 10.554C4.41034 11.3449 4.40889 12.6694 4.58561 13.4578C4.76226 14.2456 5.39705 15.5444 5.91513 16.178C7.29869 17.8701 9.77236 18.8528 11.8565 18.5383C13.3914 18.3067 14.5854 17.7123 15.6458 16.6518C17.3338 14.9639 17.9639 12.6665 17.3728 10.3553C16.5907 7.29722 13.6308 5.177 10.516 5.44358ZM13.823 10.0297V10.554H10.9999H8.17683V10.0297V9.50545H10.9999H13.823V10.0297ZM14.549 11.8043V12.3285H10.9999H7.45089V11.8043V11.28H10.9999H14.549V11.8043ZM15.4362 13.5788V14.1031H10.9999H6.56363V13.5788V13.0545H10.9999H15.4362V13.5788Z" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0_87_2642" transform="matrix(0.00757576 0 0 0.00674711 0 -0.00603332)" />
                                        </pattern>
                                        <image id="image0_87_2642" width="132" height="150" xlink:href="data:image/png;base64,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" />
                                    </defs>
                                </svg>
                            </i>
                            <?php echo esc_html($subtitle_title); ?>
                        </div>
                        <h1 class="title">
                            <?php echo wp_kses_post($heading_title); ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'icon_image'); ?>
                            </span>
                        </h1>
                        <p class="description">
                            <?php echo wp_kses_post($desc); ?>
                        </p>
                        <div class="rbt-btn-group">
                            <a <?php echo esc_attr($attr); ?> class="rbt-btn rbt-btn-primary">
                                <span><i class="fa-regular fa-objects-column"></i></span>
                                <?php echo esc_html($btn_title); ?>
                            </a>
                            <a <?php echo esc_attr($attr2); ?> class="rbt-btn hover-effect-4"><?php echo esc_html($btn_2title); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Elementor_Widget_Banner());
