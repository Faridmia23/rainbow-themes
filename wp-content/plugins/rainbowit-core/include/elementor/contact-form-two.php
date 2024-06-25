<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbow_Contact_Form_two extends Widget_Base
{
  use \Elementor\RainbowitElementCommonFunctions;

  public function get_name()
  {
    return 'rainbow-contact-form-two2';
  }

  public function get_title()
  {
    return __('Contact Us Form 2', 'rainbowit');
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
  }
  protected function render()
  {

    $settings        = $this->get_settings();


?>
    <div class="rbt-section-wrapper">
      <div class="rbt-form-wrapper contact-form-wrapper rbt-form-wrapper-customcss">
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
<?php
  }
}

Plugin::instance()->widgets_manager->register(new Rainbow_Contact_Form_two());
