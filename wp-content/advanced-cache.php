<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

define( 'WP_ROCKET_ADVANCED_CACHE', true );
$rocket_cache_path = 'D:\OpenServer\domains\wp.abedor-rez.loc/wp-content/cache/wp-rocket/';
$rocket_config_path = 'D:\OpenServer\domains\wp.abedor-rez.loc/wp-content/wp-rocket-config/';

if ( file_exists( 'D:\OpenServer\domains\wp.abedor-rez.loc\wp-content\plugins\wp-rocket\inc\front/process.php' ) ) {
	include( 'D:\OpenServer\domains\wp.abedor-rez.loc\wp-content\plugins\wp-rocket\inc\front/process.php' );
} else {
	define( 'WP_ROCKET_ADVANCED_CACHE_PROBLEM', true );
}