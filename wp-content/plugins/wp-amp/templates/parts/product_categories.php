<?php
$cat_count  = sizeof( get_the_terms( $this->post->ID, 'product_cat' ) );
if( $this->options->get( 'product_categories' ) ):
	echo $this->update_content_links( $this->product->get_categories( ', ',
		'<p class="amphtml-posted-in">' . _n( 'Категория:', 'Категории:', $cat_count, 'amphtml' ) . ' ', '</p>' ) );
endif;
