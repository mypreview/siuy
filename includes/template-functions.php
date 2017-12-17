<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @author  	Mahdi Yazdani
 * @package 	Siuy
 * @since 	    1.1.0
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 * @since 1.1.0
 */
function siuy_body_classes($classes)

{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()):
		$classes[] = 'hfeed';
	endif;
	// Adds a class of sidebar layout to all pages.
	if (is_active_sidebar('sidebar')):
		$layout_sidebar = get_theme_mod('siuy_layout_sidebar', 'right-sidebar');
		if (!empty($layout_sidebar) && ! Siuy::is_fluid_template()):
			$classes[] = esc_attr($layout_sidebar);
		endif;
	else:
		$classes[] = 'no-sidebar';
	endif;
	return $classes;
}
add_filter('body_class', 'siuy_body_classes', 10, 1);
/**
 * Accesible offcanvas panel.
 *
 * @return 		void
 * @since 	    1.0.0
 */
function siuy_offcanvas()

{
	?>
	<div id="right" class="siuy-offcanvas c-offcanvas is-hidden" role="complementary">
		<div id="primary-slinky-menu" class="siuy-slinky-menu">
		</div>
		<div class="offcanvas-nav d-block d-md-none" data-set="bs"></div>
	</div><!-- .siuy-offcanvas -->
	<?php
}
add_action('siuy_before_page_content', 'siuy_offcanvas', 10);
/**
 * Sample implementation of the Custom Header feature.
 *
 * @return 		void
 * @since 	    1.0.0
 */
function siuy_header_image()

{
	if ((is_home() || is_front_page()) && (get_header_image())):
		$image = (!empty(get_header_image())) ? get_header_image() : '';
		?>
		<div class="site-header-image">
		<?php the_header_image_tag(); ?>
		</div>
	<?php
	endif;
}
add_action('siuy_before_site_content', 'siuy_header_image', 10);
/**
 * Change comment form textarea to use placeholder
 *
 * @param  		array $args
 * @return 		array
 * @since 	    1.0.0
 */
function siuy_comment_textarea_placeholder($args)

{
	$args['comment_field'] = str_replace('textarea', 'textarea placeholder="' . esc_attr__('Write a comment...', 'siuy') . '"', $args['comment_field']);
	return $args;
}
add_filter('comment_form_defaults', 'siuy_comment_textarea_placeholder', 10, 1);
/**
 * Comment form fields placeholder
 *
 * @param  		array $args
 * @return 		array
 * @since 	    1.0.0
 */
function siuy_comment_form_fields($fields)

{
	foreach($fields as & $field):
		$field = str_replace('id="author"', 'id="author" placeholder="' . esc_attr__('Name', 'siuy') . '"', $field);
		$field = str_replace('id="email"', 'id="email" placeholder="' . esc_attr__('E-mail', 'siuy') . '"', $field);
		$field = str_replace('id="url"', 'id="url" placeholder="' . esc_attr__('Website', 'siuy') . '"', $field);
	endforeach;
	return $fields;
}
add_filter('comment_form_default_fields', 'siuy_comment_form_fields', 10, 1);
/**
 * Move the comment text field to the bottom
 *
 * @param  		array $args
 * @return 		array
 * @since 	    1.0.0
 */
function siuy_move_comment_field_to_bottom($fields)

{
	$comment_field = $fields['comment'];
	unset($fields['comment']);
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter('comment_form_fields', 'siuy_move_comment_field_to_bottom', 10, 1);
/**
 * Displaying footer widget areas
 *
 * @return 		void
 * @since 	    1.0.0
 */
function siuy_footer_widget_areas()

{
	if (is_active_sidebar('footer-3')):
		$widget_columns = apply_filters('siuy_footer_widget_areas', 3);
	elseif (is_active_sidebar('footer-2')):
		$widget_columns = apply_filters('siuy_footer_widget_areas', 2);
	elseif (is_active_sidebar('footer-1')):
		$widget_columns = apply_filters('siuy_footer_widget_areas', 1);
	else:
		$widget_columns = apply_filters('siuy_footer_widget_areas', 0);
	endif;
	if ($widget_columns > 0):
	?>
	<div class="container widget-areas widget-col-<?php echo absint($widget_columns); ?>">
	<?php
	for ($counter = 0; $counter <= $widget_columns; $counter++):
		if (is_active_sidebar('footer-' . $counter)):
			echo '<div class="column">';
			dynamic_sidebar('footer-' . intval($counter));
			echo '</div>';
		endif;
	endfor;
	?>
	</div>
	<?php
	endif;
}	
add_action('siuy_footer', 'siuy_footer_widget_areas', 10);