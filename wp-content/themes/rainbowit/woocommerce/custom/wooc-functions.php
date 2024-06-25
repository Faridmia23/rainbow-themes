<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */


/*-------------------------------------
#. Theme supports for WooCommerce
---------------------------------------*/
function rainbowit_shop_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}



/*-------------------------------------
#. Custom functions used directly
---------------------------------------*/
function rainbowit_shop_get_template_parts( $template ){
    get_template_part( 'woocommerce/custom/template-parts/content', $template );
}


function rainbowit_shop_hide_page_title(){
    return false;
}

function rainbowit_shop_loop_shop_per_page(){
    $rainbowit_options 	= Rainbowit_Helper::rainbowit_get_options();
    if ($rainbowit_options['wc_num_product']){
        return $rainbowit_options['wc_num_product'];
    } else {
        return 8;
    }

}

function rainbowit_shop_wrapper_start() {
    rainbowit_shop_get_template_parts( 'shop-header' );
}

function rainbowit_shop_wrapper_end() {
    rainbowit_shop_get_template_parts( 'shop-footer' );
}

function rainbowit_shop_shop_topbar() {
    rainbowit_shop_get_template_parts( 'shop-top' );
}

function rainbowit_shop_loop_shop_columns(){
    $rainbowit_options 	= Rainbowit_Helper::rainbowit_get_options();
    if (!empty($rainbowit_options['wc_num_product_per_row'])){
        return $rainbowit_options['wc_num_product_per_row'];
    } else {
        return 4;
    }

}

function rainbowit_shop_loop_product_title(){
    echo '<h3><a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link">' . get_the_title() . '</a></h3>';
}

function rainbowit_shop_shop_thumb_area(){
    rainbowit_shop_get_template_parts( 'shop-thumb' );
}

function rainbowit_shop_shop_info_wrap_start(){
    echo '<div class="rbt-card-body p--24">';
}

function rainbowit_shop_shop_add_description(){
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        global $post;
        echo '<div class="shop-excerpt grid-hide"><div class="short-description">';
        the_excerpt();
        echo '</div></div>';
    }
}

function rainbowit_shop_shop_info_wrap_end(){
    echo '</div>';
}


function rainbowit_shop_render_sku(){
    rainbowit_shop_get_template_parts( 'product-sku' );
}

function rainbowit_shop_render_meta(){
    rainbowit_shop_get_template_parts( 'product-meta' );
}

function rainbowit_shop_show_or_hide_related_products(){
    $rainbowit_options 	= Rainbowit_Helper::rainbowit_get_options();
    // Show or hide related products
    if ( empty( $rainbowit_options['wc_related'] ) ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    }
}

function rainbowit_shop_hide_product_data_tab( $tabs ){

    $rainbowit_options 	= Rainbowit_Helper::rainbowit_get_options();


    if ( empty( $rainbowit_options['wc_description'] ) ) {
        unset( $tabs['description'] );
    }
    if ( empty( $rainbowit_options['wc_additional_info'] ) ) {
        unset( $tabs['additional_information'] );
    }
    return $tabs;
}

function rainbowit_shop_product_review_form( $comment_form ){
    $commenter = wp_get_current_commenter();

    $comment_form['fields'] = array(
        'author' => '<div class="row"><div class="col-sm-6"><div class="comment-form-author form-group"><input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name *', 'rainbowit' ) . '" required /></div></div>',
        'email'  => '<div class="comment-form-email col-sm-6"><div class="form-group"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email *', 'rainbowit' ) . '" required /></div></div></div>',
    );

    $comment_form['comment_field'] = '';

    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
        $comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'rainbowit' ) .'</label>
		<select name="rating" id="rating" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'rainbowit' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'rainbowit' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'rainbowit' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'rainbowit' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'rainbowit' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'rainbowit' ) . '</option>
			</select></p>';
    }

    $comment_form['comment_field'] .= '<div class="col-sm-12 p-0"><div class="form-group comment-form-comment"><textarea id="comment" name="comment" class="form-control" placeholder="' . esc_attr__( 'Your Review *', 'rainbowit' ) . '" cols="45" rows="8" required></textarea></div></div>';

    return $comment_form;
}

function rainbowit_shop_show_or_hide_cross_sells(){
    // Show or hide related cross sells
    $rainbowit_options 	= Rainbowit_Helper::rainbowit_get_options();
    if ( !empty($rainbowit_options['wc_cross_sell'] ) ) {
        add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
    }
}



/**
 * Change the breadcrumb separator
 */
function rainbowit_change_breadcrumb_delimiter( $defaults ) {
    $separator          = '';
    $defaults['delimiter'] = '<li class="rbt-breadcrumb-item icon"><i class="fa-regular fa-chevron-right"></i></li>';
    $defaults['wrap_before'] = '<ul class="page-list shop-breadcrumb pages-info mb--5">';
    $defaults['wrap_after'] = '</ul>';
    $defaults['before'] = '<li class="rbt-breadcrumb-item">';
    $defaults['after'] = '</li>';
    $defaults['home'] = esc_html__('Home', 'rainbowit');
    return $defaults;
}


add_filter( 'woocommerce_output_related_products_args', 'rainbowit_change_number_related_products', 9999 );

function rainbowit_change_number_related_products( $args ) {
    $args['posts_per_page'] = 3; // # of related products
    $args['columns'] = 3; // # of columns per row
    return $args;
}


/**
 * Fragments cart contents count
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'rainbowit_woocommerce_header_add_to_cart_fragment' );
function rainbowit_woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="rbt-cart-count"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
    <?php
    $fragments['span.rbt-cart-count'] = ob_get_clean();
    return $fragments;
}

function reviews_count_func( $atts = '') {
	// Make sure an ID was passed,
	if ( ! empty( $atts['id'] && function_exists( 'wc_get_product' ) ) ) {
		// Get a WC_Product object for the product.
		$product = wc_get_product( (int) $atts['id'] );
		// Return the review count.
		$total_rating = $product->get_review_count();

		if( $total_rating < 10 ) {
			$total_rating = '0'.$total_rating;
			return $total_rating;
		}

		return $total_rating;
	}
}

add_shortcode( 'reviews_count', 'reviews_count_func', 10, 1 );

// shop rating functino

add_action("woocommerce_after_shop_loop_item_title",'rainbowit_woocommerce_after_shop_loop_item_title',5);

function rainbowit_woocommerce_after_shop_loop_item_title() {
    global $product;
    $rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

    if( $rainbowit_own_product_checkbox == 'yes' ) {

        $rating            	= get_post_meta( get_the_ID(), '_wc_average_rating', true ); 
        $review_count 	    =  $product->get_review_count();

    } else {
        $rating 	    =  get_post_meta( get_the_ID(), '_envato_product_avg_rating', true );
        $review_count 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true );
    } 

    $tags = wp_get_post_terms($product->get_id(), 'product_tag');

    if (!empty($tags) && isset($tags[0])) {
        $tag = $tags[0];
        $tag_link = get_term_link($tag);
    }

    ?>

    <div class="rbt-card-meta woocommerce">
        <?php if (!empty($tags) && isset($tags[0])) { ?>
            <div class="rbt-categories">
                <a  href="<?php echo esc_url( esc_url($tag_link) ); ?>" class="category"><?php echo esc_html( $tags[0]->name );?></a>
            </div>
            <?php } 
            if( $rating > 0  ) { ?>
            <div class="review">
                    <?php if ( $rating ) : ?>
                    <?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $rating).'"><span style="width:'.( ( $rating / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$rating.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>'; ?>
                <?php endif; ?>
                
                
                <?php if( $rating > 0 ) { ?>
                <span class="rating-count">(<?php 
                    echo $review_count?>)
                </span>
                <?php } ?>
            </div>
            <?php } ?>
    </div>
    <?php
}

add_action('woocommerce_shop_loop_item_title', function() { ?>
    <h3 class="title">
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h3>
    <?php
},10);

add_action("woocommerce_after_shop_loop_item_title",function() { 

   global $product;
   $rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

    if( $rainbowit_own_product_checkbox == 'yes' ) {
        $envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);

    } else {
        $envato_product_total_sales 	=  get_post_meta( get_the_ID(), '_envato_product_total_sales', true );
    }

    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    if ($regular_price > 0) {
    ?>
    <div class="rbt-card-bottom">
        <div class="sales">

            <div class="price">
                <?php
                if (!empty($sale_price) &&  $sale_price > 0) {
                    echo '<div class="off-price">' . wc_price($regular_price) . '</div>';
                    echo '<div class="current-price">' . wc_price($sale_price) . '</div>';
                } else {
                    if ($regular_price > 0) {

                        echo '<div class="current-price">' . wc_price($regular_price) . '</div>';
                    }
                }
                ?>
            </div>

            <?php if (!empty($envato_product_total_sales)) { ?>
                <span class="sales-count"><?php echo esc_html($envato_product_total_sales); ?> <?php echo esc_html__("sales", "rainbowit"); ?></span>
            <?php } ?>
        </div>
    <?php } ?>
    <?php
}, 10 );

add_action("woocommerce_after_shop_loop_item", function() {
    $rainbowit_options          	=  Rainbowit_Helper::rainbowit_get_options();
    $rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);
    if( $rainbowit_own_product_checkbox == 'yes' ) {
        $envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
    } else {
        $envato_product_preview_url 	=  get_post_meta( get_the_ID(), '_envato_product_preview_url', true );
    }

    $service_product_checkbox = get_post_meta( get_the_ID(), "rainbowit_service_product_checkbox", true );

    $preview_btn_text 				=  isset( $rainbowit_options['preview_btn_text'] ) ? $rainbowit_options['preview_btn_text'] : '';
    $service_order_btn_title        = ( $rainbowit_options['order_btn_text'] ) ? $rainbowit_options['order_btn_text'] : '';
    global $post;
    $plan_product_enable = '';
    if (class_exists('acf')) {
        $plan_product_enable = get_field('plan_product_enable', $post->ID);

    }


    ?>
    <div class="rbt-card-btn">
            <?php if( $service_product_checkbox == 'yes' || $plan_product_enable == 'enable') { ?>
                <a data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-sm hover-effect-1 btn-border-secondary ajax-order-now-product" style="cursor:pointer;">
                    <span><i class="fa-regular fa-cart-shopping"></i></span>
                    <?php echo esc_html( $service_order_btn_title ); ?>
                </a>
            <?php } else { ?>
            <a href="<?php echo esc_url( $envato_product_preview_url );?>" class="rbt-btn rbt-btn-sm hover-effect-1 btn-border-secondary ">
                <span><i class="fa-sharp fa-regular fa-eye"></i></span>
                <?php echo esc_html($preview_btn_text); ?>
            </a>
            <?php } 
                woocommerce_template_loop_add_to_cart(); 
            
            ?>
        </div>
    </div>
    <?php 
}, 10 );