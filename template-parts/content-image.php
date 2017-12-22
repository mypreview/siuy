<?php
/**
 * The template for displaying posts in the `Image` post format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Siuy
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
	<header class="entry-header">
		<?php 
		siuy_post_thumbnail();

		$content = apply_filters('the_content', get_the_content());
		$image = get_media_embedded_in_content($content, array('img'));

		// If not a single post, highlight the image file.
		if (! is_single() && ! empty($image) && '' === get_the_post_thumbnail()):

			foreach ($image as $image_html):
				?>
				<div class="entry-thumb">
					<a class="thumb" href="<?php the_permalink(); ?>" aria-hidden="true">
						<?php echo $image_html; ?>
					</a>
				</div>
				<?php
			endforeach;

		endif;
		
		if (is_singular()):
			the_title('<h1 class="entry-title" itemprop="headline">', '</h1>');
		else:
			the_title('<h2 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;

		if ('post' === get_post_type()): ?>
		<div class="entry-meta">
			<?php siuy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="mainContentOfPage">
		<?php

		if (is_single() || empty($image)):

			the_content(sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'siuy'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			));

			wp_link_pages(array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'siuy'),
				'after'  => '</div>',
			));

		endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php siuy_entry_footer($posted_categories = true, $posted_tags = true, $posted_comments = true, $posted_readmore = false); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
