<?php
/**
 * Title:          Footer
 * Categories:     footer
 * Slug:           siuy/footer
 * Inserter:       no
 * Keywords:       footer, links, copyright
 * Block Types:    core/template-part/footer
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     siuy/patterns
 */

?>
<!-- wp:group {"className":"alignfull", "align":"full","style":{"spacing":{"padding":{"top":"80px","right":"0px","bottom":"30px","left":"0px"}}},"backgroundColor":"secondary","textColor":"text-light","layout":{"inherit":false},"fontSize":"small"} -->
<div class="wp-block-group alignfull has-text-light-color has-secondary-background-color has-text-color has-background has-small-font-size" style="padding-top:80px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:group {"style":{"spacing":{"padding":{"right":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","left":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","bottom":"30px"}}},"layout":{"inherit":true}} -->
<div class="wp-block-group" style="padding-right:var(--wp--custom--spacing--side);padding-bottom:30px;padding-left:var(--wp--custom--spacing--side)"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"24%"} -->
<div class="wp-block-column" style="flex-basis:24%"><!-- wp:site-logo /-->

<!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-alt"}}}},"textColor":"secondary-alt"} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"text","fontSize":"medium"} -->
<h3 class="has-text-color has-medium-font-size" id="title" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Categories', 'siuy' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:categories {"showHierarchy":true,"showOnlyTopLevel":true,"className":"is-style-two-columns"} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"text","fontSize":"medium"} -->
<h4 class="has-text-color has-medium-font-size" id="title" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Subscribe', 'siuy' ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Subscribe to our e-mail list to read all news first. We will not spam you, promise!', 'siuy' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:mypreview/flash-form {"honeypot":{"a11yMessage":"","a11yNoLabel":false,"autoCompleteOff":false,"enable":false,"moveInlineCSS":false,"placeholder":"","timeCheck":10},"method":"get"} -->
<div class="wp-block-mypreview-flash-form"><form action="#" class="contact-form wp-block-mypreview-flash-form__fieldset" enctype="application/x-www-form-urlencoded" method="get"></form></div>
<!-- /wp:mypreview/flash-form -->
</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:separator {"align":"full","backgroundColor":"text-lighter","className":"is-style-wide"} -->
<hr class="wp-block-separator alignfull has-text-color has-text-lighter-color has-alpha-channel-opacity has-text-lighter-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","left":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)"}}},"layout":{"inherit":true}} -->
<div class="wp-block-group" style="padding-right:var(--wp--custom--spacing--side);padding-left:var(--wp--custom--spacing--side)"><!-- wp:group {"layout":{"type":"flex","allowOrientation":false,"justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:verse {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-alt"}}}},"textColor":"secondary-alt","fontSize":"small","fontFamily":"secondary"} -->
<pre class="wp-block-verse has-secondary-alt-color has-text-color has-link-color has-secondary-font-family has-small-font-size"><?php esc_html_e( '© Siuy 2022. All Rights Reserved', 'siuy' ); ?></pre>
<!-- /wp:verse -->

<!-- wp:social-links {"iconColor":"zorba","iconColorValue":"#A89B8E","openInNewTab":true,"size":"has-small-icon-size","className":"has-icon-color is-style-logos-only","style":{"spacing":{"blockGap":"20px"}}} -->
<ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://www.facebook.com","service":"facebook"} /-->

<!-- wp:social-link {"url":"https://www.instagram.com","service":"instagram"} /-->

<!-- wp:social-link {"url":"https://twitter.com/","service":"twitter"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
