<?php
/**
 * Siuy functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * Do not add any custom code here.
 * Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 *
 * @see 		https://codex.wordpress.org/Theme_Development
 * @see 		https://codex.wordpress.org/Plugin_API
 * @author  	Mahdi Yazdani
 * @package 	Siuy
 * @since 		1.0.0
 */
// Assign the "Siuy" info to constants.
$siuy_theme = wp_get_theme('siuy');
define('SIUY_THEME_NAME', $siuy_theme->get('Name'));
define('SIUY_THEME_URI', $siuy_theme->get('ThemeURI'));
define('SIUY_THEME_AUTHOR', $siuy_theme->get('Author'));
define('SIUY_THEME_AUTHOR_URI', $siuy_theme->get('AuthorURI'));
define('SIUY_THEME_VERSION', $siuy_theme->get('Version'));
// Siuy only works in WordPress 4.7 or later.
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')):
	require 'includes/back-compat.php';

endif;
/**
 * Initialize all the things.
 * Functions and definitions
 *
 * @since 1.0.0
 */
$siuy = (object)array(
	'version' => SIUY_THEME_VERSION,
	'main' => require 'includes/class-siuy.php',
	'customizer' => require 'includes/class-siuy-customizer.php',
	'functions' => require 'includes/template-functions.php',
	'tags' => require 'includes/template-tags.php',
	'posts-widget' => require 'includes/class-siuy-posts-widget.php'
);
/**
 * Load Jetpack compatibility file.
 *
 * @since 1.0.0
 */
if (defined('JETPACK__VERSION')):
	require 'includes/jetpack.php';

endif;