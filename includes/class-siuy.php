<?php
/**
 * Theme setup and custom theme supports.
 *
 * @author  	Mahdi Yazdani
 * @package 	Siuy
 * @since 	    1.1.0
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Siuy')):
	/**
	 * The main Siuy setup class
	 */
	class Siuy

	{
		/**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
		public function __construct()

		{
			add_action('after_setup_theme', array(
				$this,
				'setup'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('widgets_init', array(
				$this,
				'widgets'
			) , 10);
			add_action('wp_head', array(
				$this,
				'javascript_detection'
			) , 0);
			add_action('wp_head', array(
				$this,
				'pingback_header'
			) , 10);
			add_filter('wp_resource_hints', array(
				$this,
				'resource_hints'
			) , 10, 2);
			add_filter('nav_menu_link_attributes', array(
				$this,
				'add_attribute'
			) , 10, 3);
			add_filter('excerpt_length', array(
				$this,
				'custom_excerpt_length'
			) , 10, 1);
			add_filter('excerpt_more', array(
				$this,
				'custom_excerpt_more'
			) , 10, 1);
		}
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.0
		 */
		public function setup()

		{
			/**
			 * Set the content width based on the theme's design and stylesheet.
			 */
			if (!isset($content_width)):
				// Pixels
				$content_width = apply_filters('siuy_content_width', 980);
			endif;
			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on siuy, use a find and replace
			* to change 'siuy' to the name of your theme in all the template files
			*/
			// Loads wp-content/languages/themes/siuy-it_IT.mo.
			load_theme_textdomain('siuy', trailingslashit(WP_LANG_DIR) . 'themes/');
			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain('siuy', get_stylesheet_directory() . '/languages');
			// Loads wp-content/themes/siuy/languages/it_IT.mo.
			load_theme_textdomain('siuy', get_template_directory() . '/languages');
			// Add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');
			/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
			add_theme_support('title-tag');
			/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			*/
			add_theme_support('post-thumbnails');
			add_image_size('siuy-featured-image-posts-widget', 284, 200, true);
			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(array(
				'primary-menu' => __('Primary', 'siuy')
			));
			/*
			* Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			* to output valid HTML5.
			*/
			add_theme_support('html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets'
			));
			/*
			* Enable support for Post Formats.
			*
			* See: https://codex.wordpress.org/Post_Formats
			*/
			add_theme_support('post-formats', array(
				'aside',
				'audio',
				'chat',
				'gallery',
				'image',
				'link',
				'quote',
				'status',
				'video'
			));
			/**
			 * Enable support for site logo
			 */
			add_theme_support('custom-logo', array(
				'width' => 150,
				'height' => 76,
				'flex-width' => true,
				'flex-height' => false
			));
			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support('site-logo', array(
				'size' => 'full'
			));
			// Setup the WordPress core custom header feature.
			add_theme_support('custom-header', apply_filters('siuy_custom_header_args', array(
				'default-image' => get_parent_theme_file_uri('assets/admin/img/header-image.jpg') ,
				'default-text-color' => 'FF5252',
				'width' => 1920,
				'height' => 774,
				'flex_width' => true
			)));
			register_default_headers(apply_filters('siuy_register_default_headers', array(
				'default-image' => array(
					'url' => '%s/assets/admin/img/header-image.jpg',
					'thumbnail_url' => '%s/assets/admin/img/header-image.jpg',
					'description' => __('Default Header Image', 'siuy') ,
				) ,
			)));
			// Setup the WordPress core custom background feature.
			add_theme_support('custom-background', apply_filters('siuy_custom_background_args', array(
				'default-color' => 'FFFFFF'
			)));
			// Declare support for selective refreshing of widgets.
			add_theme_support('customize-selective-refresh-widgets');
			/**
			 *  This theme styles the visual editor to resemble the theme style,
			 *  specifically font, colors, icons, and column width.
			 */
			add_editor_style(array(
				get_theme_file_uri('/assets/css/editor-style.css') ,
				$this->fonts_url()
			));
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.1.0
		 */
		public function enqueue()

		{
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
			// Add custom fonts, used in the main stylesheet.
			wp_enqueue_style('siuy-fonts', $this->fonts_url() , array() , null);
			// Theme stylesheet.
			wp_enqueue_style('siuy-styles', get_theme_file_uri('/assets/css/siuy' . $suffix . '.css') , array() , SIUY_THEME_VERSION);
			wp_add_inline_style('siuy-styles', Siuy_Customizer::inline_style());
			wp_enqueue_script('jquery');
			wp_enqueue_script('siuy-scripts', get_theme_file_uri('/assets/js/siuy' . $suffix . '.js') , array(
				'jquery'
			) , SIUY_THEME_VERSION, true);
			if (is_singular() && comments_open() && get_option('thread_comments')):
				wp_enqueue_script('comment-reply');
			endif;
		}
		/**
		 * Declaring widget(s) and widget area(s).
		 *
		 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 * @since 1.0.0
		 */
		public function widgets()

		{
			$sidebar_args['sidebar'] = array(
				'name' => __('Sidebar', 'siuy') ,
				'id' => 'sidebar',
				'description' => __('Widgets added to this region will appear in archive pages.', 'siuy')
			);
			$footer_widget_areas = apply_filters('siuy_footer_widget_areas', 3);
			if (is_int($footer_widget_areas)):
				for ($i = 1; $i <= intval($footer_widget_areas); $i++):
					$footer = sprintf('footer_%d', $i);
					$sidebar_args[$footer] = array(
						/* translators: %d: Decimal, i.e. 1. */
						'name' => sprintf(__('Footer %d', 'siuy') , $i) ,
						/* translators: %d: Decimal, i.e. 1. */
						'id' => sprintf('footer-%d', $i) ,
						/* translators: %d: Decimal, i.e. 1. */
						'description' => sprintf(__('Widgetized Footer Area %d.', 'siuy') , $i)
					);
				endfor;
			endif;
			/**
			 * Widget wrapper and title tags.
			 */
			foreach($sidebar_args as $sidebar => $args):
				$widget_tags = apply_filters('siuy_widget_markup_args', array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>'
				));
				/**
				 * Dynamically generated filter hooks.
				 *
				 * 'siuy_sidebar_widget_tags'
				 * 'siuy_footer_1_widget_tags'
				 * 'siuy_footer_2_widget_tags'
				 * 'siuy_footer_3_widget_tags'
				 *
				 */
				$filter_hook = sprintf('siuy_%s_widget_tags', $sidebar);
				$widget_tags = apply_filters($filter_hook, $widget_tags);
				if (is_array($widget_tags)):
					register_sidebar($args + $widget_tags);
				endif;
			endforeach;
		}
		/**
		 * Handles JavaScript detection.
		 * Adds a "js" class to the root "<html>" element when JavaScript is detected.
		 *
		 * @since 1.0.0
		 */
		public function javascript_detection()

		{
			echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
		}
		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles.
		 *
		 * @since 1.0.0
		 */
		public function pingback_header()

		{
			if (is_singular() && pings_open()):
				printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
			endif;
		}
		/**
		 * Register custom fonts.
		 *
		 * @since 1.0.0
		 */
		public function fonts_url()

		{
			$fonts_url = '';
			/**
			 * Translators: If there are characters in your language that are not
			 * supported by Cardo or Lato translate this to 'off'.
			 * Do not translate into your own language.
			 */
			$cardo_and_lato = _x('on', 'cardo_and_lato font: on or off', 'siuy');
			if ('off' !== $cardo_and_lato):
				$font_families = array();
				$font_families[] = 'Cardo:400,400i,700,700i';
				$font_families[] = 'Lato:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
				$font_families[] = 'Playfair Display:400,400i,700,700i,900,900i';
				$query_args = array(
					'family' => urlencode(implode('|', $font_families)) ,
					'subset' => urlencode('latin,latin-ext') ,
				);
				$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
			endif;
			return esc_url_raw($fonts_url);
		}
		/**
		 * Add preconnect for Google Fonts.
		 *
		 * @since 1.0.0
		 */
		public function resource_hints($urls, $relation_type)

		{
			if (wp_style_is('siuy-fonts', 'queue') && 'preconnect' === $relation_type):
				$urls[] = array(
					'href' => 'https://fonts.gstatic.com',
					'crossorigin',
				);
			endif;
			return $urls;
		}
		/**
		 * Add itemprop="url" markup to each link in the navigation menu
		 *
		 * @since 1.0.0
		 */
		public function add_attribute($atts, $item, $args)

		{
			$atts['itemprop'] = 'url';
			return $atts;
		}
		/**
		 * Control Excerpt Length Using Filters.
		 *
		 * @since 1.0.0
		 */
		public function custom_excerpt_length($length)

		{
			return apply_filters('siuy_excerpt_length', 40);
		}
		/**
		 * Adds the ... to the end of excerpt read more link.
		 *
		 * @since 1.0.0
		 */
		public function custom_excerpt_more($more)

		{
			return apply_filters('siuy_excerpt_more', '...');
		}
		/**
		 * Schema type.
		 *
		 * @since 1.0.0
		 */
		public static function html_tag_schema()

		{
			$schema = 'https://schema.org/';
			$type = 'WebPage';
			if (is_singular('post')):
				$type = 'Article';
			elseif (is_author()):
				$type = 'ProfilePage';
			elseif (is_search()):
				$type = 'SearchResultsPage';
			endif;
			echo 'itemscope="itemscope" itemtype="' . esc_attr($schema) . esc_attr($type) . '"';
		}
		/**
		 * Query fluid template usage.
		 *
		 * @since 1.1.0
		 */
		public static function is_fluid_template()

		{
			return is_page_template('page-templates/template-fluid.php') ? true : false;
		}
	}
endif;
return new Siuy();