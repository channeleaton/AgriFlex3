<?php

/**
 * Loads required theme assets
 * @package AgriFlex3
 * @since 1.0
 */
class AgriFlex_Assets {

	public function __construct() {

		// Register all scripts used in the theme
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

		// Enqueue global scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_scripts' ) );
		
		// Register all styles used in the theme
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		// Enqueue global styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_styles' ) );

	}

	public function register_scripts() {

		wp_register_script( 'foundation',
			AF_THEME_DIRURL . '/bower_components/foundation/js/foundation.js',
			array( 'jquery' ),
			false,
			true
		);

		wp_register_script( 'foundation-topbar',
			AF_THEME_DIRURL . '/bower_components/foundation/js/foundation/foundation.topbar.js',
			array( 'foundation' ),
			false,
			true
		);

		wp_register_script( 'agriflex-public',
			AF_THEME_DIRURL . '/js/src/public.min.js',
			false,
			false,
			true
		);

	}

	public function enqueue_global_scripts() {

		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'foundation-topbar' );
		wp_enqueue_script( 'agriflex-public' );

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