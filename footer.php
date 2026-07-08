<?php
/**
 * Site footer — reused on every page. Edit once, updates everywhere.
 *
 * @package Estatein_Dark
 */

// The shared "Start Your Real Estate Journey Today" CTA sits above the footer
// on every page. Templates can hide it by setting $GLOBALS['estatein_hide_cta'].
if ( empty( $GLOBALS['estatein_hide_cta'] ) ) {
	get_template_part( 'template-parts/cta' );
}

$footer_cols = array(
	'Home'       => array( 'Hero Section', 'Features', 'Properties', 'Testimonials', "FAQ's" ),
	'About Us'   => array( 'Our Story', 'Our Works', 'How It Works', 'Our Team', 'Our Clients' ),
	'Properties' => array( 'Portfolio', 'Categories' ),
	'Services'   => array( 'Valuation Mastery', 'Strategic Marketing', 'Negotiation Wizardry', 'Closing Success', 'Property Management' ),
	'Contact Us' => array( 'Contact Form', 'Our Offices' ),
);
?>
	</main><!-- #content -->

	<footer class="site-footer">
		<div class="container">

			<div class="footer-top">
				<div class="footer-brand">
					<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<svg class="brand__logo" viewBox="0 0 32 32" aria-hidden="true"><path d="M6 26V10c0-2 2-3 4-2l6 3V6c0-2 2-3 4-2l4 2c1 .5 2 1.5 2 3v17z" fill="#703bf7"/></svg>
						<span><?php bloginfo( 'name' ); ?></span>
					</a>
					<form class="footer-signup" action="#" method="post" onsubmit="return false;">
						<input type="email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'estatein-dark' ); ?>" aria-label="<?php esc_attr_e( 'Email', 'estatein-dark' ); ?>">
						<button type="submit" aria-label="<?php esc_attr_e( 'Subscribe', 'estatein-dark' ); ?>"><?php estatein_e_icon( 'send' ); ?></button>
					</form>
				</div>

				<?php foreach ( $footer_cols as $heading => $links ) : ?>
					<div class="footer-col">
						<h4><?php echo esc_html( $heading ); ?></h4>
						<ul>
							<?php foreach ( $links as $link ) : ?>
								<li><a href="#"><?php echo esc_html( $link ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="footer-bottom">
				<div class="legal">
					<span>&copy;<?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'estatein-dark' ); ?></span>
					<a href="#"><?php esc_html_e( 'Terms &amp; Conditions', 'estatein-dark' ); ?></a>
				</div>
				<div class="footer-social">
					<a href="#" aria-label="Facebook"><?php estatein_e_icon( 'facebook' ); ?></a>
					<a href="#" aria-label="LinkedIn"><?php estatein_e_icon( 'linkedin' ); ?></a>
					<a href="#" aria-label="Twitter"><?php estatein_e_icon( 'twitter' ); ?></a>
					<a href="#" aria-label="YouTube"><?php estatein_e_icon( 'youtube' ); ?></a>
				</div>
			</div>

		</div>
	</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
