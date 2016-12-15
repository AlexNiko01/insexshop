<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

include_once( ABSPATH . 'wp-admin/includes/media.php' );

class AMPHTML_Template {

	const TEMPLATE_DIR = 'templates';
	const TEMPLATE_PART_DIR = 'templates/parts';
	const TEMPLATE_CART_DIR = 'templates/add-to-cart';
	const STYLE_DIR = 'css';
	const SITE_ICON_SIZE = 32;
	const SCHEMA_IMG_MIN_WIDTH = 696;

	public $properties;
	protected $sanitizer;
	protected $embedded_elements;

	protected $template = 'base';
	public $template_content = '';
	protected $fonts;
	protected $blocks;

	/**
	 * @var AMPHTML_Options
	 */
	protected $options;

	public function __construct( $options ) {

		if ( true === AMPHTML()->is_amp() ) {
			remove_shortcode( 'gallery' );
			add_shortcode( 'gallery', array( $this, 'gallery_shortcode' ) );

		}
		$this->sanitizer        = new AMPHTML_Sanitize( $this );
		$this->properties       = array();
		$this->options          = $options;
		$this->doc_title        = function_exists( 'wp_get_document_title' ) ? wp_get_document_title() : wp_title( '', false );
		$this->base_url         = home_url() . '/';
		$this->blog_name        = $this->options->get( 'logo_text' );
		$this->logo             = $this->options->get( 'logo' );
		$this->default_logo     = $this->options->get( 'default_logo' );

		add_action( AMPHTML::TEXT_DOMAIN . '_template_head', array( $this, 'page_fonts' ) );
		add_action( AMPHTML::TEXT_DOMAIN . '_template_css', array( $this, 'get_custom_css' ) );
		add_filter( 'get_pagenum_link', array( $this, 'update_pagination_link' ) );


		/*
		 * Yoast SEO integration issues
		 */
		if ( AMPHTML::instance()->is_yoast_seo() && is_home() ) {
			add_filter( 'wpseo_canonical', array( $this, 'fix_canonical_url' ) );
			add_filter( 'wpseo_opengraph_title', array( $this, 'fix_og_title' ) );
		}

		/*
		 * Add extra css
		 */
		add_action( 'amphtml_template_css', array( $this, 'set_extra_css' ), 100 );

		$this->embedded_elements = array(
			array( 'slug' => 'amp-accordion', 'src' => 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js' ),
			array( 'slug' => 'amp-form', 'src' => 'https://cdn.ampproject.org/v0/amp-form-0.1.js' ),
			array( 'slug' => 'amp-ad', 'src' => 'https://cdn.ampproject.org/v0/amp-ad-0.1.js' )
		);
		$this->google_analytics = $this->get_google_analitycs();
	}

	protected function get_google_analitycs() {
		if ( $this->options->get( 'google_analytic' ) ) {
			$this->add_embedded_element(
				array( 'slug' => 'amp-analytics', 'src' => 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js' )
			);
			$analytics = array(
				'vars'     => array(
					'account' => $this->options->get( 'google_analytic' )
				),
				'triggers' => array(
					'trackPageview' => array(
						'on'      => 'visible',
						'request' => 'pageview',
					),
				),
			);

			return $analytics;
		}
	}


	public function set_default_embedded_elements() {
		$default_elemets = array(
			array( 'slug' => 'amp-carousel', 'src' => 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js' ),
			array( 'slug' => 'amp-iframe', 'src' => 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js' ),
			array( 'slug' => 'amp-youtube', 'src' => 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js' ),
			array( 'slug' => 'amp-audio', 'src' => 'https://cdn.ampproject.org/v0/amp-audio-0.1.js' ),
			array( 'slug' => 'amp-vimeo', 'src' => 'https://cdn.ampproject.org/v0/amp-vimeo-0.1.js' )
		);

		$this->embedded_elements = array_merge( $this->embedded_elements, $default_elemets );

		return $this;
	}

	public function get_embedded_elements() {
		return $this->embedded_elements;
	}

	public function add_embedded_element( $new_element ) {
		$slugs = array();
		foreach ( $this->embedded_elements as $element ) {
			$slugs[] = $element['slug'];
		}

		if ( ! in_array( $new_element['slug'], $slugs ) ) {
			$this->embedded_elements[] = $new_element;
		}

		return $this;
	}

	/*public function page_fonts() {
		$used_fonts = array();
		foreach ( $this->options->get_tabs()->get( 'appearance' )->get_font_fields( 'fonts' ) as $font ) {
			$font_name = $this->options->get( $font['id'] );
			if ( ! in_array( $font_name, $used_fonts ) ) {
				$additional_styles = apply_filters( 'amphtml_font_styles', ':400,700,400italic,500,500italic' );
				echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' . $font_name . $additional_styles . '">' . PHP_EOL;
			}
			$used_fonts[]               = $font_name;
			$this->fonts[ $font['id'] ] = str_replace( '+', ' ', $font_name );
		}
	}*/

	public function get_element_fonts() {

		return ".logo { Font-Family: {$this->fonts['logo_font']}, serif }"
		       . ".main-navigation, .hamburger { Font-Family: {$this->fonts['menu_font']}, serif }"
		       . ".amphtml-title { Font-Family: {$this->fonts['title_font']}, serif }"
		       . ".amphtml-meta-author { Font-Family: {$this->fonts['post_meta_font']}, serif }"
		       . ".amphtml-content { Font-Family: {$this->fonts['content_font']}, serif }"
		       . ".footer { Font-Family: {$this->fonts['footer_font']}, serif }";

	}

	public function get_element_colors() {
		$add_to_cart_button = $this->options->get( 'add_to_cart_button_color' );

		return 'nav.amphtml-title,'
		       . 'section[expanded] span.expanded,'
		       . 'section[expanded] span.collapsed,'
		       . 'section:not([expanded]) span.collapsed,'
		       . 'section .accordion-header'
		       . "{ background: {$this->options->get( 'header_color' )}; }"
		       . ".footer { background: {$this->options->get( 'footer_color' )}; }"
		       . "a, #pagination .next a, #pagination .prev a { color: {$this->options->get( 'link_color' )}; }"
		       . "body { background: {$this->options->get( 'background_color' )} }"
		       . "body, .amphtml-content, .amphtml-sku, .amphtml-stock-status,"
		       . " .price, .amphtml-posted-in, .amphtml-tagged-as, .amphtml-meta { color: {$this->options->get( 'main_text_color' )} }"
		       . "h1.amphtml-title { color: {$this->options->get( 'main_title_color' )} }"
		       . "nav.amphtml-title a, nav.amphtml-title div, div.main-navigation a { color: {$this->options->get( 'header_text_color' )} }"
		       . ".amphtml-add-to a { background-color: {$add_to_cart_button}; border-color: {$add_to_cart_button} }"
		       . ".amphtml-add-to a:hover, .amphtml-add-to a:active { background-color: {$add_to_cart_button}; border-color: {$add_to_cart_button}; }"
		       . "div.footer, div.footer a { color: {$this->options->get( 'footer_text_color' )} }";
	}


	public function get_custom_css() {

		$content_width      = absint( $this->options->get( 'content_width' ) );
		$main_content_width = $content_width + 32;

		echo PHP_EOL
		     . ".amphtml-title div, .footer .inner { max-width: {$content_width}px; margin: 0 auto;}"
		     . "#main .inner { max-width: {$main_content_width}px; } "
		     . $this->get_element_fonts()
		     . $this->get_element_colors();
	}

	public function __get( $key ) {
		if ( isset( $this->properties[ $key ] ) ) {
			return $this->properties[ $key ];
		}

		return '';
	}

	public function __set( $key, $value ) {
		$this->properties[ $key ] = $value;
	}

	public function the_template_content() {
		echo $this->render( $this->template_content );
	}

	public function render( $filename = '' ) {
		if ( ! $filename ) {
			$filename = $this->template;
		}

		$template_path = $this->get_template_path( $filename );

		if ( file_exists( $template_path ) ) {
			ob_start();
			include( $template_path );

			return ob_get_clean();
		}
	}

	protected function get_template_path( $filename ) {

		//theme templates
		$path[] = locate_template( array(
			AMPHTML()->get_plugin_folder_name() . DIRECTORY_SEPARATOR . $filename
			. '.php'
		), false );
		$path[] = locate_template( array(
			AMPHTML()->get_plugin_folder_name() . DIRECTORY_SEPARATOR . 'parts'
			. DIRECTORY_SEPARATOR . $filename . '.php'
		), false );
		$path[] = locate_template( array(
			AMPHTML()->get_plugin_folder_name() . DIRECTORY_SEPARATOR . 'add-to-cart'
			. DIRECTORY_SEPARATOR . $filename . '.php'
		), false );
		//plugin templates
		$path[] = $this->get_dir_path( self::TEMPLATE_DIR ) . DIRECTORY_SEPARATOR . $filename . '.php';
		$path[] = $this->get_dir_path( self::TEMPLATE_PART_DIR ) . DIRECTORY_SEPARATOR . $filename . '.php';
		$path[] = $this->get_dir_path( self::TEMPLATE_CART_DIR ) . DIRECTORY_SEPARATOR . $filename . '.php';

		foreach ( $path as $template ) {
			if ( file_exists( $template ) ) {
				return $template;
			}
		}
	}

	public function get_option( $option ) {
		return $this->options->get( $option );
	}

	protected function get_dir_path( $sub_dir ) {

		$amphtml_dir = AMPHTML::instance()->get_amphtml_path();

		if ( is_dir( $amphtml_dir . $sub_dir ) ) {
			return $amphtml_dir . $sub_dir;
		}

		return false;
	}

	public function set_template_content( $template ) {
		$this->template_content = $template;
		add_action( AMPHTML::TEXT_DOMAIN . '_template_content', array( $this, 'the_template_content' ) );

		return $this;
	}

	public function get_style( $filename ) {

		$styles = '';
		$path   = $this->get_dir_path( self::STYLE_DIR ) . DIRECTORY_SEPARATOR . $filename . '.css';

		if ( file_exists( $path ) ) {
			$styles = file_get_contents( $path );
		}

		return apply_filters( AMPHTML::TEXT_DOMAIN . '_style', $styles, $this );

	}

	public function get_title( $id ) {
		return ( get_post_meta( $id, "amphtml-override-title", true ) ) ?
			get_post_meta( $id, "amphtml-custom-title", true ) : get_the_title( $id );
	}

	public function get_content( $post ) {

		$content = $post->post_content;
		if ( get_post_meta( $post->ID, "amphtml-override-content", true ) ) {
			$content = get_post_meta( $post->ID, "amphtml-custom-content", true );
		}
		if ( $this->options->get( 'default_the_content' ) ) {
			$this->remove_custom_the_content_hooks();
		}

		return apply_filters( 'the_content', $content );
	}

	public function remove_custom_the_content_hooks() {
		global $wp_filter;
		$hooks    = $wp_filter['the_content'];
		$defaults = $this->get_default_the_content_hooks();
		foreach ( $hooks as $priority => $functions ) {
			foreach ( $functions as $name => $function ) {
				$function_name = ( is_array( $function['function'] ) ) ? $function['function'][1] : $function['function'];
				if ( ! isset( $defaults[ $priority ] ) || ! in_array( $function_name, $defaults[ $priority ] )
				) {
					unset( $wp_filter['the_content'][ $priority ][ $name ] );
				}
			}
			if ( ! count( $wp_filter['the_content'][ $priority ] ) ) {
				unset( $wp_filter['the_content'][ $priority ] );
			}
		}
	}

	public function get_default_the_content_hooks() {
		return apply_filters( 'amphtml_the_content', array(
			'11' => array( 'capital_P_dangit', 'do_shortcode' ),
			'10' => array(
				'wptexturize',
				'convert_smilies',
				'wpautop',
				'shortcode_unautop',
				'prepend_attachment',
				'wp_make_content_images_responsive'
			),
			'8'  => array( 'run_shortcode', 'autoembed' ),
		) );
	}

	public function set_post( $id ) {

		$this->post               = get_post( $id );
		$this->ID                 = $this->post->ID;
		$this->title              = $this->get_title( $this->ID );
		$this->publish_timestamp  = get_the_date( 'U', $this->ID );
		$this->modified_timestamp = get_post_modified_time( 'U', false, $this->post );
		$this->author             = get_userdata( $this->post->post_author );
		$this->content            = $this->get_content( $this->post );
		$this->content            = $this->sanitizer->sanitize_content( $this->content );
		$this->content            = apply_filters( AMPHTML::TEXT_DOMAIN . '_' . 'single_content', $this->content );
		$this->featured_image     = $this->get_featured_image();

		$description    = $this->get_post_excerpt_by_id( $id );
		$logo           = $this->logo;
		$image_metadata = $this->get_image_metadata();
		if ( empty( $logo ) ) {
			$logo = $this->default_logo;
		}

		if ( ! empty( $logo ) AND ! empty( $image_metadata ) ) { // todo refactoring - general function for schema.org

			$metadata = array(
				'@context'         => 'http://schema.org',
				'@type'            =>  apply_filters( 'amphtml_schema_type', $this->options->get( 'schema_type' ), $this ),
				'mainEntityOfPage' => array(
					'@type' => 'WebPage',
					'@id'   => get_permalink(),
				),
				'publisher'        => array(
					'@type' => 'Organization',
					'name'  => $this->blog_name,
				),
				'headline'         => $this->title,
				'datePublished'    => date( 'c', $this->publish_timestamp ),
				'dateModified'     => date( 'c', $this->modified_timestamp ),
				'author'           => array(
					'@type' => 'Person',
					'name'  => $this->author->display_name,
				),
			);

			if ( $description ) {
				$metadata['description'] = $this->remove_html_comments( $description );
			}

			if ( $logo ) {
				$metadata['publisher']['logo'] = array(
					'@type'  => 'ImageObject',
					'url'    => $logo,
					'height' => self::SITE_ICON_SIZE,
					'width'  => self::SITE_ICON_SIZE,
				);
			}

			if ( $image_metadata ) {
				$metadata['image'] = $image_metadata;
			}

			$this->metadata = apply_filters( AMPHTML::TEXT_DOMAIN . '_' . 'metadata', $metadata, $this );

		}

	}

	public function set_schema_metadata( $description = '', $type = 'NewsArticle' ) {
		global $post;
		if ( ! $post ) {
			return '';
		}
		$author         = get_userdata( $post->post_author );
		$logo           = $this->default_logo;
		$image_metadata = $this->get_image_metadata();
		$type = apply_filters( 'amphtml_schema_type', $this->options->get( 'schema_type' ), $this ); // todo refactoring

		if ( empty( $logo ) ) {
			$logo = $this->logo;
		}

		if ( ! empty( $logo ) AND ! empty( $image_metadata ) ) {

			$metadata = array(
				'@context'         => 'http://schema.org',
				'@type'            => $type,
				'mainEntityOfPage' => array(
					'@type' => 'WebPage',
					'@id'   => get_permalink(),
				),
				'publisher'        => array(
					'@type' => 'Organization',
					'name'  => $this->blog_name,
				),
				'headline'         => $this->title,
				'datePublished'    => date( 'c', get_the_date( 'U', $post->ID ) ),
				'dateModified'     => date( 'c', get_post_modified_time( 'U', false, $post ) ),
				'author'           => array(
					'@type' => 'Person',
					'name'  => $author->display_name,
				),
			);

			if ( $description ) {
				$metadata['description'] = $this->remove_html_comments( $description );
			}

			if ( $logo ) {
				$metadata['publisher']['logo'] = array(
					'@type'  => 'ImageObject',
					'url'    => $logo,
					'height' => self::SITE_ICON_SIZE,
					'width'  => self::SITE_ICON_SIZE,
				);
			}

			if ( $image_metadata ) {
				$metadata['image'] = $image_metadata;
			}

			$this->metadata = apply_filters( AMPHTML::TEXT_DOMAIN . '_' . 'metadata', $metadata, $this );
		}
	}

	public function get_attachment_id_from_src( $image_src ) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";

		return $wpdb->get_var( $query );

	}

	public function remove_html_comments( $html ) {
		return preg_replace( '/<!--(.*?)-->/', '', $html );
	}

	private function get_image_metadata() {
		$post_image_id = '';
		$image_ids = array();
		if ( $this->ID ) {
			$post_image_id = $this->get_post_thumbnail_id( $this->ID );

			if ( strlen( $post_image_id ) == 0 ) {
				$image_ids = get_posts( array(
					'post_parent'      => $this->ID,
					'post_type'        => 'attachment',
					'post_mime_type'   => 'image',
					'posts_per_page'   => 1,
					'orderby'          => 'menu_order',
					'order'            => 'ASC',
					'fields'           => 'ids',
					'suppress_filters' => false,
				) );
			}
		}

		if ( count( $image_ids ) ) {
			$post_image_id = current( $image_ids );
		} else {
			$default_image = $this->options->get( 'default_image' );
			$post_image_id = $this->get_attachment_id_from_src( $default_image );
		}

		return $this->get_schema_images( $post_image_id );
	}

	function get_post_thumbnail_id( $post_id ) {
		$thumbnail_id = get_post_meta( $post_id, 'amphtml_featured_image_id', true );
		if ( ! $thumbnail_id ) {
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		}

		return $thumbnail_id;
	}

	public function get_schema_images( $post_image_id ) {

		$post_image_src = wp_get_attachment_image_src( $post_image_id, 'full' );

		if ( is_array( $post_image_src ) ) {
			return array(
				'@type'  => 'ImageObject',
				'url'    => $post_image_src[0],
				'width'  => ( $post_image_src[1] > self::SCHEMA_IMG_MIN_WIDTH ) ? $post_image_src[1] : self::SCHEMA_IMG_MIN_WIDTH,
				'height' => $post_image_src[2],
			);
		}

		return '';
	}

	public function get_post_excerpt_by_id( $post_id ) {
		global $post;
		$post = get_post( $post_id );
		setup_postdata( $post );
		$the_excerpt = get_the_excerpt();
		wp_reset_postdata();

		return $the_excerpt;
	}

	public function get_featured_image() {
		$featured_iamge    = '';
		$image_id          = get_post_meta( $this->ID, 'amphtml_featured_image_id', true );
		$post_thumbnail_id = ( $image_id ) ? $image_id : get_post_thumbnail_id( $this->ID );
		if ( $post_thumbnail_id ) {
			$featured_iamge = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		}

		return $featured_iamge;
	}

	public function nav_menu() {
		$nav_menu = wp_nav_menu( array(
				'theme_location' => $this->options->get( 'amphtml_menu' ),
				'echo'           => false
			)
		);
		$nav_menu = $this->update_content_links( $nav_menu );

		return apply_filters( AMPHTML::TEXT_DOMAIN . '_nav_menu', $nav_menu );
	}

	public function update_content_links( $content ) {
		$dom_model         = $this->sanitizer->get_dom_model();
		$avoid_amp_class = apply_filters( AMPHTML::TEXT_DOMAIN . '_no_amp_menu_link', 'no-amp' );
		$content           = $dom_model->load( $content );
		foreach ( $content->find( 'a' ) as $anchor ) {
			if ( false === strpos( $anchor->parent->class, $avoid_amp_class ) ) {
				$anchor->href = $this->get_amphtml_link( $anchor->href );
			}
		}

		return $content;
	}

	public function get_amphtml_link( $link ) {
		return $this->options->get_amphtml_link( $link );
	}

	public function get_logo_link() {
		$arg = apply_filters( 'amphtml_logo_link', false );
		if ( $arg == false ) {
			echo esc_url( $this->get_amphtml_link( $this->base_url ) );
		} else {
			echo $arg;
		}
	}

	public function gallery_shortcode( $attr ) {

		$size = $this->get_default_image_size();

		add_image_size( 'amphtml-size', $size['width'], $size['height'] );

		$sanitizer = new AMPHTML_Sanitize( $this );

		$gallery = gallery_shortcode( $attr );

		$attr = shortcode_atts( array(
			'size' => 'amphtml-size'
		), $attr );

		$sanitizer->load_content( $gallery );

		$image_size = $this->get_image_size( $attr['size'] );

		$gallery_content = $sanitizer->get_content();

		$gallery_images = $sanitizer->get_amp_images( $image_size );

		$gallery_content = $this->render_element( 'carousel', array(
			'width'  => $image_size['width'],
			'height' => $image_size['height'],
			'images' => $gallery_images
		) );

		return $gallery_content;
	}

	public function get_default_image_size() {
		$size           = array();
		$size['width']  = $this->options->get( 'content_width' );
		$size['height'] = round( $size['width'] / ( 16 / 9 ), 0 );

		return $size;
	}

	public function get_image_size( $size ) {
		$sizes = $this->get_image_sizes();

		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		}

		return false;
	}

	public function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;
	}

	public function render_element( $template, $element ) {

		$template_path = $this->get_template_path( $template );

		if ( file_exists( $template_path ) ) {
			ob_start();
			include( $template_path );

			return ob_get_clean();
		}
	}

	public function get_post_meta() {
		$meta = ( $this->options->get( 'post_meta_author' ) ) ? $this->render( 'meta-author' ) : '';
		$meta .= ( $this->options->get( 'post_meta_categories' ) ) ? $this->render( 'meta-cats' ) : '';
		$meta .= ( $this->options->get( 'post_meta_tags' ) ) ? $this->render( 'meta-tags' ) : '';
		$meta .= $this->render( 'meta-time' );
		$meta = $this->update_content_links( $meta );

		return apply_filters( AMPHTML::TEXT_DOMAIN . '_meta', $meta, $this );
	}

	public function is_featured_image() {
		global $wp_query;

		if ( ! $this->featured_image ) {
			return false;
		}

		return ( ( is_archive() && $this->options->get( 'archive_featured_image' ) )
		         || ( is_page() && $this->options->get( 'page_featured_image' ) )
		         || ( is_home() && ! is_front_page() && ! $wp_query->is_posts_page && $this->options->get( 'page_featured_image' ) )
		         || ( is_single() && $this->options->get( 'post_featured_image' ) )
		         || ( is_search() && $this->options->get( 'search_page_post_featured_image' ) )
		         || ( is_home() && is_front_page() && $this->options->get( 'blog_page_post_featured_image' ) )
		         || ( $wp_query->is_posts_page && $this->options->get( 'blog_page_post_featured_image' ) )
		);
	}

	public function is_enabled_meta() {
		global $wp_query;

		return ( ( is_search() && $this->options->get( 'search_page_post_meta' ) )
		         || ( is_archive() && $this->options->get( 'archive_meta' ) )
		         || ( is_home() && is_front_page() && $this->options->get( 'blog_page_post_meta' ) )
		         || ( $wp_query->is_posts_page && $this->options->get( 'blog_page_post_meta' ) )
		);
	}

	public function update_pagination_link( $pagination_link ) {

		$endpoint = AMPHTML()->get_endpoint();
		$pattern  = "/(\/page\/\d+)?\/($endpoint)(\/page\/\d+)?\/$/";

		preg_match( $pattern, $pagination_link, $matches );

		if ( false === isset( $matches[2] ) ) {
			return $pagination_link;
		}

		$mached_endpoint = $matches[2];

		$pagination_link = str_replace( $matches[0], '', $pagination_link );

		$page = isset( $matches[3] ) ? $matches[3] : '';

		$pagination_link = $pagination_link . $page . '/' . $matches[2] . '/';

		return $pagination_link;
	}

	public function get_canonical_url() {

		return AMPHTML()->get_canonical_url();
	}

	public function get_permalink() {
		global $wp;

		return home_url( add_query_arg( array(), $wp->request ) );
	}

	public function get_add_to_cart_button() { //todo move to wc class
		global $product;


		if ( $product->product_type === 'external' ) {

			return include( $this->get_template_path( $product->product_type ) );
		}

		return include( $this->get_template_path( 'simple' ) );

	}

	public function get_product_image_links( $product ) { //todo move to wc class
		$attachment_ids = $product->get_gallery_attachment_ids();
		if ( count( $attachment_ids ) ) {
			$attachment_ids[]        = $product->get_image_id();
			$this->product_image_ids = $attachment_ids;
			$sanitizer               = new AMPHTML_Sanitize( $this );
			$sanitizer->load_content( $this->render( 'wc-product-images' ) );
			$image_size = $this->get_default_image_size();;
			$gallery_content = $sanitizer->get_content();
			$gallery_images  = $sanitizer->get_amp_images( $image_size );
			$gallery_content = $this->render_element( 'carousel', array(
				'width'  => $image_size['width'],
				'height' => $image_size['height'],
				'images' => $gallery_images
			) );

			return $gallery_content;
		}

		return $this->render_element( 'image', $this->featured_image );
	}

	public function fix_canonical_url() {
		return $this->get_canonical_url();
	}

	public function fix_og_title() {
		return $this->doc_title;
	}

	public function set_blocks( $type, $default = true ) {
		$this->blocks = $this->options->get_template_elements( $type, $default );
	}

	public function get_blocks() {
		return $this->blocks;
	}

	public function get_related_posts( $post, $count = 2 ) {
		$taxs = get_object_taxonomies( $post );
		if ( ! $taxs ) {
			return '';
		}

		// ignoring post formats
		if ( ( $key = array_search( 'post_format', $taxs ) ) !== false ) {
			unset( $taxs[ $key ] );
		}

		// try tags first
		if ( ( $tag_key = array_search( 'post_tag', $taxs ) ) !== false ) {

			$tax          = 'post_tag';
			$tax_term_ids = wp_get_object_terms( $post->ID, $tax, array( 'fields' => 'ids' ) );
		}

		// if no tags, then by cat or custom tax
		if ( empty( $tax_term_ids ) ) {
			// remove post_tag to leave only the category or custom tax
			if ( $tag_key !== false ) {
				unset( $taxs[ $tag_key ] );
				$taxs = array_values( $taxs );
			}

			$tax          = $taxs[0];
			$tax_term_ids = wp_get_object_terms( $post->ID, $tax, array( 'fields' => 'ids' ) );

		}

		if ( $tax_term_ids ) {
			$args    = array(
				'post_type'      => $post->post_type,
				'posts_per_page' => $count,
				'orderby'        => 'rand',
				'post_status'    => 'publish',
				'tax_query'      => array(
					array(
						'taxonomy' => $tax,
						'field'    => 'id',
						'terms'    => $tax_term_ids
					)
				),
				'post__not_in'   => array( $post->ID ),
			);
			$related = new WP_Query( $args );

			return $related;
		}
	}

	public function get_recent_posts( $count ) {
		return new WP_Query(
			array(
				'orderby'             => 'date',
				'posts_per_page'      => $count,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			)
		);
	}

	public function get_doc_title() {
		return $this->doc_title;
	}

	public function set_extra_css() {
		$extra_css = $this->options->get( 'extra_css_amp' );
		if ( ! empty( $extra_css ) ) {
			echo $extra_css;
		}
	}

	public function get_footer() {
		$footer_content = apply_filters( AMPHTML::TEXT_DOMAIN . '_template_footer', $this->options->get( 'footer_content' ) );
		if ( $footer_content ) {
			$footer_content = do_shortcode( $footer_content );
			$footer_content = $this->sanitizer->sanitize_content( $footer_content )->save();
		}

		return $footer_content;
	}

	public function load() {
		global $wp_query;
		$social_share_script = array(
			'slug' => 'amp-social-share',
			'src'  => 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js'
		);

		switch ( true ) {
			case is_front_page():
			case ( $wp_query->is_posts_page ):
				$this->set_template_content( 'archive' )
				     ->set_default_embedded_elements();
				$this->doc_title = $this->title = $this->options->get( 'blog_page_title' );
				add_filter( 'aioseop_title', array ( $this, 'get_doc_title' ) );
				$this->set_blocks( 'blog' );
				$this->set_schema_metadata();
				break;
			case is_home():
				$this->set_template_content( 'single-content' );
				$current_post_id = get_option( 'page_on_front' );
				$this->set_post( $current_post_id );
				$this->doc_title = $this->post->post_title;
				add_filter( 'aioseop_title', array( $this, 'get_doc_title' ) );
				$this->set_blocks( 'pages' );
				if ( $this->options->get( 'page_social_share' ) ) {
					$this->add_embedded_element( $social_share_script );
				}
				break;
			case is_single():
				$this->set_template_content( 'single-content' );
				$current_post_id = get_the_ID();
				$this->set_post( $current_post_id );
				$this->set_blocks( 'posts' );
				if ( $this->options->get( 'post_social_share' ) ) {
					$this->add_embedded_element( $social_share_script );
				}
				break;
			case is_page():
				$this->set_template_content( 'single-content' );
				$current_post_id = get_the_ID();
				$this->set_post( $current_post_id );
				$this->set_blocks( 'pages' );
				if ( $this->options->get( 'page_social_share' ) ) {
					$this->add_embedded_element( $social_share_script );
				}
				break;
			case is_archive():
				$this->set_template_content( 'archive' )
				     ->set_default_embedded_elements();
				$this->set_blocks( 'archives' );
				$this->title = get_the_archive_title();
				$this->set_schema_metadata( get_the_archive_description() );
				break;
			case is_404():
				$this->set_template_content( 'single-content' );
				$this->set_blocks( '404' );
				break;
			case is_search():
				$this->set_template_content( 'archive' );
				$this->set_blocks( 'search' );
				$this->title = __( 'Search Results', 'amphtml' );
				$this->set_schema_metadata();
				break;
		}
	}

	public function get_image_size_from_url( $url ) {
		$image = new FastImage( $url );
		list( $size['width'], $size['height'] ) = $image->getSize();

		return $size;
	}
}