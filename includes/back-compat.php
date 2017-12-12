<?php
/**
 * Siuy back compat functionality
 * Inspired by Twenty Sixteen back-compat.php
 *
 * Prevents Siuy from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @see 		https://github.com/WordPress/twentysixteen
 * @author  	Mahdi Yazdani
 * @package 	Siuy
 * @since 	    1.0.0
 */
/**
 * Prevent switching to Siuy on old versions of WordPress.
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
if (!function_exists('siuy_switch_theme')):
	function siuy_switch_theme()
	{
		switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
		unset($_GET['activated']);
		add_action('admin_notices', 'siuy_upgrade_notice');
	}
endif;
add_action('after_switch_theme', 'siuy_switch_theme');
/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Siuy on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('siuy_upgrade_notice')):
	function siuy_upgrade_notice()
	{
		$message = sprintf(__('Siuy requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'siuy') , $GLOBALS['wp_version']);
		printf('<div class="error"><p>%s</p></div>', $message);
	}
endif;
/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('siuy_customize')):
	function siuy_customize()
	{
		wp_die(sprintf(__('Siuy requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'siuy') , $GLOBALS['wp_version']) , '', array(
			'back_link' => true,
		));
	}
endif;
add_action('load-customize.php', 'siuy_customize');
/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('siuy_preview')):
	function siuy_preview()
	{
		if (isset($_GET['preview'])):
			wp_die(sprintf(__('Siuy requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'siuy') , $GLOBALS['wp_version']));
		endif;
	}
endif;
add_action('template_redirect', 'siuy_preview');