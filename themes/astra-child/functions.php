<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

// URLs (for src)
define( 'CHILD_THEME_STYLE_PATH', get_stylesheet_directory_uri() . '/res/css' );
define( 'CHILD_THEME_SCRIPT_PATH', get_stylesheet_directory_uri() . '/res/js' );

// Disk paths (for filemtime / file_exists)
define( 'CHILD_THEME_STYLE_DIR', get_stylesheet_directory() . '/res/css' );
define( 'CHILD_THEME_SCRIPT_DIR', get_stylesheet_directory() . '/res/js' );

function gc_file_version( $file_path ) {
	return file_exists( $file_path )
		? filemtime( $file_path )
		: CHILD_THEME_ASTRA_CHILD_VERSION;
}

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style(
		'astra-child-theme',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'astra-theme-css' ),
		gc_file_version( get_stylesheet_directory() . '/style.css' ),
		'all'
	);

	wp_enqueue_style(
		'astra-child-custom',
		CHILD_THEME_STYLE_PATH . '/main-style.css',
		array( 'astra-child-theme' ),
		gc_file_version( CHILD_THEME_STYLE_DIR . '/main-style.css' ),
		'all'
	);

	wp_enqueue_style(
		'astra-header-custom-style',
		CHILD_THEME_STYLE_PATH . '/header.css',
		array( 'astra-child-theme' ),
		gc_file_version( CHILD_THEME_STYLE_DIR . '/header.css' ),
		'all'
	);

	wp_enqueue_style(
		'astra-footer-custom-style',
		CHILD_THEME_STYLE_PATH . '/footer.css',
		array( 'astra-header-custom-style' ),
		gc_file_version( CHILD_THEME_STYLE_DIR . '/footer.css' ),
		'all'
	);
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/**
 * Enqueue scripts
 */
function child_enqueue_scripts() {

	wp_enqueue_script(
		'astra-child-custom',
		CHILD_THEME_SCRIPT_PATH . '/main-script.js',
		array(),
		gc_file_version( CHILD_THEME_SCRIPT_DIR . '/main-script.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_scripts', 15 );