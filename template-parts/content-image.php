<?php
/**
 * Template part for displaying image posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @link 	https://developer.wordpress.org/reference/functions/get_media_embedded_in_content/
 * @package Siuy
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
	<header class="entry-header">
		<?php 
		// A list of found HTML images.
		$get_images = get_media_embedded_in_content(apply_filters('the_content', get_the_content()), array('img'));
		if ((has_post_thumbnail() || !empty($get_images)) && ! post_password_required() && ! is_attachment()): ?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" target="_self">
				<?php 
				if (has_post_thumbnail()):
					the_post_thumbnail('full', array('itemprop' => 'image')); 
				elseif (!has_post_thumbnail() && !empty($get_images)):
					echo $get_images[0];
				endif;
				?>
			</a>
		</div><!-- .entry-thumb -->
		<?php 
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

	<?php if (is_singular()): ?>

	<div class="entry-content" itemprop="mainContentOfPage">
		<?php
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
		?>
	</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-footer">
		<?php siuy_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
