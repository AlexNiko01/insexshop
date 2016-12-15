<?php
/**
 * @var $this AMPHTML_Template
 */

if ( $this->options->get( 'archive_ad_top' ) ) {
	echo $this->render( 'ad-top' );
}