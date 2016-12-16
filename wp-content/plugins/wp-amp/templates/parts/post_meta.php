<?php if ( $this->options->get( 'post_meta' ) ): ?>
	<ul class="amphtml-meta">
		<?php echo $this->get_post_meta() ?>
	</ul>
<?php endif; ?>
