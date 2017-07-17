<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*** Plugin Scripts and CSS ***/
if (!function_exists('sp_wps_scripts_style')) {
	function sp_wps_scripts_style(){
		// CSS Files
		wp_enqueue_style('slick', SP_WPS_URL . 'assets/css/slick.css', array(), NULL);
		wp_enqueue_style('font-awesome', SP_WPS_URL . 'assets/css/font-awesome.min.css', array(), NULL);
		wp_enqueue_style('wps-style', SP_WPS_URL . 'assets/css/style.css');

		//JS Files
		wp_enqueue_script( 'slick-min-js', SP_WPS_URL . 'assets/js/slick.min.js', array('jquery'), NULL, TRUE );
	}
	add_action('wp_enqueue_scripts', 'sp_wps_scripts_style');
}


// Load WP Color Picker
function wpsf_widget_color_picker() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'load-widgets.php', 'wpsf_widget_color_picker' );