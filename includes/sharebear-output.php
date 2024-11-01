<?php
/*
 * Output
 */

	// After Content
	function sharebear_after_content($content) {
		
		// vars
		$sharebear_cpts = sharebear_get_option('sharebear_cpts');
		$location = sharebear_get_option('sharebear_locations');

		$sharebear_exclude_pages = sharebear_get_option('sharebear_exclude_pages');
		$sharebear_exclude_posts = sharebear_get_option('sharebear_exclude_posts');
		$sharebear_pages_array = explode(", ",$sharebear_exclude_pages);
		$sharebear_posts_array = explode(", ",$sharebear_exclude_posts);

		if( $location && in_array("after_content", $location) && $sharebear_cpts && is_singular($sharebear_cpts) && !is_single($sharebear_posts_array) && !is_page($sharebear_pages_array) ) {
			$content .= '<div class="sb-content sb-after-content">';
			$content .= sharebear_construct();
			$content .= '</div>';
			return $content;
		} else {
			return $content;
		}
	}
	add_filter('the_content', 'sharebear_after_content');

	// Before Content
	function sharebear_before_content($content) {

		// vars
		$sharebear_cpts = sharebear_get_option('sharebear_cpts');
		$location = sharebear_get_option('sharebear_locations');

		$sharebear_exclude_pages = sharebear_get_option('sharebear_exclude_pages');
		$sharebear_exclude_posts = sharebear_get_option('sharebear_exclude_posts');
		$sharebear_pages_array = explode(", ",$sharebear_exclude_pages);
		$sharebear_posts_array = explode(", ",$sharebear_exclude_posts);

		if( $location && in_array("before_content", $location) && $sharebear_cpts && is_singular($sharebear_cpts) && !is_single($sharebear_posts_array) && !is_page($sharebear_pages_array) ) {
			$before_content = sharebear_construct();
			$before_content_wrapper = '<div class="sb-content sb-before-content">';
			$before_content_wrapper_close = '</div>';
			return $before_content_wrapper . $before_content . $before_content_wrapper_close . $content;
		} else {
			return $content;
		}
	}
	add_filter('the_content', 'sharebear_before_content');

	// Sidebar Posts
	function sharebear_sidebar($content) {

		// vars
		$sharebear_cpts = sharebear_get_option('sharebear_cpts');
		$location = sharebear_get_option('sharebear_locations');

		$sharebear_exclude_pages = sharebear_get_option('sharebear_exclude_pages');
		$sharebear_exclude_posts = sharebear_get_option('sharebear_exclude_posts');
		$sharebear_pages_array = explode(", ",$sharebear_exclude_pages);
		$sharebear_posts_array = explode(", ",$sharebear_exclude_posts);

			if( $location && in_array("sidebar", $location) && $sharebear_cpts && is_singular($sharebear_cpts) && !is_single($sharebear_posts_array) && !is_page($sharebear_pages_array) ) {
				echo '<div class="sb-sidebar">';
				echo sharebear_construct();
				echo '</div>';
			}

	}
	add_filter('wp_footer', 'sharebear_sidebar');