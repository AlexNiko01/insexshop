<?php
if ( $this->options->get( 'archive_desc' ) ) {
	the_archive_description( '<div class="taxonomy-description">', '</div>' );
}