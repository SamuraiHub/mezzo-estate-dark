<?php
/**
 * "Start Your Real Estate Journey Today" CTA band. Reused above the footer.
 *
 * @package Estatein_Dark
 */
?>
<section class="cta section">
	<div class="container cta__inner">
		<div class="cta__text">
			<h2><?php esc_html_e( 'Start Your Real Estate Journey Today', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Your dream property is just a click away. Whether you\'re looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.', 'estatein-dark' ); ?></p>
		</div>
		<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Explore Properties', 'estatein-dark' ); ?></a>
	</div>
</section>
