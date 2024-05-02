<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Rainbowit_Elementor_Page_Overview extends Widget_Base
{

    use \Elementor\RainbowitElementCommonFunctions;

    public function get_name()
    {
        return 'rainbowit-page-overview';
    }

    public function get_title()
    {
        return esc_html__('Page Overview Sticky', 'rainbowit');
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
			'content_section',
			[
				'label' => esc_html__( 'Image Item', 'rainbowit' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__('Tab Title', 'rainbowit'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Overview', 'rainbowit'),
            ]
        );

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'rainbowit' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

       
		$this->end_controls_section();

    }

    protected function render($instance = [])
    {

        $settings       = $this->get_settings_for_display();

    ?>

    <div class="rbt-section-wrapper sticky-top ">
        <div class="container">
            <nav class="rbt-onepagenav">
                <ul class="rbt-onepage-nav">
                    <?php 
                    if(!empty($settings['list'])) { 
                        $count = 1;
                        foreach( $settings['list'] as $item ) { 

                            $tab_title = $item['tab_title'] ?? '';
                            $current = '';
                            if( $count == 1 ) {
                                $current = 'current';
                            }

                            $replace_title = str_replace(" ","-", $tab_title);

                            ?>
                        <li class="<?php echo esc_attr( $current ); ?>"><a href="#<?php echo esc_attr( strtolower( $replace_title ) ); ?>"><?php echo esc_html( $tab_title  ); ?></a></li>

                        <?php 
                        $count++; } 
                    } ?>

                </ul>
            </nav>
        </div>
    </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new Rainbowit_Elementor_Page_Overview());