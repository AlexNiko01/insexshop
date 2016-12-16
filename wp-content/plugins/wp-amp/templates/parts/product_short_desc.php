<?php if ( $this->options->get( 'product_short_desc' ) ): ?>
	<?php $html = apply_filters( 'woocommerce_short_description', $this->post->post_excerpt ) ?>
	<?php echo $this->sanitizer->sanitize_content( $html ); ?>
<?php endif;
