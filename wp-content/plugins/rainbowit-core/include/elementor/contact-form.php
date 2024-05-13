<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbow_Contact_Form extends Widget_Base
{
  use \Elementor\RainbowitElementCommonFunctions;

  public function get_name()
  {
    return 'rainbow-contact-form2';
  }

  public function get_title()
  {
    return __('Contact Form', 'rainbowit');
  }

  public function get_icon()
  {
    return 'eicon-featured-image';
  }

  public function get_categories()
  {
    return ['rainbowit'];
  }

  protected function register_controls()
  {


    $this->start_controls_section(
      '_section_content',
      [
        'label' => esc_html__('Content', 'rainbowit'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new \Elementor\Repeater();
    $repeater->add_control(
      'tab_title',
      [
        'label'       => esc_html__('Tab Title', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Pre Sales', 'rainbowit'),
      ]
    );
    $repeater->add_control(
      'shortcode',
      [
        'label'       => esc_html__('Shortcode', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'placeholder' => esc_html__('Shortcode', 'rainbowit'),
      ]
    );

    $repeater->add_control(
      'icon_contorl',
      [
        'label'       => esc_html__('Icon Class', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXT,
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
      '_section_actions',
      [
        'label' => esc_html__('Contact Support', 'rainbowit'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->add_control(
      'support_title',
      [
        'label'       => esc_html__('Support Title', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
        'placeholder' => esc_html__('Support Title', 'rainbowit'),
      ]
    );

    $this->add_control(
      'support_desc',
      [
        'label'       => esc_html__('Support Description', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
      ]
    );

    $this->add_control(
      'btn_title',
      [
        'label'       => esc_html__('Button Title', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXT,
        'default'     => esc_html__('Do You have a Technical Question?', 'rainbowit'),
        'placeholder' => esc_html__('Contact Support', 'rainbowit'),
      ]
    );

    $this->add_control(
      'btn_link',
      [
        'label' => esc_html__('Button Link', 'rainbowit'),
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
      '_product_option',
      [
        'label' => esc_html__('Top Product', 'rainbowit'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'product_title',
      [
          'label' => esc_html__('Product Title', 'rainbowit'),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__('', 'rainbowit'),
      ]
    );

    $this->add_control(
      'posts_per_page',
      [
          'label' => esc_html__('Posts Per Page', 'rainbowit'),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__('-1', 'rainbowit'),
      ]
    );

    $this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'rainbowit' ),
					'desc'  => esc_html__( 'DESC', 'rainbowit' ),
				],
			]
		);

    $this->end_controls_section();
  }
  protected function render()
  {

    $settings        = $this->get_settings();
    $btn_link        = $settings['btn_link']['url'];
    $support_title   = $settings['support_title'];
    $support_desc    = $settings['support_desc'];
    $btn_title       = $settings['btn_title'];
    $order           = $settings['order'];
    $posts_per_page  = $settings['posts_per_page'];
    $product_title   = $settings['product_title'];


?>
    <div class="rbt-section-wrapper rbt-section-gapBottom mt_dec--205">
      <div class="container">
        <div class="row row--12 row-gap-5">
          <div class="col-12 col-md-12 col-lg-8 col-xl-7 ms-auto">
            <div class="rbt-form-wrapper contact-form-wrapper">
              <nav class="rbt-tabs-wrapper pb--45">
                <div class="nav rbt-tabs-2" id="nav-tab" role="tablist">
                  <!-- tab 1 -->
                  <?php
                  if (!empty($settings['list'])) {
                    $count = 1;
                    foreach ( $settings['list'] as $item ) {

                      $tab_title    = $item['tab_title'] ?? '';
                      $shortcode    = $item['shortcode'] ?? '';
                      $active = '';
                      if( $count == '1' ) {
                          $active = 'active';
                      }
                  ?>
                      <button class="rbt-tab-link2 <?php echo esc_attr( $active );?>" id="rbt-tab<?php echo esc_attr( $count ); ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo esc_attr( $count ); ?>" type="button" role="tab" aria-controls="tab-<?php echo esc_attr( $count ); ?>" aria-selected="true">
                        <span class="hide-sm-layout"><i class="<?php echo $item['icon_contorl'];?>"></i></span>
                        <span><?php echo esc_html( $tab_title ); ?></span>
                      </button>
                  <?php
                  $count++; }
                  } ?>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <?php
                  if (!empty($settings['list'])) {
                    $count = 1;
                    foreach ( $settings['list'] as $item )  {

                      $tab_title    = $item['tab_title'] ?? '';
                      $shortcode    = $item['shortcode'] ?? '';
                      $active = '';
                      if( $count == '1' ) {
                          $active = 'active show';
                      }
                  ?>
                <div class="tab-pane fade <?php echo esc_attr( $active );?>" id="tab-<?php echo esc_attr( $count ); ?>" role="tabpanel" aria-labelledby="rbt-tab<?php echo esc_attr( $count ); ?>">
                  <?php echo do_shortcode( $shortcode ); ?>
                </div>
                <?php
                  $count++; }
                  } ?>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-4 col-xl-3 me-auto">
            <div class="rbt-sidebar flex-md-row flex-lg-column">
              <div class="rbt-sidebar-card card-bg-shape" data-sal="slide-up" data-sal-duration="400">
                <div class="side-card-content">
                  <h6 class="title text-center "><?php echo esc_html( $support_title ); ?></h6>
                  <p class="description text-center ">
                    <?php echo wp_kses_post( $support_desc ); ?>
                  </p>
                  <?php if(isset( $btn_link ) ) { ?>
                  <a class="rbt-btn rbt-btn-dark rbt-btn-sm" href="<?php echo esc_url( $btn_link ); ?>">
                    <?php echo esc_html( $btn_title ); ?>
                  </a>
                  <?php } ?>
                </div>
              </div>
              <div class="rbt-sidebar-card plr--32" data-sal="slide-up" data-sal-duration="400">
                <h6 class="title"><?php echo esc_html ( $product_title );?></h6>
                <nav>
                  <ul class="rbt-list has-link has-img">
                  <?php 
                  $query = new \WP_Query( 
                    array(
                      'posts_per_page'      => $posts_per_page,
                      'post_type'           => 'product',
                      'post_status'         => 'publish',
                      'ignore_sticky_posts' => 1,
                      'meta_key'            => 'total_sales',
                      'orderby'             => 'meta_value_num',
                      'order'               => $order,
                    ) 
                  );
                  ?>
                  <?php 
                      if($query->have_posts()) :
                        while($query->have_posts()) : $query->the_post();
                    ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                        <?php echo wp_trim_words( get_the_title(), 4 ); ?>
                        <i class="fa-solid fa-arrow-up-right"></i>
                      </a>
                    </li>
                    <?php
                        endwhile;
                          wp_reset_postdata();
                      endif;
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}

Plugin::instance()->widgets_manager->register(new Rainbow_Contact_Form());
