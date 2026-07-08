<?php
/**
 * Template Name: About Us
 * Matches the Figma "About Us Page" design.
 *
 * @package Estatein_Dark
 */

get_header();

$values = array(
	array( 'star',  'Trust', 'Trust is the cornerstone of every successful real estate transaction.' ),
	array( 'value', 'Excellence', 'We set the bar high for ourselves. From the properties we list to the services we provide.' ),
	array( 'home',  'Client-Centric', 'Your dreams and needs are at the center of our universe. We listen, understand.' ),
	array( 'check', 'Our Commitment', 'We are dedicated to providing you with the highest level of service, professionalism, and support.' ),
);

$achievements = array(
	array( '3+ Years of Excellence', 'With over 3 years in the industry, we\'ve amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.' ),
	array( 'Happy Clients', 'Our greatest achievement is the satisfaction of our clients. Their success stories fuel our passion for what we do.' ),
	array( 'Industry Recognition', 'We\'ve earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.' ),
);

$steps = array(
	array( 'Step 01', 'Discover a World of Possibilities', 'Your journey begins with exploring our carefully curated property listings. Use our intuitive search tools to filter properties based on your preferences.' ),
	array( 'Step 02', 'Narrowing Down Your Choices', 'Once you\'ve found properties that catch your eye, save them to your account or make a shortlist.' ),
	array( 'Step 03', 'Personalized Guidance', 'Have questions about a property or need more information? Our dedicated team of real estate experts is just a call or message away.' ),
	array( 'Step 04', 'See It for Yourself', 'Arrange viewings of the properties you\'re interested in. We\'ll coordinate with the property owners and accompany you to ensure you get a firsthand look.' ),
	array( 'Step 05', 'Making Informed Decisions', 'Before making an offer, our team will assist you with due diligence, including property inspections, legal checks, and market analysis.' ),
	array( 'Step 06', 'Getting the Best Deal', 'We\'ll help you negotiate the best terms and prepare your offer. Our goal is to secure the property at the right price and on favorable terms.' ),
);

$team = array(
	array( 'Max Mitchell', 'Founder' ),
	array( 'Sarah Johnson', 'Chief Real Estate Officer' ),
	array( 'David Brown', 'Head of Property Management' ),
	array( 'Michael Turner', 'Legal Counsel' ),
);

$clients = array(
	array( 'ABC Corporation', 'Since 2019', 'Commercial Real Estate', 'Luxury Home Development', 'Estatein\'s expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.' ),
	array( 'GreenTech Enterprises', 'Since 2018', 'Commercial Real Estate', 'Retail Space', 'Estatein\'s ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.' ),
);
?>

<section class="page-hero section--tight">
	<div class="container two-col">
		<div>
			<span class="eyebrow" style="color:var(--muted)">✦ <?php esc_html_e( 'Our Journey', 'estatein-dark' ); ?></span>
			<h1><?php esc_html_e( 'Our Journey', 'estatein-dark' ); ?></h1>
			<p><?php esc_html_e( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we\'ve expanded our reach, forged valuable partnerships, and gained the trust of countless clients.', 'estatein-dark' ); ?></p>
			<div class="stats" style="margin-top:24px">
				<div class="stat"><b>200+</b><span><?php esc_html_e( 'Happy Customers', 'estatein-dark' ); ?></span></div>
				<div class="stat"><b>10k+</b><span><?php esc_html_e( 'Properties For Clients', 'estatein-dark' ); ?></span></div>
				<div class="stat"><b>16+</b><span><?php esc_html_e( 'Years of Experience', 'estatein-dark' ); ?></span></div>
			</div>
		</div>
		<div class="hero__media has-photo" style="aspect-ratio:16/10">
			<img src="<?php echo esc_url( estatein_img( 'about-journey.jpg' ) ); ?>" alt="<?php esc_attr_e( 'A model home held in an open hand', 'estatein-dark' ); ?>" loading="lazy">
		</div>
	</div>
</section>

<!-- OUR VALUES -->
<section class="section">
	<div class="container two-col">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Our Values', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-2">
			<?php foreach ( $values as $v ) : ?>
				<div class="value-card">
					<span class="v-icon"><?php estatein_e_icon( $v[0] ); ?></span>
					<h4><?php echo esc_html( $v[1] ); ?></h4>
					<p><?php echo esc_html( $v[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ACHIEVEMENTS -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Our Achievements', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-3">
			<?php foreach ( $achievements as $a ) : ?>
				<div class="achieve-card"><h4><?php echo esc_html( $a[0] ); ?></h4><p><?php echo esc_html( $a[1] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- NAVIGATING THE EXPERIENCE (STEPS) -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Navigating the Estatein Experience', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'At Estatein, we\'ve designed a straightforward process to help you find and purchase your dream property with ease. Here\'s a step-by-step guide to how it all works.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-3">
			<?php foreach ( $steps as $s ) : ?>
				<div class="step-card"><div class="step-num"><?php echo esc_html( $s[0] ); ?></div><h4><?php echo esc_html( $s[1] ); ?></h4><p><?php echo esc_html( $s[2] ); ?></p></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- TEAM -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Meet the Estatein Team', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to make your real estate dreams a reality.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-4">
			<?php
			$team_ids = estatein_get_ids( 'team_member', 4 );
			if ( ! empty( $team_ids ) ) {
				foreach ( $team_ids as $mid ) :
					$photo  = get_the_post_thumbnail_url( $mid, 'medium_large' );
					$social = get_post_meta( $mid, 'estatein_social', true );
					?>
					<div class="team-card">
						<div class="team-card__photo"<?php echo $photo ? ' style="background-image:url(' . esc_url( $photo ) . ');background-size:cover;background-position:center"' : ''; ?>>
							<a class="social-badge" href="<?php echo esc_url( $social ? $social : '#' ); ?>" aria-label="<?php echo esc_attr( get_the_title( $mid ) ); ?> social"><?php estatein_e_icon( 'twitter' ); ?></a>
						</div>
						<h4><?php echo esc_html( get_the_title( $mid ) ); ?></h4>
						<span><?php echo esc_html( get_post_meta( $mid, 'estatein_role', true ) ); ?></span>
						<div><a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Say Hello 👋', 'estatein-dark' ); ?></a></div>
					</div>
				<?php endforeach;
			} else {
				$team_imgs = array( 'team-1.jpg', 'team-2.jpg', 'team-3.jpg', 'team-4.jpg' );
				foreach ( $team as $i => $m ) :
					?>
					<div class="team-card">
						<div class="team-card__photo" style="background-image:url(<?php echo esc_url( estatein_img( $team_imgs[ $i ] ) ); ?>);background-size:cover;background-position:center">
							<span class="social-badge"><?php estatein_e_icon( 'twitter' ); ?></span>
						</div>
						<h4><?php echo esc_html( $m[0] ); ?></h4>
						<span><?php echo esc_html( $m[1] ); ?></span>
						<div><a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Say Hello 👋', 'estatein-dark' ); ?></a></div>
					</div>
				<?php endforeach;
			}
			?>
		</div>
	</div>
</section>

<!-- VALUED CLIENTS -->
<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow"></span>
			<h2><?php esc_html_e( 'Our Valued Clients', 'estatein-dark' ); ?></h2>
			<p><?php esc_html_e( 'At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we\'ve had the pleasure of serving.', 'estatein-dark' ); ?></p>
		</div>
		<div class="grid grid-2">
			<?php foreach ( $clients as $c ) : ?>
				<div class="pd-panel">
					<div class="pd-head" style="margin:0 0 8px">
						<div><span class="muted" style="font-size:13px"><?php echo esc_html( $c[1] ); ?></span><h3 style="margin:.2em 0 0"><?php echo esc_html( $c[0] ); ?></h3></div>
						<a class="btn" href="#"><?php esc_html_e( 'Visit Website', 'estatein-dark' ); ?></a>
					</div>
					<div class="tags"><span class="tag"><?php echo esc_html( $c[2] ); ?></span><span class="tag"><?php echo esc_html( $c[3] ); ?></span></div>
					<div class="value-card" style="background:var(--bg)"><p><strong><?php esc_html_e( 'What They Said 😍', 'estatein-dark' ); ?></strong></p><p><?php echo esc_html( $c[4] ); ?></p></div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php estatein_slider_foot( '01', '10' ); ?>
	</div>
</section>

<?php
get_footer();
