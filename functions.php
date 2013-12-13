<?php
/**
 * AgriFlex3
 * @package      AgriFlex3
 * @since        1.0.0
 * @copyright    Copyright (c) 2013, Texas A&M AgriLife
 * @license      GPL-2.0+
 */

// Initialize Genesis
require_once TEMPLATEPATH . '/lib/init.php';

// Define some useful constants
define( 'AF_THEME_DIRNAME', 'AgriFlex3' );
define( 'AF_THEME_DIRPATH', get_stylesheet_directory() );
define( 'AF_THEME_DIRURL', get_stylesheet_directory_uri() );

// Autoload all classes
spl_autoload_register( 'AgriFlex::autoload' );

class AgriFlex {

	private static $file = __FILE__;

	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );

	}

	/**
	 * Initialize the various classes
	 * @since 1.0
	 * @return void
	 */
	public function init() {

		// Get Genesis setup the way we want it
		$af_genesis = new AgriFlex_Genesis;

		// Enqueue our assets
		$af_assets = new AgriFlex_Assets;

	}

	/**
	 * Autoloads any classes called within the theme
	 * @since 1.0
	 * @param  string $classname The name of the class
	 * @return void
	 */
	public static function autoload( $classname ) {

		$filename = dirname( __FILE__ ) .
      DIRECTORY_SEPARATOR .
      str_replace( '_', DIRECTORY_SEPARATOR, $classname ) .
      '.php';
    if ( file_exists( $filename ) )
      require $filename;

	}

}

new AgriFlex;
