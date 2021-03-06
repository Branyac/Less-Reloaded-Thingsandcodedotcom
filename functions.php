<?php

/*-----------------------------------------------------------------------------------*/
/* Load Theme textdomain
/*-----------------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'less_theme_setup' );
function less_theme_setup(){
    load_theme_textdomain( 'less-revival', get_template_directory() . '/languages' );
}

// Define the version as a constant so we can easily replace it throughout the theme
define( 'LESS_VERSION', 2.0 );
add_theme_support( 'title-tag' );
/*-----------------------------------------------------------------------------------*/
/* Add Rss to Head
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Enables custom logo in header
/*-----------------------------------------------------------------------------------*/
$custom_logo_params = array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
   'unlink-homepage-logo' => true, 
    );
add_theme_support( 'custom-logo' , $custom_logo_params);

/*-----------------------------------------------------------------------------------*/
/* Add Content width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 900;
}

/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'less-revival' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function less_scripts()  {
	// theme styles
    wp_register_style('less-Roboto', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap', array(), null, 'all');
    wp_enqueue_style('less-Roboto');
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
  
}
add_action( 'wp_enqueue_scripts', 'less_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Add a pingback url to header
/*-----------------------------------------------------------------------------------*/

function less_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'less_pingback_header' );