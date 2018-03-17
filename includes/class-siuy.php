<?php
/**
 * Conj Class
 *
 * @author  	Mahdi Yazdani
 * @package 	mypreview-conj
 * @since 	    1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MyPreview_Conj' ) ) :

	/**
	 * The main Conj class
	 */
	class MyPreview_Conj {

		/**
		 * Setup class.
		 *
		 * @return  void
		 */
		public function __construct() {

			add_action( 'after_setup_theme',        array( $this, 'setup' ),                           10 );
			add_action( 'wp_head',          		array( $this, 'javascript_detection' ),             0 );
			add_action( 'wp_head',          		array( $this, 'pingback_header' ),                 10 );
			add_action( 'widgets_init',             array( $this, 'widgets_init' ),                     5 );
			add_action( 'current_screen',           array( $this, 'hide_mm_sidebar' ),                 10 );
			add_filter( 'sidebars_widgets',         array( $this, 'filter_mm_widgets' ),            10, 1 );
			add_action( 'wp_resource_hints',        array( $this, 'resource_hints' ),               10, 2 );
			add_action( 'wp_enqueue_scripts',       array( $this, 'enqueue' ),                     	   10 );
			add_action( 'wp_enqueue_scripts',       array( $this, 'child_scripts' ),       			   30 );
			add_filter( 'body_class',               array( $this, 'body_classes' ), 				10, 1 );
			add_filter( 'excerpt_more',             array( $this, 'custom_excerpt_more' ), 			10, 1 );
			add_filter( 'widget_tag_cloud_args',    array( $this, 'widget_tag_cloud_args' ), 		10, 1 );
			add_action( 'edit_category',            array( $this, 'category_transient_flusher' ), 	   10 );
			add_action( 'save_post',                array( $this, 'category_transient_flusher' ), 	   10 );
			add_filter( 'comment_form_fields',      array( $this, 'move_comment_field_to_bottom' ), 10, 1 );
			add_action( 'wp',      					array( $this, 'add_custom_header' ), 			   99 );
			add_action( 'get_header',   			array( $this, 'hc_restructuring_filter' ), 		   10 );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'mm_nav_menu_start_el' ), 		10, 4 );
			add_filter( 'wp_nav_menu_objects', 		array( $this, 'mm_nav_menu_objects' ), 			10, 2 );
			add_filter( 'nav_menu_css_class', 		array( $this, 'mm_nav_menu_css_class' ), 		10, 4 );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_social_icons' ), 		10, 4 );
			add_filter( 'wp_list_categories', 		array( $this, 'cat_count_span' ), 				10, 1 );
			add_filter( 'get_archives_link', 		array( $this, 'archive_count_span' ), 			10, 1 );

		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @return  void
		 */
		public function setup() {

			/*
			 * Load Localisation files.
			 *
			 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
			 */
			
			// Loads wp-content/languages/themes/conj-it_IT.mo.
			load_theme_textdomain( 'conj', trailingslashit( WP_LANG_DIR ) . 'themes/' );

			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain( 'conj', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/conj/languages/it_IT.mo.
			load_theme_textdomain( 'conj', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );

			/**
			 * Enable support for site logo.
			 *
			 * @see 	https://developer.wordpress.org/themes/functionality/custom-logo/
			 */
			add_theme_support( 'custom-logo', array(
				'height'      => 140,
				'width'       => 400,
				'flex-width'  => TRUE
			) );

			/**
			 * Set up the WordPress core custom header feature.
			 *
			 * @see 	https://developer.wordpress.org/themes/functionality/custom-headers
			 */
			add_theme_support( 'custom-header', apply_filters( 'mypreview_conj_custom_header_args', array(
				'default-text-color' => '6B6F81',
				'width'              => 1950,
				'height'             => 500,
				'flex-height'        => TRUE,
				'wp-head-callback'   => array( $this, 'header_styles' )
			) ) );

			/**
			 * Set up the WordPress core custom background feature.
			 *
			 * @see 	https://codex.wordpress.org/Custom_Backgrounds
			 */
			add_theme_support( 'custom-background', apply_filters( 'mypreview_conj_custom_background_args', array(
				'default-color' => 'F4F5FA',
				'default-image' => '',
			) ) );

			/**
			 * This theme uses wp_nav_menu() in four location.
			 *
			 * @see 	https://developer.wordpress.org/reference/functions/wp_nav_menu/
			 */
			register_nav_menus( array(
				'primary'   => __( 'Primary Menu', 'conj' ),
				'social'   	=> __( 'Social Menu', 'conj' ),
				'secondary' => __( 'Secondary Menu', 'conj' ),
				'handheld'	=> sprintf( esc_html__( 'Push Menu %1$s(Handheld)%2$s', 'conj' ), '<em><small>', '</small></em>' )
			) );

			/**
			* Enable support for post formats.
			*
			* @see 		https://codex.wordpress.org/Post_Formats
			*/
			add_theme_support( 'post-formats', array(
				'aside',
				'audio',
				'chat',
				'gallery',
				'image',
				'link',
				'quote',
				'status',
				'video'
			) );

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets'
			) );

			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/*
			 * This theme styles the visual editor to resemble the theme style,
			 * specifically font, colors, and column width.
		 	 */
			add_editor_style( array( 'assets/css/editor-style.css', self::google_fonts_url() ) );

		}

		/**
		 * Get site description.
		 *
		 * @return string
		 */
		public function header_styles() {

			$header_text_color = get_header_textcolor();

			// If no custom options for text are set, let's bail.
			// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
			if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
				return;
			}

			// If we get this far, we have custom styles. Let's do this.
			?>
			<style type="text/css">
			<?php
				// Has the text been hidden?
				if ( 'blank' === $header_text_color ) : ?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
				// If the user has set a custom color for the text use that.
				else : ?>
				.site-title,
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif; ?>
			</style>
			<?php

		}

		/**
		 * Handles JavaScript detection.
		 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
		 *
		 * @return  void
		 */
		public function javascript_detection() {

			echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

		}

		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles.
		 *
		 * @return  void
		 */
		public function pingback_header() {

			if ( is_singular() && pings_open() ) {
				printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
			}

		}

		/**
		 * Register widget area.
		 *
		 * @see 	https://codex.wordpress.org/Function_Reference/register_sidebar
		 * @return  void
		 */
		public function widgets_init() {

			$sidebar_args['mega-menu'] = array(
				'name'          => __( 'Mega Menu', 'conj' ),
				'id'            => 'mega-menu-sidebar',
				'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'conj' )
			);

			$sidebar_args['sidebar'] = array(
				'name'          => __( 'Sidebar', 'conj' ),
				'id'            => 'sidebar-1',
				'description'   => __( 'Widgets added to this region will appear in archive/shop pages.', 'conj' )
			);

			$sidebar_args['footer_bar'] = array(
				'name'          => __( 'Footer Bar', 'conj' ),
				'id'            => 'footer-bar-1',
				'description'   => __( 'A full-width widgetized area which will display any widget added to this region above the footer widget area.', 'conj' )
			);

			$rows    = intval( apply_filters( 'mypreview_conj_footer_widget_rows', 2 ) );
			$regions = intval( apply_filters( 'mypreview_conj_footer_widget_columns', 4 ) );

			for ( $row = 1; $row <= $rows; $row++ ) {
				for ( $region = 1; $region <= $regions; $region++ ) {
					$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
					$footer   = sprintf( 'footer_%d', $footer_n );

					if ( 1 === $rows ) {
						/* translators: 1: Decimal number. */
						$footer_region_name = sprintf( __( 'Footer Column %1$d', 'conj' ), $region );
						/* translators: 1: Decimal number. */
						$footer_region_description = sprintf( __( 'Widgets added here will appear in column %1$d of the footer.', 'conj' ), $region );
					} else {
						/* translators: 1: Decimal number, 2: Decimal number. */
						$footer_region_name = sprintf( __( 'Footer Row %1$d - Column %2$d', 'conj' ), $row, $region );
						/* translators: 1: Decimal number. */
						$footer_region_description = sprintf( __( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'conj' ), $region, $row );
					} // End If Statement

					$sidebar_args[ $footer ] = array(
						'name'        => $footer_region_name,
						/* translators: 1: Decimal number. */
						'id'          => sprintf( 'footer-%d', $footer_n ),
						'description' => $footer_region_description,
					);
				}
			}

			$sidebar_args = apply_filters( 'mypreview_conj_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {

				if ( 'mega-menu-sidebar' === $args['id'] ) {
					$wrapper_tag = 'li';
					$title_tag = 'h2';
				} else {
					$wrapper_tag = 'div';
					$title_tag = 'span';
				}// End If Statement

				$widget_tags = array(
					'before_widget' => '<' . esc_html( $wrapper_tag ) . ' id="%1$s" class="widget %2$s">',
					'after_widget'  => '</' . esc_html( $wrapper_tag ) . '>',
					'before_title'  => '<' . esc_html( $title_tag ) . ' class="widget-title">',
					'after_title'   => '</' . esc_html( $title_tag ) . '>',
				);
				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 *
				 * 'mypreview_conj_sidebar_widget_tags'
				 * 'mypreview_conj_footer_bar_widget_tags'
				 *
				 * 'mypreview_conj_footer_1_widget_tags'
				 * 'mypreview_conj_footer_2_widget_tags'
				 * 'mypreview_conj_footer_3_widget_tags'
				 * 'mypreview_conj_footer_4_widget_tags'
				 */
				$filter_hook = sprintf( 'mypreview_conj_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );
				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}

		}

		/**
		 * Hide our sidebar from the widgets admin page.
		 *
		 * @return void.
		 */
		public function hide_mm_sidebar() {
			
			global $wp_registered_sidebars;
			$currentScreen = get_current_screen();

			if ( 'widgets' === $currentScreen->id ) {
				if ( array_key_exists( 'mega-menu-sidebar', $wp_registered_sidebars ) ) {
					unset( $wp_registered_sidebars['mega-menu-sidebar'] );
				}
			} // End If Statement

		}

		/**
		 * Make sure mega menu widgets don't show up in the inactive sidebar.
		 *
		 * @param  array  $widgets 		Array of sidebars and their widgets.
		 * @return void.
		 */
		public function filter_mm_widgets( $widgets ) {
			
			global $pagenow;

			if ( isset( $pagenow ) && 'widgets.php' === $pagenow ) {

				if ( array_key_exists( 'mega-menu-sidebar', $widgets ) ) {

					unset( $widgets['mega-menu-sidebar'] );

				} // End If Statement

			} // End If Statement

			return $widgets;

		}

		/**
		 * Add preconnect for Google Fonts.
		 *
		 * @param  array  $urls            URLs to print for resource hints.
		 * @param  array  $relation_type   The relation type the URLs are printed.
		 * @return array  $urls            URLs to print for resource hints.
		 */
		public function resource_hints( $urls, $relation_type ) {

			if ( wp_style_is( 'mypreview-conj-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
				$urls[] = array(
					'href' => 'https://fonts.gstatic.com',
					'crossorigin'
				);
			} // End If Statement

			return $urls;

		}

		/**
		 * Register custom Google web fonts.
		 *
		 * @return string|url
		 */
		public static function google_fonts_url() {

			$fonts_url = '';
			/*
			 * Translators: If there are characters in your language that are not
			 * supported by Montserrat, translate this to 'off'. Do not translate
			 * into your own language.
			 */
			$montserrat = _x( 'on', 'montserrat font: on or off', 'conj' );

			if ( 'off' !== $montserrat ) {
				$font_families = array();
				$font_families[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin,latin-ext' )
				);
				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			} // End If Statement

			return esc_url_raw( $fonts_url );

		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @see 	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
		 * @see 	https://developer.wordpress.org/reference/functions/wp_enqueue_style/
		 * @see 	https://developer.wordpress.org/reference/functions/wp_enqueue_script/
		 * @return 	void
		 */
		public function enqueue() {

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_style( 'mypreview-conj-google-font', self::google_fonts_url(), array(), null );
			wp_enqueue_style( 'feather', get_theme_file_uri( '/assets/css/vendor/feather' . $suffix . '.css' ), array(), MYPREVIEW_CONJ_THEME_VERSION );
			wp_enqueue_style( 'mypreview-conj-styles', get_stylesheet_uri(), '', MYPREVIEW_CONJ_THEME_VERSION );
			wp_add_inline_style( 'mypreview-conj-styles', MyPreview_Conj_Customizer_Settings::css() );

			// Get the URL to cart page if WooCommerce exists.
			$mypreview_conj_wc_cart_url = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$mypreview_conj_wc_cart_url = wc_get_cart_url();
			}

			$mypreview_conj_l10n = array(
				'mypreview_conj_layout_widget_state'	 	=> 	esc_html( get_theme_mod( 'mypreview_conj_layout_widget_visibility_state', 'open-state' ) ),
				'mypreview_conj_wc_product_lbl'	 			=> 	esc_html__( 'Product', 'conj' ),
				'mypreview_conj_wc_added_content'	 	 	=> 	esc_html__( 'successfuly added to cart!', 'conj' ),
				'mypreview_conj_wc_removed_content'	 	 	=> 	esc_html__( 'has been removed from your cart.', 'conj' ),
				'mypreview_conj_wc_info_lbl'				=> 	esc_html__( 'Cart', 'conj' ),
				'mypreview_conj_wc_updated_lbl'				=> 	esc_html__( 'has been updated!', 'conj' ),
				'mypreview_conj_wc_error_lbl'				=> 	esc_html__( 'Sorry,', 'conj' ),
				'mypreview_conj_wc_checkout_error_content'	=> 	esc_html__( 'your order can\'t be completed.', 'conj' ),
				'mypreview_conj_wc_checkout_two_steps_str1'	=> 	esc_html__( 'Back to shipping details', 'conj' ),
				'mypreview_conj_wc_checkout_two_steps_str2'	=> 	esc_html__( 'Proceed to payment', 'conj' ),
				'mypreview_conj_wc_cart_url'				=> 	esc_url( $mypreview_conj_wc_cart_url )
			);
			
			wp_register_script( 'mypreview-conj-scripts', get_theme_file_uri( '/assets/js/conj' . $suffix . '.js' ), array( 'jquery' ), MYPREVIEW_CONJ_THEME_VERSION, TRUE );
			wp_localize_script( 'mypreview-conj-scripts', 'conj_vars', $mypreview_conj_l10n );
			wp_enqueue_script( 'mypreview-conj-scripts' );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

				wp_enqueue_script( 'comment-reply' );

			} // End If Statement

		}
		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @return void
		 */
		public function child_scripts() {

			if ( is_child_theme() ) {

				$child_theme = wp_get_theme( get_stylesheet() );
				wp_enqueue_style( 'mypreview-conj-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );

			} // End If Statement

		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param  array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {

			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			} // End If Statement
			
			// Add class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			} // End If Statement

			// Add class if we're viewing the Customizer for easier styling of theme options.
			if ( is_customize_preview() ) {
				$classes[] = 'mypreview-conj-customizer';
			} // End If Statement

			// Add a class if there is a custom header.
			if ( has_header_image() ) {
				$classes[] = 'has-header-image';
			} // End If Statement

			// Add class if sidebar is used.
			if ( is_active_sidebar( 'sidebar-1' ) && ! is_404() ) {
				$classes[] = 'has-sidebar';
			} // End If Statement

			// Add class if the site title and tagline is hidden.
			if ( 'blank' === get_header_textcolor() ) {
				$classes[] = 'title-tagline-hidden';
			} // End If Statement

			$header_customizer = get_theme_mod( 'mypreview_conj_layout_header_customizer' );
			// Custom body class added when the custom header is active.
			if ( $header_customizer && ! empty( $header_customizer ) ) {
				$classes[]	= 'conj-header-active';
				// If there is NO logo placed in the header area.
				if ( ! array_key_exists( 'logo', $header_customizer ) ) {
					$classes[]	= 'conj-header-active-no__logo';
				}
				// If there is NO primary navigation placed in the header area.
				if ( ! array_key_exists( 'primary_navigation', $header_customizer ) ) {
					$classes[]	= 'conj-header-active-no__primary-nav';
				}
			} // End If Statement


			// Add class if WooCommerce breadcrumbs removed.
			if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
				$classes[]	= 'no-wc-breadcrumb';
			} // End If Statement

			// Add class if the current page is the homepage template.
			if ( mypreview_conj_is_homepage_template() ) {
				$classes[]	= 'conj-homepage-template';
			} // End If Statement
			
			return $classes;

		}

		/**
		 * Adds the `...` to the end of excerpt read more link.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/excerpt_more/
		 * @param 	string $excerpt Excerpt more string.
		 * @return 	string
		 */
		public function custom_excerpt_more( $more ) {

			return apply_filters( 'mypreview_conj_excerpt_more', '...' );

		}

		/**
		 * Modifies tag cloud widget arguments to display all tags in the same font size
		 * and use list format for better accessibility.
		 *
		 * @param 	array $args Arguments for tag cloud widget.
		 * @return 	array The filtered arguments for tag cloud widget.
		 */
		public function widget_tag_cloud_args( $args ) {

			$args['largest']  = 1;
			$args['smallest'] = 1;
			$args['unit']     = 'em';
			$args['format']   = 'list';

			return $args;
			
		}

		/**
		 * Flush out the transients used in mypreview_conj_categorized_blog.
		 *
		 * @see 	https://codex.wordpress.org/Function_Reference/delete_transient
		 * @return 	void
		 */
		public function category_transient_flusher() {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			} // End If Statement

			delete_transient( 'mypreview_conj_categories' );

		}

		/**
		 * Move the comment text field to the bottom.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/comment_form_fields/
		 * @return 	void
		 */
		public function move_comment_field_to_bottom( $fields ) {

			$comment_field = $fields['comment'];
        	unset( $fields['comment'] );
        	$fields['comment'] = $comment_field;
        	return $fields;

		}

		/**
		 * Initialize custom header.
		 *
		 * @return 	void
		 */
		public function add_custom_header() {

			$setting = get_theme_mod( 'mypreview_conj_layout_header_customizer' );

			if ( ! $setting || empty( $setting ) ) {
				return;
			} // End If Statement

			remove_all_actions( 'mypreview_conj_header' );
			add_action( 'mypreview_conj_header', array( $this, 'custom_header' ) );

		}

		/**
		 * Initialize custom header.
		 *
		 * @return 	void
		 */
		public function custom_header() {

			$html      = '';
			$rows_html = '';
			$rows      = $this->header_get_rows( get_theme_mod( 'mypreview_conj_layout_header_customizer' ) );

			foreach ( $rows as $row ) {

				if ( empty( $row ) ) {
					continue;
				}

				$row_html     = '';
				$count        = 0;
				$columns      = 0;
				$max_columns  = 12;
				$widget_count = count( $row );
				$widgets      = $this->header_sort_wigets_by_position( $row );

				foreach ( $widgets as $key => $widget ) {
					$widget_content = $this->header_do_function( $key );

					if ( $widget_content ) {
						$count++;
					} else {
						$widget_count--;
						continue;
					}

					// Used to calculate empty columns between widgets.
					$empty = 0;

					// Init array for widget row classes.
					$classes = array();

					// Calculate empty space between columns.
					if ( $columns < intval( $widget['x'] ) ) {
						$empty = intval( $widget['x'] ) - $columns;
					}

					// Add pre class and add empty columns to $columns var.
					if ( 0 < $empty ) {
						$classes[] = 'conj-header-pre-' . $empty;
						$columns   = $columns + $empty;
					}

					$columns = $columns + intval( $widget['w'] );
					$classes[] = 'conj-header-span-' . intval( $widget['w'] );

					if ( $widget_count === $count ) {
						if ( $max_columns === $columns ) {
							$classes[] = 'conj-header-last';
						} else {
							$classes[] = 'conj-header-post-' . ( $max_columns - $columns );
						}

						$count = 0;
					}

					$row_html .= sprintf( '<div class="%1$s">%2$s</div>', esc_attr( implode( ' ', $classes ) ), $widget_content );
				}

				if ( '' !== $row_html ) {
					$rows_html .= sprintf( '<div class="conj-header-row">%1$s</div>', $row_html );
				}
			}

			if ( '' !== $rows_html ) {
				$html = $rows_html;
			}

			echo $html;

		}

		/**
		 * Sort widgets by row.
		 * 
		 * @return  array
		 */
		private function header_get_rows( $widgets ) {

			$widget_rows = array();

			foreach ( $widgets as $key => $widget ) {
				$widget_rows[ $widget['y'] ][ $key ] = $widget;
			}

			ksort( $widget_rows );

			return $widget_rows;

		}

		/**
		 * Sort widgets by their position on the grid.
		 * 
		 * @return  array
		 */
		private function header_sort_wigets_by_position( $widgets = array() ) {

			$ordered_widgets = array();

			foreach ( $widgets as $key => $widget ) {
				$ordered_widgets[ $key ] = $widget['x'];
			}

			array_multisort( $ordered_widgets, SORT_ASC, $widgets );

			return $widgets;

		}

		/**
		 * Render component content.
		 * 
		 * @param   string $component The name of the component to render
		 * @return  array
		 */
		private function header_do_function( $component = array() ) {

			$components = MyPreview_Conj_Customizer::header_components();
			$component_function = '';

			if ( $component && array_key_exists( $component, $components ) ) {

				$component_function = $components[ $component ]['hook'];

			} // End If Statement

			if ( '' !== $component_function && function_exists( $component_function ) ) {

				// Render the function.
				ob_start();
				call_user_func( $component_function );
				$content = ob_get_clean();

				return $content;

			} // End If Statement

			return FALSE;

		}

		/**
		 * Work through the stored data and display the components in the desired order
		 * Without the disabled components
		 *
		 * @uses 	https://developer.wordpress.org/reference/functions/is_admin/
		 * @return  void
		 */
		public function hc_restructuring_filter() {

			// Bail out, if the current request IS for an ADMINISTRATIVE interface page.
			if ( is_admin() ) {
				return;
			}

			$options = get_theme_mod( 'mypreview_conj_homepage_control' );
			$components = array();

			if ( isset( $options ) && '' != $options ) {

				$components = explode( ',', $options );

				// Remove all existing actions on "mypreview_conj_homepage" hook
				remove_all_actions( 'mypreview_conj_homepage' );

				// Remove disabled components
				$components = $this->hc_remove_disabled_items( $components );

				// Perform the reordering!
				if ( 0 < count( $components ) ) {
					$count = 5;
					foreach ( $components as $key => $value ) {
						if ( FALSE !== strpos( $value, '@' ) ) {
							$obj_v = explode( '@' , $value );
							if ( class_exists( $obj_v[0] ) && method_exists( $obj_v[0], $obj_v[1] ) ) {
								add_action( 'mypreview_conj_homepage', 		array( $obj_v[0], $obj_v[1] ), 	$count );
							} // End If Statement
						} else {
							if ( function_exists( $value ) ) {
								add_action( 'mypreview_conj_homepage', 		esc_attr( $value ), 			$count );
							}
						} // End If Statement
						$count + 5;
					}
				} // End If Statement
			} // End If Statement
		}

		/**
		 * Maybe remove disabled items from the main ordered array
		 *
		 * @param   array 	$components 	Array with components order.
		 * @return  array  	Re-ordered components with disabled components removed.
		 */
		private function hc_remove_disabled_items( $components ) {

			if ( 0 < count( $components ) ) {
				foreach ( $components as $key => $value ) {
					if ( FALSE !== strpos( $value, '[disabled]' ) ) {
						unset( $components[ $key ] );
					}
				}
			} // End If Statement

			return $components;
		}

		/**
		 * Add a mega menu to a specific menu item.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/
		 * @return 	string
		 */
		public function mm_nav_menu_start_el( $item_output, $item, $depth = 0, $args = array() ) {

			if ( $this->mm_is( $item->ID ) && 0 === $depth && 'primary' === $args->theme_location ) {
				$html = $this->mm_create( $item->ID );
				if ( '' !== $html ) {
					$item_output .= $html;
				}
			}

			return $item_output;

		}

		/**
		 * Create mega menu HTML structure.
		 *
		 * @return 	html
		 */
		public function mm_create( $id ) {

			$html		= '';
			$rows_html	= '';
			$mega_menu	= $this->mm_get( $id );
			$rows		= $this->mm_get_rows( $mega_menu['widgets'] );

			foreach ( $rows as $row ) {
				if ( empty( $row ) ) {
					continue;
				}

				$row_html		= '';
				$count			= 0;
				$columns		= 0;
				$max_columns	= 12;
				$widget_count	= count( $row );
				$widgets		= $this->mm_sort_wigets_by_position( $row );

				foreach ( $widgets as $widget ) {
					$widget_content = $this->mm_do_widget( $widget['id'] );

					if ( $widget_content ) {
						$count++;
					} else {
						$widget_count--;
						continue;
					} // End If Statement

					// Used to calculate empty columns between widgets.
					$empty = 0;

					// Init array for widget row classes.
					$classes = array();

					// Calculate empty space between columns.
					if ( $columns < intval( $widget['x'] ) ) {
						$empty = intval( $widget['x'] ) - $columns;
					} // End If Statement

					// Add pre class and add empty columns to $columns var.
					if ( 0 < $empty ) {
						$classes[] = 'conjmm-pre-' . $empty;
						$columns = $columns + $empty;
					} // End If Statement

					$columns = $columns + intval( $widget['w'] );

					$classes[] = 'conjmm-span-' . intval( $widget['w'] );

					if ( $widget_count === $count ) {
						if ( $max_columns === $columns ) {
							$classes[] = 'conjmm-last';
						} else {
							$classes[] = 'conjmm-post-' . ( $max_columns - $columns );
						}

						$count = 0;
					} // End If Statement

					$classes = apply_filters( 'mypreview_conj_mega_menu_widget_classes', $classes );

					$row_html .= sprintf( '<div class="%1$s">%2$s</div>', esc_attr( implode( ' ', $classes ) ), $widget_content );

				}

				if ( '' !== $row_html ) {
					$rows_html .= sprintf( '<div class="%1$s">%2$s</div>', esc_attr( apply_filters( 'mypreview_conj_mega_menu_row_classes', 'conjmm-row' ) ), $row_html );
				} // End If Statement
			}

			if ( '' !== $rows_html ) {
				$html .= sprintf( '<ul class="sub-menu"><li><div class="%1$s">%2$s</div></li></ul>', esc_attr( apply_filters( 'mypreview_conj_mega_menu_classes', 'conjmm-mega-menu' ) ), $rows_html );
			} // End If Statement

			return $html;

		}

		/**
		 * Remove sub menu items that may be under a mega menu.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/wp_nav_menu_objects/
		 * @return 	array
		 */
		public function mm_nav_menu_objects( $sorted_menu_items, $args ) {

			$parents = array();
			$to_remove = array();

			// Get all parents that are mega menus.
			foreach ( $sorted_menu_items as $item ) {
				if ( 0 === intval( $item->menu_item_parent ) && $this->mm_is( $item->ID ) ) {
					$parents[] = $item;
				} // End If Statement
			}

			// Get all items that are sub items of a parent.
			foreach ( $parents as $parent ) {
				$to_remove = array_merge( $to_remove, $this->mm_look_for_subitems( $parent->ID, $sorted_menu_items ) );
			}

			// Now remove these items from the main array.
			foreach ( $sorted_menu_items as $key => $item ) {
				if ( in_array( $item->ID, $to_remove ) ) {
					unset( $sorted_menu_items[ $key ] );
				} // End If Statement
			}

			$sorted_menu_items = array_values( $sorted_menu_items );

			return $sorted_menu_items;

		}

		/**
		 * Add a `menu-item-has-children` class to mega menu item, if it doens't have it yet.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/nav_menu_css_class/
		 * @return 	array
		 */
		public function mm_nav_menu_css_class( $classes, $item, $args = array(), $depth = 0 ) {

			if ( 0 === $depth && $this->mm_is( $item->ID ) ) {
				$classes[] = 'conjmm-active';

				if ( ! in_array( 'menu-item-has-children', $classes ) ) {
					$classes[] = 'menu-item-has-children';
				}
			} // End If Statement

			return array_filter( $classes );

		}

		/**
		 * Get a widget by widget id.
		 * Inspired by `Widget Shortcode` plugin - `do_widget( $args )`
		 *
		 * @link 	https://wordpress.org/plugins/widget-shortcode/
		 * @return 	array
		 */
		private function mm_do_widget( $widget_id ) {

			global $_wp_sidebars_widgets, $wp_registered_widgets, $wp_registered_sidebars;

			$args = apply_filters( 'mypreview_conj_mega_menu_do_widget_args', array(
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
			) );

			if ( empty( $widget_id ) || ! isset( $wp_registered_widgets[ $widget_id ] ) ) {
				return;
			} // End If Statement

			// Get the widget instance options.
			$widget_number = preg_replace( '/[^0-9]/', '', $widget_id );
			$options       = get_option( $wp_registered_widgets[ $widget_id ]['callback'][0]->option_name );
			$instance      = $options[ $widget_number ];
			$class         = get_class( $wp_registered_widgets[ $widget_id ]['callback'][0] );
			$widgets_map   = $this->mm_widget_shortcode_get_widgets_map();

			// Maybe the widget is removed or deregistered.
			if ( ! isset( $widgets_map[ $widget_id ] ) ) {
				return;
			} // End If Statement

			$_original_widget_position = $widgets_map[ $widget_id ];

			// Maybe the widget is removed or deregistered.
			if ( ! $class ) {
				return;
			} // End If Statement

			if ( ! isset( $wp_registered_sidebars[ $_original_widget_position ] ) ) {
				return;
			} // End If Statement

			$params = array(
				'name'          => $wp_registered_sidebars[ $_original_widget_position ]['name'],
				'id'            => $wp_registered_sidebars[ $_original_widget_position ]['id'],
				'description'   => $wp_registered_sidebars[ $_original_widget_position ]['description'],
				'before_widget' => $args['before_widget'],
				'before_title'  => $args['before_title'],
				'after_title'   => $args['after_title'],
				'after_widget'  => $args['after_widget'],
				'widget_id'     => $widget_id,
				'widget_name'   => $wp_registered_widgets[ $widget_id ]['name'],
			);

			// Substitute HTML id and class attributes into before_widget.
			$class_name = '';

			foreach ( (array) $wp_registered_widgets[ $widget_id ]['classname'] as $cn ) {
				if ( is_string( $cn ) ) {
					$class_name .= '_' . $cn;
				} elseif ( is_object( $cn ) ) {
					$class_name .= '_' . get_class( $cn );
				} // End If Statement
			}

			$class_name = ltrim( $class_name, '_' );

			$params['before_widget'] = sprintf( $params['before_widget'], $widget_id, $class_name );

			// Render the widget.
			ob_start();
			the_widget( $class, $instance, $params );
			$content = ob_get_clean();

			return $content;

		}

		/**
		 * Returns an array of all widgets as the key, their position as the value.
		 *
		 * @see 	https://developer.wordpress.org/reference/functions/wp_get_sidebars_widgets/
		 * @return 	array
		 */
		private function mm_widget_shortcode_get_widgets_map() {

			$sidebars_widgets = wp_get_sidebars_widgets();
			$widgets_map = array();
			if ( ! empty( $sidebars_widgets ) ) {
				foreach ( $sidebars_widgets as $position => $widgets ) {
					if ( ! empty( $widgets ) && 'array_version' !== $position ) {
						foreach ( $widgets as $widget ) {
							$widgets_map[ $widget ] = $position;
						}
					} // End If Statement
				}
			} // End If Statement

			return $widgets_map;

		}

		/**
		 * Given a menu item id, return the relevant option.
		 *
		 * @return 	array
		 */
		private function mm_get( $item_id ) {

			if ( ! $item_id ) {
				return FALSE;
			} // End If Statement

			$savedData = get_option( 'CONJMM_DATA' );

			if ( $savedData && array_key_exists( intval( $item_id ), $savedData ) ) {
				return $savedData[ intval( $item_id ) ];
			} // End If Statement

			return FALSE;

		}

		/**
		 * Sort widgets by row.
		 *
		 * @return 	array
		 */
		private function mm_get_rows( $mega_menu ) {

			$widget_rows = array();

			foreach ( $mega_menu as $widget ) {
				$widget_rows[ $widget['y'] ][] = $widget;
			}

			ksort( $widget_rows );

			return $widget_rows;

		}

		/**
		 * Sort widgets by their position on the grid.
		 *
		 * @return 	array
		 */
		private function mm_sort_wigets_by_position( $widgets = array() ) {

			$ordered_widgets = array();

			foreach ( $widgets as $key => $widget ) {
				$ordered_widgets[ $key ] = $widget['x'];
			}

			array_multisort( $ordered_widgets, SORT_ASC, $widgets );

			return $widgets;

		}

		/**
		 * Given a menu item id, tell if it is a mega menu. 
		 * Also returns FALSE for mega menus that are not active.
		 *
		 * @return 	boolean
		 */
		private function mm_is( $item_id ) {

			if ( ! $item_id ) {
				return FALSE;
			}

			$savedData = get_option( 'CONJMM_DATA' );

			if ( $savedData && array_key_exists( intval( $item_id ), $savedData ) ) {
				$mega_menu = $savedData[ intval( $item_id ) ];

				if ( FALSE === $mega_menu['active'] ) {
					return FALSE;
				} // End If Statement

				if ( empty( $mega_menu['widgets'] ) ) {
					return FALSE;
				} // End If Statement

				$widgets = $mega_menu['widgets'];

				if ( empty( $widgets ) ) {
					return FALSE;
				} // End If Statement

				return TRUE;
			}

			return FALSE;

		}

		/**
		 * Look for all the sub items of a parent item.
		 *
		 * @return 	array
		 */
		private function mm_look_for_subitems( $parent, $items ) {

			$remove = array();

			foreach ( $items as $item ) {
				if ( $parent === intval( $item->menu_item_parent ) ) {
					$remove[] = $item->ID;
					$remove = array_merge( $remove, $this->mm_look_for_subitems( $item->ID, $items ) );
				} // End If Statement
			}

			return $remove;

		}

		/**
		 * Display font icons in social links menu.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/walker_nav_menu_start_el/
		 * @return 	array
		 */
		public function nav_menu_social_icons( $item_output, $item, $depth, $args ) {

			$social_icons = mypreview_conj_get_social_icons();
			$title_display = FALSE;

			if ( 'social' === $args->theme_location ) {

				if ( 'dropdown' === $args->menu_class ) {
					$title_display = TRUE;
				} // End If Statement

				foreach( (array) $social_icons as $attr => $value ) {

					if ( FALSE !== strpos( $item_output, $attr ) ) {

						$item_output = str_replace( $args->link_after, '</span>' . self::get_icons_markup( array(
							'icon' 			=> 	esc_attr( $value ) ,
							'title' 		=> 	esc_attr( $item->title ) ,
							'title_display' => 	$title_display
						) ) , $item_output );

					} // End If Statement

				}
			}

			return $item_output;

		}

		/**
		 * Adds a span around post counts in category widget.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/wp_list_categories/
		 * @return 	html
		 */
		public function cat_count_span( $links ) {

			$links 	= 	str_replace( '</a> (', '<span class="count">(', $links );
			$links 	= 	str_replace( ')', ')</span></a>', $links );

			return $links;

		}

		/**
		 * Adds a span around post counts in archive widget.
		 *
		 * @see 	https://developer.wordpress.org/reference/hooks/get_archives_link/
		 * @return 	html
		 */
		public function archive_count_span( $links ) {

			$links = str_replace( '</a>&nbsp;(', '<span class="count">(', $links );
			$links = str_replace( ')', ')</span></a>', $links );

			return $links;

		}

		/**
		 * Return font icon HTML markup.
		 *
		 * @return 	html
		 */
		public static function get_icons_markup( $args = array() ) {

			// Make sure $args are an array.
			if ( empty( $args ) ) {
				return esc_html__( 'Please define default parameters in the form of an array.', 'conj' );
			}

			// Set defaults.
			$defaults = array(
				'icon' 			=> 		'',
				'title' 		=> 		'',
				'title_display' => 		FALSE,
				// Hide from screen readers.
				'aria_hidden' 	=> 		TRUE, 
				'fallback' 		=> 		FALSE,
			);
			// Parse args.
			$args = wp_parse_args( $args, $defaults );
			// Set aria hidden.
			$aria_hidden = '';
			if ( TRUE === $args['aria_hidden'] ) {
				$aria_hidden = ' aria-hidden="true"';
			} // End If Statement
			// Begin font icon HTML markup.
			$icon = sprintf( '<span class="si-%1$s" %2$s', esc_attr( $args['icon'] ), $aria_hidden );
			// If there is a title, display it.
			if ( $args['title'] && ! $args['title_display'] ) {
				$icon.= sprintf( ' title="%1$s"', esc_attr( $args['title'] ) );
			} // End If Statement
			$icon.= sprintf( '><i class="feather-%1$s"></i>', esc_attr( $args['icon'] ) );
			// If there is a link title, display it.
			if ( $args['title_display'] ) {
				$icon.= sprintf( esc_attr( $args['title'] ) );
			} // End If Statement
			$icon.= sprintf( '</span>' );

			return $icon;

		}
		
	}

endif;
// End Class.

return new MyPreview_Conj();
