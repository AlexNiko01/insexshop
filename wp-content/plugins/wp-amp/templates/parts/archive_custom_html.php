<?php $content = $this->options->get( 'archive_custom_html' ) ?>
<?php if( $content ):  ?>
	<p><?php printf( __( '%s', 'amphtml' ), $content ); ?></p>
<?php endif; ?>