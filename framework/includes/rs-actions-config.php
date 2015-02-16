<?php
/**
 * The template for requried actions hooks.
 *
 * @package cakes
 * @since 1.0
 */
add_action( 'wp_enqueue_scripts', 'cakes_scripts' );
add_action( 'wp_head', 'cakes_custom_styles', 8);
add_action( 'admin_head', 'cakes_admin_custom_styles', 8 );
add_action( 'tgmpa_register', 'cakes_include_required_plugins' );


/**
 * Enqueue scripts and styles.
 */
function cakes_scripts() {
  wp_enqueue_style( 'wp-style', get_stylesheet_uri() );
  wp_enqueue_style( 'cakes-style', T_CSS . '/style.css' );
  wp_enqueue_style( 'fonts', T_URI . '/fonts/fonts.css' );

  wp_enqueue_script( 'cakes-swiper', T_URI . '/js/idangerous.swiper.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'cakes-skrollr', T_URI . '/js/skrollr.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'cakes-circliful', T_URI . '/js/jquery.circliful.min.js', array('jquery'), '1.0.0', true );

    wp_enqueue_script( 'cakes-mixitup', T_URI . '/js/jquery.mixitup.min.js', array('jquery'), '1.0.0', true );

  if (is_page()) {
    wp_enqueue_script( 'google-map', 'http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en', array(), '1.0.0', true );
    wp_enqueue_script( 'cakes-map', T_URI . '/js/map.js', array('jquery'), '1.0.0', true );
  }

  wp_enqueue_script( 'cakes-main', T_URI . '/js/main.js', array('jquery'), '1.0.0', true );

  if ( is_singular() ) {
    wp_enqueue_script( 'cakes-sharethis', 'http://w.sharethis.com/button/buttons.js', array(), '1.0.0', true );
    wp_enqueue_script( 'single-scripts', T_URI . '/js/single-scripts.js', array('jquery'), '1.0.0', true );
  }

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

}

function cakes_include_required_plugins() {

	$plugins = array(

		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> T_PATH .'/'. F_PATH .'/includes/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Cakes Plugins', // The plugin name
			'slug'     				=> 'cakes-plugins', // The plugin slug (typically the folder name)
			'source'   				=> T_PATH .'/'. F_PATH .'/includes/plugins/cakes-plugins.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
	);

	// Change this to your theme text domain, used for internationalising strings

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'cakes',         			// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'cakes' ),
			'menu_title'                       			=> __( 'Install Plugins', 'cakes' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'cakes' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'cakes' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'cakes' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'cakes' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'cakes' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

function cakes_custom_styles() {

	global $cakes_opt;

	// general settings
	$logo = $cakes_opt['general-logo']['url'];
	$logo_height=$cakes_opt['general-logo-height'];
	$logo_width=$cakes_opt['general-logo-width'];

	// css code
	$css_code = $cakes_opt['css-code'];


	$style  =	'<style type="text/css" media="screen">';
	$style .=	'#header .logo .icon {background:url('.$logo.') center no-repeat; width:'.$logo_width.'px !important; height:'.$logo_height.'px !important;}';
	$style .= 	$css_code;

	$style .=	'</style>';

	echo $style;
}

// Desable row layouts controls
function cakes_admin_custom_styles() {
    echo '<style>.vc_row_layouts.vc_control{display:none !important;}</style>';
}
