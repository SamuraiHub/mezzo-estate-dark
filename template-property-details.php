<?php
/**
 * Template Name: Property Details
 * Matches the Figma "Property Details Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$features = array(
	'Expansive oceanfront terrace for outdoor entertaining',
	'Gourmet kitchen with top-of-the-line appliances',
	'Private beach access for morning strolls and sunset views',
	'Master suite with a spa-expired bathroom and ocean-facing balcony',
	'Private garage and ample storage space',
);

$pricing = array(
	'Additional Fees' => array(
		array( 'Property Transfer Tax', '$25,000', 'Based on the sale price and local regulations' ),
		array( 'Legal Fees', '$3,000', 'Approximate cost for legal services, including title transfer' ),
		array( 'Home Inspection', '$500', 'Recommended for due diligence' ),
		array( 'Property Insurance', '$1,200', 'Annual cost for comprehensive property insurance' ),
		array( 'Mortgage Fees', 'Varies', 'If applicable, consult your lender for specific details' ),
	),
	'Monthly Costs' => array(
		array( 'Property Taxes', '$1,250', 'Approximate monthly property tax based on the sale price and local rates' ),
		array( 'Homeowners Association Fee', '$300', 'Monthly fee for common area maintenance and security' ),
	),
);

$faqs = array(
	array( 'How do I search for properties on Estatein?', 'Learn how to use our user-friendly search tools to find properties that match your criteria.' ),
	array( 'What documents do I need to sell my property through Estatein?', 'Find out about the necessary documentation for listing your property with us.' ),
	array( 'How can I contact an Estatein agent?', 'Discover the different ways you can get in touch with our experienced agents.' ),
);
?>

<section class="section--tight" style="padding-top:40px">
	<div class="container">
		<div class="pd-head">
			<div>
				<h1 style="font-size:clamp(26px,3vw,34px);margin-bottom:6px"><?php esc_html_e( 'Seaside Serenity Villa', 'estatein-dark' ); ?></h1>
				<span class="loc"><?php estatein_e_icon( 'pin' ); ?> <?php esc_html_e( 'Malibu, California', 'estatein-dark' ); ?></span>
			</div>
			<div class="price" style="text-align:right"><span><?php esc_html_e( 'Price', 'estatein-dark' ); ?></span><b>$1,250,000</b></div>
		</div>

		<div class="pd-gallery">
			<div class="g"><img src="<?php echo esc_url( estatein_img( 'detail-1.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Villa exterior with pool', 'estatein-dark' ); ?>" loading="lazy"></div>
			<div class="g"><img src="<?php echo esc_url( estatein_img( 'detail-2.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Villa interior living space', 'estatein-dark' ); ?>" loading="lazy"></div>
		</div>

		<div class="pd-cols">
			<div class="pd-panel">
				<h3><?php esc_html_e( 'Description', 'estatein-dark' ); ?></h3>
				<p class="muted" style="font-size:14px"><?php esc_html_e( 'Discover your own piece of paradise with the Seaside Serenity Villa. With an open floor plan, breathtaking ocean views from every room, and direct access to a pristine sandy beach, this property is the epitome of coastal living.', 'estatein-dark' ); ?></p>
				<div class="pd-spec">
					<div><span><?php esc_html_e( 'Bedrooms', 'estatein-dark' ); ?></span><b>04</b></div>
					<div><span><?php esc_html_e( 'Bathrooms', 'estatein-dark' ); ?></span><b>03</b></div>
					<div><span><?php esc_html_e( 'Area', 'estatein-dark' ); ?></span><b>2,500 Sq Ft</b></div>
				</div>
			</div>
			<div class="pd-panel">
				<h3><?php esc_html_e( 'Key Features and Amenities', 'estatein-dark' ); ?></h3>
				<?php foreach ( $features as $f ) : ?>
					<div class="pd-feature"><span class="b"><?php estatein_e_icon( 'bolt' ); ?></span><?php echo esc_html( $f ); ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- INQUIRE FORM -->
<section class="section">
	<div class="container two-col">
		<div class="section-head">
			<h2><?php esc_html_e( 'Inquire About Seaside Serenity Villa', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Interested in this property? Fill out the form below, and our real estate experts will get back to you with more details, including scheduling a viewing and answering any questions you may have.', 'estatein-dark' ); ?></p>
		</div>
		<?php estatein_form_notice(); ?>
		<form id="form" class="form-card" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<?php estatein_form_hidden( 'Inquiry: Seaside Serenity Villa' ); ?>
			<div class="form-grid">
				<div class="field"><label for="first_name"><?php esc_html_e( 'First Name', 'estatein-dark' ); ?></label><input id="first_name" name="first_name" type="text" required placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="last_name"><?php esc_html_e( 'Last Name', 'estatein-dark' ); ?></label><input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="email"><?php esc_html_e( 'Email', 'estatein-dark' ); ?></label><input id="email" name="email" type="email" required placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="phone"><?php esc_html_e( 'Phone', 'estatein-dark' ); ?></label><input id="phone" name="phone" type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein-dark' ); ?>"></div>
			</div>
			<div class="field full" style="margin-top:20px"><label for="selected_property"><?php esc_html_e( 'Selected Property', 'estatein-dark' ); ?></label><input id="selected_property" type="text" value="Seaside Serenity Villa, Malibu, California" readonly></div>
			<div class="field full" style="margin-top:20px"><label for="message"><?php esc_html_e( 'Message', 'estatein-dark' ); ?></label><textarea id="message" name="message" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein-dark' ); ?>"></textarea></div>
			<div class="form-foot">
				<label class="form-agree"><input type="checkbox"> <?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'estatein-dark' ); ?></label>
				<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Send Your Message', 'estatein-dark' ); ?></button>
			</div>
		</form>
	</div>
</section>

<!-- PRICING DETAILS -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<h2><?php esc_html_e( 'Comprehensive Pricing Details', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'At Estatein, transparency is key. We want to have a clear understanding of all costs associated with your property investment.', 'estatein-dark' ); ?></p>
		</div>
		<?php foreach ( $pricing as $group => $rows ) : ?>
			<div class="pd-panel" style="margin-bottom:20px">
				<div class="head-row" style="margin-bottom:20px"><h3 style="margin:0"><?php echo esc_html( $group ); ?></h3><a class="btn" href="#"><?php esc_html_e( 'Learn More', 'estatein-dark' ); ?></a></div>
				<div class="grid grid-2">
					<?php foreach ( $rows as $r ) : ?>
						<div class="value-card" style="background:var(--bg)"><h4 style="font-size:16px;margin-bottom:6px"><?php echo esc_html( $r[0] ); ?></h4><p><strong style="color:var(--text)"><?php echo esc_html( $r[1] ); ?></strong> — <?php echo esc_html( $r[2] ); ?></p></div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- FAQ -->
<section class="section">
	<div class="container">
		<div class="head-row">
			<div class="section-head"><h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein-dark' ); ?></h2><p><?php esc_html_e( 'Find answers to common questions about Estatein\'s services, property listings, and the real estate process.', 'estatein-dark' ); ?></p></div>
			<a class="btn" href="#"><?php esc_html_e( 'View All FAQ\'s', 'estatein-dark' ); ?></a>
		</div>
		<div class="grid grid-3">
			<?php foreach ( $faqs as $f ) : ?>
				<article class="faq-card"><h4><?php echo esc_html( $f[0] ); ?></h4><p><?php echo esc_html( $f[1] ); ?></p><a class="btn" href="#"><?php esc_html_e( 'Read More', 'estatein-dark' ); ?></a></article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_footer();
