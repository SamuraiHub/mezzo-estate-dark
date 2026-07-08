<?php
/**
 * Single Property — renders a real `property` CPT entry in the Figma
 * "Property Details" layout using the post's own fields and image.
 *
 * @package Estatein_Dark
 */

get_header();

while ( have_posts() ) :
	the_post();
	$id       = get_the_ID();
	$price    = get_post_meta( $id, 'estatein_price', true );
	$location = get_post_meta( $id, 'estatein_location', true );
	$beds     = get_post_meta( $id, 'estatein_beds', true );
	$baths    = get_post_meta( $id, 'estatein_baths', true );
	$area     = get_post_meta( $id, 'estatein_area', true );
	$thumb    = get_the_post_thumbnail_url( $id, 'large' );

	$features = array(
		__( 'Expansive terrace for outdoor entertaining', 'estatein-dark' ),
		__( 'Gourmet kitchen with top-of-the-line appliances', 'estatein-dark' ),
		__( 'Private access for morning strolls and sunset views', 'estatein-dark' ),
		__( 'Master suite with spa-inspired bathroom', 'estatein-dark' ),
		__( 'Private garage and ample storage space', 'estatein-dark' ),
	);
	?>

	<section class="section--tight" style="padding-top:40px">
		<div class="container">
			<div class="pd-head">
				<div>
					<h1 style="font-size:clamp(26px,3vw,34px);margin-bottom:6px"><?php the_title(); ?></h1>
					<?php if ( $location ) : ?><span class="loc"><?php estatein_e_icon( 'pin' ); ?> <?php echo esc_html( $location ); ?></span><?php endif; ?>
				</div>
				<?php if ( $price ) : ?><div class="price" style="text-align:right"><span><?php esc_html_e( 'Price', 'estatein-dark' ); ?></span><b><?php echo esc_html( $price ); ?></b></div><?php endif; ?>
			</div>

			<div class="pd-gallery">
				<div class="g"><img src="<?php echo esc_url( $thumb ? $thumb : estatein_img( 'detail-1.jpg' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy"></div>
				<div class="g"><img src="<?php echo esc_url( estatein_img( 'detail-2.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Interior living space', 'estatein-dark' ); ?>" loading="lazy"></div>
			</div>

			<div class="pd-cols">
				<div class="pd-panel">
					<h3><?php esc_html_e( 'Description', 'estatein-dark' ); ?></h3>
					<div class="muted" style="font-size:14px"><?php the_content(); ?></div>
					<div class="pd-spec">
						<?php if ( $beds ) : ?><div><span><?php esc_html_e( 'Bedrooms', 'estatein-dark' ); ?></span><b><?php echo esc_html( str_pad( $beds, 2, '0', STR_PAD_LEFT ) ); ?></b></div><?php endif; ?>
						<?php if ( $baths ) : ?><div><span><?php esc_html_e( 'Bathrooms', 'estatein-dark' ); ?></span><b><?php echo esc_html( str_pad( $baths, 2, '0', STR_PAD_LEFT ) ); ?></b></div><?php endif; ?>
						<?php if ( $area ) : ?><div><span><?php esc_html_e( 'Area', 'estatein-dark' ); ?></span><b><?php echo esc_html( $area ); ?></b></div><?php endif; ?>
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

	<!-- INQUIRE -->
	<section class="section">
		<div class="container two-col">
			<div class="section-head">
				<h2><?php printf( esc_html__( 'Inquire About %s', 'estatein-dark' ), esc_html( get_the_title() ) ); ?></h2>
				<p><?php esc_html_e( 'Interested in this property? Fill out the form below, and our real estate experts will get back to you with more details.', 'estatein-dark' ); ?></p>
			</div>
			<?php estatein_form_notice(); ?>
			<form id="form" class="form-card" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<?php estatein_form_hidden( 'Inquiry: ' . get_the_title() ); ?>
				<div class="form-grid">
					<div class="field"><label for="first_name"><?php esc_html_e( 'First Name', 'estatein-dark' ); ?></label><input id="first_name" name="first_name" type="text" required placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein-dark' ); ?>"></div>
					<div class="field"><label for="last_name"><?php esc_html_e( 'Last Name', 'estatein-dark' ); ?></label><input id="last_name" name="last_name" type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein-dark' ); ?>"></div>
					<div class="field"><label for="email"><?php esc_html_e( 'Email', 'estatein-dark' ); ?></label><input id="email" name="email" type="email" required placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein-dark' ); ?>"></div>
					<div class="field"><label for="phone"><?php esc_html_e( 'Phone', 'estatein-dark' ); ?></label><input id="phone" name="phone" type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein-dark' ); ?>"></div>
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
endwhile;
get_footer();
