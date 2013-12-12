<?php

/**
 * Sets up Genesis Framework to our needs
 * @package AgriFlex3
 * @since 1.0
 */
class AgriFlex_Genesis {

	public function __construct() {

		// Add Genesis HTML5 support
		$this->add_html5_support();

		// Add the responsive viewport
		$this->add_responsive_viewport();

		// Keep Genesis from loading any stylesheets
		$this->remove_stylesheet();

		// Force IE out of compatibility mode
		add_action( 'genesis_meta', array( $this, 'fix_compatibility_mode' ) );

		// Remove default html5shiv
		remove_action( 'wp_head', 'genesis_html5_ie_fix' );

		// Specify the favicon location
		add_filter( 'genesis_pre_load_favicon', array( $this, 'add_favicon' ) );

		// Create the structural wraps
		$this->add_structural_wraps();

		// Remove profile fields
		add_action( 'admin_init', array( $this, 'remove_profile_fields' ) );

		// Remove unneeded layouts
		$this->remove_genesis_layouts();

		// Remove unneeded sidebars
		$this->remove_genesis_sidebars();

	}

	/**
	 * Enables HTML5 support in Genesis
	 * @since 1.0
	 * @return void
	 */
	private function add_html5_support() {

		add_theme_support( 'html5' );

	}

	/**
	 * Adds the responsive viewport meta tag
	 * @since 1.0
	 * @return void
	 */
	private function add_responsive_viewport() {

		add_theme_support( 'genesis-responsive-viewport' );

	}

	/**
	 * Removes any stylesheet Genesis may try to load
	 * @since 1.0
	 * @return void
	 */
	private function remove_stylesheet() {

		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

	}

	/**
	 * Forces IE out of compatibility mode
	 * @since 1.0
	 * @return void
	 */
	public function fix_compatibility_mode() {

		echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge">';

	}

	/**
	 * Changes the Genesis default favicon location
	 * @since 1.0
	 * @param string $favicon_url The default favicon location
	 * @return string
	 */
	public function add_favicon( $favicon_url ) {

		return AF_THEME_DIRURL . '/img/favicon.ico';

	}

	/**
	 * Adds structural wraps to the specified elements
	 * @since 1.0
	 * @return void
	 */
	private function add_structural_wraps() {

		add_theme_support(
			'genesis-structural-wraps',
			array(
				'header',
				'menu-primary',
				'site-inner',
				'footer',
			)
		);

	}

	/**
	 * Remove unneeded user profile fields
	 * @since 1.0
	 * @return void
	 */
	public function remove_profile_fields() {

		remove_action( 'show_user_profile', 'genesis_user_options_fields' );
		remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
		remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
		remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
		remove_action( 'show_user_profile', 'genesis_user_seo_fields'     );
		remove_action( 'edit_user_profile', 'genesis_user_seo_fields'     );
		remove_action( 'show_user_profile', 'genesis_user_layout_fields'  );
		remove_action( 'edit_user_profile', 'genesis_user_layout_fields'  );

	}

	/**
	 * Removes any layouts that we don't need
	 * @since 1.0
	 * @return void
	 */
	private function remove_genesis_layouts() {

		genesis_unregister_layout( 'content-sidebar-sidebar' );
		genesis_unregister_layout( 'sidebar-sidebar-content' );
		genesis_unregister_layout( 'sidebar-content-sidebar' );

	}

	/**
	 * Removes any default sidebars that we don't need
	 * @since 1.0
	 * @return void
	 */
	private function remove_genesis_sidebars() {

		unregister_sidebar( 'sidebar-alt' );
		unregister_sidebar( 'header-right' );

	}

}