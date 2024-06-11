<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Pricing_Plan extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-pricing-plan';
    }

    public function get_title()
    {
        return esc_html__('Pricing Plan', 'rainbowit');
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

    public function get_product_title() {
        $args = array(
            'posts_per_page'      => -1,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'order'               => 'desc',
            'meta_query'          => array(
              array(
                'key'     => '_product_url',
                'compare' => 'NOT EXISTS',
              ),
            ),
        );

        $title_array = [];

        $query = new \WP_Query($args);

        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
          $id = get_the_ID();
          $title_array[$id] = get_the_title();
          endwhile;
          wp_reset_postdata();
        endif;

        return $title_array;
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Pricing List', 'rainbowit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'heading_enable',
			[
				'label' => esc_html__( 'Heading Enable?', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rainbowit' ),
				'label_off' => esc_html__( 'Hide', 'rainbowit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Pricing List', 'rainbowit'),
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
			'pricing_plan_title',
			[
				'label' => esc_html__( 'Plan Title', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Starter Plan', 'rainbowit' ),
			]
		);

        $repeater->add_control(
			'plan_sub_title',
			[
				'label' => esc_html__( 'Plan Sub title', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Starter Plan', 'rainbowit' ),
			]
		);

        $repeater->add_control(
			'product_select',
			[
				'label' => esc_html__( 'Product Select', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => $this->get_product_title()
			]
		);

        $repeater->add_control(
            'button_title',
            [
                'label' => esc_html__('Button Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Purchase Now', 'rainbowit'),
            ]
        );

        $repeater->add_control(
			'feature_description',
			[
				'label' => esc_html__( 'Feature LIst', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

        $repeater->add_control(
            'plan_time',
            [
                'label' => esc_html__('Monthly/Yearly', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );

        $repeater->add_control(
			'button_highlight',
			[
				'label' => esc_html__( 'Button Hightlight?', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'rainbowit' ),
				'label_off' => esc_html__( 'Hide', 'rainbowit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $repeater->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rainbowit'),
            ]
        );

        $this->add_control(
			'pricing_list',
			[
				'label' => esc_html__( 'Repeater List', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'pricing_plan_title' => esc_html__( 'Title #1', 'rainbowit' ),
					],
					[
						'pricing_plan_title' => esc_html__( 'Title #2', 'rainbowit' ),
					],
				],
				'title_field' => '{{{ pricing_plan_title }}}',
			]
		);

        $this->end_controls_section();
    }

    protected function render($instance = [])
    {

        $settings            = $this->get_settings_for_display();
        $heading_enable      = $settings['heading_enable'];
        $heading_title       = $settings['heading_title'];

        
?>

<div class="rbt-pricing-area bg-color-extra2 rbt-section-gap">
    <div class="container">
        <?php if( $heading_enable  == 'yes') { ?>
        <div class="row g-5 mb--30">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="section-title text-center" data-sal="slide-up" data-sal-duration="400">
                    <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo esc_html($heading_title); ?></<?php echo esc_html($settings['sec_title_tag']); ?>>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row g-5">
        <?php 
        if ( $settings['pricing_list'] ) {
			
			foreach (  $settings['pricing_list'] as $item ) { 

                $pricing_plan_title     = $item['pricing_plan_title'];
                $product_select         = $item['product_select'];
                $button_title           = $item['button_title'];
                $feature_description    = $item['feature_description'];
                $plan_time              = $item['plan_time'];
                $button_highlight       = $item['button_highlight'];
                $plan_sub_title         = $item['plan_sub_title'];
                $badge_text             = $item['badge_text'];
                $price = '';

                if(isset($product_select ) && !empty($product_select ) ) {
                    $product        = wc_get_product( $product_select );
                    $price          = $product->get_regular_price();
                }
                
            
            ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <div class="pricing-table style-2">
                        <div class="pricing-header">
                            <?php if(!empty($badge_text ) ) { ?>
                            <div class="pricing-badge"><span><?php echo esc_html( $badge_text); ?></span></div>
                            <?php } ?>
                            <h3 class="title"><?php echo esc_html( $pricing_plan_title );?></h3>
                            <?php if( !empty($plan_sub_title)) { ?>
                            <P class="sub-title"><?php echo esc_html($plan_sub_title); ?></P>
                            <?php } ?>
                            <div class="price-wrap">
                                <div class="monthly-pricing" style="display: block;">
                                    <span class="amount"><?php echo $price; ?><?php echo get_woocommerce_currency_symbol(); ?></span>
                                    <?php if( !empty( $plan_time ) ) { ?>
                                    <span class="duration">/<?php echo esc_html( $plan_time );?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if( !empty( $button_title ) ) { ?>
                                <div class="pricing-btn mt--30 <?php echo esc_attr( $button_highlight); ?>">
                                    <a class="pricing-plan-btn rbt-btn  hover-icon-reverse w-100 ajax-order-now-product"  data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr( $product_select ); ?>">
                                        <div class="icon-reverse-wrapper">
                                            <span class="btn-text"><?php echo esc_html( $button_title ); ?></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if( !empty( $feature_description ) ) { ?>
                        <div class="pricing-body">
                            <ul class="list-item">
                                <?php echo wp_kses_post( $feature_description ); ?>
                            </ul>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            <?php 
            }
        } 
        ?>
        </div>
    </div>
</div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Pricing_Plan());

?>

