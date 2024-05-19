<?php
/**
 * Template part for displaying header page title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rainbowit
 */

// Get Value
$rainbowit_options              = Rainbowit_Helper::rainbowit_get_options();
$banner_layout                  = Rainbowit_Helper::rainbowit_banner_layout();
$banner_area                    = $banner_layout['banner_area'];
$banner_title                   = rainbowit_get_acf_data("rainbowit_custom_title");
$banner_sub_title               = rainbowit_get_acf_data("rainbowit_custom_sub_title");
$rainbowit_breadcrumbs_enable   = rainbowit_get_acf_data("rainbowit_breadcrumbs_enable");
$page_breadcrumb                = Rainbowit_Helper::rainbowit_page_breadcrumb();
$page_breadcrumb_enable         = $page_breadcrumb['breadcrumbs'];

?>

<div class="rbt-section-bgCommon">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb text-center pt--175">
                    <div class="rbt-section-title">
                    <?php if($banner_title){ ?>
                        <h2 class="title title-xl"><?php echo esc_html( $banner_title ); ?></h2>
                    <?php  } else { ?>
                        <?php the_title( '<h2 class="title title-xl">', '</h2>' ); ?>
                    <?php  }  ?>
                    <?php if ("no" !== $page_breadcrumb_enable && "0" !== $page_breadcrumb_enable) {
                        //rainbowit_breadcrumbs();
                    } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>