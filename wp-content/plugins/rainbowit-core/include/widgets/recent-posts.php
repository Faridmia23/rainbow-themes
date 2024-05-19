<?php
/**
 * @package Rainbowit
 */
if( !class_exists('Rainbowit_Recent_Post') ){
    class Rainbowit_Recent_Post extends WP_Widget{
        /**
         * Register widget with WordPress.
         */
        function __construct(){

            $widget_options = array(
                'description'                   => esc_html__('Rainbowit: Popular Products', 'Rainbowit'),
                'customize_selective_refresh'   => true,
            );

            parent:: __construct('Rainbowit_Recent_Post', esc_html__( 'Rainbowit: Popular Products', 'Rainbowit'), $widget_options );

        }
        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance){

            if ( ! isset( $args['widget_id'] ) ) {

            $args['widget_id'] = $this->id;

        }
        
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts','Rainbowit' );
        
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $show_item = ( ! empty( $instance['show_item'] ) ) ? absint( $instance['show_item'] ) : 3;
        $num_title_word = ( ! empty( $instance['num_title_word'] ) ) ? absint( $instance['num_title_word'] ) : 7;

?>
            <?php 
            echo $args['before_widget']; 
            if( $title ): 
            echo $args['before_title'];  
            echo esc_html( $title );  
            echo $args['after_title']; 
            endif; 

                $posts = array(
                    'post_type' => 'product',
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => $show_item,
                    'ignore_sticky_posts' => 1
                );
                $posts = new WP_Query( $posts );
                

                ?>
                    <nav>
        <ul class="rbt-list has-link has-img">
               
                    <?php

                    while($posts->have_posts()) : $posts->the_post();  ?>

                        <li>
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                            <?php echo wp_trim_words( get_the_title(), $num_title_word,' '); ?>
                                <i class="fa-solid fa-arrow-up-right"></i>
                            </a>
                        </li>

                    <?php endwhile; ?>
                    </ul>
    </nav>

            <?php echo $args['after_widget']; ?>
            
            <?php wp_reset_postdata();
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
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['show_item'] = (int) $new_instance['show_item'];
            $instance['num_title_word'] = (int) $new_instance['num_title_word'];
            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */

        public function form( $instance ) {
        $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $show_item          = isset( $instance['show_item'] ) ? absint( $instance['show_item'] ) : 3;
        $num_title_word     = isset( $instance['num_title_word'] ) ? absint( $instance['num_title_word'] ) : 7;
      
    ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','Rainbowit' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'show_item' )); ?>"><?php echo esc_html__( 'No. of Item of posts to show:','Rainbowit' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'show_item' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_item' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($show_item); ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'num_title_word' )); ?>"><?php echo esc_html__( 'Title Word','Rainbowit' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'num_title_word' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_title_word' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($num_title_word); ?>" size="3">
        </p>
        
    <?php
        }
    }
}



// register Contact  Widget widget
function Rainbowit_Recent_Post(){
    register_widget('Rainbowit_Recent_Post');
}
add_action('widgets_init','Rainbowit_Recent_Post');
