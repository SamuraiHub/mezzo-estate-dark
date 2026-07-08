<?php
/**
 * Single post template.
 *
 * @package Estatein_Dark
 */

get_header();
?>
<section class="section">
	<div class="container" style="max-width:820px">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<div class="page-hero" style="padding-bottom:16px">
					<h1><?php the_title(); ?></h1>
					<p class="muted"><?php echo esc_html( get_the_date() ); ?> · <?php the_author(); ?></p>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="property-card__img" style="aspect-ratio:16/8;margin-bottom:28px"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
			</article>
			<div style="margin-top:40px"><?php comments_template(); ?></div>
		<?php endwhile; ?>
	</div>
</section>
<?php
get_footer();
