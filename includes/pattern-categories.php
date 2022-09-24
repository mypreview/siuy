<?php
/**
 * Block pattern categories.
 *
 * @link          https://mypreview.github.io/siuy
 * @author        MyPreview (Github: @mahdiyazdani, @gooklani, @mypreview)
 * @since         2.0.0
 *
 * @package       siuy
 * @subpackage    siuy/includes
 * @phpcs:disable WPThemeReview.PluginTerritory.ForbiddenFunctions.editor_blocks_register_block_style
 */

namespace Siuy\Includes\Block_Patterns;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Registers block pattern categories.
 *
 * @since     2.0.0
 * @return    void
 */
function categories(): void {
	$categories = apply_filters(
		'siuy_pattern_categories',
		array(
			'header' => array( 'label' => _x( 'Headers', 'pattern category', 'siuy' ) ),
			'footer' => array( 'label' => _x( 'Footers', 'pattern category', 'siuy' ) ),
		)
	);

	foreach ( $categories as $name => $properties ) {
		if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			\register_block_pattern_category( $name, $properties );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\categories', 9 );
