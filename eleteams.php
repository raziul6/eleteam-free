<?php
/*
Plugin Name: Ele Teams Lite
Plugin URI: http://themeunique.com/eleteams/
Description: Elementor Team Builder Plugin
Author: Syed Raziul Islam
Author URI: https://codecanyon.net/user/theme_unique
Version: 1.0
Text Domain: eleteams
Domain Path: languages
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class eleteams_Elementor_Dependency {
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			self::$_instance->setup_plugin_constants();
			self::$_instance->hooks();
		}
		return self::$_instance;
	}
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'init' ] );
	}
	
	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '%1$s requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Theme', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '%1$s requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Theme', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '%1$s requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'eleteams Theme', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	private function setup_plugin_constants(){
		if(!defined('ELETEAMSDIR')){			
			define( "ELETEAMSDIR", plugin_dir_path(__FILE__) );
		}
		if(!defined('ELETEAMSURL')){			
			define( "ELETEAMSURL", plugin_dir_url(__FILE__) );
		}
	}

	/**
	 * Default Hook and Actions
	 *
	 * @return void
	 */
	private function hooks(){
		add_action( 'plugins_loaded', array($this, 'eleteams_load_textdomain') );
		add_action('wp_enqueue_scripts', array($this, 'eleteams_frontend_scripts'));
		add_action('elementor/elements/categories_registered', array($this, 'add_elementor_custom_cat'));
	}
	
	/**
	 * Add Elementor Custom Category
	 *
	 * @param [type] $elements_manager
	 * @return void
	 */
	public function add_elementor_custom_cat( $elements_manager ) {
		$elements_manager->add_category(
			'eleteams-category',[
				'title' => esc_html__( 'Ele Teams', 'eleteams' ),
			]
		);
	}

	/**
	 * Load Ele Teams FrontEnd Scripts
	 *
	 * @return void
	 */
	public function eleteams_frontend_scripts(){
		wp_enqueue_style( 'eleteams-main', ELETEAMSURL . "assets/css/eleteams.css", );
	}

	/**
	 * Load Ele Teams Plugins Textdomain
	 */
	public function eleteams_load_textdomain(){
		load_plugin_textdomain( 'eleteams', false, ELETEAMSDIR ."/languages" );
	}
	
	/**
	 * init Widgets
	 *
	 * @return void
	 */
	public function init_widgets() {
		
		require_once ELETEAMSDIR . '/widgets/team-1.php';

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \eleteamOne() );     
	}

}

eleteams_Elementor_Dependency::instance();