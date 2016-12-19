<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );

?>

<?php if ( $heading ): ?>
	<h2><?php //echo $heading; ?>Характеристики</h2>
<?php endif; ?>

<?php $product->list_attributes(); ?>
<div class="product_meta">
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Тип товара:', 'Тип товара:', $size, 'woocommerce' ) . ' ', '.</span>' );
	?>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>