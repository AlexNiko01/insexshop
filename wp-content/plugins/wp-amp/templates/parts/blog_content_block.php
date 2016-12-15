<?php
while ( have_posts() ): the_post();
	$id = get_the_ID();
	$this->set_post( $id );
	echo $this->render( 'loop-single' );
endwhile;
