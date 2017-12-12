<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Siuy
 */
?>

	</div><!-- #content -->

	<?php do_action('siuy_after_site_content'); ?>

	<footer id="colophon" class="site-footer dark" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

		<?php do_action('siuy_footer'); ?>

		<div class="site-info">
			<div class="container">

				<?php do_action('siuy_before_site_info'); ?>

				<a href="<?php echo esc_url(__('https://wordpress.org/', 'siuy')); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf(esc_html__('Proudly powered by %s', 'siuy'), 'WordPress');
				?>	
				</a>

				<span class="sep"> | </span>

				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf(esc_html__('Theme: %1$s by %2$s.', 'siuy'), 'Siuy', '<a href="' . esc_url(SIUY_THEME_URI) . '" target="_blank">MyPreview LLC</a>');
				?>

				<?php do_action('siuy_after_site_info'); ?>
				
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>