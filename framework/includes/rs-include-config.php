<?php
/**
 * Loads Shortcodes and other Stuffs.
 *
 * @package cakes
 * @since 1.0
 */


// Metaboxes Integration
// ----------------------------------------------------------------------------------------------------
if( !defined( 'RWMB_URL' ) && !defined( 'RWMB_DIR' ) ) {
  define( 'RWMB_URL', trailingslashit( T_URI . '/' . F_PATH .'/includes/meta-box') );
  define( 'RWMB_DIR', trailingslashit( T_PATH . '/'. F_PATH .'/includes/meta-box') );
}

include_once RWMB_DIR . 'meta-box.php';
include_once( T_PATH .'/'. F_PATH .'/includes/rs-metaboxes-config.php');

// Import Integration
// ----------------------------------------------------------------------------------------------------
locate_template('framework/includes/importer/init.php', true);

// TGM Integration
// ----------------------------------------------------------------------------------------------------
locate_template('framework/includes/plugins/tgm/class-tgm-plugin-activation.php', true);

