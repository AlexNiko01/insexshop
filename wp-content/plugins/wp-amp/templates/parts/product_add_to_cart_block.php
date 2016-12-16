<div class="clearfix">
	<p class="amphtml-price">
		<span class="price"><?php echo $this->product->get_price_html(); ?></span>

		<?php if ( $this->options->get( 'product_stock_status' ) ): ?>
			<span class="amphtml-stock-status">
	                <?php if ( ! $this->product->managing_stock() && ! $this->product->is_in_stock() ): ?>
		                <?php _e( 'Out Of Stock', 'amphtml' ) ?>
	                <?php else: ?>
		                <?php _e( 'In Stock', 'amphtml' ) ?>
	                <?php endif; ?>
	            </span>
		<?php endif; ?>
	</p>
	<?php $this->get_add_to_cart_button(); ?>
</div>