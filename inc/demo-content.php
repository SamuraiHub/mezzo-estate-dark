<?php
/**
 * One-click demo setup.
 *
 * On theme activation this creates the six design pages, assigns the matching
 * page templates, sets a static Home front page, and builds the primary menu —
 * so the site looks like the Figma out of the box. Runs only once and never
 * overwrites content the user already created.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create/link a page by slug and return its ID.
 *
 * @param string $title    Page title.
 * @param string $slug     Page slug.
 * @param string $template Page template file (relative to theme root) or ''.
 * @return int Page ID.
 */
function estatein_ensure_page( $title, $slug, $template = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing instanceof WP_Post ) {
		$page_id = $existing->ID;
	} else {
		$page_id = wp_insert_post( array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '', // Design is rendered by the PHP template.
		) );
	}
	if ( $page_id && ! is_wp_error( $page_id ) && $template ) {
		update_post_meta( $page_id, '_wp_page_template', $template );
	}
	return (int) $page_id;
}

/**
 * Run the demo setup once, after the theme is switched on.
 */
function estatein_setup_demo_content() {
	if ( get_option( 'estatein_demo_installed' ) ) {
		return;
	}

	$pages = array(
		'home'             => estatein_ensure_page( __( 'Home', 'estatein-dark' ), 'home', '' ),
		'about'            => estatein_ensure_page( __( 'About Us', 'estatein-dark' ), 'about-us', 'template-about.php' ),
		'properties'       => estatein_ensure_page( __( 'Properties', 'estatein-dark' ), 'properties', 'template-properties.php' ),
		'property-details' => estatein_ensure_page( __( 'Property Details', 'estatein-dark' ), 'property-details', 'template-property-details.php' ),
		'services'         => estatein_ensure_page( __( 'Services', 'estatein-dark' ), 'services', 'template-services.php' ),
		'contact'          => estatein_ensure_page( __( 'Contact Us', 'estatein-dark' ), 'contact', 'template-contact.php' ),
	);

	// Static front page = Home (front-page.php renders the hero design on it).
	if ( ! empty( $pages['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $pages['home'] );
	}

	// Build the primary navigation menu.
	$menu_name = __( 'Primary Menu', 'estatein-dark' );
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) ) {
			$nav_items = array( 'home', 'about', 'properties', 'services' );
			foreach ( $nav_items as $key ) {
				if ( empty( $pages[ $key ] ) ) {
					continue;
				}
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => get_the_title( $pages[ $key ] ),
					'menu-item-object'    => 'page',
					'menu-item-object-id' => $pages[ $key ],
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
				) );
			}
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	// Seed editable Properties / Team / Testimonials / FAQs / Services.
	estatein_seed_cpts();

	update_option( 'estatein_demo_installed', 1 );
}
add_action( 'after_switch_theme', 'estatein_setup_demo_content' );

/**
 * Insert a CPT entry once (matched by title + type), set meta and image.
 *
 * @param string $type    Post type.
 * @param string $title   Post title.
 * @param string $content Body/excerpt content.
 * @param array  $meta    Meta key => value pairs.
 * @param string $image   Bundled image filename for the featured image.
 * @param bool   $excerpt Store $content as excerpt instead of body.
 */
function estatein_seed_post( $type, $title, $content, $meta = array(), $image = '', $excerpt = false ) {
	$found = get_posts( array( 'post_type' => $type, 'title' => $title, 'numberposts' => 1, 'fields' => 'ids', 'post_status' => 'any' ) );
	if ( ! empty( $found ) ) {
		return (int) $found[0];
	}
	$args = array(
		'post_type'   => $type,
		'post_title'  => $title,
		'post_status' => 'publish',
	);
	if ( $excerpt ) {
		$args['post_excerpt'] = $content;
	} else {
		$args['post_content'] = $content;
	}
	$id = wp_insert_post( $args );
	if ( is_wp_error( $id ) || ! $id ) {
		return 0;
	}
	foreach ( $meta as $k => $v ) {
		update_post_meta( $id, $k, $v );
	}
	if ( $image ) {
		$att = estatein_import_image( $image );
		if ( $att ) {
			set_post_thumbnail( $id, $att );
		}
	}
	return (int) $id;
}

/**
 * Seed all demo CPT content mirroring the Figma.
 */
function estatein_seed_cpts() {

	$properties = array(
		array( 'Seaside Serenity Villa', 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood.', array( 'estatein_price' => '$550,000', 'estatein_location' => 'Malibu, California', 'estatein_beds' => 4, 'estatein_baths' => 3, 'estatein_area' => '2,500 Sq Ft', 'estatein_type' => 'Villa' ), 'property-1.jpg' ),
		array( 'Metropolitan Haven', 'A chic and fully-furnished 2-bedroom apartment with panoramic city views.', array( 'estatein_price' => '$650,000', 'estatein_location' => 'New York, NY', 'estatein_beds' => 2, 'estatein_baths' => 2, 'estatein_area' => '1,800 Sq Ft', 'estatein_type' => 'Apartment' ), 'property-2.jpg' ),
		array( 'Rustic Retreat Cottage', 'An elegant 3-bedroom, 2.5-bathroom townhouse in a gated community.', array( 'estatein_price' => '$350,000', 'estatein_location' => 'Aspen, Colorado', 'estatein_beds' => 3, 'estatein_baths' => 3, 'estatein_area' => '2,100 Sq Ft', 'estatein_type' => 'Townhouse' ), 'property-3.jpg' ),
	);
	foreach ( $properties as $p ) {
		estatein_seed_post( 'property', $p[0], $p[1], $p[2], $p[3], true );
	}

	$team = array(
		array( 'Max Mitchell', 'Founder', 'team-1.jpg' ),
		array( 'Sarah Johnson', 'Chief Real Estate Officer', 'team-2.jpg' ),
		array( 'David Brown', 'Head of Property Management', 'team-3.jpg' ),
		array( 'Michael Turner', 'Legal Counsel', 'team-4.jpg' ),
	);
	foreach ( $team as $t ) {
		estatein_seed_post( 'team_member', $t[0], '', array( 'estatein_role' => $t[1], 'estatein_social' => '#' ), $t[2] );
	}

	$testimonials = array(
		array( 'Exceptional Service!', 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'Wade Warren', 'USA, California' ),
		array( 'Efficient and Reliable', 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'Emelie Thomson', 'USA, Florida' ),
		array( 'Trusted Advisors', 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!', 'John Mans', 'USA, Nevada' ),
	);
	foreach ( $testimonials as $t ) {
		estatein_seed_post( 'testimonial', $t[0], $t[1], array( 'estatein_author' => $t[2], 'estatein_location' => $t[3], 'estatein_rating' => 5 ) );
	}

	$faqs = array(
		array( 'How do I search for properties on Estatein?', 'Learn how to use our user-friendly search tools to find properties that match your criteria.' ),
		array( 'What documents do I need to sell my property through Estatein?', 'Find out about the necessary documentation for listing your property with us.' ),
		array( 'How can I contact an Estatein agent?', 'Discover the different ways you can get in touch with our experienced agents.' ),
	);
	foreach ( $faqs as $f ) {
		estatein_seed_post( 'faq', $f[0], $f[1] );
	}

	$services = array(
		array( 'Find Your Dream Home', 'home', 'Explore our curated listings to find the property that matches your dreams.' ),
		array( 'Unlock Property Value', 'value', 'Maximise the value of your property with our expert selling services.' ),
		array( 'Effortless Property Management', 'manage', 'Comprehensive management solutions that take the stress out of ownership.' ),
		array( 'Smart Investments, Informed Decisions', 'invest', 'Strategic investment advisory to build your real estate portfolio.' ),
	);
	foreach ( $services as $s ) {
		estatein_seed_post( 'service', $s[0], '', array( 'estatein_icon' => $s[1], 'estatein_summary' => $s[2] ) );
	}
}
