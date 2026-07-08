<?php
/**
 * Fallback template — used for the blog index, archives and search.
 *
 * @package Estatein_Dark
 */

get_header();
?>
<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<div class="page-hero"><h1><?php single_post_title(); ?></h1></div>
			<?php elseif ( is_search() ) : ?>
				<div class="page-hero"><h1><?php printf( esc_html__( 'Search results for: %s', 'estatein-dark' ), '<span class="text-purple">' . esc_html( get_search_query() ) . '</span>' ); ?></h1></div>
			<?php elseif ( is_archive() ) : ?>
				<div class="page-hero"><h1><?php the_archive_title(); ?></h1></div>
			<?php endif; ?>

			<div class="grid grid-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'faq-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="property-card__img" style="margin-bottom:16px;display:block"><?php the_post_thumbnail( 'medium_large' ); ?></a>
						<?php endif; ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'estatein-dark' ); ?></a>
					</article>
				<?php endwhile; ?>
			</div>

			<div style="margin-top:40px"><?php the_posts_pagination(); ?></div>

		<?php else : ?>
			<div class="page-hero"><h1><?php esc_html_e( 'Nothing found', 'estatein-dark' ); ?></h1><p class="muted"><?php esc_html_e( 'Sorry, no content matched your request.', 'estatein-dark' ); ?></p></div>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
