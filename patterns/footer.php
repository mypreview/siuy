<?php
/**
 * Title:         Footer
 * Categories:    footer
 * Slug:          siuy/footer
 * Inserter:      no
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"80px","right":"0px","bottom":"30px","left":"0px"}}},"backgroundColor":"secondary","textColor":"text-light","layout":{"inherit":false},"fontSize":"small"} -->
<div class="wp-block-group alignfull has-text-light-color has-secondary-background-color has-text-color has-background has-small-font-size" style="padding-top:80px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:group {"style":{"spacing":{"padding":{"right":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","left":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","bottom":"30px"}}},"layout":{"inherit":true}} -->
<div class="wp-block-group" style="padding-right:var(--wp--custom--spacing--side);padding-bottom:30px;padding-left:var(--wp--custom--spacing--side)"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"24%"} -->
<div class="wp-block-column" style="flex-basis:24%"><!-- wp:site-logo /-->

<!-- wp:site-title {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-alt"}}}},"textColor":"secondary-alt"} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"text","fontSize":"medium"} -->
<h3 class="has-text-color has-medium-font-size" id="title" style="font-style:normal;font-weight:700">
	<?php echo esc_html__( 'Categories', 'siuy' ); ?>
</h3>
<!-- /wp:heading -->

<!-- wp:categories {"showHierarchy":true,"showOnlyTopLevel":true,"className":"is-style-two-columns"} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"textColor":"text","fontSize":"medium"} -->
<h4 class="has-text-color has-medium-font-size" id="title" style="font-style:normal;font-weight:700">
	<?php echo esc_html__( 'Subscribe', 'siuy' ); ?>
</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>
	<?php echo esc_html__( 'Subscribe to our e-mail list to read all news first. We will not spam you, promise!', 'siuy' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:mypreview/flash-form {"action":"https:////one.us5.list-manage.com/subscribe/post?u=165a28efbd2bc087ff4f973d1\u0026id=97d3bfe2ef","formId":"ad5afb43-f5b4-4ebb-bf49-0cf3ef523c1c","honeypot":{"a11yMessage":"","a11yNoLabel":false,"autoCompleteOff":false,"enable":false,"moveInlineCSS":false,"placeholder":"","timeCheck":10},"isNewTab":true,"method":"get","to":"dev-email@flywheel.local","style":{"spacing":{"blockGap":"10px"}}} -->
<div class="wp-block-mypreview-flash-form"><form action="https:////one.us5.list-manage.com/subscribe/post" class="contact-form wp-block-mypreview-flash-form__fieldset" enctype="application/x-www-form-urlencoded" id="ad5afb43-f5b4-4ebb-bf49-0cf3ef523c1c" method="get" style="--gap:10px" target="_blank"><!-- wp:mypreview/flash-form-field-email {"formId":"ad5afb43-f5b4-4ebb-bf49-0cf3ef523c1c","id":"d8bdf506-2a02-4d32-9bd7-5cb2b29157dc","identifier":"email","isRequired":true,"label":"Email","noLabel":true,"placeholder":"Email","width":75} -->
<div class="wp-block-mypreview-flash-form-field-email form-field has-custom-width has-custom-width--75 form-field--email"><div class="wp-block-mypreview-flash-form-field-email__label visually-hidden"><label for="d8bdf506-2a02-4d32-9bd7-5cb2b29157dc"><?php echo esc_html__( 'Email', 'siuy' ); ?></label><abbr class="required" title="(required)">
<?php echo esc_html( '*' ); ?>
</abbr></div><div class="wp-block-mypreview-flash-form-field-email__input"><input class="" id="d8bdf506-2a02-4d32-9bd7-5cb2b29157dc" name="d8bdf506-2a02-4d32-9bd7-5cb2b29157dc" placeholder="Email" required type="email" autocomplete="email username"/></div></div>
<!-- /wp:mypreview/flash-form-field-email -->

<!-- wp:mypreview/flash-form-field-button {"defaultValue":"Send","formId":"ad5afb43-f5b4-4ebb-bf49-0cf3ef523c1c","id":"5e38bc90-f53b-4d40-a1f4-a0b4d47e15f8","identifier":"button","type":"submit","width":25,"lock":{"remove":true},"borderColor":"secondary-alt","backgroundColor":"secondary","textColor":"secondary-alt","style":{"border":{"style":"solid","width":"1px","radius":"0px"},"spacing":{"padding":{"top":"5px","right":"5px","bottom":"5px","left":"5px"}}}} -->
<div class="wp-block-mypreview-flash-form-field-button form-field has-custom-width has-custom-width--25 form-field--button"><div class="wp-block-mypreview-flash-form-field-button__input"><button class="button wp-block-button__link has-secondary-alt-border-color has-border-color has-secondary-alt-color has-secondary-background-color has-text-color has-background" form="ad5afb43-f5b4-4ebb-bf49-0cf3ef523c1c" id="5e38bc90-f53b-4d40-a1f4-a0b4d47e15f8" type="submit" style="border-radius:0px;border-style:solid;border-width:1px;padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px"><?php echo esc_html__( 'Send', 'siuy' ); ?></button></div></div>
<!-- /wp:mypreview/flash-form-field-button --><input name="u" type="hidden" value="165a28efbd2bc087ff4f973d1"/><input name="id" type="hidden" value="97d3bfe2ef"/></form></div>
<!-- /wp:mypreview/flash-form --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:separator {"align":"full","backgroundColor":"text-lighter","className":"is-style-wide"} -->
<hr class="wp-block-separator alignfull has-text-color has-text-lighter-color has-alpha-channel-opacity has-text-lighter-background-color has-background is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)","left":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dside)"}}},"layout":{"inherit":true}} -->
<div class="wp-block-group" style="padding-right:var(--wp--custom--spacing--side);padding-left:var(--wp--custom--spacing--side)"><!-- wp:group {"layout":{"type":"flex","allowOrientation":false,"justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:verse {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-alt"}}}},"textColor":"secondary-alt","fontSize":"small","fontFamily":"secondary"} -->
<pre class="wp-block-verse has-secondary-alt-color has-text-color has-link-color has-secondary-font-family has-small-font-size">
	<?php echo esc_html__( '© Siuy 2022. All Rights Reserved', 'siuy' ); ?>
</pre>
<!-- /wp:verse -->

<!-- wp:social-links {"iconColor":"zorba","iconColorValue":"#A89B8E","openInNewTab":true,"size":"has-small-icon-size","className":"has-icon-color is-style-logos-only","style":{"spacing":{"blockGap":"20px"}}} -->
<ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://www.facebook.com","service":"facebook"} /-->

<!-- wp:social-link {"url":"https://www.instagram.com","service":"instagram"} /-->

<!-- wp:social-link {"url":"https://twitter.com/","service":"twitter"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
