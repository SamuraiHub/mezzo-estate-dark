<?php
/**
 * Estatein Dark — theme bootstrap.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'ESTATEIN_VERSION', '1.0.1' );
define( 'ESTATEIN_DIR', get_template_directory() );
define( 'ESTATEIN_URI', get_template_directory_uri() );

require_once ESTATEIN_DIR . '/inc/theme-setup.php';
require_once ESTATEIN_DIR . '/inc/helpers.php';
require_once ESTATEIN_DIR . '/inc/post-types.php';
require_once ESTATEIN_DIR . '/inc/fields.php';
require_once ESTATEIN_DIR . '/inc/seo.php';
require_once ESTATEIN_DIR . '/inc/forms.php';
require_once ESTATEIN_DIR . '/inc/demo-content.php';

/**
 * Enqueue styles and scripts.
 */
function estatein_assets() {
	// Urbanist — the typeface used throughout the Figma design.
	wp_enqueue_style(
		'estatein-fonts',
		'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Required WordPress stylesheet (theme header).
	wp_enqueue_style( 'estatein-base', get_stylesheet_uri(), array(), ESTATEIN_VERSION );

	// Main compiled styles.
	wp_enqueue_style( 'estatein-main', ESTATEIN_URI . '/assets/css/theme.css', array( 'estatein-base' ), ESTATEIN_VERSION );

	// Interactions: mobile menu, announcement close, tabs. Deferred for performance.
	wp_enqueue_script( 'estatein-main', ESTATEIN_URI . '/assets/js/theme.js', array(), ESTATEIN_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'estatein_assets' );

/**
 * Preconnect to the Google Fonts hosts so Urbanist loads faster.
 */
function estatein_resource_hints( $hints, $relation ) {
	if ( 'preconnect' === $relation ) {
		$hints[] = array( 'href' => 'https://fonts.googleapis.com' );
		$hints[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'estatein_resource_hints', 10, 2 );
