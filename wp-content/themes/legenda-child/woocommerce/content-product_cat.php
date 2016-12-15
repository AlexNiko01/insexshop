<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="span4 product-category <?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1)
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<span class="mask-container">
	<?php /*<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">*/ ?>
		<?php
			$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
			if ( $thumbnail_id ) {
				$image = etheme_get_image( $thumbnail_id );
			} else {
				$image = woocommerce_placeholder_img_src();
			}
			if ( $image )
				echo '<img src="' . $image . '" alt="' . $category->name . '" width="300" height="300"/>';
		?>
		<span class="block-mask"></span>
		<span class="db"><?php echo $category->name; ?></span><?php /*</a>*/ ?>
	</span>

<!--		--><?php
//
//			$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
//
//			if ( $thumbnail_id ) {
//				$image = etheme_get_image( $thumbnail_id );
//			} else {
//				$image = woocommerce_placeholder_img_src();
//			}
//
//			if ( $image )
//				echo '<img src="' . $image . '" alt="' . $category->name . '" />';
//		?>
<!---->
<!--		<div class="block-mask">-->
<!--			<div class="mask-content">-->
<!--				<a href="--><?php //echo get_term_link( $category->slug, 'product_cat' ); ?><!--"><i class="icon-link"></i></a>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	-->
<!---->
<!--	<a href="--><?php //echo get_term_link( $category->slug, 'product_cat' ); ?><!--">-->
<!--		--><?php
//			echo $category->name;
//
//			if ( $category->count > 0 )
//				echo apply_filters( 'woocommerce_subcategory_count_html', ' (' . $category->count . ')', $category );
//		?>
<!--	</a> -->

	<?php
		/**
		 * woocommerce_after_subcategory_title hook
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
	?>


	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>