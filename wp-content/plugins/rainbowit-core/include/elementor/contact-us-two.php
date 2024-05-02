<?php
namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbow_Contact_Form2 extends Widget_Base
{
  use \Elementor\RainbowitElementCommonFunctions;

  public function get_name()
  {
    return 'rainbow-contact-form';
  }

  public function get_title()
  {
    return __('Contact Form 2', 'rainbowit');
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

    $this->add_control(
      'section_id',
      [
          'label' => esc_html__('Section Id Name', 'rainbowit'),
          'type' => Controls_Manager::TEXT,
          'default' => esc_html__('contact', 'rainbowit'),
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

    $this->add_control(
      'shortcode',
      [
        'label'       => esc_html__('Shortcode', 'rainbowit'),
        'type'        => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'placeholder' => esc_html__('Shortcode', 'rainbowit'),
      ]
    );

    $this->end_controls_section();
  }
  protected function render()
  {

    $settings        = $this->get_settings();
    $sub_title       = $settings['sub_title'];
    $heading_title   = $settings['heading_title'];
    $shortcode       = $settings['shortcode'];
    $section_id      = $settings['section_id'];


?>
    <div class="rbt-section-gapBottom rbt-section-gapTop rbt-section-wrapper-4" id="<?php echo esc_attr( $section_id ); ?>">
      <div class="container">
        <div class="rbt-section-title section-title-center" data-sal="slide-up" data-sal-duration="400">
        <span class="subtitle"><?php echo esc_html( $sub_title ); ?></span>
        <<?php echo esc_html($settings['sec_title_tag']); ?> class="title"><?php echo $heading_title; ?></<?php echo $settings['sec_title_tag']; ?>>
        </div>

        <div class="rbt-form-wrapper mx-auto mt--30 radius-lg">
          <?php echo do_shortcode( $shortcode ); ?>
        </div>
      </div>
    </div>

<?php
  }
}
Plugin::instance()->widgets_manager->register(new Rainbow_Contact_Form2());
