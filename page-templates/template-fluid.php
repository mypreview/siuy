<?php
/**
 * The template for displaying all pages/posts with fluid width.
 *
 * Template Name: 		Fluid Template
 * Template Post Type:	post, page
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Siuy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while (have_posts()) : the_post();

				if (is_singular('post')):
					get_template_part('template-parts/content', get_post_type());
					
					// Display Author Bio
					siuy_author_bio();

				else:
					get_template_part('template-parts/content', 'page');

				endif;

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;

				// Displays the navigation to next/previous post
				if ('post' === get_post_type()):
					the_post_navigation();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();