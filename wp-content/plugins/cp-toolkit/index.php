<?php
/**
 * Plugin Name: CP Toolkit Elementor
 * Description: Custom Elementor extension by CreativePeoples.
 * Plugin URI:  
 * Version:     1.0.0
 * Author:      CreativePeoples
 * Text Domain: cp-toolkit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main CP Toolkit Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Cp_Toolkit {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Cp_Toolkit The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Cp_Toolkit An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'cp-toolkit' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'cp-toolkit' ),
			'<strong>' . esc_html__( 'CP Toolkit Extension', 'cp-toolkit' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cp-toolkit' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cp-toolkit' ),
			'<strong>' . esc_html__( 'CP Toolkit Extension', 'cp-toolkit' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cp-toolkit' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cp-toolkit' ),
			'<strong>' . esc_html__( 'CP Toolkit Extension', 'cp-toolkit' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'cp-toolkit' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/banner.php' );
		require_once( __DIR__ . '/widgets/current-leads.php' );
		require_once( __DIR__ . '/widgets/sales-directory.php' );
		require_once( __DIR__ . '/widgets/check-list-feature.php' );
		require_once( __DIR__ . '/widgets/featured-item.php' );
		require_once( __DIR__ . '/widgets/footer.php' );
		require_once( __DIR__ . '/widgets/hero-area.php' );
		require_once( __DIR__ . '/widgets/icon-cards.php' );
		require_once( __DIR__ . '/widgets/testimonials.php' );
		require_once( __DIR__ . '/widgets/services.php' );
		require_once( __DIR__ . '/widgets/demos.php' );
		require_once( __DIR__ . '/widgets/steps.php' );
		require_once( __DIR__ . '/widgets/case-study.php' );
		require_once( __DIR__ . '/widgets/logo-section.php' );
		require_once( __DIR__ . '/widgets/pricing-area.php' );
		require_once( __DIR__ . '/widgets/breadcum-area.php' );
		require_once( __DIR__ . '/widgets/cp-freequency.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Banner_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Current_Leads() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Sales_Directory() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Checklist_featrued() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Featured_Item() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Footer_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Hero_Area() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Icon_Cards() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Testimonials_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Services() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Demos() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Steps() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Case_Study() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Logo_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \pricing_area_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \cp_breadcum_area_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \freequency_area_Widget() );

	}

}

Cp_Toolkit::instance();


function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'creative-peoples',
		[
			'title' => __( 'CreativePeoples', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );