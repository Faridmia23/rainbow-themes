<?php
/**
 * @author  Rainbow-Themes
 * @since   1.0
 * @version 1.0
 * @package rainbowit
 */
?>
<div>
	<?php
	global $product; ?>
	<a href="<?php the_permalink(); ?>">
	<?php 
		woocommerce_template_loop_product_thumbnail();
	?>
	</a>
</div>
                    