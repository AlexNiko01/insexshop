<?php $content = $this->options->get( 'search_page_custom_html' ) ?>
<?php if( $content ):  ?>
	<p><?php printf( __( '%s', 'amphtml' ), $content ); ?></p>
<?php endif; ?>