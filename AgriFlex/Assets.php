<?php

/**
 * Loads required theme assets
 * @package AgriFlex3
 * @since 1.0
 */
class AgriFlex_Assets {

	public function __construct() {

		// Register all styles used in the theme
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		// Enqueue global styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_styles' ) );

	}

	/**
	 * Registers all styles used within the theme
	 * @since 1.0
	 * @return void
	 */
	public function register_styles() {

		wp_register_style(
			'default-styles',
			AF_THEME_DIRURL . '/css/default.css',
			array(),
			'',
			'screen'
		);

	}

	/**
	 * Enqueues styles used globally
	 * @since 1.0
	 * @global $wp_styles
	 * @return void
	 */
	public function enqueue_global_styles() {

		global $wp_styles;

		wp_enqueue_style( 'default-styles' );

	}

}