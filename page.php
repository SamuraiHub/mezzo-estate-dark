<?php
/**
 * Default page template — also the blank, full-width canvas Elementor builds on.
 *
 * @package Estatein_Dark
 */

get_header();
?>
<article class="section">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			// If the page has no visible content (e.g. a fresh Elementor page),
			// don't render an empty header block.
			if ( ! is_page_template() && get_the_title() ) {
				echo '<div class="page-hero"><h1>' . esc_html( get_the_title() ) . '</h1></div>';
			}
			the_content();
			wp_link_pages();
		endwhile;
		?>
	</div>
</article>
<?php
get_footer();
