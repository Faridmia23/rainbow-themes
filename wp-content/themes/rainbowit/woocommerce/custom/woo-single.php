<?php
// Woocommerce Single Page
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_title", 5);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_rating", 10);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_price", 10);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_excerpt", 20);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_add_to_cart", 30);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_meta", 40);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_sharing", 50);
remove_action("woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs", 10);
remove_action("woocommerce_after_single_product_summary", "woocommerce_output_related_products", 20);
add_action("woocommerce_before_single_product", "rainbowit_woocommerce_before_single_product", 20);
add_action('woocommerce_before_main_content', 'rainbowit_before_main_content', 5);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_shortcode( 'reviews_count', 'reviews_count_func3', 10, 1 );




function rainbowit_before_main_content()
{
	global $post;
	
	$product_id = get_the_ID();
	$product = wc_get_product( $product_id );

							
	$service_product_checkbox = get_post_meta( get_the_ID(), "rainbowit_service_product_checkbox", true );

	if (!is_home() && !is_front_page() && !is_shop()) {

		$rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

		if( $rainbowit_own_product_checkbox == 'yes' ) {
			$envato_product_last_update 		=  get_post_meta( get_the_ID(), '_own_product_last_update', true);
			$envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
			$envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);
			$envato_product_preview_icon_url 	=  get_post_meta( get_the_ID(), '_own_product_image_file', true);
		} else {
			$envato_product_last_update 	=  get_post_meta( get_the_ID(), '_envato_product_last_update', true);
			$envato_product_avg_rating 		=  get_post_meta( get_the_ID(), '_envato_product_avg_rating', true);
			$envato_product_total_rating 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true);
			$envato_product_preview_url 	=  get_post_meta( get_the_ID(), '_envato_product_preview_url', true);
			$envato_product_total_sales 	=  get_post_meta( get_the_ID(), '_envato_product_total_sales', true);
			$envato_product_preview_icon_url  =  get_post_meta(get_the_ID(), '_envato_product_preview_icon_url', true);
		}
		

		
		$envato_product_avg_rating 		  =  get_post_meta(get_the_ID(), '_envato_product_avg_rating', true);
		$envato_product_total_rating 	  =  get_post_meta(get_the_ID(), '_envato_product_total_rating', true);
		$last_update_date 				  = new DateTime($envato_product_last_update);
		$envato_product_last_update 	  = $last_update_date->format('j F y');


		if( $service_product_checkbox == 'yes' && is_product() ) {
		?>
			<div class="rbt-section-bgCommon">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="breadcrumb text-center pt--175">
								<div class="rbt-section-title">
									<h2 class="title title-xl">
										<?php the_title(); ?>
									</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}

		if ($service_product_checkbox != 'yes' && is_product() ) {
			$thumbnail_id = get_post_thumbnail_id(get_the_ID());

    		$image_url = wp_get_attachment_url($thumbnail_id);
			$rating                         = get_post_meta( get_the_ID(), '_wc_average_rating', true );  
			$own_product_feature_list       = get_post_meta( get_the_ID(), 'own_product_feature_list', true );    

?>
			<!--End Banner Section -->

			<div class="rbt-section-wrapper-4 pt--140 pb--60">
				<div class="container">
					<div class="row row--12 row-gap-4 ">
						<div class="col-12 col-md-6 col-lg-6 col-xl-6 ms-auto">
							<div class="rbt-product-breadcrumb">
								<?php if( isset($envato_product_preview_icon_url) && !empty($envato_product_preview_icon_url)) { ?>
								<img class="product-thumbnail" src="<?php echo esc_url($envato_product_preview_icon_url); ?>" alt="product icon">
								<?php } ?>
								<div class="product-breadcrumb">
									<?php rainbowit_breadcrumbs(); ?>
									<h5 class="rbt-product-name"><?php the_title(); ?></h5>
								</div>
							</div>
							<div class="rbt-preview-card">
								<div class="card-top">
									<div class="dot"></div>
									<div class="dot"></div>
									<div class="dot"></div>
								</div>
								<div class="rbt-preview-product">
									<a class="rbt-preview-overlay" href="<?php echo esc_url($envato_product_preview_url); ?>" target="_blank">
										<div class="preview-btn">
											<span class="preview-icon">
												<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M42.5 0.5C44.4688 0.572917 46.1094 1.26562 47.4219 2.57812C48.7344 3.89062 49.4271 5.53125 49.5 7.5V42.5C49.4271 44.4688 48.7344 46.1094 47.4219 47.4219C46.1094 48.7344 44.4688 49.4271 42.5 49.5H7.5C5.53125 49.4271 3.89062 48.7344 2.57812 47.4219C1.26562 46.1094 0.572917 44.4688 0.5 42.5V7.5C0.572917 5.53125 1.26562 3.89062 2.57812 2.57812C3.89062 1.26562 5.53125 0.572917 7.5 0.5H42.5ZM38.125 31.125V15.375C38.125 14.3542 37.7969 13.5156 37.1406 12.8594C36.4844 12.2031 35.6458 11.875 34.625 11.875H18.875C17.8542 11.875 17.0156 12.2031 16.3594 12.8594C15.7031 13.5156 15.375 14.3542 15.375 15.375C15.375 16.3958 15.7031 17.2344 16.3594 17.8906C17.0156 18.5469 17.8542 18.875 18.875 18.875H26.2031L12.8594 32.1094C12.2031 32.8385 11.875 33.6771 11.875 34.625C11.875 35.5729 12.2031 36.4115 12.8594 37.1406C13.5885 37.7969 14.4271 38.125 15.375 38.125C16.3229 38.125 17.1615 37.7969 17.8906 37.1406L31.125 23.7969V31.125C31.125 32.1458 31.4531 32.9844 32.1094 33.6406C32.7656 34.2969 33.6042 34.625 34.625 34.625C35.6458 34.625 36.4844 34.2969 37.1406 33.6406C37.7969 32.9844 38.125 32.1458 38.125 31.125Z" fill="white" />
												</svg>
											</span>
											<span><?php echo esc_html__("Live Priview", "rainbowit"); ?></span>
										</div>
									</a>
									<div class=" product-images border-0 mt-0 pt-0  woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1;">
										<div class="woocommerce-product-gallery__wrapper">
											<img src="<?php echo esc_url($image_url);?>" alt="fearture image"/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-6 col-xl-4 me-auto">
							<div class="rbt-cart">
								<div class="rbt-cart-top">
									<h6 class="product-license">
										<?php echo esc_html__("Regular License", "rainbowit"); ?>
									</h6>
									<div class="rbt-product-price">
									<?php
										
										$product2 		= wc_get_product(get_the_ID());
										$regular_price  = $product2->get_regular_price();
										$sale_price     = $product2->get_sale_price();

										if ( $sale_price ) {
											echo '<div class="off-price">' . wc_price( $regular_price ) . '</div>';
											echo '<div class="current-price">' . wc_price( $sale_price ) . '</div>';
											} else {
											echo '<div class="current-price">' . wc_price( $regular_price ) . '</div>';
										} 
									?>
									</div>
								</div>
								<div class="rbt-cart-body">
									<?php if( $rainbowit_own_product_checkbox != 'yes') { ?>
									<ul class="rbt-list rbt-list-2">
										<li>
											<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
											<span><?php echo esc_html__("Quality checked by Envato", "rainbowit"); ?></span>
										</li>
										<li>
											<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
											<span><?php echo esc_html__("6 months support from Rainbow-Themes", "rainbowit"); ?></span>
										</li>
										<li>
											<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
											<span><?php echo esc_html__("Lifetime Future updates", "rainbowit"); ?></span>
										</li>
									</ul>
									<?php } else { ?>
										<?php 
											$sentences = explode("\n", $own_product_feature_list);

											?>
											
												<ul class="rbt-list rbt-list-2">
													<?php foreach($sentences as $value ) { ?>
													<li>
														<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
														<span><?php echo $value;?></span>
													</li>
													<?php } ?>
												</ul>	
									<?php } ?>
								</div>
								<div class="rbt-product-meta">
									<?php if( $envato_product_total_sales > 0 ) { ?>
									<div class="single-meta">
										<h6 class="meta-name"><?php echo esc_html__("Total Sales :", "rainbowit"); ?></h6>
										<span class="meta-info meta-badge"><?php echo esc_html($envato_product_total_sales); ?></span>
									</div>
									<?php } ?>
									<div class="single-meta">
										<h6 class="meta-name"><?php echo esc_html__("Updated :", "rainbowit"); ?></h6>
										<span class="meta-info"><?php echo esc_attr($envato_product_last_update); ?></span>
									</div>
								</div>
								<div class="rbt-btn-group btn-gap-12">
									<?php 
									global $product;

									$external_url = get_post_meta( get_the_ID(), '_product_url', true );
									if( !empty($external_url) && $rainbowit_own_product_checkbox != 'yes') {
										?>
									
									<a href="<?php echo esc_url( $external_url );?>" class="rbt-btn rbt-btn-md rbt-btn-success">
									<span>
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g id="envato1">
											<path id="Vector" d="M17.6384 3.1385C17.103 2.84581 15.5686 3.02679 13.7258 3.58902C10.5006 5.76166 7.77868 8.96262 7.58859 14.103C7.55407 14.226 7.23608 14.0862 7.17307 14.0482C6.30209 12.403 5.95706 10.6706 6.68434 8.17145C6.81993 7.94906 6.37654 7.67543 6.2971 7.75332C6.13737 7.91114 5.47208 8.60967 5.03014 9.36517C2.83938 13.1105 4.27188 17.9094 8.10478 20.0097C11.9366 22.1131 16.7755 20.7562 18.9091 16.9784C21.3775 12.6184 19.0854 3.9348 17.6384 3.1385Z" fill="white"></path>
										</g>
									</svg>
								</span>
									Buy on Envato
								</a>
								<?php } else { ?>
										
									<a  data-redirect_url="<?php echo wc_get_checkout_url(); ?>" data-product_id="<?php echo esc_attr(get_the_ID()); ?>" class="rbt-btn rbt-btn-md rbt-btn-success woocommerce-own-product ajax-order-now-product"><span><i class="fa-regular fa-cart-shopping"></i></span>
									Buy Now
								</a>
								<?php } ?>

									<a href="<?php echo esc_url($envato_product_preview_url); ?>" class="rbt-btn rbt-btn-md hover-effect-1">
										<span>
											<i class="fa-sharp fa-regular fa-eye"></i>
										</span>
										<?php echo esc_html__("Preview", "rainbowit"); ?>
									</a>
								</div>
								<?php if( $service_product_checkbox != 'yes' && $envato_product_total_rating >= 3 ) { ?>
								<div class="cart-bottom">
									<div class="review">
										<span class="review-text"><?php echo esc_html__("Reviews", "rainbowit"); ?></span>
										<div class="rating">
											<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
											<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
											<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
											<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
											<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
										</div>
										<span class="rating-avg"><?php echo esc_attr($envato_product_avg_rating); ?></span>
										<span class="rating-count badge"><?php echo esc_attr($envato_product_total_rating); ?> <?php echo esc_html__("(Total)", "rainbowit"); ?></span>
									</div>
								</div>
								<?php } else { 
									 if( $rating > 0 ) { ?>
									
									<div class="cart-bottom">
										<div class="review">
											<span class="review-text"><?php echo esc_html__("Reviews", "rainbowit"); ?></span>
												<?php if ( $rating ) : ?>
												<?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $rating).'"><span style="width:'.( ( $rating / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$rating.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>'; ?>
											<?php endif; ?>
											
                                        	
											<?php if( $rating > 0 ) { ?>
											<span class="rating-count">
											<?php echo esc_html( $rating ); ?>
											<span class="rbt-review-total">(Total<?php echo " ";?><?php 
												echo do_shortcode( "[reviews_count id='".$product_id ."']");
											?>)</span>
											
											</span>
											<?php } ?>
										</div>
									</div>
								<?php } } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		}
	}
}

function rainbowit_woocommerce_before_single_product()
{
	global $product;
	global $post;

	
							
	$service_product_checkbox = get_post_meta($post->ID, "rainbowit_service_product_checkbox", true);
	if ($service_product_checkbox != 'yes') { ?>
		<div class="pt--55 rbt-section-gap2Bottom">
		<?php } else { ?>
			<div class="rbt-section-gapBottom mt_dec--205">
			<?php } ?>
			<div class="container">
			<?php
		}

		add_action("woocommerce_before_single_product_summary", "rainbowit_before_single_product_summery", 10);
		function rainbowit_before_single_product_summery()
		{
			global $product;
			global $post;
			$service_product_checkbox = get_post_meta($post->ID, "rainbowit_service_product_checkbox", true);
			?>
				<div class="row row--12">
					<div class="col-10 col-md-10 col-xl-10 mx-auto ">
						<?php woocommerce_output_all_notices(); ?>
					</div>
					<?php if ($service_product_checkbox != 'yes') { ?>
						<div class="col-12 col-md-12 col-lg-7 col-xl-6 ms-auto">
						<?php } else { ?>
							<div class="col-12 col-md-7 col-xl-6 ms-auto order-2 order-md-1">
								<div class="row align-items-center clearfix">
								<?php
							}
						}

						add_action("woocommerce_after_single_product_summary", "rainbowit_after_single_product_summery", 9);

						function rainbowit_after_single_product_summery()
						{
							global $post;
							global $product;
							$product_delivery_time 			= get_post_meta($post->ID, "_service_product_delivery_time", true);
							$product_total_jobs 			= get_post_meta($post->ID, "_service_product_total_jobs", true);
							$product_queue_item 			= get_post_meta($post->ID, "_service_product_queue_item", true);
							$rainbowit_options 				= Rainbowit_Helper::rainbowit_get_options();
							$single_product_banner_tagline 	= isset( $rainbowit_options["single_product_banner_tagline"] ) ? $rainbowit_options["single_product_banner_tagline"] : '';
							$single_product_heading_title 	= isset( $rainbowit_options["single_product_heading_title"] ) ? $rainbowit_options["single_product_heading_title"] : '';
							$single_product_btn_title 		= isset( $rainbowit_options["single_product_btn_title"] ) ? $rainbowit_options["single_product_btn_title"] : '';
							$single_product_btn_quote_link 	= isset( $rainbowit_options["single_product_btn_quote_link"] ) ? $rainbowit_options["single_product_btn_quote_link"] : '';
							$single_product_vat_text_change = isset( $rainbowit_options["single_product_vat_text_change"] ) ? $rainbowit_options["single_product_vat_text_change"] : '';

							// own product variable

							$rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

							if( $rainbowit_own_product_checkbox == 'yes' ) {
								$envato_product_last_update 		=  get_post_meta( get_the_ID(), '_own_product_last_update', true);
								$envato_product_published_date 	=  get_post_meta( get_the_ID(), '_own_product_published_date', true);
								$envato_product_compatable_with 	=  get_post_meta( get_the_ID(), '_own_product_compatable_with', true);
								$envato_product_column 			=  get_post_meta( get_the_ID(), '_onw_product_column', true);
								$envato_product_preview_url 		=  get_post_meta( get_the_ID(), '_own_product_preview_url', true);
								$envato_product_total_sales 		=  get_post_meta( get_the_ID(), '_own_product_total_sales', true);
								$product_documentation_link 		=  get_post_meta( get_the_ID(), '_onw_product_documentation_link', true);
							} else {
								$envato_product_last_update 	=  get_post_meta( get_the_ID(), '_envato_product_last_update', true);
								$envato_product_published_date 	=  get_post_meta( get_the_ID(), '_envato_product_published_date', true);
								$envato_product_compatable_with =  get_post_meta( get_the_ID(), '_envato_product_compatable_with', true);
								$envato_product_column 			=  get_post_meta( get_the_ID(), '_envato_product_column', true);
								$envato_product_avg_rating 		=  get_post_meta( get_the_ID(), '_envato_product_avg_rating', true);
								$envato_product_total_rating 	=  get_post_meta( get_the_ID(), '_envato_product_total_rating', true);
								$envato_product_preview_url 	=  get_post_meta( get_the_ID(), '_envato_product_preview_url', true);
								$envato_product_total_sales 	=  get_post_meta( get_the_ID(), '_envato_product_total_sales', true);
								$product_documentation_link 	=  get_post_meta( get_the_ID(), '_envator_product_documentation_link', true);
							}


							$last_update_date 				= new DateTime($envato_product_last_update);
							$envato_product_last_update 	= $last_update_date->format('j F y');
							$published_date 				= new DateTime($envato_product_published_date);
							$envato_product_published_date  = $published_date->format('j F y');

							$service_product_checkbox = get_post_meta( get_the_ID(), "rainbowit_service_product_checkbox", true);
							$envato_featured_product_checkbox = get_post_meta( get_the_ID(), "_envato_featured_product_checkbox_item", true);

							

							if ( class_exists('acf') && $product->is_type('external') ) {

								$envato_product_change_log = get_field( 'envato_product_change_log', get_the_ID() );
							} elseif( class_exists('acf') && $rainbowit_own_product_checkbox == 'yes' ) {
								$envato_product_change_log = get_field( 'envato_product_change_log', get_the_ID() );
							}

							$own_product_feature_list       = get_post_meta( get_the_ID(), 'own_product_feature_list', true );  
							$rating                         = get_post_meta( get_the_ID(), '_wc_average_rating', true );  

							$external_class = 'col-12 col-md-12 col-lg-5 col-xl-4 me-auto';
							$siebar_class = 'rbt-sidebar h-100';
							$elevate_class = 'elevate-with-rbt elevate-with-rbt-3 d-md-none d-lg-block';
							if ( $service_product_checkbox == 'yes' ) {
								$external_class = 'col-12 col-md-5 col-xl-4 me-auto order-1 order-md-2 d-none d-md-block';
								$siebar_class = 'rbt-sidebar-2 h-100';
								$elevate_class = 'elevate-with-rbt';
							?>
								</div>
							<?php } ?>
							<div class="<?php echo esc_attr($external_class); ?>">
								<div class="<?php echo esc_attr($siebar_class); ?> ">
									<!-- cart -->
									<?php if ( $service_product_checkbox == 'yes' ) { ?>
										<div class="rbt-cart">
											<div class="rbt-cart-top">
												<div class="rbt-product-price">
													<?php woocommerce_template_single_price(); ?>
												</div>
											</div>
											<p class="price-meta"><?php echo esc_html( $single_product_vat_text_change ); ?></p>
											<div class="rating-box clearfix">
												<?php woocommerce_template_single_rating(); ?>
											</div>
											<div class="rbt-cart-body">
												<ul class="rbt-list rbt-list-2">
													<?php
													if (isset($product_queue_item) && !empty($product_queue_item)) { ?>
														<li>
															<span><i class="fa-regular fa-forward"></i></span>
															<span><span class="color-primary fw-bold"><?php echo esc_attr($product_queue_item); ?> <?php echo esc_html__("Orders", "rainbowit"); ?></span> <?php echo esc_html__("in Queue", "rainbowit"); ?></span>
														</li>
													<?php }
													if (isset($product_delivery_time) && !empty($product_delivery_time)) { ?>
														<li>
															<span><i class="fa-sharp fa-regular fa-alarm-clock"></i></span>
															<span><?php echo esc_html__("Estimated Delivery:", "rainbowit"); ?> <?php echo esc_attr($product_delivery_time); ?></span>
														</li>
													<?php }
													if (isset($product_total_jobs) && !empty($product_total_jobs)) { ?>
														<li>
															<span><i class="fa-regular fa-suitcase"></i></span>
															<span><?php echo esc_html($product_total_jobs); ?> <?php echo esc_html__(" Done", "rainbowit"); ?></span>
														</li>
													<?php } ?>
												</ul>
											</div>
											<?php woocommerce_template_single_add_to_cart(); ?>
										</div>
									<?php } 
									if ($service_product_checkbox != 'yes') { ?>
										<div class="rbt-badge-wrapper">
											<div class="feature-badge">
												<?php echo esc_html__("Recently Updated", "rainbowit"); ?>
												<span class="badge-check"><i class="fa-solid fa-badge-check"></i></span>
											</div>
											<div class="feature-badge">
												<?php echo esc_html__("Well Documented", "rainbowit"); ?>
												<span class="badge-check"><i class="fa-solid fa-badge-check"></i></span>
											</div>
										</div>
										<?php if( $envato_featured_product_checkbox == 'yes') { ?>
										<div class="rbt-featured-item">
											<img src="<?php echo RAINBOWIT_IMG_URL; ?>/product-details/themeforest-featured-icon.png" alt="icon">
											<?php echo esc_html__("This item is featured on ThemeForest", "rainbowit"); ?>
										</div>
										<?php } ?>
										<div class="product-info product-info-right">
											<h6 class="product-info-title text-center "><?php echo esc_html__("Theme Information", "rainbowit"); ?></h6>
											<!-- info 1 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-light fa-calendar-days"></i></span>
													<?php echo esc_html__("Last Update :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html($envato_product_last_update); ?>
												</div>
											</div>
											<!-- info 2 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-sharp fa-regular fa-rocket"></i></span>
													<?php echo esc_html__("Published :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html($envato_product_published_date); ?>
												</div>
											</div>
											<!-- info 3 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-light fa-high-definition"></i></span>
													<?php echo esc_html__("High Resolution :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html__("Yes", "rainbowit"); ?>
												</div>
											</div>
											<!-- info 4 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-regular fa-arrows-cross"></i></span>
													<?php echo esc_html__("Compatible With :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html($envato_product_compatable_with); ?>
												</div>
											</div>
											<!-- info 5 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-regular fa-columns-3"></i></span>
													<?php echo esc_html__("Columns :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html($envato_product_column); ?>
												</div>

											</div>
											<!-- info 6 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-light fa-file"></i></span>
													<?php echo esc_html__("Documentation :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<?php echo esc_html__("Well Documented", "rainbowit"); ?>
												</div>
											</div>
											<!-- info 7 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-light fa-bolt"></i></span>
													<?php echo esc_html__("Changelog :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="info-btn" href="#">
														<?php echo esc_html__("Show", "rainbowit"); ?>
														<i class="fa-sharp fa-solid fa-chevron-right"></i>
													</a>
												</div>
											</div>
											<!-- info 7 -->
											<div class="single-info">
												<div class="info-name">
													<span><i class="fa-light fa-file"></i></span>
													<?php echo esc_html__("Documentation :", "rainbowit"); ?>
												</div>
												<div class="info-value">
													<a class="info-btn" href="<?php echo esc_url($product_documentation_link);?>">
														<?php echo esc_html__("View Docs", "rainbowit"); ?>
														<i class="fa-sharp fa-solid fa-chevron-right"></i>
													</a>
												</div>
											</div>

											<?php if( isset( $envato_product_change_log ) && !empty( $envato_product_change_log ) ) { ?>
											<!-- Modal start -->
											<div class="modal fade backdrop" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<button type="button" class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">
															<i class="fa-sharp fa-regular fa-xmark"></i>
														</button>
														<div class="rbt-modal-wrapper">
															<h4 class="rbt-modal-title">
																<?php echo esc_html__("Update Change Log","rainbowit"); ?>
															</h4>
															<?php echo wp_kses_post( $envato_product_change_log ); ?>
														</div>
													</div>
												</div>
											</div>
											<!-- Modal end -->
											<?php } ?>
										</div>
									<?php } ?>
									<div class="<?php echo esc_attr($elevate_class); ?>">
										<div class="banner-content-wrapper">
											<div class="content">
												<span class="nav-badge"><?php echo esc_html($single_product_banner_tagline); ?></span>
												<h3 class="title">
													<?php echo esc_html($single_product_heading_title); ?>
												</h3>
												<a href="<?php echo esc_url($single_product_btn_quote_link); ?>" class="rbt-btn rbt-btn-secondary rbt-btn-round rbt-btn-xm">
													<?php echo esc_html($single_product_btn_title); ?>
													<span><i class="fa-solid fa-arrow-up-right"></i></span>
												</a>
											</div>
										</div>
									</div>
									<?php if ($service_product_checkbox == 'yes') { ?>
										<div class="rbt-cart sticky-top mt--25">
											<div class="rbt-cart-top">
												<div class="rbt-product-price">
													<?php woocommerce_template_single_price(); ?>
												</div>
											</div>
											<p class="price-meta"><?php echo esc_html( $single_product_vat_text_change ); ?></p>
											<div class="rating-box clearfix">
												<?php woocommerce_template_single_rating(); ?>
											</div>
											<div class="rbt-cart-body">
												<ul class="rbt-list rbt-list-2">
													<?php if (isset($product_queue_item) && !empty($product_queue_item)) { ?>
														<li>
															<span><i class="fa-regular fa-forward"></i></span>
															<span><span class="color-primary fw-bold"><?php echo esc_attr($product_queue_item); ?> <?php echo esc_html__("Orders", "rainbowit"); ?></span> <?php echo esc_html__("in Queue", "rainbowit"); ?></span>
														</li>
													<?php }
													if (isset($product_delivery_time) && !empty($product_delivery_time)) { ?>
														<li>
															<span><i class="fa-sharp fa-regular fa-alarm-clock"></i></span>
															<span><?php echo esc_html__("Estimated Delivery:", "rainbowit"); ?> <?php echo esc_attr($product_delivery_time); ?></span>
														</li>
													<?php }
													if (isset($product_total_jobs) && !empty($product_total_jobs)) { ?>
														<li>
															<span><i class="fa-regular fa-suitcase"></i></span>
															<span><?php echo esc_html($product_total_jobs); ?> <?php echo esc_html__("Done", "rainbowit"); ?></span>
														</li>
													<?php } ?>
												</ul>
											</div>
											<?php woocommerce_template_single_add_to_cart(); ?>
										</div>
									<?php } 
									if ($service_product_checkbox != 'yes') { ?>
										<div class="rbt-cart sticky-top d-none d-md-block">
											<div class="rbt-cart-top">
												<h6 class="product-license">
													<?php echo esc_html__("Regular License", "rainbowit"); ?>
												</h6>
												<div class="rbt-product-price">
												<?php
													global $product;

													$product2 = wc_get_product(get_the_ID());
													$regular_price = $product2->get_regular_price();
													$sale_price = $product2->get_sale_price();
													if ( $sale_price ) {
														echo '<div class="off-price">' . wc_price( $regular_price ) . '</div>';
														echo '<div class="current-price">' . wc_price( $sale_price ) . '</div>';
														} else {
														echo '<div class="current-price">' . wc_price( $regular_price ) . '</div>';
													} 
												?>
												</div>

											</div>
											<div class="rbt-cart-body">
											<?php 
												if( $rainbowit_own_product_checkbox != 'yes') { ?>
												<ul class="rbt-list rbt-list-2">
													<li>
														<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
														<span><?php echo esc_html__("Quality checked by Envato", "rainbowit"); ?></span>
													</li>
													<li>
														<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
														<span><?php echo esc_html__("6 months support from Rainbow-Themes", "rainbowit"); ?></span>
													</li>
													<li>
														<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
														<span><?php echo esc_html__("Lifetime Future updates", "rainbowit"); ?></span>
													</li>
												</ul>
												<?php
												}   else { 

													$sentences = explode("\n", $own_product_feature_list);

													?>
													
														<ul class="rbt-list rbt-list-2">
															<?php foreach($sentences as $value ) { ?>
															<li>
																<span class="color-primary"><i class="fa-duotone fa-check"></i></span>
																<span><?php echo $value;?></span>
															</li>
															<?php } ?>
														</ul>

												<?php } ?>
											</div>
											<div class="rbt-product-meta">
												<?php if( $envato_product_total_sales > 0 ) { ?>
												<div class="single-meta">
													<h6 class="meta-name"><?php echo esc_html__("Total Sales :", "rainbowit"); ?></h6>
													<span class="meta-info meta-badge"><?php echo esc_html($envato_product_total_sales); ?></span>
												</div>
												<?php } ?>
												<div class="single-meta">
													<h6 class="meta-name"><?php echo esc_html__("Updated :", "rainbowit"); ?></h6>
													<span class="meta-info"><?php echo esc_attr($envato_product_last_update); ?></span>
												</div>
											</div>
											<div class="rbt-btn-group btn-gap-12 bottom-sidebar-gap">

												<?php woocommerce_template_single_add_to_cart(); ?>

												<a href="<?php echo esc_url($envato_product_preview_url); ?>" class="rbt-btn rbt-btn-md hover-effect-1">
													<span>
														<i class="fa-sharp fa-regular fa-eye"></i>
													</span>
													<?php echo esc_html__("Preview", "rainbowit"); ?>
												</a>
											</div>
											<?php if( $rainbowit_own_product_checkbox != 'yes' && $envato_product_total_rating > 3 ) { ?>
											<div class="cart-bottom">
												<div class="review">
													<span class="review-text"><?php echo esc_html__("Reviews", "rainbowit"); ?></span>
													<div class="rating">
														<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
														<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
														<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
														<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
														<span class="rating-icon"><i class="fa-solid fa-star"></i></span>
													</div>
													<span class="rating-avg"><?php echo esc_attr($envato_product_avg_rating); ?></span>
													<span class="rating-count badge"><?php echo esc_attr($envato_product_total_rating); ?> <?php echo esc_html__("(Total)", "rainbowit"); ?></span>
												</div>
											</div>
											<?php } else { 
												if( $rating > 0 ) { ?>
									
												<div class="cart-bottom">
													<div class="review">
														<span class="review-text"><?php echo esc_html__("Reviews", "rainbowit"); ?></span>
														<?php 
														woocommerce_template_loop_rating(); 
														?>
														<?php if( $rating > 0 ) { ?>
														<span class="rating-count">
														<?php echo esc_html( $rating ); ?>
														<span class="rbt-review-total">(Total<?php echo " ";?><?php 
															echo do_shortcode( "[reviews_count id='".get_the_ID() ."']");
														?>)</span>
														
														</span>
														<?php } ?>
													</div>
												</div>

											<?php } } ?>
										</div>
									<?php } ?>
								</div>
							</div>
							</div>
						</div>

						<?php
						}

						add_action("woocommerce_single_product_summary", "rainbowit_template_single_title", 5);

						function rainbowit_template_single_title()
						{
							global $post;
							$service_product_checkbox = get_post_meta($post->ID, "rainbowit_service_product_checkbox", true);
							global $product;
							if ($service_product_checkbox == 'yes') {
						?>

							<div class="product-images border-0 mt-0 pt-0 mb--30">
								<?php woocommerce_show_product_images(); ?>
							</div>
						<?php } ?>
						<div class="product-info mb--25">
							<div class="rbt-section-title mb--25">
								<h3 class="title title-sm m-0 "><?php the_title(); ?></h3>
							</div>

							<?php
							the_content();

							if (class_exists('acf') && $service_product_checkbox == 'yes' ) {

								$product_content_template = get_field('product_content_template', $post->ID);
								if (class_exists("\\Elementor\\Plugin")) {
									$pluginElementor = \Elementor\Plugin::instance();
									$contentElementor2 = $pluginElementor->frontend->get_builder_content($product_content_template);
									echo do_shortcode($contentElementor2);
								}
							}
							?>

						</div>
						
						<?php 
						global $product;
						$product_type = $product->get_type();
						if ($product_type != 'external') { ?>
							<div class="product-info rating-tab-custom"><?php woocommerce_output_product_data_tabs(); ?></div>
						<?php } ?>
				</div>
				<?php
						}

						add_action("woocommerce_after_single_product", "rainbowit_woocommerce_after_single_product", 20);

						function rainbowit_woocommerce_after_single_product()
						{
				?>
			</div>
			</div>
			<?php
						}

						add_action("woocommerce_after_single_product", "rainbowit_related_after_single_product_summary", 21);

						function rainbowit_related_after_single_product_summary()
						{

							global $product;
							$service_product_checkbox = get_post_meta(get_the_ID(), "rainbowit_service_product_checkbox", true);
							$rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);
							$product_type = $product->get_type();

							$related_products = wc_get_related_products($product->get_id());
							$filtered_related_products = array();
							// Filter out external products
							if( 'external' == $product->get_type() ) {
								$filtered_related_products = array_filter($related_products, function($product_id) {
									$product = wc_get_product($product_id);
									return $product && 'external' === $product->get_type();
								});
							}


							if($service_product_checkbox == 'yes') {

								$filtered_related_products = array_filter($related_products, function($product_id) {
									$product = wc_get_product($product_id);
								
									// Retrieve the meta value for the 'rainbowit_service_product_checkbox' meta key
									$service_product_checkbox = get_post_meta($product_id, 'rainbowit_service_product_checkbox', true);
								
									// Check if the product exists and if the meta value matches your criteria
									return $product && $service_product_checkbox && $service_product_checkbox === 'yes';
								});
							}

							if($rainbowit_own_product_checkbox == 'yes') {

								$filtered_related_products = array_filter($related_products, function($product_id) {
									$product = wc_get_product($product_id);
								
									// Retrieve the meta value for the 'rainbowit_service_product_checkbox' meta key
									$rainbowit_own_product_checkbox2 = get_post_meta($product_id, 'rainbowit_own_product_checkbox', true);
								
									// Check if the product exists and if the meta value matches your criteria
									return $product && $rainbowit_own_product_checkbox2 && $rainbowit_own_product_checkbox2 === 'yes';
								});
							}

							$rainbowit_options 	  = Rainbowit_Helper::rainbowit_get_options();
							$rel_product_subtitle = isset( $rainbowit_options["rel_product_subtitle"] ) ? $rainbowit_options["rel_product_subtitle"] : '';
							$rel_product_title 	  = isset($rainbowit_options["rel_product_title"]) ? $rainbowit_options["rel_product_title"] : '';;
							$rel_product_desc 	  = isset($rainbowit_options["rel_product_desc"]) ? $rainbowit_options["rel_product_desc"] : '';;
							global $post;
							$service_product_checkbox = get_post_meta($post->ID, "rainbowit_service_product_checkbox", true);

							if (count($filtered_related_products) > 0) { ?>

				<div class="rbt-section-wrapper faridmia-related-product">
					<div class="container">
						<div class="rbt-parent wider-section">
							<div class="rbt-parent-bg parent-bg-3 "></div>
							<div class="rbt-inner-img rbt-inner-img"></div>
							<div class="rbt-inner-content" data-sal="slide-up" data-sal-duration="400">
								<div class="inner">
									<div class="rbt-section-title section-title-center">
										<span class="subtitle">
											<?php
											if ($service_product_checkbox != 'yes') {
												echo esc_html__("Related Product", "rainbowit");
											} else {
												echo esc_html($rel_product_subtitle);
											}

											?>
										</span>
										<h3 class="title">
											<?php
											if ($service_product_checkbox == 'yes') {
												echo esc_html__("Related Items", "rainbowit");
											} else {
												echo esc_html($rel_product_title);
											}

											?>
										</h3>
										<p class="description">
											<?php echo wp_kses_post($rel_product_desc); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="rbt-top-items mt_dec--115">
							<div class="row row--12 row-gap-5 ">
								<?php rainbowit_output_related_products(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php
							}
						}

						add_filter("woocommerce_output_related_products", "rainbowit_output_related_products", 10, 1);

						function rainbowit_output_related_products()
						{

							global $product;
							$product_type = $product->get_type();
							$rainbowit_own_product_checkbox 		=  get_post_meta( get_the_ID(), 'rainbowit_own_product_checkbox', true);

							global $post;
							$service_product_checkbox = get_post_meta(get_the_ID(), "rainbowit_service_product_checkbox", true);
							

							if ( $product_type != 'external' && $service_product_checkbox == 'yes' ) {
								$related_products = array_filter(
									array_map("wc_get_product", wc_get_related_products(get_the_ID(), 3, $product->get_upsell_ids())),
									function ($related_product) {
										// Exclude external products and products with 'rainbowit_own_product_checkbox' meta key set to 'yes'
										if ($related_product->is_type('external')) {
											return false;
										}
										$meta_value = get_post_meta($related_product->get_id(), 'rainbowit_own_product_checkbox', true);
										if ($meta_value === 'yes') {
											return false;
										}
										return true;
									}
								);
							} elseif( $rainbowit_own_product_checkbox == 'yes'){
								$related_products = array_filter(
									array_map("wc_get_product", wc_get_related_products(get_the_ID(), 3, $product->get_upsell_ids())),
									function ($related_product) {
										// Exclude external products and products with 'rainbowit_service_product_checkbox' meta key set to 'yes'
										if ($related_product->is_type('external')) {
											return false;
										}
										$meta_value = get_post_meta($related_product->get_id(), 'rainbowit_service_product_checkbox', true);
										if ($meta_value === 'yes') {
											return false;
										}
										return true;
									}
								);
							
							} else {
								$related_products = array_filter(
									array_map("wc_get_product", wc_get_related_products(get_the_ID(), 3, $product->get_upsell_ids())),
									function ($related_product) {
										// Exclude external products and products with specific meta keys set to 'yes'
										$service_meta_value = get_post_meta($related_product->get_id(), 'rainbowit_service_product_checkbox', true);
										$own_meta_value = get_post_meta($related_product->get_id(), 'rainbowit_own_product_checkbox', true);
										if ($service_meta_value === 'yes' || $own_meta_value === 'yes') {
											return false;
										}
										return true;
									}
								);
							}

							foreach ($related_products as $related_product) :

								$post_object = get_post($related_product->get_id());
								setup_postdata($GLOBALS["post"] = &$post_object);
								if ($product_type != 'external' && $service_product_checkbox == 'yes') {
									wc_get_template_part("content", "serviceproduct");
								} elseif( $product_type == 'external' ) {
									wc_get_template_part("content", "product-grid2");
								} else {
									wc_get_template_part("content", "product-grid3");
								}

							endforeach;
						}

						add_action("woocommerce_after_single_product", "rainbowit_related_after_single_product_summary_employee", 22);


						function rainbowit_related_after_single_product_summary_employee()
						{
							$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
							$blog_bottom_client_template_id = isset($rainbowit_options['blog_bottom_client_template_id']) ? $rainbowit_options['blog_bottom_client_template_id'] : '';
							if (class_exists("\\Elementor\\Plugin")) {
								$pluginElementor = \Elementor\Plugin::instance();
								$contentElementor2 = $pluginElementor->frontend->get_builder_content($blog_bottom_client_template_id);

								echo do_shortcode($contentElementor2);
							}
						}

						if ( !function_exists('rainbowit_product_comments') ) {

							function rainbowit_product_comments($comment, $args, $depth)
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

				<div class="comment rbt-review-card sal-animate" id="comment-<?php comment_ID(); ?>" data-sal="slide-up" data-sal-duration="400">

					<figure class="image-box"><?php print get_avatar($comment, 115, null, null, array('class' => array())); ?></figure>
					<div class="inner">
						<div class="review">
							<?php
								if ($rating && wc_review_ratings_enabled()) {
									echo wc_get_rating_html($rating); // WPCS: XSS ok.
								}
							?>
						</div>
						<h5 class="user"><?php echo get_comment_author_link(); ?></h5>
						<?php comment_text(); ?>

					</div>
				</div>
		<?php
							}
						}
						function reviews_count_func3( $atts = '') {
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