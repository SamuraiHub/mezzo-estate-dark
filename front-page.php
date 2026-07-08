<?php
/**
 * Front page — Home. Matches the Figma "Home Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$properties = array(
	array( 'title' => 'Seaside Serenity Villa', 'desc' => 'A stunning 4-bedroom, 3-bathroom villa in a peaceful suburban neighborhood.', 'price' => '$550,000', 'beds' => '4', 'baths' => '3', 'type' => 'Villa' ),
	array( 'title' => 'Metropolitan Haven', 'desc' => 'A chic and fully-furnished 2-bedroom apartment with panoramic city views.', 'price' => '$550,000', 'beds' => '2', 'baths' => '2', 'type' => 'Villa' ),
	array( 'title' => 'Rustic Retreat Cottage', 'desc' => 'An elegant 3-bedroom, 2.5-bathroom townhouse in a gated community.', 'price' => '$550,000', 'beds' => '3', 'baths' => '3', 'type' => 'Villa' ),
);

$testimonials = array(
	array( 'title' => 'Exceptional Service!', 'text' => 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'name' => 'Wade Warren', 'loc' => 'USA, California' ),
	array( 'title' => 'Efficient and Reliable', 'text' => 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'name' => 'Emelie Thomson', 'loc' => 'USA, Florida' ),
	array( 'title' => 'Trusted Advisors', 'text' => 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!', 'name' => 'John Mans', 'loc' => 'USA, Nevada' ),
);

$faqs = array(
	array( 'q' => 'How do I search for properties on Estatein?', 'a' => 'Learn how to use our user-friendly search tools to find properties that match your criteria.' ),
	array( 'q' => 'What documents do I need to sell my property through Estatein?', 'a' => 'Find out about the necessary documentation for listing your property with us.' ),
	array( 'q' => 'How can I contact an Estatein agent?', 'a' => 'Discover the different ways you can get in touch with our experienced agents.' ),
);
?>

<!-- HERO -->
<section class="hero section">
	<div class="container hero__grid">
		<div class="hero__content">
			<h1><?php esc_html_e( 'Discover Your Dream Property with Estatein', 'estatein-dark' ); ?></h1>
			<p><?php esc_html_e( 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'estatein-dark' ); ?></p>
			<div class="hero__actions">
				<a class="btn" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein-dark' ); ?></a>
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Browse Properties', 'estatein-dark' ); ?></a>
			</div>
			<div class="stats">
				<div class="stat"><b>200+</b><span><?php esc_html_e( 'Happy Customers', 'estatein-dark' ); ?></span></div>
				<div class="stat"><b>10k+</b><span><?php esc_html_e( 'Properties For Clients', 'estatein-dark' ); ?></span></div>
				<div class="stat"><b>16+</b><span><?php esc_html_e( 'Years of Experience', 'estatein-dark' ); ?></span></div>
			</div>
		</div>
		<div class="hero__media has-photo">
			<img src="<?php echo esc_url( estatein_img( 'hero-building.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Modern glass real estate tower', 'estatein-dark' ); ?>" width="920" height="814" fetchpriority="high">
		</div>
	</div>
</section>

<!-- FEATURE CARDS -->
<section class="section--tight">
	<div class="container">
		<?php get_template_part( 'template-parts/feature-cards' ); ?>
	</div>
</section>

<!-- FEATURED PROPERTIES -->
<section class="section">
	<div class="container">
		<div class="head-row">
			<div class="section-head">
				<span class="eyebrow"></span>
				<h2><?php esc_html_e( 'Featured Properties', 'estatein-dark' ); ?></h2>
				<p><?php esc_html_e( 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein.', 'estatein-dark' ); ?></p>
			</div>
			<a class="btn" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'View All Properties', 'estatein-dark' ); ?></a>
		</div>
		<div class="grid grid-3">
			<?php
			$property_ids = estatein_get_ids( 'property', 3 );
			if ( ! empty( $property_ids ) ) {
				foreach ( $property_ids as $pid ) {
					estatein_property_card_from_post( $pid );
				}
			} else {
				// Fallback so the section never looks empty before demo import.
				$imgs = array( 'property-1.jpg', 'property-2.jpg', 'property-3.jpg' );
				foreach ( $properties as $i => $p ) {
					$p['url'] = home_url( '/property-details/' );
					$p['img'] = estatein_img( $imgs[ $i ] );
					estatein_property_card( $p );
				}
			}
			?>
		</div>
		<?php estatein_slider_foot( '01', '60' ); ?>
	</div>
</section>

<!-- TESTIMONIALS -->
<section class="section">
	<div class="container">
		<div class="head-row">
			<div class="section-head">
				<span class="eyebrow"></span>
				<h2><?php esc_html_e( 'What Our Clients Say', 'estatein-dark' ); ?></h2>
				<p><?php esc_html_e( 'Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate needs.', 'estatein-dark' ); ?></p>
			</div>
			<a class="btn" href="#"><?php esc_html_e( 'View All Testimonials', 'estatein-dark' ); ?></a>
		</div>
		<div class="grid grid-3">
			<?php
			$t_ids = estatein_get_ids( 'testimonial', 3 );
			if ( ! empty( $t_ids ) ) {
				$testimonials = array();
				foreach ( $t_ids as $tid ) {
					$rating = (int) get_post_meta( $tid, 'estatein_rating', true );
					$testimonials[] = array(
						'title'  => get_the_title( $tid ),
						'text'   => wp_strip_all_tags( get_post_field( 'post_content', $tid ) ),
						'name'   => get_post_meta( $tid, 'estatein_author', true ),
						'loc'    => get_post_meta( $tid, 'estatein_location', true ),
						'rating' => $rating > 0 ? $rating : 5,
					);
				}
			}
			foreach ( $testimonials as $t ) :
				$rating = isset( $t['rating'] ) ? (int) $t['rating'] : 5;
				?>
				<article class="testimonial">
					<div class="stars" aria-label="<?php echo esc_attr( sprintf( _n( '%d star', '%d stars', $rating, 'estatein-dark' ), $rating ) ); ?>"><?php echo esc_html( str_repeat( '★', $rating ) ); ?></div>
					<h4><?php echo esc_html( $t['title'] ); ?></h4>
					<p><?php echo esc_html( $t['text'] ); ?></p>
					<div class="testimonial__by">
						<span class="avatar"></span>
						<div><b><?php echo esc_html( $t['name'] ); ?></b><span><?php echo esc_html( $t['loc'] ); ?></span></div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<?php estatein_slider_foot( '01', '10' ); ?>
	</div>
</section>

<!-- FAQ -->
<section class="section">
	<div class="container">
		<div class="head-row">
			<div class="section-head">
				<span class="eyebrow"></span>
				<h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein-dark' ); ?></h2>
				<p><?php esc_html_e( 'Find answers to common questions about Estatein\'s services, property listings, and the real estate process. We\'re here to provide clarity and assist you every step of the way.', 'estatein-dark' ); ?></p>
			</div>
			<a class="btn" href="#"><?php esc_html_e( 'View All FAQ\'s', 'estatein-dark' ); ?></a>
		</div>
		<div class="grid grid-3">
			<?php
			$faq_ids = estatein_get_ids( 'faq', 3 );
			if ( ! empty( $faq_ids ) ) {
				$faqs = array();
				foreach ( $faq_ids as $fid ) {
					$faqs[] = array( 'q' => get_the_title( $fid ), 'a' => wp_strip_all_tags( get_post_field( 'post_content', $fid ) ) );
				}
			}
			foreach ( $faqs as $f ) :
				?>
				<article class="faq-card">
					<h4><?php echo esc_html( $f['q'] ); ?></h4>
					<p><?php echo esc_html( $f['a'] ); ?></p>
					<a class="btn" href="#"><?php esc_html_e( 'Read More', 'estatein-dark' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
		<?php estatein_slider_foot( '01', '10' ); ?>
	</div>
</section>

<?php
get_footer();
