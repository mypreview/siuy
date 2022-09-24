<?php
/**
 * Title:         404 Error
 * Slug:          siuy/404
 * Inserter:      no
 */

?>
<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"inherit":false,"contentSize":"790px"}} -->
<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px"><!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"9rem"}},"textColor":"primary"} -->
<h1 class="has-text-align-center has-primary-color has-text-color" style="font-size:9rem">
	<?php echo esc_html__( '404', 'siuy' ); ?>
</h1>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center" id="page-not-found">
	<?php echo esc_html__( 'Page not found', 'siuy' ); ?>
</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>
<?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'siuy' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"Search","showLabel":false,"buttonText":"Search"} /-->

<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group -->