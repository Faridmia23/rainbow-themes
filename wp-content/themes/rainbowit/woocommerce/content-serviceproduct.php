<?php 
    $rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
    $service_order_btn_title        = ( $rainbowit_options['order_btn_text'] ) ? $rainbowit_options['order_btn_text'] : '';
    $product_details_button_text    = ($rainbowit_options['details_btn_text']) ? $rainbowit_options['details_btn_text'] : '';
    $product_delivery_time          = get_post_meta( $post->ID, '_service_product_delivery_time', true );
    $product_total_jobs             = get_post_meta( $post->ID, '_service_product_total_jobs', true );
    $product_queue_item             = get_post_meta( $post->ID, '_service_product_queue_item', true );
    global $product;
    $product_id                     = $product->get_id();
    $rating                         = get_post_meta( $product_id, '_wc_average_rating', true ); 
?>
<div class="col-12 col-lg-6 col-xl-4 col-xxl-6 single-item sal-animate" data-sal="slide-up" data-sal-duration="400">
    <div class="rbt-card-3">
        <div class="card-body">
            <div class="card-left">
                <?php woocommerce_template_loop_product_thumbnail(); ?>
            </div>
            <div class="card-right">
                <div class="card-content">
                    <h6 class="title title-xm">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h6>
                    <div class="price rainbowit-price-custom">
                        <?php woocommerce_template_loop_price(); ?>
                    </div>
                </div>
                <div class="rbt-btn-group btn-gap-12">
                    <a data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-xm rbt-btn-primary rbt-btn-round  btn-primary-outline rbt-btn-xm hover-effect-1 ajax-order-now-product" style="cursor:pointer;" aria-describedby="some text">
                        <span><i class="fa-regular fa-cart-shopping"></i></span>
                        <?php echo esc_html($service_order_btn_title); ?>
                    </a>
                    <a href="<?php the_permalink(); ?>" class="rbt-btn rbt-btn-xm rbt-btn-round rbt-btn-xm hover-effect-2">
                        <span><i class="fa-regular fa-circle-info"></i></span>
                        <?php echo esc_html($product_details_button_text); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-bottom">
            <div class="card-meta">

                <?php if (isset($product_queue_item) && !empty($product_queue_item)) { ?>
                    <p class="single-meta">
                        <span><i class="fa-regular fa-forward"></i></span>
                        <span class="mark-with-primary"><?php echo esc_html($product_queue_item); ?></span> <?php echo esc_html__("in Queue", "rainbowit-core"); ?>
                    </p>
                <?php  } ?>
                <?php if (isset($product_delivery_time) && !empty($product_delivery_time)) { ?>
                    <p class="single-meta">
                        <span><i class="fa-sharp fa-regular fa-alarm-clock"></i></span>
                        <?php echo esc_html($product_delivery_time); ?>
                    </p>
                <?php  } ?>

                <?php if (isset($product_total_jobs) && !empty($product_total_jobs)) { ?>
                    <p class="single-meta">
                        <span><i class="fa-regular fa-suitcase"></i></span>
                        <?php echo esc_html($product_total_jobs); ?>
                    </p>
                <?php  } ?>
                <div class="review single-meta woocommerce">
                    <?php
                    woocommerce_template_loop_rating();
                    ?>
                    <?php if ($rating > 0) { ?>
                        <span class="rating-count">
                            <?php echo esc_html($rating); ?>
                            <span class="rbt-review-total">(Total<?php echo " "; ?>
                            <?php echo do_shortcode("[reviews_count id='" . $product_id . "']"); ?>)</span>
                        </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>