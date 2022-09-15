<?php
/**
 * Block styles.
 *
 * @link          https://mypreview.github.io/siuy
 * @author        MyPreview (Github: @mahdiyazdani, @gooklani, @mypreview)
 * @since         2.0.0
 *
 * @package       siuy
 * @subpackage    siuy/includes
 * @phpcs:disable WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
 */

namespace Siuy\Includes\Block_Styles;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Register block styles
 *
 * @since     1.0.0
 * @return    void
 */
function styles(): void {
	$styles = apply_filters(
		'siuy_block_styles',
		array(
			array(
				'block' => 'core/paragraph',
				'name'  => 'subtitle',
				'label' => _x( 'Subtitle', 'block style', 'siuy' ),
			),
		)
	);

	foreach ( $styles as $properties ) {
		if ( ! \WP_Block_Styles_Registry::get_instance()->is_registered( $properties['block'], $properties['name'] ) ) {
			\register_block_style( $properties['block'], $properties );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\styles' );
