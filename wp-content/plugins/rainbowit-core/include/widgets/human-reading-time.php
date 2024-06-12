<?php

/**
 * @package Rainbowit
 */

if (!class_exists('Rainbowit_Reading_Time_Widget')) {
    class Rainbowit_Reading_Time_Widget extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {

            $widget_options = array(
                'description'                   => esc_html__('Rainbowit Reading Time', 'Rainbowit'),
                'customize_selective_refresh'   => true,
            );

            parent::__construct('Rainbowit_Reading_Time_Widget', esc_html__('Rainbowit Reading Time', 'Rainbowit'), $widget_options);
        }
        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            echo wp_kses_post($args['before_widget']);
            
            ?>
            <div class="rbt-progress d-none d-xl-block">
                <!-- progress timing -->
                <progress max="100" value="0"></progress>

                <div class="rbt-blog-read-time">
                    <span><i class="fa-regular fa-clock"></i></span>
                    <span><?php echo rainbowit_content_estimated_reading_time(get_the_content()); ?></span>
                </div>
            </div>
        <?php
            echo wp_kses_post($args['after_widget']);
        }
        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance)
        {
            $instance              = array();
            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
        
        }
    }
}
function Rainbowit_Reading_Time_Widget()
{
    register_widget('Rainbowit_Reading_Time_Widget');
}
add_action('widgets_init', 'Rainbowit_Reading_Time_Widget');
