<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Siuy
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js no-svg" <?php Siuy::html_tag_schema(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action('siuy_before_page_content'); ?>

<div id="page" class="site c-offcanvas-content-wrap">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'siuy'); ?></a>
	<header id="masthead" class="site-header">
		<div class="site-branding">

			<?php

			do_action('siuy_before_site_branding');

			the_custom_logo();
			if (is_front_page() && is_home()) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
			<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php 

			do_action('siuy_after_site_branding');

			endif; 
			?>

		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
			<button class="siuy-menu-toggle js-offcanvas-toggler js-primary-offcanvas-toggler" aria-controls="primary-menu" aria-expanded="false">
				<span class="hamburger-nav-icon">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</span>
			</button>
			<?php
			if (apply_filters('siuy_display_site_navigation', true)):
				wp_nav_menu(array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu',
				));
			endif;
			?>
		</nav><!-- #site-navigation -->

		<?php do_action('siuy_after_site_navigation');  ?>

	</header><!-- #masthead -->

	<?php do_action('siuy_before_site_content'); ?>
	
	<div id="content" class="container site-content">