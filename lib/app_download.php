<?php
function get_app_download_style( $params ) {
	$btn_height = $params['height'];
	$btn_bg_color = $params['btn_bg_color'];
	$btn_ft_color = $params['btn_ft_color'];
	$btn_ft_size = $params['btn_ft_size'];
	$btn_show_spead = $params['btn_show_spead'];
	echo "
	<style>
		.bottom_btn_wrap, .app_download_btn {
			border: 0;
			text-align: center;
		} 
	
		.bottom_btn_wrap {
			box-sizing: border-box;
			z-index: 100000;
			position: fixed;
		    left: 0;
		    right: 0;
			bottom: 0px;
			width: 100%;
			margin:0 auto;
			height: {$btn_height}px;
			transform: translate(0, {$btn_height}px);
			-webkit-transform: translate(0, {$btn_height}px);
			-webkit-transition: -webkit-transform 500ms;
			transition: transform 500ms;
			border: 0;
		}

		.show_selector {
			-webkit-transform: translate(0px, 0px);
			 transform: translate(0px, 0px);
		}

		.app_download_btn {
			width: 100%;
			height: 100%;
			background-color: #{$btn_bg_color};
			color: #{$btn_ft_color};
			font-size: {$btn_ft_size};
			text-align: center;
		}
		
		.app_download_btn:visited {
		

		}
	</style>";
}

function get_user_mobile_device() {
	$mAgent = array("iPhone","iPod","Android","Blackberry",
		"Opera Mini", "Windows ce", "Nokia", "sony" );
	$chkMobile = false;
	for($i=0; $i<sizeof($mAgent); $i++){
			if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
					$chkMobile = true;
					return $mAgent[$i];
			}
	}
	return false;
}
function app_download( $atts, $content ) {
//	 if (!get_user_mobile_device()) return "<span class='bottom_btn_wrap'></span>";
	$params = shortcode_atts( array(
			'height' => '50',
			'btn_bg_color' => 'fff',
			'btn_ft_color' => 'fff',
			'btn_ft_size' => '13px',
			'btn_show_spead' => '500ms',
			'show_btn_point' => 30,
	), $atts );

	$link = get_user_mobile_device() === 'iPhone'
		? "location.href='https://itunes.apple.com/app/id1022299429?utm_source=webpage&utm_medium=banner&utm_campaign=appinstall&utm_term=img&utm_content=appstore_up'"
		: "location.href='https://play.google.com/store/apps/details?id=com.sidea.albamowner&utm_source=webpage&utm_medium=banner&utm_campaign=appinstall&utm_term=img&utm_content=playstore_up'";

	get_app_download_style( $params );
	// get_app_download_script( $params['show_btn_point'] );

	$result_btn = "<div class='bottom_btn_wrap'>
		<button class='app_download_btn' onclick={$link}>{$content}</butto>
	</div>";
	return $result_btn;
};

function app_download_filter( $atts ) {
	return $atts;
}
 ?>
