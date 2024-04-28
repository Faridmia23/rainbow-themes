<?php

/**
 * @package Rainbowit
 */

if (!class_exists('Rainbowit_Footer_Logo_Widget')) {
    class Rainbowit_Footer_Logo_Widget extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {

            $widget_options = array(
                'description'                   => esc_html__('Rainbowit Logo Widget', 'Rainbowit'),
                'customize_selective_refresh'   => true,
            );

            parent::__construct('Rainbowit_Footer_Logo_Widget', esc_html__('Rainbowit Logo Widget', 'Rainbowit'), $widget_options);
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
            if (!empty($instance['title'])) {
                echo wp_kses_post($args['before_title']) . apply_filters('widget_title', esc_html($instance['title'])) . wp_kses_post($args['after_title']);
            }
            $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
            $content = isset($instance['content']) ? $instance['content'] : '';
?>
            <?php
            if (!empty($image)) { ?>
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">

                        <img class="logo-light" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr('Logo'); ?>">
                    </a>
                </div>
            <?php  }
            ?>
            <?php if (!empty($content)) : ?>
                <div class="rbt-section-title section-title-left mb--0">
                    <p class="description-2 text-start ">
                        <?php echo $content; ?>
                    </p>
                </div>
            <?php endif ?>
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
            $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
            $instance['content']   = (!empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';
            if (current_user_can('unfiltered_html')) {
                $instance['content'] = $new_instance['content'];
            } else {
                $instance['content'] = wp_kses_post($new_instance['content']);
            }
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
            $image = !empty($instance['image']) ? $instance['image'] : '';
            $content = !empty($instance['content']) ? $instance['content'] : '';
        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
                <button class="upload_image_button button button-primary" style="margin-top: 15px;"><?php _e("Upload Image","rainbowit");?></button>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php echo esc_html__('Content:', 'Rainbowit') ?></label>
                <textarea id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" rows="7" class="widefat"><?php echo esc_textarea($content); ?></textarea>
            </p>
<?php
        }
    }
}
function Rainbowit_Footer_Logo_Widget()
{
    register_widget('Rainbowit_Footer_Logo_Widget');
}
add_action('widgets_init', 'Rainbowit_Footer_Logo_Widget');
