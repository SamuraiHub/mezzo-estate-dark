<?php
/**
 * Four-up feature cards row (Find Your Dream Home … Smart Investments).
 * Reused on the Home and Services pages.
 *
 * @package Estatein_Dark
 */

// Pull from the Service CPT when available, otherwise use sensible defaults.
$features = array();
$service_ids = function_exists( 'estatein_get_ids' ) ? estatein_get_ids( 'service', 4 ) : array();
if ( ! empty( $service_ids ) ) {
	foreach ( $service_ids as $sid ) {
		$icon = get_post_meta( $sid, 'estatein_icon', true );
		$features[] = array( $icon ? $icon : 'home', get_the_title( $sid ) );
	}
} else {
	$features = array(
		array( 'home',   __( 'Find Your Dream Home', 'estatein-dark' ) ),
		array( 'value',  __( 'Unlock Property Value', 'estatein-dark' ) ),
		array( 'manage', __( 'Effortless Property Management', 'estatein-dark' ) ),
		array( 'invest', __( 'Smart Investments, Informed Decisions', 'estatein-dark' ) ),
	);
}
?>
<div class="feature-cards">
	<?php foreach ( $features as $f ) : ?>
		<div class="feature-card">
			<span class="fc-arrow"><?php estatein_e_icon( 'arrow-ur' ); ?></span>
			<span class="fc-icon"><?php estatein_e_icon( $f[0] ); ?></span>
			<h4><?php echo esc_html( $f[1] ); ?></h4>
		</div>
	<?php endforeach; ?>
</div>
