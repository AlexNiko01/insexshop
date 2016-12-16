<?php

if ( ! defined( 'ABSPATH' ) )
exit;

if ( ! class_exists( '_WP_Editors' ) )
require( ABSPATH . WPINC . '/class-wp-editor.php' );

function artabr_ivs_button_translation() {
$strings = array(
    'ivs_title'                                      => __('Add video this microdata', 'ivs-shortcode'),
    'ivs_title_section_video'  => __('Add video', 'ivs-shortcode'),
    'ivs_add_video_id'            => __('ID video', 'ivs-shortcode'),
    'ivs_add_video_id_tooltip'            => __('Add video ID. This is the last 11 characters in a link.', 'ivs-shortcode'),
    'ivs_add_video_width'            => __('Width player', 'ivs-shortcode'),
    'ivs_add_video_width_tooltip'            => __('Specify the width of the window video player', 'ivs-shortcode'),
    'ivs_add_video_height'            => __('Height player', 'ivs-shortcode'),
    'ivs_add_video_height_tooltip'            => __('Specify the height of the window video player', 'ivs-shortcode'),
    'ivs_add_video_align'            => __('Alignment video', 'ivs-shortcode'),
    'ivs_add_video_align_tooltip'            => __('Alignment on the page video player window: left, center, right on the edge.', 'ivs-shortcode'),
    'ivs_add_video_align_center'            => __('Align center', 'ivs-shortcode'),
    'ivs_add_video_align_left'            => __('Align left', 'ivs-shortcode'),
    'ivs_add_video_align_right'            => __('Align right', 'ivs-shortcode'),
    'ivs_title_section_schema'            => __('Add microdata', 'ivs-shortcode'),
    'ivs_title_add_schema_url'            => __('Url video', 'ivs-shortcode'),
    'ivs_title_add_schema_url_tooltip'            => __('Add url video. eg https://www.youtube.com/watch?v=HPwH0yS1c44', 'ivs-shortcode'),
    'ivs_title_add_schema_name'            => __('Video title', 'ivs-shortcode'),
    'ivs_title_add_schema_name_tooltip'            => __('Specify the video title', 'ivs-shortcode'),
    'ivs_title_add_schema_desc'            => __('Description of video', 'ivs-shortcode'),
    'ivs_title_add_schema_desc_tooltip'            => __('Specify the video description of movie', 'ivs-shortcode'),
    'ivs_title_add_schema_duration_label'            => __('Video duration', 'ivs-shortcode'),
    'ivs_title_add_schema_duration_label_tooltip'            => __('Specify the duration of the video in ISO 8601 format', 'ivs-shortcode'),
    'ivs_title_add_schema_duration_min'            => __('Minutes', 'ivs-shortcode'),
    'ivs_title_add_schema_duration_sec'            => __('Seconds', 'ivs-shortcode'),
    'ivs_title_add_schema_download'            => __('Download date video', 'ivs-shortcode'),
    'ivs_title_add_schema_download_tooltip'            => __('Move the cursor to select the date, and download video clips. The desired format will be installed automatically.', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb'            => __('Link to the thumbnail', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb_tooltip'            => __('Enter a link to a thumbnail from the video.', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb_width'            => __('Width thumbnail', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb_width_tooltip'            => __('Enter the width of a thumbnail from the video', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb_height'            => __('Height thumbnail', 'ivs-shortcode'),
    'ivs_title_add_schema_thumb_height_tooltip'            => __('Enter the height of a thumbnail from the video', 'ivs-shortcode'),
 

);

$locale = _WP_Editors::$mce_locale;
$translated = 'tinyMCE.addI18n("' . $locale . '.art_insert_yt", ' . json_encode( $strings ) . ");\n";

return $translated;
}

$strings = artabr_ivs_button_translation();
