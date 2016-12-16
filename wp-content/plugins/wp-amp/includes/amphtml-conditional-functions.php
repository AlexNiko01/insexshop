<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( function_exists( 'AMPHTML' ) ) {

	/**
	 * @return bool
	 */
	function is_wp_amp() {
		return AMPHTML()->is_amp();
	}
}