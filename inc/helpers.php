<?php
/**
 * Reusable render helpers and inline SVG icons.
 *
 * @package Estatein_Dark
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return an inline SVG icon by name. Keeps the theme self-contained
 * (no external icon fonts) and lets every template reuse the same set.
 *
 * @param string $name Icon key.
 * @return string SVG markup.
 */
function estatein_icon( $name ) {
	$s = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">';
	$paths = array(
		'home'     => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9.5 21v-6h5v6"/>',
		'value'    => '<path d="M4 20V10"/><path d="M10 20V4"/><path d="M16 20v-7"/><path d="M22 20H2"/>',
		'manage'   => '<rect x="3" y="4" width="7" height="7"/><rect x="14" y="4" width="7" height="7"/><rect x="3" y="15" width="7" height="5"/><rect x="14" y="13" width="7" height="7"/>',
		'invest'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 10h4.5a2 2 0 0 1 0 4H9"/>',
		'arrow-ur' => '<path d="M7 17 17 7"/><path d="M8 7h9v9"/>',
		'arrow-l'  => '<path d="M19 12H5"/><path d="M12 5 5 12l7 7"/>',
		'arrow-r'  => '<path d="M5 12h14"/><path d="M12 5l7 7-7 7"/>',
		'bed'      => '<path d="M3 18v-6h18v6"/><path d="M3 12V7a2 2 0 0 1 2-2h6v7"/><path d="M21 18v2M3 18v2"/>',
		'bath'     => '<path d="M4 12V6a2 2 0 0 1 4 0"/><path d="M2 12h20v3a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4z"/><path d="M6 19l-1 2M18 19l1 2"/>',
		'villa'    => '<path d="M3 21V9l9-6 9 6v12"/><path d="M9 21v-6h6v6"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'phone'    => '<path d="M4 4h4l2 5-3 2a12 12 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 2 6a2 2 0 0 1 2-2z"/>',
		'pin'      => '<path d="M12 21s7-6 7-11a7 7 0 1 0-14 0c0 5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
		'star'     => '<path d="M12 3l2.6 5.6 6.1.8-4.5 4.2 1.2 6-5.4-3-5.4 3 1.2-6L3.3 9.4l6.1-.8z" fill="currentColor" stroke="none"/>',
		'send'     => '<path d="m22 2-7 20-4-9-9-4z"/><path d="M22 2 11 13"/>',
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4-4"/>',
		'type'     => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/>',
		'range'    => '<circle cx="12" cy="12" r="8"/><path d="M12 8v4l3 2"/>',
		'size'     => '<path d="M3 3h7v7H3zM14 14h7v7h-7z"/><path d="M14 3h7v7M3 14v7h7"/>',
		'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
		'facebook' => '<path d="M14 9V7a2 2 0 0 1 2-2h2V2h-3a4 4 0 0 0-4 4v3H8v3h3v9h3v-9h3l1-3z" fill="currentColor" stroke="none"/>',
		'linkedin' => '<rect x="2" y="2" width="20" height="20" rx="3"/><path d="M7 10v7M7 7v.01M11 17v-4a2 2 0 0 1 4 0v4M11 10v7" />',
		'twitter'  => '<path d="M22 5.9a8 8 0 0 1-2.3.6 4 4 0 0 0 1.8-2.2 8 8 0 0 1-2.5 1A4 4 0 0 0 12 9a11 11 0 0 1-8-4 4 4 0 0 0 1.2 5.3 4 4 0 0 1-1.8-.5 4 4 0 0 0 3.2 4 4 4 0 0 1-1.8.1 4 4 0 0 0 3.7 2.8A8 8 0 0 1 2 18.6 11 11 0 0 0 20 9.2 8 8 0 0 0 22 5.9z"/>',
		'youtube'  => '<rect x="2" y="5" width="20" height="14" rx="4"/><path d="m10 9 5 3-5 3z" fill="currentColor" stroke="none"/>',
		'bolt'     => '<path d="M13 2 4 14h7l-1 8 9-12h-7z" fill="currentColor" stroke="none"/>',
		'check'    => '<path d="m5 12 5 5L20 6"/>',
	);
	$body = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
	return $s . $body . '</svg>';
}

/**
 * Echo a feature/service card icon circle.
 */
function estatein_e_icon( $name ) {
	echo estatein_icon( $name ); // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Render a single property card.
 *
 * @param array $p Property data (title, desc, price, beds, baths, type, img).
 */
function estatein_property_card( $p ) {
	$p = wp_parse_args( $p, array(
		'title' => '', 'desc' => '', 'price' => '', 'beds' => '', 'baths' => '', 'type' => 'Villa', 'img' => '', 'url' => '#',
	) );
	?>
	<article class="property-card">
		<div class="property-card__img">
			<?php if ( $p['img'] ) : ?><img src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>"><?php endif; ?>
		</div>
		<h3><?php echo esc_html( $p['title'] ); ?></h3>
		<p class="property-card__desc"><?php echo esc_html( $p['desc'] ); ?> <a href="<?php echo esc_url( $p['url'] ); ?>"><?php esc_html_e( 'Read More', 'estatein-dark' ); ?></a></p>
		<div class="tags">
			<span class="tag"><?php estatein_e_icon( 'bed' ); ?><?php echo esc_html( $p['beds'] ); ?>-Bedroom</span>
			<span class="tag"><?php estatein_e_icon( 'bath' ); ?><?php echo esc_html( $p['baths'] ); ?>-Bathroom</span>
			<span class="tag"><?php estatein_e_icon( 'villa' ); ?><?php echo esc_html( $p['type'] ); ?></span>
		</div>
		<div class="property-card__foot">
			<div class="property-card__price"><span><?php esc_html_e( 'Price', 'estatein-dark' ); ?></span><b><?php echo esc_html( $p['price'] ); ?></b></div>
			<a class="btn btn--primary" href="<?php echo esc_url( $p['url'] ); ?>"><?php esc_html_e( 'View Property Details', 'estatein-dark' ); ?></a>
		</div>
	</article>
	<?php
}

/**
 * URL to a bundled theme image.
 *
 * @param string $file Filename in /assets/images/.
 * @return string
 */
function estatein_img( $file ) {
	return ESTATEIN_URI . '/assets/images/' . $file;
}

/**
 * Render a property card from a `property` CPT post.
 *
 * @param int $id Post ID.
 */
function estatein_property_card_from_post( $id ) {
	estatein_property_card( array(
		'title' => get_the_title( $id ),
		'desc'  => get_the_excerpt( $id ),
		'price' => get_post_meta( $id, 'estatein_price', true ),
		'beds'  => get_post_meta( $id, 'estatein_beds', true ),
		'baths' => get_post_meta( $id, 'estatein_baths', true ),
		'type'  => get_post_meta( $id, 'estatein_type', true ) ? get_post_meta( $id, 'estatein_type', true ) : 'Villa',
		'img'   => get_the_post_thumbnail_url( $id, 'large' ) ? get_the_post_thumbnail_url( $id, 'large' ) : '',
		'url'   => get_permalink( $id ),
	) );
}

/**
 * Query helper: return IDs for a CPT (newest first).
 *
 * @param string $type  Post type.
 * @param int    $limit Number of posts.
 * @return int[]
 */
function estatein_get_ids( $type, $limit = -1 ) {
	return get_posts( array(
		'post_type'      => $type,
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'ASC',
		'fields'         => 'ids',
		'no_found_rows'  => true,
	) );
}

/**
 * Slider footer (count + prev/next). Purely presentational in this trial build.
 */
function estatein_slider_foot( $index = '01', $total = '60' ) {
	?>
	<div class="slider-foot">
		<span class="count"><b><?php echo esc_html( $index ); ?></b> <?php esc_html_e( 'of', 'estatein-dark' ); ?> <?php echo esc_html( $total ); ?></span>
		<div class="slider-nav">
			<button type="button" aria-label="<?php esc_attr_e( 'Previous', 'estatein-dark' ); ?>"><?php estatein_e_icon( 'arrow-l' ); ?></button>
			<button type="button" aria-label="<?php esc_attr_e( 'Next', 'estatein-dark' ); ?>"><?php estatein_e_icon( 'arrow-r' ); ?></button>
		</div>
	</div>
	<?php
}
