<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

<?php 
	$sidebarname = 'single';
?>
<div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
	<div class="container">
		<div class="row-fluid">
			<div class="span12 a-center">
				<?php woocommerce_template_single_title(); ?>
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action('woocommerce_before_main_content');
				?>
			</div>
		</div>
	</div>
</div>

<div id="product-<?php the_ID(); ?>" class="container">
<?php /*<div id="product-<?php the_ID(); ?>" <?php post_class('container'); ?>>*/ ?>
	<div class="page-content">
		<div class="row">

			<div class="content span12">
			
					<?php while ( have_posts() ) : the_post(); ?>
			
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
			
					<?php endwhile; // end of the loop. ?>
			
				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
				?>
				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					//do_action('woocommerce_after_main_contents');
				?>
<?php
// crossells
//$crosssell_ids = get_post_meta( get_the_ID(), '_crosssell_ids' );
//$crosssell_ids=$crosssell_ids[0];
//?>
<?php
//if(count($crosssell_ids)>0){
//echo '<h3 class="title"><span>Похожие секс-игрушки</span></h3>
//<div class="w100">';}
//?>
<?php
//if(count($crosssell_ids)>0){
//$args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'post__in' => $crosssell_ids );
//$loop = new WP_Query( $args );
//while ( $loop->have_posts() ) : $loop->the_post();
//?><!--<div class="w25">-->
<!--<a href='--><?php //the_permalink(); ?><!--'>--><?php //the_post_thumbnail( 'thumbnail' ); ?>
<!--<span class="sblock">--><?php //the_title();?><!--</span></a>-->
<!--<span class="sblock">--><?php //echo wc_price($product->get_price_including_tax(1, $product->get_sale_price()));?><!--</span>-->
<!--<form class="cart" method="post" enctype="multipart/form-data">-->
<!--     <input type="hidden" name="add-to-cart" value="--><?php //echo esc_attr($product->id); ?><!--">-->
<!--     <button type="submit"> --><?php //echo $product->single_add_to_cart_text(); ?><!-- </button>-->
<!--</form>-->
<!--</div>--><?php
//endwhile;
//}
//?>
<?php
//if(count($crosssell_ids)>0){
//echo '<div class="clear"></div>
//</div>';}
// ?>
			</div>
		</div>

	</div>
</div>

<?php get_footer('shop'); ?>