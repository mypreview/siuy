<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Siuy
 */
/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function siuy_jetpack_setup()
{
	// Add theme support for Infinite Scroll.
	add_theme_support('infinite-scroll', array(
		'container' => 'main',
		'render' => 'siuy_infinite_scroll_render',
		'footer' => 'page'
	));
	// Add theme support for Responsive Videos.
	add_theme_support('jetpack-responsive-videos');
	// Add theme support for Content Options.
	add_theme_support('jetpack-content-options', array(
		'author-bio' => true,
		'author-bio-default' => true,
		'post-details' => array(
			'stylesheet' => 'siuy-styles',
			'date' => '.posted-on',
			'categories' => '.cat-links',
			'tags' => '.tags-links',
			'author' => '.byline',
			'comment' => '.comments-link',
		) ,
		'featured-images' => array(
			'archive' => true,
			'archive-default' => true,
			'post' => true,
			'post-default' => true,
			'page' => true,
			'page-default' => true
		)
	));
}
add_action('after_setup_theme', 'siuy_jetpack_setup');
/**
 * Author Bio Avatar Size.
 */
function siuy_author_bio_avatar_size($size)
{
	return $size = 102;
}
add_filter('jetpack_author_bio_avatar_size', 'siuy_author_bio_avatar_size', 10, 1);
/**
 * Custom render function for Infinite Scroll.
 */
function siuy_infinite_scroll_render()
{
	while (have_posts()):
		the_post();
		if (is_search()):
			get_template_part('template-parts/content', 'search');
		else:
			get_template_part('template-parts/content', get_post_format());
		endif;
	endwhile;
}