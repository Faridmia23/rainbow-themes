<?php

/**
 * @package Rainbowit
 */

if (!class_exists('Rainbowit_Single_Quote_Widget')) {
    class Rainbowit_Single_Quote_Widget extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {

            $widget_options = array(
                'description'                   => esc_html__('Single Quote Widget', 'Rainbowit'),
                'customize_selective_refresh'   => true,
            );

            parent::__construct('Rainbowit_Single_Quote_Widget', esc_html__('Single Quote Widget', 'Rainbowit'), $widget_options);
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
            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'exclusive','Rainbowit' );
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
            $content = isset($instance['content']) ? $instance['content'] : '';
            $btn_text = isset($instance['btn_text']) ? $instance['btn_text'] : '';
            $btn_url = isset($instance['btn_url']) ? $instance['btn_url'] : '#';
?>
            <div class="elevate-with-rbt elevate-with-rbt-2 d-none d-xxl-block" style="background:url('<?php echo esc_url($image); ?>'),var(--gradient-dark)">
                <div class="banner-content-wrapper" >
                    <div class="content ps-4">
                        <span class="nav-badge m-0"><?php echo esc_html($title);?></span>
                        <h3 class="sidebar-title text-white ">
                        <?php echo esc_html($content);?>
                        </h3>
                        <a href="<?php echo esc_url($btn_url);?>" class="rbt-btn rbt-btn-secondary rbt-btn-round rbt-btn-xm">
                            <?php echo esc_html($btn_text);?>
                            <span><i class="fa-solid fa-arrow-up-right"></i></span>
                        </a>
                    </div>
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
            $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
            $instance['content']   = (!empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['btn_text'] = sanitize_text_field( $new_instance['btn_text'] );
            $instance['btn_url'] = sanitize_text_field( $new_instance['btn_url'] );
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
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $btn_text              = isset( $instance['btn_text'] ) ? esc_attr( $instance['btn_text'] ) : '';
            $btn_url              = isset( $instance['btn_url'] ) ? esc_attr( $instance['btn_url'] ) : '';
            $image = !empty($instance['image']) ? $instance['image'] : '';
            $content = !empty($instance['content']) ? $instance['content'] : '';
        ?>
            <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','Rainbowit' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p>
                <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
                <button class="upload_image_button button button-primary" style="margin-top: 15px;"><?php _e("Upload Image","rainbowit");?></button>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php echo esc_html__('Content:', 'Rainbowit') ?></label>
                <textarea id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" rows="7" class="widefat"><?php echo esc_textarea($content); ?></textarea>
            </p>
            <p><label for="<?php echo esc_attr($this->get_field_id( 'btn_text' )); ?>"><?php echo esc_html__( 'Button Text:','Rainbowit' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'btn_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'btn_text' )); ?>" type="text" value="<?php echo esc_attr($btn_text); ?>" /></p>
            <p><label for="<?php echo esc_attr($this->get_field_id( 'btn_url' )); ?>"><?php echo esc_html__( 'Button Url:','Rainbowit' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'btn_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'btn_url' )); ?>" type="text" value="<?php echo esc_attr($btn_url); ?>" /></p>
            
<?php
        }
    }
}
function Rainbowit_Single_Quote_Widget()
{
    register_widget('Rainbowit_Single_Quote_Widget');
}
add_action('widgets_init', 'Rainbowit_Single_Quote_Widget');
