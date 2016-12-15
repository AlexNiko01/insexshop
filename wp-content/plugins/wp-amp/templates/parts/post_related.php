<?php if ( $this->options->get( 'post_related' ) ) {
	echo $this->render( 'related-posts' );
}