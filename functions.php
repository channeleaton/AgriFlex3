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
define( 'AF_THEME_TEXTDOMAIN', 'agriflex' );

// Autoload all classes
spl_autoload_register( 'AgriFlex::autoload' );

class AgriFlex {

	private static $file = __FILE__;

	private static $instance;

	private function __construct() {

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

		// Fix the navigation
		$af_navigation = new AgriFlex_Navigation;

        // Add AgriLife Required DOM Elements
        $af_required = new AgriFlex_RequiredDOM;

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

	public static function get_instance() {

		return null == self::$instance ? new self : self::$instance;

	}

}

AgriFlex::get_instance();



/**
 * Theme Option for Background Images
 * https://codex.wordpress.org/Theme_Customization_API
 * @since 1.0
 */
function agriflex_customize_register($wp_customize){
	// A group of options for the control
	$wp_customize->add_section(
    'agriflex_background_options',
    array(
        'title'     => 'Background Image',
        'priority'  => 30 
    )
	);
	// Register the option's data for the control
	$wp_customize->add_setting(
    'agriflex_background_image',
    array(
        'default'      => '',
        'transport'    => 'refresh'
    )
	);
	// Display a control in Appearance > Customize
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'agriflex_background_image',
      array(
        'label'    => '',
        'settings' => 'agriflex_background_image',
        'section'  => 'agriflex_background_options'
      )
    )
	);
}
add_action('customize_register', 'agriflex_customize_register');

// Use the setting's content in the theme.
function agriflex_customize_css() {
	?>
		<style type="text/css">
			<?php if ( get_theme_mod( 'agriflex_background_image' ) != '' && 0 < count( strlen( ( $background_image_url = get_theme_mod( 'agriflex_background_image' ) ) ) ) ) { ?>
	    	body {
  	  		background-image: url(<?php echo $background_image_url; ?>);
    		}
			<?php } // end if ?>
		</style>
	<?php
}
add_action( 'wp_head', 'agriflex_customize_css');
