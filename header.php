<?php
/**
 * Site header — reused on every page. Edit once, updates everywhere.
 *
 * @package Estatein_Dark
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'estatein-dark' ); ?></a>

<div id="page" class="site">

	<?php get_template_part( 'template-parts/announcement-bar' ); ?>

	<header class="site-header">
		<div class="container site-header__inner">

			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<svg class="brand__logo" viewBox="0 0 32 32" aria-hidden="true"><path d="M6 26V10c0-2 2-3 4-2l6 3V6c0-2 2-3 4-2l4 2c1 .5 2 1.5 2 3v17z" fill="#703bf7"/></svg>
					<span><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
			</a>

			<nav class="main-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'estatein-dark' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'nav-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					) );
				} else {
					// Sensible default so the theme looks right before a menu is set.
					echo '<ul class="nav-menu">';
					$defaults = array( 'Home' => '/', 'About Us' => '/about-us/', 'Properties' => '/properties/', 'Services' => '/services/' );
					foreach ( $defaults as $label => $path ) {
						printf( '<li><a href="%s">%s</a></li>', esc_url( home_url( $path ) ), esc_html( $label ) );
					}
					echo '</ul>';
				}
				?>
			</nav>

			<a class="btn header-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'estatein-dark' ); ?></a>

			<button class="nav-toggle" id="nav-toggle" aria-label="<?php esc_attr_e( 'Menu', 'estatein-dark' ); ?>" aria-expanded="false" aria-controls="primary-nav">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
			</button>

		</div>
	</header>

	<main id="content" class="site-main" tabindex="-1">
