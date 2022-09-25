<?php
/**
 * Title:          Recent Posts Grid Tile
 * Categories:     recent-posts
 * Slug:           siuy/recent-posts-grid-tile
 * Inserter:       yes
 * Keywords:       recent posts, latest posts
 * Block Types:    core/latest-posts
 * 
 * @since          2.0.0
 * @package        siuy
 * @subpackage     siuy/patterns
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var(--wp--custom--spacing--side)","left":"var(--wp--custom--spacing--side)","top":"70px","bottom":"50px"}}},"backgroundColor":"tile","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-tile-background-color has-background" style="padding-top:70px;padding-right:var(--wp--custom--spacing--side);padding-bottom:50px;padding-left:var(--wp--custom--spacing--side)"><!-- wp:latest-posts {"postsToShow":4,"displayPostContent":true,"excerptLength":18,"displayPostDate":true,"postLayout":"grid","columns":4,"displayFeaturedImage":true,"featuredImageSizeSlug":"large","addLinkToFeaturedImage":true} /--></div>
<!-- /wp:group -->
