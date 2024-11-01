<?php
/*
 * Construct Output
 */

	function sharebear_construct() {

		// Get Platforms
		$sharebear_platforms = sharebear_get_option('sharebear_platform');

		// stop sharebear if no platforms are selected
		if ( ! $sharebear_platforms ) return;

		// Initialize output
		$sharebear_output = '';

		// get title + permalink
		$permalink = get_permalink();
		$title = the_title_attribute('echo=0');
		$source = get_site_url();

		// Headline
		$sharebear_headline = sharebear_get_option('sharebear_headline');

		// Headline Markup
		$sharebear_headline_markup = sharebear_get_option('sharebear_headline_markup');
		if (!$sharebear_headline_markup) {
			$sharebear_headline_markup = "h5";
		}

		// Styles | Layout | Sizes
		$sharebear_layout = sharebear_get_option('sharebear_layout');
		$sharebear_style = sharebear_get_option('sharebear_style');
		$sharebear_size = sharebear_get_option('sharebear_size');
		if (!$sharebear_size) {
			$sharebear_size = "sb-medium";
		}

		// Twitter handle
		$twitterhandle = sharebear_get_option('sharebear_twitter_handle');
		if ($twitterhandle) {
			$handle ='&via='. $twitterhandle;
			$handle = str_replace( "@", "", $handle );
		} else {
			$handle = "";
		}

		// email
		$emailsubject = sharebear_get_option('sharebear_email_subject');
		$emailmessage = sharebear_get_option('sharebear_email_message');
		$emailsubject ? '' : $emailsubject = 'Hi friend!';
		$emailmessage ? '' : $emailmessage = 'Check out this post I came across:';

		// Output Sharebear Wrapper
		$sharebear_output .= "<div class='sharebear $sharebear_layout $sharebear_style $sharebear_size'>";

		// Output Headline
		if ($sharebear_headline ? $sharebear_output .= '<'. $sharebear_headline_markup .' class="sb-title">'. $sharebear_headline .' </'. $sharebear_headline_markup .'>' : '' );

		foreach( $sharebear_platforms as $sharebear_platform => $key) {

			/* Set correct URL for every platform */

			// Facebook
			if($key == 'sb-facebook') {
				$linktitle = __('Share on Facebook', 'sharebear');
				$url = 'http://www.facebook.com/sharer/sharer.php?u='.urlencode($permalink).'&title='.urlencode($title).'';
			}
			// Twitter
			if ($key == 'sb-twitter') {
				$linktitle = __('Share on Twitter', 'sharebear');
				$url = 'http://twitter.com/share?text='.urlencode($title).'&url='.urlencode($permalink) . $handle.'';
			}
			// Google+
			if ($key == 'sb-google-plus') {
				$linktitle = __('Share on Google+', 'sharebear');
				$url = 'https://plus.google.com/share?url='.urlencode($permalink).'';
			}
			// Reddit
			if ($key == 'sb-reddit') {
				$linktitle = __('Share on Reddit', 'sharebear');
				$url = 'http://www.reddit.com/submit?url='.urlencode($permalink).'&title='.urlencode($title).'';
			}
			// LinkedIn
			if ($key == 'sb-linkedin') {
				$linktitle = __('Share on LinkedIn', 'sharebear');
				$url = 'http://www.linkedin.com/shareArticle?mini=true&url='.urlencode($permalink).'&title='.urlencode($title).'&source='.urlencode($source).'';
			}
			// Mail
			if ($key == 'sb-envelope') {
				$linktitle = __('Send via Email', 'sharebear');
				$url = 'mailto:?subject='. $emailsubject .'&body='. $emailmessage .' '. urlencode($permalink).'';
			}
			// Pinterest
			if ($key == 'sb-pinterest') {
				$linktitle = __('Pin on Pinterest', 'sharebear');
				$url = 'http://pinterest.com/pin/create/button/?url='.urlencode($permalink).'&description='.urlencode($title).'';
			}
			// StumbleUpon
			if ($key == 'sb-stumbleupon') {
				$linktitle = __('StumbleUpon', 'sharebear');
				$url = 'http://www.stumbleupon.com/submit?url='.urlencode($permalink).'&title='.urlencode($title).'';
			}

			// FontAwesome
			$FontAwesome = str_replace('sb-', 'fa-', $key);

			// show button text only if layout is button
			if ( $sharebear_layout == 'sb-button' ) {
				$sharetext = "<span class='sb-button-text'>$linktitle</span>";
			} else {
				$sharetext = "";
			}

			// Output Link
			$sharebear_output .= "<a title='$linktitle' class='sb-icon $key' href='$url'><i class='fa $FontAwesome' aria-hidden='true'></i>$sharetext</a>";

		}

		// Close Wrapper
		$sharebear_output .= "</div>";

		// Return Output
		return $sharebear_output;

	}