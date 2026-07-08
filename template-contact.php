<?php
/**
 * Template Name: Contact
 * Matches the Figma "Contact Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$contact_cards = array(
	array( 'mail',  'info@estatein.com', '' ),
	array( 'phone', '+1 (123) 456-7890', '' ),
	array( 'pin',   'Main Headquarters', '' ),
	array( 'twitter', 'Instagram   LinkedIn   Facebook', '' ),
);

$offices = array(
	array( 'Main Headquarters', '123 Estatein Plaza, City Center, Metropolis', 'Our main headquarters serve as the heart of Estatein. Located in the bustling city center, this is where our core team of experts operates.', 'international' ),
	array( 'Regional Offices', '456 Urban Avenue, Downtown District, Metropolis', 'Estatein\'s presence extends to multiple regions, each with its own dynamic real estate landscape. Discover our regional offices, staffed by local experts.', 'regional' ),
);
?>

<section class="page-hero section--tight">
	<div class="container">
		<h1><?php esc_html_e( 'Get in Touch with Estatein', 'estatein-dark' ); ?></h1>
		<p><?php esc_html_e( 'Welcome to Estatein\'s Contact Us page. We\'re here to assist you with any inquiries, requests, or feedback you may have. Whether you\'re looking to buy or sell a property, explore investment opportunities, or simply want to connect, we\'re just a message away.', 'estatein-dark' ); ?></p>
	</div>
</section>

<section class="section--tight">
	<div class="container">
		<div class="feature-cards">
			<?php foreach ( $contact_cards as $c ) : ?>
				<div class="contact-card feature-card">
					<span class="fc-arrow"><?php estatein_e_icon( 'arrow-ur' ); ?></span>
					<span class="c-icon"><?php estatein_e_icon( $c[0] ); ?></span>
					<h4><?php echo esc_html( $c[1] ); ?></h4>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- LET'S CONNECT FORM -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Let\'s Connect', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'We\'re excited to connect with you and learn more about your real estate goals. Use the form below to get in touch with Estatein.', 'estatein-dark' ); ?></p>
		</div>
		<?php estatein_form_notice(); ?>
		<form id="form" class="form-card" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<?php estatein_form_hidden( 'Contact enquiry (Let\'s Connect)' ); ?>
			<div class="form-grid cols-3">
				<div class="field"><label for="first_name"><?php esc_html_e( 'First Name', 'estatein-dark' ); ?></label><input id="first_name" name="first_name" type="text" required placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="last_name"><?php esc_html_e( 'Last Name', 'estatein-dark' ); ?></label><input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="email"><?php esc_html_e( 'Email', 'estatein-dark' ); ?></label><input id="email" name="email" type="email" required placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="phone"><?php esc_html_e( 'Phone', 'estatein-dark' ); ?></label><input id="phone" name="phone" type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="inquiry_type"><?php esc_html_e( 'Inquiry Type', 'estatein-dark' ); ?></label><select id="inquiry_type" name="inquiry_type"><option><?php esc_html_e( 'Select Inquiry Type', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Buying', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Selling', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Investing', 'estatein-dark' ); ?></option></select></div>
				<div class="field"><label for="hear"><?php esc_html_e( 'How Did You Hear About Us?', 'estatein-dark' ); ?></label><select id="hear" name="hear"><option><?php esc_html_e( 'Select', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Search Engine', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Social Media', 'estatein-dark' ); ?></option><option><?php esc_html_e( 'Referral', 'estatein-dark' ); ?></option></select></div>
			</div>
			<div class="field full" style="margin-top:20px"><label for="message"><?php esc_html_e( 'Message', 'estatein-dark' ); ?></label><textarea id="message" name="message" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein-dark' ); ?>"></textarea></div>
			<div class="form-foot">
				<label class="form-agree"><input type="checkbox"> <?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'estatein-dark' ); ?></label>
				<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Send Your Message', 'estatein-dark' ); ?></button>
			</div>
		</form>
	</div>
</section>

<!-- OFFICE LOCATIONS -->
<section class="section">
	<div class="container" data-tabs>
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Discover Our Office Locations', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Estatein is here to serve you across multiple locations. Whether you\'re looking to meet our team, discuss real estate opportunities, or simply drop by for a chat, we have offices conveniently located to serve your needs.', 'estatein-dark' ); ?></p>
		</div>
		<div class="tabs">
			<button class="is-active" data-tab="all"><?php esc_html_e( 'All', 'estatein-dark' ); ?></button>
			<button data-tab="regional"><?php esc_html_e( 'Regional', 'estatein-dark' ); ?></button>
			<button data-tab="international"><?php esc_html_e( 'International', 'estatein-dark' ); ?></button>
		</div>
		<div class="grid grid-2">
			<?php foreach ( $offices as $o ) : ?>
				<div class="pd-panel" data-tab-panel="<?php echo esc_attr( $o[3] ); ?>">
					<span class="muted" style="font-size:13px"><?php echo esc_html( $o[0] ); ?></span>
					<h3 style="margin:.3em 0"><?php echo esc_html( $o[1] ); ?></h3>
					<p class="muted" style="font-size:14px"><?php echo esc_html( $o[2] ); ?></p>
					<div class="tags">
						<span class="tag"><?php estatein_e_icon( 'mail' ); ?> info@estatein.com</span>
						<span class="tag"><?php estatein_e_icon( 'phone' ); ?> +1 (123) 456-7890</span>
						<span class="tag"><?php estatein_e_icon( 'pin' ); ?> Metropolis</span>
					</div>
					<a class="btn btn--primary btn--block" href="#" style="margin-top:16px"><?php esc_html_e( 'Get Direction', 'estatein-dark' ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- EXPLORE ESTATEIN'S WORLD (GALLERY) -->
<section class="section">
	<div class="container">
		<div class="gallery-grid">
			<?php
			$gallery = array(
				'office-1.jpg' => 'Estatein open-plan office',
				'office-2.jpg' => 'The Estatein team',
				'office-3.jpg' => 'A client meeting in progress',
				'office-4.jpg' => 'Estatein agents',
				'office-5.jpg' => 'Estatein specialists',
				'office-6.jpg' => 'Closing a deal with a handshake',
			);
			foreach ( $gallery as $file => $alt ) {
				printf(
					'<div class="gallery-item"><img src="%s" alt="%s" loading="lazy"></div>',
					esc_url( estatein_img( $file ) ),
					esc_attr( $alt )
				);
			}
			?>
		</div>
		<div class="section-head" style="margin-top:32px">
			<h2><?php esc_html_e( 'Explore Estatein\'s World', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Step inside the world of Estatein, where professionalism meets warmth, and expertise meets passion. Our gallery offers a glimpse into our team and workspaces, inviting you to get to know us better.', 'estatein-dark' ); ?></p>
		</div>
	</div>
</section>

<?php
get_footer();
