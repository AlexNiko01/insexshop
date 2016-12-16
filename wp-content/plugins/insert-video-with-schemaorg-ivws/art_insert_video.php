<?php
/*
Plugin Name: Insert Video with Schema.org
Plugin URI: http://wpruse.ru
Description: Плагин формирует шорткод, с помощью которого можно добавить в статьи видеоролики с YouTube сразу с микроразметкой по schema.org. Разметка производиться по минимальным требованиям Яндекс
Version: 2.1
Author: Артем Абрамович
Author URI: http://wpruse.ru
*/

function artabr_youtube_video( $atts, $content = null) {  
    extract(shortcode_atts( array(  
        'urlvideo' => 'z4L78PtpS1I',
		'namevideo' => '',
		'desc' => '',
		'durationmin' => '3M',
		'durationsec' => '3S',
		'upld' => '',
		'isFamilyFriendly' => 'true',
		'tmburl' => '',
		'thumbnailwidth' => '',
		'thumbnailheight' => '',
		'display' => 'none',
		'id' => '',  
        'wvideo' => 640,  
        'hvideo' => 360,
		'position'   => 'left'
    ), $atts));  
	
    $out = '<div class="art_yt '.$position .'" itemscope itemid="" itemtype="http://schema.org/VideoObject"><link itemprop="url" href="'.$urlvideo . '"><meta itemprop="name" content="' . $namevideo. '"><meta itemprop="description" content="'.  $desc . '"><meta itemprop="duration" content="PT'.$durationmin.'M'.$durationsec.'S"><link itemprop="thumbnailUrl" href="'. $tmburl . '"><span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject"><link itemprop="contentUrl" href="'. $tmburl . '"><meta itemprop="width" content="'.$thumbnailwidth. '"><meta itemprop="height" content="'.$thumbnailheight.'"></span><link itemprop="embedUrl" href="https://www.youtube.com/embed/' . $id . '"><meta itemprop="isFamilyFriendly" content="True"><meta itemprop="datePublished" content="'.$upld.'"><meta itemprop="uploadDate" content="'.$upld.'"/>';
	$out .= '<iframe width="' .$wvideo . '" height="' .$hvideo .'" src="https://www.youtube.com/embed/' . $id . '?rel=0" allowfullscreen></iframe></div>';
	
	return $out;
}  
add_shortcode('art_yt', 'artabr_youtube_video'); 


/* ------------------------------------------------------------------------- *
 *  Подключение кнопки в редакторе
/* ------------------------------------------------------------------------- */
function ivs_add_mce_button() {
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return; 
    }
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'ivs_add_tinymce_script' );
        add_filter( 'mce_buttons', 'ivs_register_mce_button' );
    }
}
add_action('admin_head', 'ivs_add_mce_button');
function ivs_add_tinymce_script( $plugin_array ) {
    $plugin_array['art_insert_yt'] = plugins_url('/mce/insert_video.js', __FILE__); 
    return $plugin_array;
}
function ivs_register_mce_button( $buttons ) {
    array_push( $buttons, 'art_insert_yt' ); 
    return $buttons;
}

/* ------------------------------------------------------------------------- *
 *  Подключение переводов
/* ------------------------------------------------------------------------- */
function artabr_ivs_load_plugin_textdomain() {
    load_plugin_textdomain( 'ivs-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'artabr_ivs_load_plugin_textdomain' );

function artabr_ivs_button_lang($locales) {
    $locales['art_insert_yt'] = plugin_dir_path ( __FILE__ ) . 'lang/translations.php';
    return $locales;
}
add_filter( 'mce_external_languages', 'artabr_ivs_button_lang');

/* ------------------------------------------------------------------------- *
 *  Подключение стилей и скриптов
/* ------------------------------------------------------------------------- */
function art_add_css(){
    wp_register_style( 'ivs_style', plugins_url( 'css/style.css', __FILE__)) ;
    wp_enqueue_style('ivs_style');
}
add_action('wp_enqueue_scripts', 'art_add_css');
add_action('admin_enqueue_scripts', 'art_add_css', 99 );

function art_add_datepicker(){
wp_enqueue_script('jquery-ui-datepicker');
//wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );
}
add_action('admin_enqueue_scripts', 'art_add_datepicker', 99 );
