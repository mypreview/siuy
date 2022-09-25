<?php
/**
 * Title:          Vanilla Hero
 * Categories:     cover
 * Slug:           siuy/hero-vanilla
 * Inserter:       yes
 * Keywords:       hero, recent posts
 * Block Types:    core/latest-posts
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     siuy/patterns
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"80px","right":"var(--wp--custom--spacing--side)","bottom":"80px","left":"var(--wp--custom--spacing--side)"},"margin":{"top":"0px","bottom":"0px"}}},"backgroundColor":"tile","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-tile-background-color has-background" style="margin-top:0px;margin-bottom:0px;padding-top:80px;padding-right:var(--wp--custom--spacing--side);padding-bottom:80px;padding-left:var(--wp--custom--spacing--side)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"228px","textTransform":"uppercase","letterSpacing":"60px","lineHeight":".8"},"spacing":{"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"textColor":"primary","className":"is-style-vertical-on-mobile"} -->
<h1 class="has-text-align-center is-style-vertical-on-mobile has-primary-color has-text-color" style="font-size:228px;line-height:.8;text-transform:uppercase;letter-spacing:60px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px"><?php esc_html_e( 'siuy', 'siuy' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:verse {"textAlign":"center","style":{"typography":{"fontSize":"24px","letterSpacing":"5px","textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"}},"textColor":"dark","fontFamily":"secondary"} -->
<pre class="wp-block-verse has-text-align-center has-dark-color has-text-color has-secondary-font-family" style="font-size:24px;font-style:normal;font-weight:700;text-transform:uppercase;letter-spacing:5px"><?php esc_html_e( 'EST 2017', 'siuy' ); ?></pre>
<!-- /wp:verse -->

<!-- wp:separator {"backgroundColor":"text-lighter","className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-text-lighter-color has-alpha-channel-opacity has-text-lighter-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostContent":true,"excerptLength":17,"displayPostDate":true,"postLayout":"grid","className":"is-style-separator-between"} /-->

<!-- wp:separator {"backgroundColor":"text-lighter","className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-text-lighter-color has-alpha-channel-opacity has-text-lighter-background-color has-background is-style-wide"/>
<!-- /wp:separator --></div>
<!-- /wp:group -->
