<?php

/**
 * Loads required theme assets
 * @package AgriFlex3
 * @since 1.0
 */
class AgriFlex_Assets {

	public function __construct() {

		// Register global scripts used in the theme
		add_action( 'wp_enqueue_scripts', array( $this, 'register_global_scripts' ) );

		// Enqueue global scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_scripts' ) );
		
		// Register admin scripts used in the theme
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// Enqueue admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Register global styles used in the theme
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		// Enqueue global styles
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_global_styles' ) );

        // Bring in typekit
        add_action( 'wp_head', array( $this, 'add_typekit' ));

	}

	/**
	 * Registers globally used scripts
	 * @since 1.0
	 * @return void
	 */
	public function register_global_scripts() {

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
			AF_THEME_DIRURL . '/js/public.min.js',
			false,
			false,
			true
		);

        wp_register_script( 'modernizr',
            AF_THEME_DIRURL . '/bower_components/modernizr/modernizr.js',
            array( 'jquery' ),
            false,
            true
        );

	}

	/**
	 * Enqueues globally used scripts
	 * @since 1.0
	 * @return void
	 */
	public function enqueue_global_scripts() {

		wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'foundation-topbar' );
		wp_enqueue_script( 'agriflex-public' );
        wp_enqueue_script( 'modernizr' );

	}

	/**
	 * Registers scripts for the backend
	 * @since 1.0
	 * @return void
	 */
	public function register_admin_scripts() {

		wp_register_script( 'agriflex-admin',
			AF_THEME_DIRURL . '/js/admin.min.js',
			false,
			false,
			true
		);

	}

	/**
	 * Enqueues scripts for the backend
	 * @since 1.0
	 * @return void
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_script( 'agriflex-admin' );

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

		wp_enqueue_style( 'default-styles' );

	}

    /**
     * Add the correct Typekit
     * @since 1.0
     * @todo Replace with async js and deal with FOUC
     * @todo Pass in variable (TBD) to select correct kit
     * @return string
     */
    public function add_typekit() {

        if('agrilife-extension' == AG_EXT_DIRNAME ) {
            // For Extension
            $key = 'xox0blb';
        } elseif ('agrilife-college' == AG_COL_DIRNAME ) {
            // For College
            $key = 'bbz1kzh';
        } else {
            // For Default Agriflex3
            $key = 'mtx5vmp';
        }

        if( !is_admin() ) :
            ?>
            <script type="text/javascript" src="//use.typekit.net/<?php echo $key; ?>.js"></script>
            <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
            <?php
        endif;

    }


}