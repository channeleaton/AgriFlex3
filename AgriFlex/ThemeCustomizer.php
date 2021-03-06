<?php

class AgriFlex_ThemeCustomizer {

  public function __construct() {

    add_action( 'customize_register', array( $this, 'agriflex_customize_register' ));

    add_action( 'wp_head', array( $this, 'agriflex_customize_background' ));

    add_action( 'genesis_after', array( $this, 'agriflex_custom_backgroundimage' ));

  }

  // Add Customization Control
  public function agriflex_customize_register($wp_customize){
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

  /* Use the control's data in the theme.
  ------------------------------------------ */
  // Add CSS
  public function agriflex_customize_background() {
    if ( get_theme_mod('agriflex_background_image') != '' && 0 < count( strlen( ( $background_image_url = get_theme_mod( 'agriflex_background_image' ) ) ) ) ) { ?>
      <style type="text/css">
        #bg-image-container {
          background-image: url(<?php echo $background_image_url; ?>);
        }
      </style>
      <?php
    }
  }

  // Add HTML
  public function agriflex_custom_backgroundimage() {
  ?>
    <div id="bg-image-container" data-src="<?php echo get_theme_mod( 'agriflex_background_image' ); ?>"></div>
  <?php 
  }
  
}