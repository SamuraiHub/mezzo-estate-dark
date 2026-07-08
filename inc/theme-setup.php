<?php
/**
 * Theme supports, menus and Elementor compatibility.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Core theme supports.
 */
function estatein_setup() {
	load_theme_textdomain( 'estatein-dark', ESTATEIN_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 160,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Let the editor/Elementor share the theme palette.
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => 'Purple',  'slug' => 'purple',  'color' => '#703bf7' ),
		array( 'name' => 'Purple Light', 'slug' => 'purple-light', 'color' => '#a685fa' ),
		array( 'name' => 'Background', 'slug' => 'bg', 'color' => '#141414' ),
		array( 'name' => 'Surface', 'slug' => 'surface', 'color' => '#1a1a1a' ),
		array( 'name' => 'White', 'slug' => 'white', 'color' => '#ffffff' ),
		array( 'name' => 'Muted', 'slug' => 'muted', 'color' => '#999999' ),
	) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'estatein-dark' ),
		'footer'  => __( 'Footer Menu', 'estatein-dark' ),
	) );
}
add_action( 'after_setup_theme', 'estatein_setup' );

/**
 * Content width used by the editor and embeds.
 */
function estatein_content_width() {
	$GLOBALS['content_width'] = 1290;
}
add_action( 'after_setup_theme', 'estatein_content_width', 0 );

/* -------------------------------------------------------------------------
 * ELEMENTOR COMPATIBILITY
 *
 * page.php acts as a blank, full-width canvas so Elementor can lay out any
 * page freely, and we register a dedicated "Elementor Full Width" template.
 * We also add Elementor Pro theme-builder location support so the theme's
 * header/footer can be overridden from the Elementor Theme Builder if the
 * user has Elementor Pro.
 * ---------------------------------------------------------------------- */

/**
 * Register Elementor Pro theme locations (header/footer/single/archive).
 */
function estatein_register_elementor_locations( $manager ) {
	$manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'estatein_register_elementor_locations' );

/**
 * Tell Elementor the theme is compatible and set its content width.
 */
function estatein_elementor_settings() {
	// Match Elementor's default content width to the theme container.
	if ( class_exists( '\Elementor\Plugin' ) ) {
		add_filter( 'elementor/frontend/the_content', function ( $content ) {
			return $content;
		} );
	}
}
add_action( 'init', 'estatein_elementor_settings' );

/**
 * Body classes: expose the active template so Elementor / CSS can target it.
 */
function estatein_body_classes( $classes ) {
	if ( is_page_template() ) {
		$classes[] = 'has-page-template';
	}
	return $classes;
}
add_filter( 'body_class', 'estatein_body_classes' );
