<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Siuy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()):
	return;
endif;
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()): ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if (1 === $comment_count):
				printf(
					/* translators: 1: title. */
					esc_html_e('One thought on &ldquo;%1$s&rdquo;', 'siuy'),
					'<span>' . get_the_title() . '</span>'
				);
			else:
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'siuy')),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			endif;
			?>
		</h2><!-- .comments-title -->

		<?php 
		// If there are comments to navigate through
		if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation" aria-label="<?php esc_html_e('Comment Navigation Above', 'siuy'); ?>">
			<span class="screen-reader-text"><?php esc_html_e('Comment navigation', 'siuy'); ?></span>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'siuy')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'siuy')); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size' => 102
			));
			?>
		</ol><!-- .comment-list -->

		<?php 
		// If there are comments to navigate through
		if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation" aria-label="<?php esc_html_e('Comment Navigation Above', 'siuy'); ?>">
			<span class="screen-reader-text"><?php esc_html_e('Comment navigation', 'siuy'); ?></span>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'siuy')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'siuy')); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation.

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (! comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'siuy'); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
