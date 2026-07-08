<?php
/**
 * Template Name: Properties
 * Matches the Figma "Properties Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$properties = array(
	array( 'title' => 'Seaside Serenity Villa', 'cat' => 'Coastal Escapes - Where Waves Beckon', 'desc' => 'Wake up to the soothing melody of waves. This beachfront villa offers.', 'price' => '$1,250,000', 'beds' => '4', 'baths' => '3', 'type' => 'Villa' ),
	array( 'title' => 'Metropolitan Haven', 'cat' => 'Urban Oasis - Life in the Heart of the City', 'desc' => 'Immerse yourself in the energy of the city. This modern apartment in the heart.', 'price' => '$650,000', 'beds' => '2', 'baths' => '2', 'type' => 'Villa' ),
	array( 'title' => 'Rustic Retreat Cottage', 'cat' => 'Countryside Charm - Escape to Nature\'s Embrace', 'desc' => 'Find tranquility in the countryside. This charming cottage is nestled amidst rolling hills.', 'price' => '$350,000', 'beds' => '3', 'baths' => '3', 'type' => 'Villa' ),
);

$filters = array(
	array( 'pin', 'Location' ), array( 'type', 'Property Type' ), array( 'range', 'Pricing Range' ),
	array( 'size', 'Property Size' ), array( 'calendar', 'Build Year' ),
);
?>

<section class="page-hero section--tight">
	<div class="container">
		<h1><?php esc_html_e( 'Find Your Dream Property', 'estatein-dark' ); ?></h1>
		<p><?php esc_html_e( 'Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. Your journey begins here.', 'estatein-dark' ); ?></p>

		<form class="search-bar" style="margin-top:32px" action="#" method="get" onsubmit="return false;">
			<input type="search" placeholder="<?php esc_attr_e( 'Search For A Property', 'estatein-dark' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'estatein-dark' ); ?>">
			<button type="submit" class="btn btn--primary"><?php estatein_e_icon( 'search' ); ?> <?php esc_html_e( 'Find Property', 'estatein-dark' ); ?></button>
		</form>

		<div class="filter-row">
			<?php foreach ( $filters as $f ) : ?>
				<select aria-label="<?php echo esc_attr( $f[1] ); ?>"><option><?php echo esc_html( $f[1] ); ?></option></select>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- DISCOVER A WORLD OF POSSIBILITIES -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Discover a World of Possibilities', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Our portfolio of properties is as diverse as your dreams. Explore the following categories to find the perfect property that resonates with your vision of home.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-3">
			<?php
			$property_ids = estatein_get_ids( 'property', 6 );
			if ( ! empty( $property_ids ) ) {
				foreach ( $property_ids as $pid ) {
					estatein_property_card_from_post( $pid );
				}
			} else {
				$imgs = array( 'property-1.jpg', 'property-2.jpg', 'property-3.jpg' );
				foreach ( $properties as $i => $p ) {
					$p['url'] = home_url( '/property-details/' );
					$p['img'] = estatein_img( $imgs[ $i ] );
					estatein_property_card( $p );
				}
			}
			?>
		</div>
		<?php estatein_slider_foot( '01', '10' ); ?>
	</div>
</section>

<!-- LET'S MAKE IT HAPPEN (BIG FORM) -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Let\'s Make it Happen', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will work their magic to find your perfect match. Don\'t wait; let\'s embark on this exciting journey together.', 'estatein-dark' ); ?></p>
		</div>

		<?php estatein_form_notice(); ?>
		<form id="form" class="form-card" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
			<?php estatein_form_hidden( 'Property enquiry (Let\'s Make it Happen)' ); ?>
			<div class="form-grid cols-4">
				<div class="field"><label for="first_name"><?php esc_html_e( 'First Name', 'estatein-dark' ); ?></label><input id="first_name" name="first_name" type="text" required placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="last_name"><?php esc_html_e( 'Last Name', 'estatein-dark' ); ?></label><input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="email"><?php esc_html_e( 'Email', 'estatein-dark' ); ?></label><input id="email" name="email" type="email" required placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein-dark' ); ?>"></div>
				<div class="field"><label for="phone"><?php esc_html_e( 'Phone', 'estatein-dark' ); ?></label><input id="phone" name="phone" type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein-dark' ); ?>"></div>

				<div class="field"><label><?php esc_html_e( 'Preferred Location', 'estatein-dark' ); ?></label><select><option><?php esc_html_e( 'Select Location', 'estatein-dark' ); ?></option></select></div>
				<div class="field"><label><?php esc_html_e( 'Property Type', 'estatein-dark' ); ?></label><select><option><?php esc_html_e( 'Select Property Type', 'estatein-dark' ); ?></option></select></div>
				<div class="field"><label><?php esc_html_e( 'No. of Bathrooms', 'estatein-dark' ); ?></label><select><option><?php esc_html_e( 'Select no. of Bathrooms', 'estatein-dark' ); ?></option></select></div>
				<div class="field"><label><?php esc_html_e( 'No. of Bedrooms', 'estatein-dark' ); ?></label><select><option><?php esc_html_e( 'Select no. of Bedrooms', 'estatein-dark' ); ?></option></select></div>
			</div>
			<div class="form-grid" style="margin-top:20px">
				<div class="field"><label><?php esc_html_e( 'Budget', 'estatein-dark' ); ?></label><select><option><?php esc_html_e( 'Select Budget', 'estatein-dark' ); ?></option></select></div>
				<div class="field"><label><?php esc_html_e( 'Preferred Contact Method', 'estatein-dark' ); ?></label><input type="text" placeholder="<?php esc_attr_e( 'Enter Your Number', 'estatein-dark' ); ?>"></div>
			</div>
			<div class="field full" style="margin-top:20px"><label for="message"><?php esc_html_e( 'Message', 'estatein-dark' ); ?></label><textarea id="message" name="message" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein-dark' ); ?>"></textarea></div>
			<div class="form-foot">
				<label class="form-agree"><input type="checkbox"> <?php esc_html_e( 'I agree with Terms of Use and Privacy Policy', 'estatein-dark' ); ?></label>
				<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Send Your Message', 'estatein-dark' ); ?></button>
			</div>
		</form>
	</div>
</section>

<?php
get_footer();
