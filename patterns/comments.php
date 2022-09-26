<?php
/**
 * Title:          Comments
 * Categories:     comments
 * Slug:           siuy/comments
 * Inserter:       yes
 * Keywords:       comments loop, comment form
 * Block Types:    core/comments
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     core/post-comments-form, core/comments-query-loop
 */

?>
<!-- wp:comments-query-loop -->
<div class="wp-block-comments-query-loop"><!-- wp:comments-title /-->

<!-- wp:post-comments-form /-->

<!-- wp:comment-template -->
<!-- wp:columns {"isStackedOnMobile":false} -->
<div class="wp-block-columns is-not-stacked-on-mobile"><!-- wp:column {"width":"80px"} -->
<div class="wp-block-column" style="flex-basis:80px"><!-- wp:avatar {"size":80,"linkTarget":"_blank","style":{"border":{"radius":"80px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"blockGap":"10px"}}} -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px"><!-- wp:comment-author-name /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:comment-date {"fontSize":"small"} /-->

<!-- wp:comment-edit-link {"fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:comment-content /-->

<!-- wp:comment-reply-link {"textAlign":"right","fontSize":"small"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:comment-template -->

<!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:comments-pagination-previous /-->

<!-- wp:comments-pagination-numbers /-->

<!-- wp:comments-pagination-next /-->
<!-- /wp:comments-pagination --></div>
<!-- /wp:comments-query-loop -->
