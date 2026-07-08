<?php
/**
 * Lightweight SEO: meta description, Open Graph / Twitter cards, JSON-LD.
 *
 * Kept minimal and non-conflicting — if the user installs Yoast/Rank Math,
 * those plugins take over the <title> and canonical; these tags simply provide
 * sensible defaults for a theme shipped without an SEO plugin.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a description string for the current view.
 *
 * @return string
 */
function estatein_meta_description() {
	if ( is_singular() ) {
		$post = get_queried_object();
		$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_strip_all_tags( $post->post_content );
		if ( ! $desc ) {
			$desc = get_bloginfo( 'description' );
		}
		return wp_trim_words( $desc, 30, '' );
	}
	return get_bloginfo( 'description' );
}

/**
 * Output meta description, Open Graph and Twitter card tags.
 */
function estatein_meta_tags() {
	// Skip if a dedicated SEO plugin is active (avoid duplicate tags).
	if ( defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) ) {
		return;
	}

	$desc  = esc_attr( estatein_meta_description() );
	$title = wp_get_document_title();
	$url   = esc_url( home_url( add_query_arg( array(), $GLOBALS['wp']->request ) ) );
	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = esc_url( get_the_post_thumbnail_url( null, 'large' ) );
	} else {
		$image = esc_url( ESTATEIN_URI . '/screenshot.png' );
	}

	echo "\n<!-- Estatein SEO -->\n";
	printf( '<meta name="description" content="%s">' . "\n", $desc );
	printf( '<meta name="theme-color" content="#141414">' . "\n" );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular() ? 'article' : 'website' );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", $desc );
	printf( '<meta property="og:url" content="%s">' . "\n", $url );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", $image );
	}
	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", $desc );
	if ( $image ) {
		printf( '<meta name="twitter:image" content="%s">' . "\n", $image );
	}
	echo "<!-- /Estatein SEO -->\n";
}
add_action( 'wp_head', 'estatein_meta_tags', 5 );

/**
 * Organisation JSON-LD on the front page for richer search results.
 */
function estatein_json_ld() {
	if ( ! is_front_page() ) {
		return;
	}
	$data = array(
		'@context' => 'https://schema.org',
		'@type'    => 'RealEstateAgent',
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'image'    => ESTATEIN_URI . '/screenshot.png',
		'description' => get_bloginfo( 'description' ),
	);
	echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
add_action( 'wp_head', 'estatein_json_ld' );

/**
 * Add a meaningful alt attribute fallback to attachment images that lack one.
 *
 * @param array $attr Image attributes.
 * @param WP_Post $attachment Attachment.
 * @return array
 */
function estatein_image_alt_fallback( $attr, $attachment ) {
	if ( empty( $attr['alt'] ) ) {
		$attr['alt'] = get_the_title( $attachment->ID );
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'estatein_image_alt_fallback', 10, 2 );
