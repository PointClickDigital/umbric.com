<?php
/**
 * Advanced Theme Options for Umbric.com
 *
 * @package       UMBRICADV
 * @author        PointClick Digital LLC
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Advanced Theme Options for Umbric.com
 * Plugin URI:    https://pointclick.digital
 * Description:   Adds additional theme support ( Custom Post Types, Taxonomies, etc. )
 * Version:       1.0.0
 * Author:        PointClick Digital LLC
 * Author URI:    https://pointclick.digital
 * Text Domain:   umbric-advanced-theme-options
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function UMBRICADV() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'UMBRICADV_NAME',			'Advanced Theme Options for Umbric.com' );

// Plugin version
define( 'UMBRICADV_VERSION',		'1.0.0' );

// Plugin Root File
define( 'UMBRICADV_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'UMBRICADV_PLUGIN_BASE',	plugin_basename( UMBRICADV_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'UMBRICADV_PLUGIN_DIR',	plugin_dir_path( UMBRICADV_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'UMBRICADV_PLUGIN_URL',	plugin_dir_url( UMBRICADV_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once UMBRICADV_PLUGIN_DIR . 'core/class-umbric-advanced-theme-options.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  PointClick Digital LLC
 * @since   1.0.0
 * @return  object|Umbric_Advanced_Theme_Options
 */
function UMBRICADV() {
	return Umbric_Advanced_Theme_Options::instance();
}

UMBRICADV();
