<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Siuy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while (have_posts()) : the_post();

			if ('post' === get_post_type()):
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part('template-parts/content', get_post_format());
				
			else:
				/*
				 * Retrieves the post type of the current post or of a given post.
				 * called single-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part('template-parts/content', get_post_type());

			endif;

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();