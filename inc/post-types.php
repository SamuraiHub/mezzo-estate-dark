<?php
/**
 * Custom Post Types for manageable content.
 *
 * Gives the client a dashboard interface to add/edit Properties, Team members,
 * Testimonials, FAQs and Services without touching code. Editable fields are
 * defined in inc/fields.php (ACF when available, native meta boxes otherwise).
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register all custom post types.
 */
function estatein_register_cpts() {

	register_post_type( 'property', array(
		'labels' => estatein_cpt_labels( 'Property', 'Properties' ),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'property' ),
		'menu_icon' => 'dashicons-admin-home',
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'team_member', array(
		'labels' => estatein_cpt_labels( 'Team Member', 'Team' ),
		'public' => true,
		'has_archive' => false,
		'rewrite' => array( 'slug' => 'team' ),
		'menu_icon' => 'dashicons-groups',
		'menu_position' => 6,
		'supports' => array( 'title', 'thumbnail' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'testimonial', array(
		'labels' => estatein_cpt_labels( 'Testimonial', 'Testimonials' ),
		'public' => true,
		'has_archive' => false,
		'rewrite' => array( 'slug' => 'testimonial' ),
		'menu_icon' => 'dashicons-format-quote',
		'menu_position' => 7,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'faq', array(
		'labels' => estatein_cpt_labels( 'FAQ', 'FAQs' ),
		'public' => true,
		'has_archive' => false,
		'rewrite' => array( 'slug' => 'faq' ),
		'menu_icon' => 'dashicons-editor-help',
		'menu_position' => 8,
		'supports' => array( 'title', 'editor' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'service', array(
		'labels' => estatein_cpt_labels( 'Service', 'Services' ),
		'public' => true,
		'has_archive' => false,
		'rewrite' => array( 'slug' => 'service' ),
		'menu_icon' => 'dashicons-building',
		'menu_position' => 9,
		'supports' => array( 'title', 'editor' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'estatein_register_cpts' );

/**
 * Build a standard labels array for a CPT.
 *
 * @param string $singular Singular label.
 * @param string $plural   Plural label.
 * @return array
 */
function estatein_cpt_labels( $singular, $plural ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'add_new_item'       => "Add New $singular",
		'edit_item'          => "Edit $singular",
		'new_item'           => "New $singular",
		'view_item'          => "View $singular",
		'search_items'       => "Search $plural",
		'not_found'          => "No $plural found",
		'all_items'          => "All $plural",
		'menu_name'          => $plural,
	);
}

/**
 * Flush rewrite rules once after the CPTs are registered on activation,
 * so single-property permalinks work without a manual Settings → Permalinks save.
 */
function estatein_flush_rewrites() {
	estatein_register_cpts();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'estatein_flush_rewrites' );
