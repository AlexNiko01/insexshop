<div class="clearfix">
	<?php if ( $this->options->get( 'wc_archives_price' ) ): ?>
		<p class="amphtml-price"><?php _e( 'Price', 'amphtml' ) ?>:<?php woocommerce_template_loop_price(); ?></p>
	<?php endif; ?>

	<?php if ( $this->options->get( 'wc_archives_add_to_cart' ) ): ?>
		<?php $this->get_add_to_cart_button(); ?>
	<?php endif; ?>
</div>
