<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/add-to-cart/simple.php.
 *
 * @var $this AMPHTML_Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product; ?>

<?php $add_to_cart_url = get_permalink( $product->id );
if ( 'add_to_cart' == $this->options->get( 'add_to_cart_behav' ) ) {
	$add_to_cart_url .= "?add-to-cart={$product->id}";
} else {
	$add_to_cart_url .= "?add-to-cart-redirect=1";
}
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'amp_before_add_to_cart_button' ); ?>
	<p class="amphtml-add-to">
		<a href="<?php echo $add_to_cart_url ?>"><?php echo $this->options->get( 'add_to_cart_text' ) ?></a>
	</p>
	<?php do_action( 'amp_after_add_to_cart_button' ); ?>

<?php endif; ?>
