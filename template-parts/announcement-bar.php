<?php
/**
 * Top announcement bar (dismissible). Reused site-wide.
 *
 * @package Estatein_Dark
 */
?>
<div class="announce" id="announce">
	<div class="container announce__inner">
		<span>✨ <?php esc_html_e( 'Discover Your Dream Property with Estatein', 'estatein-dark' ); ?>
			<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein-dark' ); ?></a>
		</span>
		<button class="announce__close" id="announce-close" aria-label="<?php esc_attr_e( 'Dismiss', 'estatein-dark' ); ?>">&times;</button>
	</div>
</div>
