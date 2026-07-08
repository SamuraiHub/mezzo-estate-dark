<?php
/**
 * Editable custom fields for the CPTs.
 *
 * One schema, two back-ends:
 *   • If Advanced Custom Fields is active, the same fields are registered as an
 *     ACF local field group (no import step needed).
 *   • If ACF is NOT installed, lightweight native meta boxes provide the same
 *     fields — so the theme is fully manageable out of the box with no plugin.
 *
 * Both back-ends store to the SAME meta keys (the field "name"), so templates
 * read values with a single get_post_meta() call either way.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field schema. Keyed by post type.
 *
 * @return array
 */
function estatein_field_schema() {
	return array(
		'property' => array(
			array( 'name' => 'estatein_price',    'label' => 'Price',          'type' => 'text' ),
			array( 'name' => 'estatein_location', 'label' => 'Location',       'type' => 'text' ),
			array( 'name' => 'estatein_beds',     'label' => 'Bedrooms',       'type' => 'number' ),
			array( 'name' => 'estatein_baths',    'label' => 'Bathrooms',      'type' => 'number' ),
			array( 'name' => 'estatein_area',     'label' => 'Area',           'type' => 'text' ),
			array( 'name' => 'estatein_type',     'label' => 'Property Type',  'type' => 'select', 'choices' => array( 'Villa', 'Apartment', 'Townhouse', 'House' ) ),
		),
		'team_member' => array(
			array( 'name' => 'estatein_role',   'label' => 'Role / Title', 'type' => 'text' ),
			array( 'name' => 'estatein_social', 'label' => 'Social URL',   'type' => 'url' ),
		),
		'testimonial' => array(
			array( 'name' => 'estatein_author',   'label' => 'Author Name', 'type' => 'text' ),
			array( 'name' => 'estatein_location', 'label' => 'Location',    'type' => 'text' ),
			array( 'name' => 'estatein_rating',   'label' => 'Rating (1-5)', 'type' => 'number' ),
		),
		'service' => array(
			array( 'name' => 'estatein_icon',    'label' => 'Icon', 'type' => 'select', 'choices' => array( 'home', 'value', 'manage', 'invest', 'range', 'check' ) ),
			array( 'name' => 'estatein_summary', 'label' => 'Summary', 'type' => 'textarea' ),
		),
	);
}

/* =========================================================================
 * ACF back-end (only when the ACF plugin is active)
 * ====================================================================== */
function estatein_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	foreach ( estatein_field_schema() as $cpt => $fields ) {
		$acf_fields = array();
		foreach ( $fields as $f ) {
			$field = array(
				'key'   => 'field_' . $f['name'],
				'label' => $f['label'],
				'name'  => $f['name'],
				'type'  => in_array( $f['type'], array( 'number', 'textarea', 'url' ), true ) ? $f['type'] : 'text',
			);
			if ( 'select' === $f['type'] ) {
				$field['type']    = 'select';
				$field['choices'] = array_combine( $f['choices'], $f['choices'] );
			}
			$acf_fields[] = $field;
		}
		acf_add_local_field_group( array(
			'key'      => 'group_' . $cpt,
			'title'    => ucfirst( str_replace( '_', ' ', $cpt ) ) . ' Details',
			'fields'   => $acf_fields,
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => $cpt ) ) ),
		) );
	}
}
add_action( 'acf/init', 'estatein_register_acf_fields' );

/* =========================================================================
 * Native meta-box back-end (fallback when ACF is not installed)
 * ====================================================================== */
function estatein_add_meta_boxes() {
	if ( class_exists( 'ACF' ) ) {
		return; // ACF handles the UI.
	}
	foreach ( array_keys( estatein_field_schema() ) as $cpt ) {
		add_meta_box( 'estatein_details', __( 'Details', 'estatein-dark' ), 'estatein_render_meta_box', $cpt, 'normal', 'high' );
	}
}
add_action( 'add_meta_boxes', 'estatein_add_meta_boxes' );

/**
 * Render the native meta box.
 *
 * @param WP_Post $post Current post.
 */
function estatein_render_meta_box( $post ) {
	$schema = estatein_field_schema();
	$fields = isset( $schema[ $post->post_type ] ) ? $schema[ $post->post_type ] : array();
	wp_nonce_field( 'estatein_save_meta', 'estatein_meta_nonce' );
	echo '<div style="display:grid;gap:14px;max-width:640px">';
	foreach ( $fields as $f ) {
		$val = get_post_meta( $post->ID, $f['name'], true );
		printf( '<p style="margin:0"><label for="%1$s" style="display:block;font-weight:600;margin-bottom:4px">%2$s</label>', esc_attr( $f['name'] ), esc_html( $f['label'] ) );
		if ( 'textarea' === $f['type'] ) {
			printf( '<textarea id="%1$s" name="%1$s" rows="3" class="widefat">%2$s</textarea>', esc_attr( $f['name'] ), esc_textarea( $val ) );
		} elseif ( 'select' === $f['type'] ) {
			printf( '<select id="%1$s" name="%1$s" class="widefat">', esc_attr( $f['name'] ) );
			foreach ( $f['choices'] as $c ) {
				printf( '<option value="%1$s"%2$s>%1$s</option>', esc_attr( $c ), selected( $val, $c, false ) );
			}
			echo '</select>';
		} else {
			$type = ( 'number' === $f['type'] ) ? 'number' : ( 'url' === $f['type'] ? 'url' : 'text' );
			printf( '<input id="%1$s" name="%1$s" type="%2$s" value="%3$s" class="widefat">', esc_attr( $f['name'] ), esc_attr( $type ), esc_attr( $val ) );
		}
		echo '</p>';
	}
	echo '</div>';
}

/**
 * Save native meta-box values.
 *
 * @param int $post_id Post ID.
 */
function estatein_save_meta( $post_id ) {
	if ( ! isset( $_POST['estatein_meta_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['estatein_meta_nonce'] ), 'estatein_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$schema = estatein_field_schema();
	$post_type = get_post_type( $post_id );
	if ( empty( $schema[ $post_type ] ) ) {
		return;
	}
	foreach ( $schema[ $post_type ] as $f ) {
		if ( ! isset( $_POST[ $f['name'] ] ) ) {
			continue;
		}
		$raw = wp_unslash( $_POST[ $f['name'] ] );
		if ( 'textarea' === $f['type'] ) {
			$clean = sanitize_textarea_field( $raw );
		} elseif ( 'url' === $f['type'] ) {
			$clean = esc_url_raw( $raw );
		} elseif ( 'number' === $f['type'] ) {
			$clean = is_numeric( $raw ) ? $raw + 0 : '';
		} else {
			$clean = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, $f['name'], $clean );
	}
}
add_action( 'save_post', 'estatein_save_meta' );

/* =========================================================================
 * Helpers used by templates & the demo seeder
 * ====================================================================== */

/**
 * Import a bundled theme image into the Media Library and return its
 * attachment ID (reused if already imported). Lets seeded CPT entries have
 * real, editable featured images.
 *
 * @param string $filename File in /assets/images/.
 * @return int Attachment ID or 0 on failure.
 */
function estatein_import_image( $filename ) {
	$existing = get_posts( array(
		'post_type'   => 'attachment',
		'meta_key'    => '_estatein_src',
		'meta_value'  => $filename,
		'numberposts' => 1,
		'fields'      => 'ids',
	) );
	if ( ! empty( $existing ) ) {
		return (int) $existing[0];
	}

	$src = ESTATEIN_DIR . '/assets/images/' . $filename;
	if ( ! file_exists( $src ) ) {
		return 0;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$upload = wp_upload_bits( $filename, null, file_get_contents( $src ) );
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}

	$filetype = wp_check_filetype( $upload['file'], null );
	$attach_id = wp_insert_attachment( array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
		'post_status'    => 'inherit',
	), $upload['file'] );

	if ( is_wp_error( $attach_id ) || ! $attach_id ) {
		return 0;
	}
	wp_update_attachment_metadata( $attach_id, wp_generate_attachment_metadata( $attach_id, $upload['file'] ) );
	update_post_meta( $attach_id, '_estatein_src', $filename );
	return (int) $attach_id;
}
