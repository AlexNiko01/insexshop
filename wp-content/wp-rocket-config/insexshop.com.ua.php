<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

$rocket_cookie_hash = '750e3dbf5547031ddbb01e31a5c58ea2';
$rocket_secret_cache_key = '57f4ccdee9d3a453970429';
$rocket_cache_reject_uri = '/checkout/(.*)|/cart/|/my-account/(.*)|/wc-api/v(.*)|/wp-json/(.*)';
$rocket_cache_reject_cookies = 'wordpress_logged_in_|wp-postpass_|wptouch_switch_toggle|comment_author_|comment_author_email_';
$rocket_cache_query_strings = array (
  0 => 'q',
);
$rocket_cache_reject_ua = 'facebookexternalhit|FB_IAB|FB4A|FBAV';
$rocket_cache_ssl = '1';
$rocket_cache_mandatory_cookies = '';
$rocket_cache_dynamic_cookies = array (
);
