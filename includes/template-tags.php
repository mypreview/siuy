<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Siuy
 */
if (!function_exists('siuy_posted_on')):
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function siuy_posted_on($posted_by = true, $posted_time = true)

	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')):
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		endif;
		$time_string = sprintf($time_string, esc_attr(get_the_date('c')) , esc_html(get_the_date()) , esc_attr(get_the_modified_date('c')) , esc_html(get_the_modified_date()));
		$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x('%s on', 'post date', 'siuy') , '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>');
		$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x('by %s', 'post author', 'siuy') , '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>');
		$output = '';
		if ($posted_by):
		$output.= '<span class="byline" itemprop="author" itemscope="itemscope" itemtype="https://schema.org/Person"> ' . $byline . '</span>'; // WPCS: XSS OK.
		endif;
		if ($posted_time):
		$output.= '<span class="posted-on" itemprop="datePublished">' . $posted_on . '</span>'; // WPCS: XSS OK.
		endif;
		echo $output; 
	}
endif;
if (!function_exists('siuy_entry_footer')):
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function siuy_entry_footer($posted_categories = true, $posted_tags = true, $posted_comments = true, $posted_readmore = true)

	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()):
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'siuy'));
			if ($categories_list && $posted_categories):
				/* translators: 1: list of categories. */
				printf('<span class="cat-links" itemprop="about">' . esc_html__('Posted in %1$s', 'siuy') . '</span>', $categories_list); // WPCS: XSS OK.
			endif;
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'siuy'));
			if ($tags_list && $posted_tags):
				/* translators: 1: list of tags. */
				printf('<span class="tags-links" itemprop="keywords">' . esc_html__('Tagged %1$s', 'siuy') . '</span>', $tags_list); // WPCS: XSS OK.
			endif;
		endif;
		if ($posted_comments && !is_single() && !post_password_required() && (comments_open() || get_comments_number())):
			echo '<span class="comments-link">';
			comments_popup_link(sprintf(wp_kses(
			/* translators: %s: post title */
			__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'siuy') , array(
				'span' => array(
					'class' => array() ,
				) ,
			)) , get_the_title()));
			echo '</span>';
		endif;
		edit_post_link(sprintf(wp_kses(
		/* translators: %s: Name of current post. Only visible to screen readers */
		__('Edit <span class="screen-reader-text">%s</span>', 'siuy') , array(
			'span' => array(
				'class' => array() ,
			) ,
		)) , get_the_title()) , '<span class="edit-link">', '</span>');
		if (!is_single() && $posted_readmore):
			echo '<span class="readmore"><a href="' . esc_url(get_the_permalink()) . '" target="_self">' . esc_html__('Read more', 'siuy') . '</a></span>';
		endif;
	}
endif;