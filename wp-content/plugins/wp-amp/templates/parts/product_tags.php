<?php
$tag_count  = sizeof( get_the_terms( $this->post->ID, 'product_tag' ) );
if( $this->options->get( 'product_tags' ) ):
	echo $this->update_content_links( $this->product->get_tags( ', ',
		'<p class="amphtml-tagged-as">' . _n( 'Тип товара:', 'Тип товара:', $tag_count, 'amphtml' ) . ' ', '</p>' ) );
endif;
