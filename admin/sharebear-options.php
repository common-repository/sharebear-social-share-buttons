<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class sharebear {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'sharebear';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'sharebear_option_metabox';
	private $metabox_id_misc = 'sharebear_option_metabox_misc';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var sharebear
	 **/
	private static $instance = null;

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	private function __construct() {
		// Set our title
		$this->title = __( 'Sharebear', 'sharebear' );
	}

	/**
	 * Returns the running object
	 *
	 * @return sharebear
	 **/
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox_misc' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_options_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {  ?>

		<style type="text/css">
			#ms-content-wrapper {
				display: table;
				width: 100%;
			}
			#ms-content, #ms-sidebar {
				display: table-cell;
				vertical-align: top;
			}
			#ms-content {
				min-width: 800px;
			}
			#ms-sidebar {
				min-width: 280px;
				width: 320px;
				padding: 30px 30px 0 0;
			}
			#ms-sidebar mark {
				padding: 5px;
				display: inline-block;
				/*color: #fff;*/
			}
			#ms-sidebar section {
				margin-bottom: 2em;
				padding-bottom: 2em;
				border-bottom: 1px solid #ccc;
			}
			#ms-sidebar section:last-child {
				padding-bottom: 0;
				border-bottom: none;
			}
			#ms-sidebar .ms-section-content {
				/*text-align: center;*/
				padding: 2em;
				background: #fff;
			}
			#ms-sidebar .ms-section-content h3 {
				margin-top: 0;
			}
			#ms-sidebar img {
				width: 100%;
				height: auto;
			}
			#ms-sidebar a {
				text-decoration: none;
			}
			#ms-sidebar a:focus {
				box-shadow:none;
			}
			#ms-sidebar .button-primary {
				/*margin-bottom: 2em;*/
				background: #384048;
				box-shadow:none;
				padding: 0 1.5em;
				height: 38px;
				line-height: 38px;
				text-shadow: none;
				border:none;
				text-transform: uppercase;
				 -webkit-transition: background 0.25s ease; /* Firefox */
				-moz-transition: background 0.25s ease; /* WebKit */
				-o-transition: background 0.25s ease; /* Opera */
				transition: background 0.25s ease; /* Standard */
			}
			#ms-sidebar .button-primary:hover {
				background: #4bd1c0;
			}
			.ms-divider {
				margin: 1em 0;
				width: 100%;
				height: 2px;
				background: #ccc;
			}
		</style>

		<div id="ms-content-wrapper">
			<div id="ms-content">

				<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
					<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

					<?php
						$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings';
						if( isset( $_GET[ 'tab' ] ) ) {
							$active_tab = $_GET[ 'tab' ];
						}
					?>

					<!-- Tabs -->
					<h2 class="nav-tab-wrapper">
						<a href="?page=sharebear&tab=settings" class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings','sharebear'); ?></a>
						<a href="?page=sharebear&tab=misc" class="nav-tab <?php echo $active_tab == 'misc' ? 'nav-tab-active' : ''; ?>"><?php _e('Misc','sharebear'); ?></a>
					</h2>

				<?php

				if ($active_tab == 'misc') {

					cmb2_metabox_form( $this->metabox_id_misc, $this->key );

				} elseif ($active_tab == 'settings') {

					cmb2_metabox_form( $this->metabox_id, $this->key );

				} ?>


				</div>

		    </div>

			<div id="ms-sidebar">
				<h2><?php _e('Our Recommendations', 'sharebear'); ?></h2>

				<section>
					<a href="<?php _e('https://mapsteps.com/en/downloads/sharebear/', 'sharebear'); ?>" target="_blank">
						<img src="<?php echo SHAREBEAR_PLUGIN_URL ?>/admin/img/sharebear_pro.jpg">
					</a>
					<div class="ms-section-content">
						<a href="<?php _e('https://mapsteps.com/en/downloads/sharebear/', 'sharebear'); ?>" target="_blank">
							<h3><?php _e('Sharebear Pro <mark>(FREE!)</mark>', 'sharebear'); ?></h3>
						</a>
						<p><?php _e('<strong>LIMITED OFFER!</strong> Download sharebear Pro for free and take advantage of the [sharebear] shortcode and other cool features!','sharebear'); ?></p>
						<a href="<?php _e('https://mapsteps.com/en/downloads/sharebear/', 'sharebear'); ?>" class="button button-primary" target="_blank">
							<?php _e('Download', 'sharebear'); ?>
						</a>
					</div>
				</section>

				<section>
					<a href="<?php _e('https://mapsteps.com/en/downloads/responsive-youtube-vimeo-popup-wordpress/', 'sharebear'); ?>" target="_blank">
						<img src="<?php echo SHAREBEAR_PLUGIN_URL ?>/admin/img/responsive-youtube-vimeo-video-popup-pro.jpg">
					</a>
					<div class="ms-section-content">
						<a href="<?php _e('https://mapsteps.com/en/downloads/responsive-youtube-vimeo-popup-wordpress/', 'sharebear'); ?>" target="_blank">
							<h3><?php _e('Responsive YouTube & Vimeo Video Popup PRO', 'sharebear'); ?></h3>
						</a>
						<p><?php _e('Create Responsive YouTube & Vimeo Popups in WordPress.', 'sharebear'); ?></p>
						<a href="<?php _e('https://mapsteps.com/en/downloads/responsive-youtube-vimeo-popup-wordpress/', 'sharebear'); ?>" class="button button-primary" target="_blank">
							<?php _e('Download', 'sharebear'); ?>
						</a>
					</div>
				</section>

				<section>
					<a href="<?php _e('https://mapsteps.com/en/downloads/ultimate-dashboard-pro/', 'sharebear'); ?>" target="_blank">
						<img src="<?php echo SHAREBEAR_PLUGIN_URL ?>/admin/img/Ultimate_Dashboard_PRO.jpg">
					</a>
					<div class="ms-section-content">
						<a href="<?php _e('https://mapsteps.com/en/downloads/ultimate-dashboard-pro/', 'sharebear'); ?>" target="_blank">
							<h3><?php _e('Ultimate Dashboard PRO', 'sharebear'); ?></h3>
						</a>
						

						<p><?php _e(' Ultimate Dashboard gives you full control over your WordPress Dashboard. Remove the default Dashboard Widgets and and create your own to provide the best User Experience for your users and clients.','sharebear'); ?></p>
						<a href="<?php _e('https://mapsteps.com/en/downloads/ultimate-dashboard-pro/', 'sharebear'); ?>" class="button button-primary" target="_blank">
							<?php _e('Download', 'sharebear'); ?>
						</a>
					</div>

				</section>

				<section>
					<a href="<?php _e('https://mapsteps.com/en/downloads/timber-wordpress-admin-theme/', 'sharebear'); ?>" target="_blank">
						<img src="<?php echo SHAREBEAR_PLUGIN_URL ?>/admin/img/Timber_Admin.jpg">
					</a>
					<div class="ms-section-content">
						<a href="<?php _e('https://mapsteps.com/en/downloads/timber-wordpress-admin-theme/', 'sharebear'); ?>" target="_blank">
							<h3><?php _e('Timber – Admin Theme', 'sharebear'); ?></h3>
						</a>
						<p><?php _e('Timber is a modern and minimalistic WordPress Admin theme that will allow you to customize the WordPress admin dashboard for you and your clients.','sharebear'); ?></p>
						<a href="<?php _e('https://mapsteps.com/en/downloads/timber-wordpress-admin-theme/', 'sharebear'); ?>" class="button button-primary" target="_blank">
							<?php _e('Download', 'sharebear'); ?>
						</a>
					</div>
				</section>
			</div>

	    </div>

		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		$prefix = 'sharebear_';

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		// Options Title
		$cmb->add_field( array(
			'name' => __( 'Share Buttons', 'sharebear' ),
			'desc' => __( 'Choose the sharing buttons you would like to display', 'sharebear' ),
			'id'   => $prefix . 'options_title',
			'type' => 'title',
		) );

		// Platforms
		$cmb->add_field( array(
			'id'      => $prefix . 'platform',
			'type'    => 'select',
			'show_option_none' => true,
			'repeatable' => true,
			'text' => array(
				'add_row_text' => __( 'Add Share Button', 'sharebear' ),
				),
			'options' => array(
				'sb-facebook' => 'Facebook',
				'sb-twitter' => 'Twitter',
				'sb-google-plus' => 'Google+',
				'sb-linkedin' => 'LinkedIn',
				'sb-reddit' => 'Reddit',
				'sb-pinterest' => 'Pinterest',
				'sb-stumbleupon' => 'StumbleUpon',
				'sb-envelope' => 'Email',
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'Display Settings', 'sharebear' ),
			'id'   => $prefix . 'display_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name' => 'Headline',
		    'desc' => 'Headline for the sharing button section.',
		    'attributes' => array(
		    	'placeholder' => 'Share this post',
		    	),
		    'id'   => $prefix . 'headline',
		    'type' => 'text',
		) );

		$cmb->add_field( array(
			'name'			   => 'Layout',
		    'id'               => $prefix . 'layout',
		    'type'             => 'radio_image',
		    'options'          => array(
		        'sb-none' => __('None', 'cmb2'),
		        'sb-outlined'    => __('Outlined', 'cmb2'),
		        'sb-rounded'  => __('Rounded', 'cmb2'),
		        'sb-boxed' => __('Boxed', 'cmb2'),
		    ),
		    'default' => 'sb-boxed',
		    'images_path'      => SHAREBEAR_PLUGIN_URL,
		    'images'           => array(
		        'sb-none' => 'assets/img/sb-none.jpg',
		        'sb-outlined'    => 'assets/img/sb-outlined.jpg',
		        'sb-rounded'  => 'assets/img/sb-rounded.jpg',
		        'sb-boxed' => 'assets/img/sb-boxed.jpg',
		    )
		) );

		// Style
		$cmb->add_field( array(
			'name'			   => 'Style',
		    'id'               => $prefix . 'style',
		    'type'             => 'radio_image',
		    'options'          => array(
		        'sb-grey' => __('Grey', 'cmb2'),
		        'sb-brand-color'    => __('Brand Colors', 'cmb2'),
		        'sb-filled'  => __('Filled', 'cmb2'),
		    ),
		    'default' => 'sb-filled',
		    'images_path'      => SHAREBEAR_PLUGIN_URL,
		    'images'           => array(
				'sb-grey'    => 'assets/img/sb-none.jpg',
				'sb-brand-color'  => 'assets/img/sb-brand-color.jpg',
				'sb-filled' => 'assets/img/sb-filled.jpg',
		    )
		) );

		$cmb->add_field( array(
			'name'			   => 'Size',
		    'id'               => $prefix . 'size',
		    'type'             => 'radio_inline',
		    'options'          => array(
		        'sb-small'    => __('Small', 'cmb2'),
		        'sb-medium'    => __('Medium', 'cmb2'),
		        'sb-large'  => __('Large', 'cmb2'),
		    ),
		    'default' => 'sb-medium',
		) );

		$cmb->add_field( array(
			'name' => __( 'Location', 'sharebear' ),
			// 'desc' => __( 'You can manually output the share icons via shortcode <code>[sharebear]</code> or display them on every post.', 'sharebear' ),
			'id'   => $prefix . 'location_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Display', 'sharebear' ),
		    'id'   => $prefix . 'locations',
			'select_all_button' => false,
			'type'    => 'multicheck_inline',
			'options' => array(
				'before_content' => __( 'Before Content', 'sharebear' ),
				'after_content' => __( 'After Content', 'sharebear' ),
				'sidebar' => __( 'Floating Sidebar', 'sharebear' ),
			),
		) );

		$post_types = get_post_types( array( 'public' => true, ) );
		foreach ($post_types as $post_type => $cpt) {
			$array[] = array(
				$cpt => $cpt
			);
		}

		$merged_array = array_reduce($array, 'array_merge', []);

		$foo = array(
			'name' => 'Post Types',
			'id'   => $prefix . 'cpts',
			'type' => 'multicheck_inline',
			'select_all_button' => false,
			'options' => $merged_array
		);

		$cmb->add_field( $foo );

		$cmb->add_field( array(
			'name'    => 'Exclude page(s)',
			'id'   => $prefix . 'exclude_pages',
			'desc'    => "can be a comma seperated list of page id's and/or slugs.",
		    'type'        => 'post_search_text',
		    'post_type'   => 'page',
		    'select_type' => 'checkbox',
		    'select_behavior' => 'add',
		) );

		$cmb->add_field( array(
			'name'    => 'Exclude post(s)',
			'id'   => $prefix . 'exclude_posts',
			'desc'    => "can be a comma seperated list of post id's and/or slugs.",
		    'type'        => 'post_search_text',
		    'post_type'   => 'post',
		    'select_type' => 'checkbox',
		    'select_behavior' => 'add',
		) );

	}

	function add_options_page_metabox_misc() {

		$prefix = 'sharebear_';

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id_misc}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id_misc,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		// Options Title
		$cmb->add_field( array(
			'name' => __( 'Misc', 'sharebear' ),
			'id'   => $prefix . 'misc_title',
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name' => 'Twitter Handle',
			'desc' => 'Your twitter username goes here',
			'attributes' => array(
				'placeholder' => '@Twitter',
				),
			'id'   => $prefix . 'twitter_handle',
			'type' => 'text_medium',
		) );

		$cmb->add_field( array(
			'name' => 'Email Subject',
			'default' => 'Hi friend!',
			'id'   => $prefix . 'email_subject',
			'type' => 'text_medium',
		) );

		$cmb->add_field( array(
			'name' => 'Email Message',
			'default' => 'Check out this post I came across:',
			'id'   => $prefix . 'email_message',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name' => 'Headline Markup',
		    'desc' => 'By default, the headline is wrapped in a &lt;h5&gt; tag. you can change this here.',
		    'default' => 'h5',
		    'id'   => $prefix . 'headline_markup',
		    'type' => 'text_medium',
		) );

		$cmb->add_field( array(
			'name' => 'Bypass FontAwesome',
			'desc' => "By checking this option Sharebear doesn't load FontAwesome CSS. Only check this option if FontAwesome is already enqueued by your theme!",
			'id'   => $prefix . 'bypass_fontawesome',
			'type' => 'checkbox',
		) );

	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'sharebear' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'metabox_id_misc', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the sharebear object
 * @since  0.1.0
 * @return sharebear object
 */
function sharebear() {
	return sharebear::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function sharebear_get_option( $key = '' ) {
	return cmb2_get_option( sharebear()->key, $key );
}

// Get it started
sharebear();
