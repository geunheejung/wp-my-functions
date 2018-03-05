<?php
	// 사용자 정의 함수 파일 추가
	include_once( get_stylesheet_directory() . '/lib/custom-functions.php' );
	include_once( get_stylesheet_directory() . '/lib/app_download.php' );

  function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
  }
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	function theme_enqueue_scripts(){
	    wp_enqueue_script( 'custom-script',get_stylesheet_directory_uri() . '/lib/custom-script.js',array(),'1.0',true);
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
	// AppDownload Shortcode
	add_shortcode('app_download_btn', 'app_download');
	// Price Selector ShortCode
 	add_shortcode('plus_selector', 'selectorTypeIsPlus');
	add_shortcode('auto_selector', 'selectorTypeIsAuto');
	// Price Selector ShortCode Filter
?>
