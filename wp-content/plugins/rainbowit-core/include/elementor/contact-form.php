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
      'product_label_title',
      [
        'label' => esc_html__('Product Label Title', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('Product', 'rainbowit'),
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
        'label' => esc_html__('Order', 'rainbowit'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'desc',
        'options' => [
          'ASC' => esc_html__('ASC', 'rainbowit'),
          'DESC'  => esc_html__('DESC', 'rainbowit'),
        ],
      ]
    );

    $this->add_control(
      'product_title_limit',
      [
        'label' => esc_html__('Product Title Limit', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('4', 'rainbowit'),
      ]
    );

    $this->add_control(
      'product_type',
      [
        'label' => esc_html__('Product Type', 'rainbowit'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'external',
        'options' => [
          'simple' => esc_html__('simple', 'rainbowit'),
          'grouped'  => esc_html__('grouped', 'rainbowit'),
          'external' => esc_html__('external', 'rainbowit'),
          'variable' => esc_html__('variable', 'rainbowit'),
          'featured' => esc_html__('featured', 'rainbowit'),
        ],
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      '_product_option_service',
      [
        'label' => esc_html__('Service Product', 'rainbowit'),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'service_label_title',
      [
        'label' => esc_html__('Service Label Title', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('Service', 'rainbowit'),
      ]
    );

    $this->add_control(
      'service_product_title',
      [
        'label' => esc_html__('Product Title', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('', 'rainbowit'),
      ]
    );

    $this->add_control(
      'service_posts_per_page',
      [
        'label' => esc_html__('Posts Per Page', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('-1', 'rainbowit'),
      ]
    );

    $this->add_control(
      'service_order',
      [
        'label' => esc_html__('Order', 'rainbowit'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'desc',
        'options' => [
          'ASC' => esc_html__('ASC', 'rainbowit'),
          'DESC'  => esc_html__('DESC', 'rainbowit'),
        ],
      ]
    );

    $this->add_control(
      'service_product_title_limit',
      [
        'label' => esc_html__('Product Title Limit', 'rainbowit'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('4', 'rainbowit'),
      ]
    );

    $this->add_control(
      'serviceproduct_type',
      [
        'label' => esc_html__('Product Type', 'rainbowit'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'simple',
        'options' => [
          'simple' => esc_html__('simple', 'rainbowit'),
          'grouped'  => esc_html__('grouped', 'rainbowit'),

          'variable' => esc_html__('variable', 'rainbowit'),
          'featured' => esc_html__('featured', 'rainbowit'),
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

    $product_title                  = $settings['product_title'];
    $title_limit                    = $settings['product_title_limit'];
    $product_type                   = $settings['product_type'];
    $service_product_title          = $settings['service_product_title'];
    $service_posts_per_page         = $settings['service_posts_per_page'];
    $service_order                  = $settings['service_order'];
    $service_product_title_limit    = $settings['service_product_title_limit'];
    $serviceproduct_type            = $settings['serviceproduct_type'];
    $service_label_title            = $settings['service_label_title'];
    $product_label_title            = $settings['product_label_title'];


?>
    <div class="rbt-section-wrapper">
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
                    foreach ($settings['list'] as $item) {

                      $tab_title    = $item['tab_title'] ?? '';
                      $shortcode    = $item['shortcode'] ?? '';
                      $active = '';
                      if ($count == '1') {
                        $active = 'active';
                      }
                  ?>
                      <button class="rbt-tab-link2 <?php echo esc_attr($active); ?>" id="rbt-tab<?php echo esc_attr($count); ?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo esc_attr($count); ?>" type="button" role="tab" aria-controls="tab-<?php echo esc_attr($count); ?>" aria-selected="true">
                        <span class="hide-sm-layout"><i class="<?php echo $item['icon_contorl']; ?>"></i></span>
                        <span><?php echo esc_html($tab_title); ?></span>
                      </button>
                  <?php
                      $count++;
                    }
                  } ?>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <?php
                if (!empty($settings['list'])) {
                  $count = 1;
                  foreach ($settings['list'] as $item) {

                    $tab_title    = $item['tab_title'] ?? '';
                    $shortcode    = $item['shortcode'] ?? '';
                    $active = '';
                    if ($count == '1') {
                      $active = 'active show';
                    }
                ?>
                    <div class="tab-pane fade <?php echo esc_attr($active); ?>" id="tab-<?php echo esc_attr($count); ?>" role="tabpanel" aria-labelledby="rbt-tab<?php echo esc_attr($count); ?>">
                      <?php echo do_shortcode($shortcode); ?>
                    </div>
                <?php
                    $count++;
                  }
                } ?>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-4 col-xl-3 me-auto">
            <div class="rbt-sidebar flex-md-row flex-lg-column">
              <div class="rbt-sidebar-card card-bg-shape">
                <div class="side-card-content">
                  <h6 class="title text-center "><?php echo esc_html($support_title); ?></h6>
                  <p class="description text-center ">
                    <?php echo wp_kses_post($support_desc); ?>
                  </p>
                  <?php if (isset($btn_link)) { ?>
                    <a class="rbt-btn rbt-btn-dark rbt-btn-sm" href="<?php echo esc_url($btn_link); ?>">
                      <?php echo esc_html($btn_title); ?>
                    </a>
                  <?php } ?>
                </div>
              </div>
              <div class="rbt-sidebar-card plr--32">
                <ul class="nav nav-pills mb-3 contact-page-tabtopbar" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo esc_html(  $product_label_title ); ?></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo esc_html(  $service_label_title ); ?></button>
                  </li>
                </ul>
                <div class="tab-content contact-page-tab" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h6 class="title"><?php echo esc_html($product_title); ?></h6>
                    <nav>
                      <ul class="rbt-list has-link has-img">
                        <?php

                        if ($product_type == 'featured') {
                          $args = array(
                            'posts_per_page' => $posts_per_page,
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'ignore_sticky_posts' => 1,
                            'meta_key'            => 'total_sales',
                            'orderby'             => 'meta_value_num',
                            'order'               => $order,
                            'tax_query'      => array(
                              array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => $product_type,
                                'operator' => 'IN',
                              ),
                            )
                          );
                        } elseif ($product_type == 'external') {
                          $args = array(
                            'posts_per_page'      => $posts_per_page,
                            'post_type'           => 'product',
                            'post_status'         => 'publish',
                            'ignore_sticky_posts' => 1,
                            'order'               => $order,
                            'meta_query'          => array(
                              array(
                                'key'     => '_product_url',
                                'compare' => 'EXISTS',
                              ),
                            ),
                          );
                        } elseif ($product_type == 'simple' || $product_type == 'grouped' || $product_type == 'variable') {
                          $args = array(
                            'posts_per_page'      => $posts_per_page,
                            'post_type'           => 'product',
                            'post_status'         => 'publish',
                            'order'               => $order,
                            'ignore_sticky_posts' => 1,
                            'tax_query'           => array(
                              array(
                                'taxonomy' => 'product_type',
                                'field'    => 'name',
                                'terms'    => $product_type,
                                'operator' => 'IN',
                              ),
                            ),
                          );
                        }

                        $query = new \WP_Query($args);

                        if ($query->have_posts()) :
                          while ($query->have_posts()) : $query->the_post();

                          $envato_product_preview_icon_url  =  get_post_meta(get_the_ID(), '_envato_product_preview_icon_url', true);

                        ?>
                            <li>
                              <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $envato_product_preview_icon_url ); ?>" alt="dot icon">
                                <?php echo wp_trim_words(get_the_title(), $title_limit, '... '); ?>
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
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <h6 class="title"><?php echo esc_html( $service_product_title ); ?></h6>
                    <nav>
                      <ul class="rbt-list has-link has-img">
                        <?php

                        
                    $args2 = array(
                      'posts_per_page'      => $service_posts_per_page,
                      'post_type'           => 'product',
                      'post_status'         => 'publish',
                      'order'               => $service_order,
                      'ignore_sticky_posts' => 1,
                      'tax_query'           => array(
                        array(
                          'taxonomy' => 'product_type',
                          'field'    => 'name',
                          'terms'    => $serviceproduct_type,
                          'operator' => 'IN',
                        ),
                      ),
                    );

                        $query2 = new \WP_Query($args2);

                        if ($query2->have_posts()) :
                          while ($query2->have_posts()) : $query2->the_post();
                        ?>
                            <li>
                              <a href="<?php the_permalink(); ?>">
                                <?php woocommerce_template_loop_product_thumbnail(); ?>
                                <?php echo wp_trim_words(get_the_title(), $service_product_title_limit, '... '); ?>
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
      </div>
    </div>
<?php
  }
}

Plugin::instance()->widgets_manager->register(new Rainbow_Contact_Form());
