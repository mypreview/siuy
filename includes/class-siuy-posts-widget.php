<?php
/**
 * (Blog) Posts widget.
 *
 * @author      Mahdi Yazdani
 * @package     Siuy
 * @since       1.1.0
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Siuy_Posts_Widget')):
    /**
     * The posts widget class
     */
    class Siuy_Posts_Widget extends WP_Widget
    {
        /**
         * Setup class.
         *
         * @since 1.0.0
         */
        public function __construct()

        {
            parent::__construct('siuy-posts-widget', __('Posts', 'siuy') . ' (' . trim(ucwords(SIUY_THEME_NAME)) . ')', array(
                'customize_selective_refresh' => true,
                'classname' => 'siuy-posts-widget',
                'description' => __('A simple widget that displays blog posts with a few additional adjustments.', 'siuy')
            ));
        }
        /**
         * Outputs the content of the widget.
         *
         * @since 1.1.0
         */
        public function widget($args, $instance)

        {
        	// Extracting the arguments + getting the values
            if (!isset($args['widget_id'])):
                $args['widget_id'] = $this->id;
            endif;
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('siuy_posts_widget_title', $instance['title']);
            $numberposts = empty($instance['numberposts']) ? 5 : (int) $instance['numberposts'];
            $post_orderby = empty($instance['post_orderby']) ? 'none' : $instance['post_orderby'];
            $post_thumbnail = empty($instance['post_thumbnail']) ? false : (bool) $instance['post_thumbnail'];
            $post_title = empty($instance['post_title']) ? true : (bool) $instance['post_title'];
            $post_date = empty($instance['post_date']) ? false : (bool) $instance['post_date'];
            $post_excerpt = empty($instance['post_excerpt']) ? false : (bool) $instance['post_excerpt'];
            $post_excerpt_limit = empty($instance['post_excerpt_limit']) ? 18 : (int) $instance['post_excerpt_limit'];
            $post_readmore_btn = empty($instance['post_readmore_btn']) ? false : (bool) $instance['post_readmore_btn'];

            // Before widget code, if any
            echo $args['before_widget'];
            // The title and the text output
            if ($title):
            	echo $args['before_title'] . esc_html($title) . $args['after_title'];
            endif;

            global $post;
			$posts_args = apply_filters('siuy_posts_widget_args', array(
				'numberposts' => absint($numberposts),
				'orderby' => esc_attr($post_orderby),
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true
			));
			$posts = get_posts($posts_args);
			if (is_array($posts) && !empty($posts)):
				foreach($posts as $post):
					setup_postdata($post);
					?>
					<article id="post-widget-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php 
							if (has_post_thumbnail() && $post_thumbnail):
                            ?>
                            <div class="entry-thumb">
                                <a href="<?php the_permalink(); ?>" target="_self">
                                    <?php the_post_thumbnail('siuy-posts-widget-featured-image', array('itemprop' => 'image')); ?>
                                </a>
                            </div><!-- .entry-thumb -->
                            <?php
							endif;
							if ($post_title):
								the_title('<h4 class="entry-title" itemprop="headline"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>'); 
							endif;
							if ($post_date):
							?>
							<div class="entry-meta">
								<?php siuy_posted_on($posted_by = false); ?>
							</div><!-- .entry-meta -->
							<?php endif; ?>
						</header><!-- .entry-header -->
						<div class="entry-content" itemprop="text">
							<?php 
							if ($post_excerpt):
                                if (has_excerpt(get_the_ID())):
                                    the_excerpt();
                                else:
                                    echo '<p>' . wp_trim_words(get_the_content(), $post_excerpt_limit) . '</p>';
                                endif;
							endif;
							if ($post_readmore_btn):
							?>
							<a href="<?php the_permalink(); ?>" class="readmore" target="_self"><?php esc_html_e('Read more', 'siuy'); ?></a>
							<?php endif; ?>
						</div><!-- .entry-content -->
					</article>
					<?php
				endforeach;
			endif;
			// After widget code, if any
            echo $args['after_widget'];
        }
        /**
         * Generates the administration form for the widget.
         * 
         * @since 1.0.0
         */
        public function form($instance)

        {
        	$defaults = array(
        		'title' => '',
        		'numberposts' => 5,
        		'post_orderby' => 'none',
        		'post_thumbnail' => false,
        		'post_title' => true,
        		'post_date' => false,
        		'post_excerpt' => false,
        		'post_excerpt_limit' => 18,
        		'post_readmore_btn' => false
        	);
        	// Extract the data from the instance variable
            $args = wp_parse_args($instance, $defaults);
            $title = empty($args['title']) ? '' : apply_filters('siuy_posts_widget_title', $args['title']);
            $numberposts = empty($args['numberposts']) ? 5 : (int) $args['numberposts'];
            $post_orderby = empty($args['post_orderby']) ? 'none' : $args['post_orderby'];
            $post_thumbnail = empty($args['post_thumbnail']) ? false : (bool) $args['post_thumbnail'];
            $post_title = empty($args['post_title']) ? true : (bool) $args['post_title'];
            $post_date = empty($args['post_date']) ? false : (bool) $args['post_date'];
            $post_excerpt = empty($args['post_excerpt']) ? false : (bool) $args['post_excerpt'];
            $post_excerpt_limit = empty($args['post_excerpt_limit']) ? 18 : (int) $args['post_excerpt_limit'];
            $post_readmore_btn = empty($args['post_readmore_btn']) ? false : (bool) $args['post_readmore_btn'];

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'siuy'); ?>:</label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo $title; ?>" class="widefat" />
            </p>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('post_orderby')); ?>">
                <option value="none" <?php echo esc_attr(selected('post_orderby', 'none')); ?>><?php esc_html_e('None', 'siuy'); ?></option>
                <option value="id" <?php echo esc_attr(selected('post_orderby', 'id')); ?>><?php esc_html_e('ID', 'siuy'); ?></option>
                <option value="author" <?php echo esc_attr(selected('post_orderby', 'author')); ?>><?php esc_html_e('Author', 'siuy'); ?></option>
                <option value="title" <?php echo esc_attr(selected('post_orderby', 'title')); ?>><?php esc_html_e('Title', 'siuy'); ?></option>
                <option value="date" <?php echo esc_attr(selected('post_orderby', 'date')); ?>><?php esc_html_e('Date', 'siuy'); ?></option>
                <option value="modified" <?php echo esc_attr(selected('post_orderby', 'modified')); ?>><?php esc_html_e('Modified', 'siuy'); ?></option>
                <option value="rand" <?php echo esc_attr(selected('post_orderby', 'rand')); ?>><?php esc_html_e('Rand', 'siuy'); ?></option>
                <option value="comment_count" <?php echo esc_attr(selected('post_orderby', 'comment_count')); ?>><?php esc_html_e('Comment Count', 'siuy'); ?></option>
            </select>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('post_thumbnail')); ?>" name="<?php echo esc_attr($this->get_field_name('post_thumbnail')); ?>" <?php checked($post_thumbnail); ?> class="checkbox" />
                <label for="<?php echo esc_attr($this->get_field_id('post_thumbnail')); ?>"><?php esc_html_e('Display post featured image?', 'siuy'); ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('post_title')); ?>" name="<?php echo esc_attr($this->get_field_name('post_title')); ?>" <?php checked($post_title); ?> class="checkbox" />
                <label for="<?php echo esc_attr($this->get_field_id('post_title')); ?>"><?php esc_html_e('Show post title?', 'siuy'); ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('post_date')); ?>" name="<?php echo esc_attr($this->get_field_name('post_date')); ?>" <?php checked($post_date); ?> class="checkbox" />
                <label for="<?php echo esc_attr($this->get_field_id('post_date')); ?>"><?php esc_html_e('Show post date?', 'siuy'); ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('post_readmore_btn')); ?>" name="<?php echo esc_attr($this->get_field_name('post_readmore_btn')); ?>" <?php checked($post_readmore_btn); ?> class="checkbox" />
                <label for="<?php echo esc_attr($this->get_field_id('post_readmore_btn')); ?>"><?php esc_html_e('Show post read more link?', 'siuy'); ?></label>
            </p>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($this->get_field_id('post_excerpt')); ?>" name="<?php echo esc_attr($this->get_field_name('post_excerpt')); ?>" <?php checked($post_excerpt); ?> class="checkbox" />
                <label for="<?php echo esc_attr($this->get_field_id('post_excerpt')); ?>"><?php esc_html_e('Show post excerpt?', 'siuy'); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_excerpt_limit')); ?>"><?php esc_html_e('Excerpt length (words):', 'siuy'); ?></label>
                <input type="number" id="<?php echo esc_attr($this->get_field_id('post_excerpt_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('post_excerpt_limit')); ?>" value="<?php echo $post_excerpt_limit; ?>" class="tiny-text" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('numberposts')); ?>"><?php esc_html_e('Number of posts to show:', 'siuy'); ?></label>
                <input type="number" id="<?php echo esc_attr($this->get_field_id('numberposts')); ?>" name="<?php echo esc_attr($this->get_field_name('numberposts')); ?>" value="<?php echo $numberposts; ?>" class="tiny-text" />
            </p>
            <?php
        }
        /**
         * Processes the widget's options to be saved.
         *
         * @since 1.1.0
         */
        public function update($new_instance, $old_instance)
        
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['numberposts'] = absint($new_instance['numberposts']);
            $instance['post_orderby'] = sanitize_text_field($new_instance['post_orderby']);
            $instance['post_thumbnail'] = (bool) $new_instance['post_thumbnail'];
            $instance['post_title'] = (bool) $new_instance['post_title'];
            $instance['post_date'] = (bool) $new_instance['post_date'];
            $instance['post_excerpt'] = (bool) $new_instance['post_excerpt'];
            $instance['post_excerpt_limit'] = absint($new_instance['post_excerpt_limit']);
            $instance['post_readmore_btn'] = (bool) $new_instance['post_readmore_btn'];
            return $instance;
        }
    }
endif;
/**
 * Register the Widget.
 * Hooked into "widgets_init".
 *
 * @since 1.0.0
 */
if (!function_exists('siuy_posts_widget_init')):
    function siuy_posts_widget_init()
    {
        register_widget('Siuy_Posts_Widget');
    }
endif;
add_action('widgets_init', 'siuy_posts_widget_init', 10);        