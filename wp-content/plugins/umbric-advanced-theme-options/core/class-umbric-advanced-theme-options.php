<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Umbric_Advanced_Theme_Options_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Umbric_Advanced_Theme_Options' ) ) :

	/**
	 * Main Umbric_Advanced_Theme_Options Class.
	 *
	 * @package		UMBRICADV
	 * @subpackage	Classes/Umbric_Advanced_Theme_Options
	 * @since		1.0.0
	 * @author		PointClick Digital LLC
	 */
	final class Umbric_Advanced_Theme_Options {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Umbric_Advanced_Theme_Options
		 */
		private static $instance;

		/**
		 * UMBRICADV helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Umbric_Advanced_Theme_Options_Helpers
		 */
		public $helpers;

		/**
		 * UMBRICADV settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Umbric_Advanced_Theme_Options_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'umbric-advanced-theme-options' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'umbric-advanced-theme-options' ), '1.0.0' );
		}

		/**
		 * Main Umbric_Advanced_Theme_Options Instance.
		 *
		 * Insures that only one instance of Umbric_Advanced_Theme_Options exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Umbric_Advanced_Theme_Options	The one true Umbric_Advanced_Theme_Options
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Umbric_Advanced_Theme_Options ) ) {
				self::$instance					= new Umbric_Advanced_Theme_Options;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Umbric_Advanced_Theme_Options_Helpers();
				self::$instance->settings		= new Umbric_Advanced_Theme_Options_Settings();

				//Fire the plugin logic
				new Umbric_Advanced_Theme_Options_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'UMBRICADV/plugin_loaded' );
			}

			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once UMBRICADV_PLUGIN_DIR . 'core/includes/classes/class-umbric-advanced-theme-options-helpers.php';
			require_once UMBRICADV_PLUGIN_DIR . 'core/includes/classes/class-umbric-advanced-theme-options-settings.php';

			require_once UMBRICADV_PLUGIN_DIR . 'core/includes/classes/class-umbric-advanced-theme-options-run.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'umbric-advanced-theme-options', FALSE, dirname( plugin_basename( UMBRICADV_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.

add_action( 'init', 'pcd_cpt_register_post_type' );
function pcd_cpt_register_post_type() {
	$args = [
		'label'  => esc_html__( 'Services', 'text-domain' ),
		'labels' => [
			'menu_name'          => esc_html__( 'Services', 'pcd-cpt' ),
			'name_admin_bar'     => esc_html__( 'Service', 'pcd-cpt' ),
			'add_new'            => esc_html__( 'Add Service', 'pcd-cpt' ),
			'add_new_item'       => esc_html__( 'Add new Service', 'pcd-cpt' ),
			'new_item'           => esc_html__( 'New Service', 'pcd-cpt' ),
			'edit_item'          => esc_html__( 'Edit Service', 'pcd-cpt' ),
			'view_item'          => esc_html__( 'View Service', 'pcd-cpt' ),
			'update_item'        => esc_html__( 'View Service', 'pcd-cpt' ),
			'all_items'          => esc_html__( 'All Services', 'pcd-cpt' ),
			'search_items'       => esc_html__( 'Search Services', 'pcd-cpt' ),
			'parent_item_colon'  => esc_html__( 'Parent Service', 'pcd-cpt' ),
			'not_found'          => esc_html__( 'No Services found', 'pcd-cpt' ),
			'not_found_in_trash' => esc_html__( 'No Services found in Trash', 'pcd-cpt' ),
			'name'               => esc_html__( 'Services', 'pcd-cpt' ),
			'singular_name'      => esc_html__( 'Service', 'pcd-cpt' ),
		],
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite_no_front'    => false,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-performance',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
			'page-attributes',
		],
		'taxonomies' => [
			'category',
			'tag',
		],
		'rewrite' => [ 'slug' => 'services', ]
	];

	register_post_type( 'service', $args );
}