<?php
/**
 * Plugin Name: Ig_api
 * Description: Simple ig feed widgets for Elementor.
 * Version:     1.0.0
 * Author:      David
 * Author URI:  https://github.com/davidkovacwebdev
 * Text Domain: elementor-addon
 */

function register_ig_feed_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/ig_api-widget-1.php' );

	$widgets_manager->register( new \Elementor_Ig_Feed_Widget() );

}

add_action( 'elementor/widgets/register', 'register_ig_feed_widget' );


function register_widget_styles() {
	wp_register_style( 'widget-style-1', plugins_url( 'css/ig_api-widget-1-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'register_widget_styles' );


/**
 * https://api.instagram.com/oauth/authorize?client_id=272499782539376&redirect_uri=https://redirectmeto.com/http://localhost/ElTest&scope=user_profile,user_media&response_type=code
 * 
 */