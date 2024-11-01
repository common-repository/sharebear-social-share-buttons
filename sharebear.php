<?php
/**
 * Plugin Name: Sharebear
 * Plugin URI: http://www.mapsteps.com/downloads/
 * Description: Just another WordPress sharing plugin.
 * Version: 1.1
 * Author: MapSteps
 * Author URI: http://www.mapsteps.com
 * Text Domain: sharebear
 */

	// exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) exit;

	// Plugin constants
	define( 'SHAREBEAR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
	define( 'SHAREBEAR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

	// Textdomain
	add_action( 'plugins_loaded', 'sharebear_textdomain' );
	function sharebear_textdomain() {
		load_plugin_textdomain( 'sharebear', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

	// Sharebear Styles & Scripts
	function sharebear_scripts() {
		if ( ! sharebear_get_option('sharebear_bypass_fontawesome') ) {
			wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
			wp_enqueue_style( 'font-awesome' );
		}
		wp_register_style( 'sharebear', SHAREBEAR_PLUGIN_URL . 'assets/css/sharebear.css' );
		wp_enqueue_style( 'sharebear' );
		wp_register_script( 'sharebear', SHAREBEAR_PLUGIN_URL . 'assets/js/sharebear.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'sharebear' );
	}
	add_action( 'wp_enqueue_scripts', 'sharebear_scripts' );

	// Required Files
	require_once SHAREBEAR_PLUGIN_DIR . 'admin/sharebear-admin.php';
	require_once SHAREBEAR_PLUGIN_DIR . 'includes/sharebear-construct.php';
	require_once SHAREBEAR_PLUGIN_DIR . 'includes/sharebear-output.php';