<?php

	// CMB2
	if ( file_exists(  SHAREBEAR_PLUGIN_DIR . '/admin/cmb2/init.php' ) && ! defined( 'CMB2_LOADED' ) ) {
	  require_once  SHAREBEAR_PLUGIN_DIR . '/admin/cmb2/init.php';
	} elseif ( file_exists(  SHAREBEAR_PLUGIN_DIR . '/admin/CMB2/init.php' ) && ! defined( 'CMB2_LOADED' ) ) {
	  require_once  SHAREBEAR_PLUGIN_DIR . '/admin/CMB2/init.php';
	}

	// Options Page
	require_once SHAREBEAR_PLUGIN_DIR . 'admin/sharebear-options.php';

	// CMB2 Custom Fields
	require_once SHAREBEAR_PLUGIN_DIR . 'admin/fields/pt-search/cmb2_post_search_field.php';
	require_once SHAREBEAR_PLUGIN_DIR . 'admin/fields/radio-image/radio-image.php';