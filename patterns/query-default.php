<?php
/**
 * Title:          Default Posts
 * Categories:     query
 * Slug:           siuy/query-default
 * Inserter:       yes
 * Keywords:       query, posts
 * Block Types:    core/query
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     siuy/patterns
 */

?>
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:post-featured-image {"isLink":true,"align":"wide"} /-->

<!-- wp:post-title {"isLink":true,"style":{"spacing":{"margin":{"bottom":"10px"}}}} /-->

<!-- wp:post-excerpt {"moreText":"Read more"} /-->

<!-- wp:spacer {"height":"10px"} -->
<div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator {"opacity":"css","className":"is-style-wide"} -->
<hr class="wp-block-separator has-css-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->