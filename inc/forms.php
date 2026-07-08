<?php
/**
 * Front-end contact / inquiry form handling.
 *
 * A single, secure native handler powers every form in the theme (Contact,
 * Properties "Let's Make it Happen", and Property Details "Inquire"). It uses a
 * nonce, a honeypot for spam, sanitises all input, emails the site admin, and
 * redirects back with a success/error flag. No plugin required — but the markup
 * is standard, so Contact Form 7 / WPForms can be dropped in instead if desired.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the hidden fields every themed form needs to post securely.
 *
 * @param string $subject Human-readable form name used in the email subject.
 */
function estatein_form_hidden( $subject ) {
	printf( '<input type="hidden" name="action" value="estatein_contact">' );
	printf( '<input type="hidden" name="estatein_subject" value="%s">', esc_attr( $subject ) );
	printf( '<input type="hidden" name="estatein_redirect" value="%s">', esc_url( get_permalink() ) );
	// Honeypot: hidden from humans, tempting to bots. Real users leave it empty.
	echo '<div aria-hidden="true" style="position:absolute;left:-9999px"><label>Leave this empty<input type="text" name="estatein_hp" tabindex="-1" autocomplete="off"></label></div>';
	wp_nonce_field( 'estatein_contact_action', 'estatein_contact_nonce' );
}

/**
 * Render a success/error banner after a submission redirect.
 */
function estatein_form_notice() {
	if ( empty( $_GET['estatein_sent'] ) ) {
		return;
	}
	$sent = sanitize_key( wp_unslash( $_GET['estatein_sent'] ) );
	if ( 'ok' === $sent ) {
		echo '<div class="form-notice form-notice--ok" role="status">' . esc_html__( 'Thanks! Your message has been sent — we\'ll be in touch shortly.', 'estatein-dark' ) . '</div>';
	} else {
		echo '<div class="form-notice form-notice--err" role="alert">' . esc_html__( 'Sorry, something went wrong. Please check your details and try again.', 'estatein-dark' ) . '</div>';
	}
}

/**
 * Process the submitted form.
 */
function estatein_handle_contact() {
	$redirect = isset( $_POST['estatein_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['estatein_redirect'] ) ) : home_url( '/' );

	// Verify nonce.
	if ( ! isset( $_POST['estatein_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['estatein_contact_nonce'] ), 'estatein_contact_action' ) ) {
		wp_safe_redirect( add_query_arg( 'estatein_sent', 'err', $redirect ) );
		exit;
	}

	// Honeypot tripped → silently treat as success (don't tip off the bot).
	if ( ! empty( $_POST['estatein_hp'] ) ) {
		wp_safe_redirect( add_query_arg( 'estatein_sent', 'ok', $redirect ) );
		exit;
	}

	$name    = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
	$last    = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$subject = isset( $_POST['estatein_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['estatein_subject'] ) ) : 'Website enquiry';

	// Minimal validation.
	if ( ! is_email( $email ) || '' === trim( $name . $message ) ) {
		wp_safe_redirect( add_query_arg( 'estatein_sent', 'err', $redirect ) );
		exit;
	}

	$body  = "New enquiry from the website:\n\n";
	$body .= "Name: {$name} {$last}\n";
	$body .= "Email: {$email}\n";
	$body .= "Phone: {$phone}\n";
	$body .= "Form: {$subject}\n\n";
	$body .= "Message:\n{$message}\n";

	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	wp_mail( get_option( 'admin_email' ), '[' . get_bloginfo( 'name' ) . '] ' . $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'estatein_sent', 'ok', $redirect ) . '#form' );
	exit;
}
add_action( 'admin_post_nopriv_estatein_contact', 'estatein_handle_contact' );
add_action( 'admin_post_estatein_contact', 'estatein_handle_contact' );
