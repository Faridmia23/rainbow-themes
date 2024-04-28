<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rainbowit
 */

get_header();

$rainbowit_options = Rainbowit_Helper::rainbowit_get_options();
$unique_id = esc_attr( rainbowit_unique_id( 'error-search-' ) );
?>
    <!-- Start 404 Page  -->
    <div class="error-area pt--200 ptb--120 ptb_sm--60 ptb_md--80">
        <div class="container">
            <div class="row align-item-center">
                <div class="col-lg-12">
                    <div class="error-inner">
                        <?php if(!empty($rainbowit_options['rainbowit_404_title'])){ ?> <h1><?php echo esc_html( $rainbowit_options['rainbowit_404_title'] );?></h1> <?php } ?>
                        <?php if(!empty($rainbowit_options['rainbowit_404_subtitle'])){ ?> <h2 class="title"><?php echo esc_html( $rainbowit_options['rainbowit_404_subtitle'] );?></h2> <?php } ?>
                        <?php if(!empty($rainbowit_options['rainbowit_404_desc'])){ ?> <p class="description"><?php echo esc_html( $rainbowit_options['rainbowit_404_desc'] );?></p> <?php } ?>

                        <?php if( $rainbowit_options['rainbowit_404_enable_search'] == 'yes'){ ?>
                            <form id="<?php echo esc_attr($unique_id); ?>" action="<?php echo esc_url(home_url( '/' )); ?>" method="GET" class="blog-search">
                                <input type="text"  name="s"  placeholder="<?php echo esc_html( $rainbowit_options['rainbowit_404_search_form_placeholder'] );?>" value="<?php echo get_search_query(); ?>"/>
                                <button class="search-button"><i class="feather-search"></i></button>
                            </form>
                        <?php } ?>

                        <?php if( $rainbowit_options['rainbowit_enable_go_back_btn'] == 'yes'){ ?>
                            <div class="view-more-button">
                                <a class="rbt-btn rbt-btn-primary" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo esc_html( $rainbowit_options['rainbowit_404_button_text'] );?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 Page  -->
<?php
get_footer();


