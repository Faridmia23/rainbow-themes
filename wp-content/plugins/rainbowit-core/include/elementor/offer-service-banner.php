<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Offer_Service extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-offer-service-widget';
    }

    public function get_title()
    {
        return esc_html__('Service Offer Widget', 'rainbowit');
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
        return ['service', 'rainbowit', 'offer'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Services', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Development', 'rainbowit'),
            ]
        );
        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Custom web services we are offering', 'rainbowit'),
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Service Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Data Solution', 'rainbowit'),
            ]
        );
        $repeater->add_control(
            'sec_title_tag_item',
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
                'default' => 'h6',
                'separator' => 'before',
            ]
        );


        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'meta_title',
            [
                'label' => esc_html__('Meta Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Full Design + Development', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'meta_info',
            [
                'label' => esc_html__('Meta Info', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Start From', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('$750.00', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'btn_title',
            [
                'label'       => esc_html__('Button Title 1', 'rainbowit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
                'placeholder' => esc_html__('View Details', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link 1', 'rainbowit'),
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

        $repeater->add_control(
            'btn_title_2',
            [
                'label'       => esc_html__('Button Title 2', 'rainbowit'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('View Details', 'rainbowit'),
                'placeholder' => esc_html__('Contact Support', 'rainbowit'),
            ]
        );

        $repeater->add_control(
            'btn_link_2',
            [
                'label' => esc_html__('Button Link 2', 'rainbowit'),
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

        $repeater->add_control(
            'service_image',
            [
                'label' => esc_html__('Service Image', 'rainbowit'),
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

        $this->start_controls_section(
            'modal_section',
            [
                'label' => esc_html__('Modal Section', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label' => esc_html__('Form Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Let’s Collaborate', 'rainbowit'),
            ]
        );
        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__('Form Shortcode', 'rainbowit'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings            = $this->get_settings_for_display();
        $heading_title       = $settings['heading_title'] ?? '';
        $sub_title           = $settings['sub_title'] ?? '';
        $form_shortcode      = $settings['form_shortcode'] ?? '';
        $form_title          = $settings['form_title'] ?? '';
?>

        <div class="container rbt-section-gapBottom">
            <!-- Modal start -->
            <div class="modal fade backdrop" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content w--fit">
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-sharp fa-regular fa-xmark"></i>
                        </button>
                        <div class="rbt-modal-wrapper">
                            <div class="rbt-section-title section-title-center">
                                <span class="subtitle"><?php echo esc_html( $form_title  ); ?></span>
                            </div>
                            <div class="rbt-form-wrapper mx-auto mt--30 radius-lg">
                               <?php echo do_shortcode( $form_shortcode ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
            <div class="rbt-section-title section-title-center mb--30">
                <span class="subtitle"><?php echo esc_html($sub_title); ?></span>
                <<?php echo esc_html($settings['sec_title_tag']); ?> class="title mb--0"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
            </div>
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto ">
                    <div class="rbt-card-group-3">
                        <!-- single card -->
                        <?php
                        if (!empty($settings['list'])) {
                            foreach ($settings['list'] as $item) {

                                $service_title  = $item['service_title'] ?? '';
                                $desc           = $item['desc'] ?? '';
                                $meta_title     = $item['meta_title'];
                                $meta_info      = $item['meta_info'];
                                $price          = $item['price'];
                                $btn_title      = $item['btn_title'];
                                $btn_title_2    = $item['btn_title_2'];
                                $btn_link       = $item['btn_link']['url'];
                                $btn_link_2     = $item['btn_link_2']['url'];
                                $service_image  = $item['service_image']['url'];

                                $service_image_id = $item['service_image']['id'];
                                $service_image_title = get_post_meta( $service_image_id, '_wp_attachment_image_alt', true);

                                if (empty($service_image_title)) {
                                    $service_image_title = get_the_title( $service_image_id );
                                }

                        ?>
                                <div class="rbt-card-4 card-wider">
                                    <div class="content-wrapper">
                                        <div class="rbt-card-content order-2 order-lg-1">
                                            <div class="rbt-section-title">
                                                <<?php echo esc_html($item['sec_title_tag_item']); ?> class="title text-white"><?php echo esc_html($service_title); ?></<?php echo esc_html($item['sec_title_tag_item']); ?>>
                                                <p class="description description-light">
                                                    <?php echo esc_html($desc); ?>
                                                </p>
                                            </div>
                                            <div class="rbt-card-body">
                                                <div class="rbt-card-meta">
                                                    <div class="meta">
                                                        <h6 class="meta-title text-white"><?php echo esc_html($meta_title); ?></h6>
                                                        <p class="meta-info"><?php echo esc_html($meta_info); ?></p>
                                                    </div>
                                                    <p class="price">
                                                        <?php echo esc_html($price); ?>
                                                        <span>*</span>
                                                    </p>
                                                </div>
                                                <div class="rbt-btn-group">
                                                    <?php if (isset($btn_link) && !empty($btn_link)) { ?>
                                                        <a href="<?php echo esc_url($btn_link); ?>" class="rbt-btn rbt-btn-primary ">
                                                            <?php echo esc_html($btn_title); ?>
                                                        </a>
                                                    <?php } ?>
                                                    <?php if (isset($btn_link_2) && !empty($btn_link_2)) { ?>
                                                        <a href="<?php echo esc_url($btn_link_2); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal" class="rbt-btn rbt-btn-offwhite">
                                                            <?php echo esc_html($btn_title_2); ?>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rbt-card-img order-1 order-lg-2">
                                            <img src="<?php echo esc_url( $service_image );?>" alt="<?php echo esc_attr($service_image_title);?>">
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>

                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Offer_Service());
