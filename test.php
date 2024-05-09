<?php
// Woocommerce Single Page


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


add_action('woocommerce_before_main_content', 'themename_before_main_content', 10);
function themename_before_main_content()
{
    if (!is_home() && !is_front_page()) {
?>

        <!-- Page Banner Section -->
        <section class="page-title">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title-box">
                        <h1><?php woocommerce_page_title(); ?></h1>
                    </div>
                    <div class="bread-crumb clearfix"><?php woocommerce_breadcrumb(); ?></div>
                </div>
            </div>
        </section>

        <!--End Banner Section -->
    <?php
    }
}


function themename_quantity_input_max_callback($max, $product)
{
    $max = 1000;
    return $max;
}


add_filter('woocommerce_quantity_input_max', 'themename_quantity_input_max_callback', 10, 2);

add_action('woocommerce_before_single_product', 'themename_woocommerce_before_single_product', 20);

function themename_woocommerce_before_single_product()
{
?>
<section class="shop-details sec-pad">
<div class="auto-container">
<?php
}

add_action('woocommerce_before_single_product_summary', 'themename_before_single_product_summery', 10);

function themename_before_single_product_summery()
{
?>

<div class="product-details-content">
<div class="row align-items-center clearfix">

<?php
}


add_action('woocommerce_after_single_product_summary', 'themename_after_single_product_summery', 10);

function themename_after_single_product_summery()
{
?>

</div>
</div>

<div class="product-discription">
<div class="tabs-box">

<?php
    woocommerce_output_product_data_tabs();
?>
</div>
</div>

<?php
}



add_action('woocommerce_single_product_summary', 'themename_template_single_title', 5);

function themename_template_single_title()
{
    global $product;
    $id = $product->get_id();
?>
<h2><?php the_title(); ?></h2>
<div class="rating-box clearfix">
<?php woocommerce_template_single_rating(); ?>
</div>
<div class="item-price">
<h3><?php echo wp_kses($product->get_price_html(), 'code_context'); ?></h3>
</div>

<div class="text"><?php the_excerpt(); ?></div>

<?php
    woocommerce_template_single_meta();
?>

<?php woocommerce_template_single_add_to_cart(); ?>
</div>

<?php

}




add_action('woocommerce_after_single_product_summary', 'themename_related_after_single_product_summary', 10);

function themename_related_after_single_product_summary()
{
?>
<?php
    global $product;
    $related = wc_get_related_products($product->get_id());
?>
<?php
    if (count($related) > 0) {
?>
<div class="related-product">
<div class="sec-title style-two centred">
<h4><?php esc_html_e('Related Products', 'themename'); ?></h4>
</div>
<div class="row clearfix">
<?php themename_output_related_products(); ?>
</div>
</div>
<?php } ?>

<?php
}

add_filter('woocommerce_output_related_products', 'themename_output_related_products', 10, 1);

function themename_output_related_products()
{
    global $product;

    $related_products = array_filter(array_map('wc_get_product', wc_get_related_products($product->get_id(), 4, $product->get_upsell_ids())), 'wc_products_array_filter_visible');
?>
<?php foreach ($related_products as $related_product) : ?>
<div class="col-lg-3 col-md-6 col-sm-12 product-block">
<?php
        $post_object = get_post($related_product->get_id());

        setup_postdata($GLOBALS['post'] = &$post_object);

        wc_get_template_part('content', 'relproduct');
?>
</div>
<?php endforeach; ?>

<?php
}





add_action('woocommerce_after_single_product', 'themename_woocommerce_after_single_product', 20);

function themename_woocommerce_after_single_product()
{
?>
</div>
</section>
<?php
}



if (!function_exists('themename_product_comments')) {

    function themename_product_comments($comment, $args, $depth)
    {
        extract($args, EXTR_SKIP);
        $args['reply_text'] = esc_html__('Reply', 'themename');
        $class              = '';
        if ($depth > 1) {
            $class = '';
        }
        if ($depth == 1) {
            $child_html_el     = '<ul><li>';
            $child_html_end_el = '</li></ul>';
        }

        if ($depth >= 2) {
            $child_html_el     = '<li>';
            $child_html_end_el = '</li>';
        }

        global $comment;
        $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));

?>

<div class="comment" id="comment-<?php comment_ID(); ?>">

<figure class="customer-thumb">
<?php print get_avatar($comment, 115, null, null, array('class' => array())); ?>
</figure>
<div class="info clearfix">
<h4><?php echo get_comment_author_link(); ?>,</h4>
<span><?php echo get_comment_date(); ?></span>
</div>
<div class="rating clearfix">
<?php
        if ($rating && wc_review_ratings_enabled()) {
            echo wc_get_rating_html($rating); // WPCS: XSS ok.
        }
?>
</div>
<p><?php comment_text(); ?></p>

</div>

<?php
    }
}