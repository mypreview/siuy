<?php
/**
 * Title:          About Me
 * Categories:     cover
 * Slug:           siuy/about
 * Inserter:       yes
 * Keywords:       about me, cover
 * Block Types:    core/cover
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     siuy/patterns
 */

?>
<!-- wp:cover {"url":"<?php echo esc_url( __( 'https://via.placeholder.com/900', 'siuy' ) ); ?>","minHeight":430,"minHeightUnit":"px","gradient":"transparent-black","contentPosition":"bottom left","style":{"spacing":{"padding":{"bottom":"0px","right":"20px","left":"20px","top":"20px"}}}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="padding-top:20px;padding-right:20px;padding-bottom:0px;padding-left:20px;min-height:430px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient has-transparent-black-gradient-background"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( __( 'https://via.placeholder.com/900', 'siuy' ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textColor":"light"} -->
<h2 class="has-light-color has-text-color"><?php echo wp_kses_post( __( 'About my<br><em>Blog</em>', 'siuy' ) ); ?></h2>
<!-- /wp:heading -->

<!-- wp:verse {"style":{"typography":{"textTransform":"uppercase"}},"textColor":"primary","fontSize":"small","fontFamily":"secondary"} -->
<pre class="wp-block-verse has-primary-color has-text-color has-secondary-font-family has-small-font-size" style="text-transform:uppercase"><?php esc_html_e( 'Read more', 'siuy' ); ?></pre>
<!-- /wp:verse --></div></div>
<!-- /wp:cover -->
