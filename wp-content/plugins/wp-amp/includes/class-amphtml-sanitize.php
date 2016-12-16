<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if( ! function_exists( 'file_get_html' ) ) {
	include_once AMPHTML()->get_amphtml_path() . '/vendor/simple_html_dom.php';
}
include_once AMPHTML()->get_amphtml_path() . '/vendor/Fastimage.php';

class AMPHTML_Sanitize {

	const YT_PATTERN = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
	const VIMEO_PATTERN = '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/';

	/**
	 * @var AMPHTML_Template
	 */
	protected $template;

	/**
	 * @var simple_html_dom
	 */
	protected $html_dom;

	protected $content;

	public function __construct( $template ) {
		$this->template = $template;
		$this->html_dom = new simple_html_dom();
		$this->html_dom->set_callback( array( $this, 'sanitize_elements' ) );
	}

	public function sanitize_content( $content ) { //todo move all methods to sanitize element
		$this->load_content( $content )
		     ->sanitize_youtube()
		     ->sanitize_vimeo()
		     ->sanitize_audio()
		     ->sanitize_iframe();

		return $this->get_content();
	}

	public function remove_inline_styles( $el ) {
		$el->style   = null;
		$el->onclick = null;
		$el->border  = null;
		$el->bgcolor = null;
		$el->color   = null;
		$el->size    = null;
	}

	public function sanitize_elements( $el ) {
		$this->remove_inline_styles( $el );

		switch ($el->tag) {
			case 'a':
				$this->sanitize_a( $el );
				break;
			case 'img':
				$this->sanitize_image( $el );
				break;
			case 'video':
				$this->sanitize_video( $el );
				break;
		}
	}

	public function sanitize_iframe() {

		if ( ! $this->content->find( 'iframe' ) ) {
			return $this;
		}

		$this->template->add_embedded_element( array(
			'slug' => 'amp-iframe',
			'src'  => 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js'
		) );

		$allowed_attributes = array(
			'width',
			'height',
			'frameborder',
			'src',
			'layout',
			'sandbox'
		);

		foreach ( $this->content->find( 'iframe' ) as $iframe ) {
			$iframe = $this->validate_attributes( $iframe, $allowed_attributes );
			$iframe->tag       = 'amp-iframe';
			$iframe->layout    = "responsive";
			$iframe->sandbox   = "allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox";
			$iframe->innertext = '<div placeholder="" class="amphtml-iframe-placeholder"></div>';
		}

		return $this;
	}

	public function sanitize_audio() {

		if ( ! $this->content->find( 'audio' ) ) {
			return $this;
		}

		$this->template->add_embedded_element( array(
			'slug' => 'amp-audio',
			'src'  => 'https://cdn.ampproject.org/v0/amp-audio-0.1.js'
		) );

		foreach ( $this->content->find( 'audio' ) as $iframe ) {
			$iframe->tag = 'amp-audio';
			$this->validate_attributes( $iframe, array(
				'src',
				'autoplay',
				'controls',
				'loop',
				'class',
				'width',
				'height',
				'id'
			) );
		}

		return $this;
	}

	public function sanitize_video( $video ) {
		$video->tag    = 'amp-video';
		$video->layout = "responsive";
	}

	public function sanitize_image( $img ) {
		$allowed_attributes = array( 'src', 'sizes', 'srcset', 'width', 'height', 'class' );
		$img   = $this->validate_attributes( $img, $allowed_attributes );
		$image = new FastImage( $img->src );
		if ( ! $image->getHandle() || ! $img->src ) {
			$img->outertext = '';
		} else {
			list( $img->width, $img->height ) = $image->getSize();
			$img->tag = 'amp-img';
		}
	}

	public function sanitize_vimeo() {

		if ( ! $this->content->find( 'iframe' ) ) {
			return $this;
		}

		$this->template->add_embedded_element( array(
			'slug' => 'amp-vimeo',
			'src'  => 'https://cdn.ampproject.org/v0/amp-vimeo-0.1.js'
		) );

		$allowed_attributes = array(
			'data-videoid',
			'layout',
			'width',
			'height'
		);

		foreach ( $this->content->find( 'iframe' ) as $iframe ) {
			if ( preg_match( self::VIMEO_PATTERN, $iframe->src, $match ) ) {
				$iframe = $this->validate_attributes( $iframe, $allowed_attributes );
				$iframe->{'data-videoid'} = $match[5];
				$iframe->tag              = 'amp-vimeo';
				$iframe->layout           = "responsive";
			}
		}

		return $this;
	}

	public function sanitize_youtube() {

		if ( ! $this->content->find( 'iframe' ) ) {
			return $this;
		}

		$allowed_attributes = array(
			'data-videoid',
			'width',
			'height'
		);

		$this->template->add_embedded_element( array(
			'slug' => 'amp-youtube',
			'src'  => 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js'
		) );

		foreach ( $this->content->find( 'iframe' ) as $iframe ) {
			if ( preg_match( self::YT_PATTERN, $iframe->src, $match ) ) {
				$iframe = $this->validate_attributes( $iframe, $allowed_attributes );
				$iframe->{'data-videoid'} = $match[1];
				$iframe->tag              = 'amp-youtube';
				$iframe->layout           = "responsive";
			}
		}

		return $this;
	}

	public function load_content( $content ) {
		$this->content = $this->html_dom->load( $content );

		return $this;
	}

	public function get_content() {
		foreach ( $this->content->find( 'font' ) as $tag ) {
			$tag->outertext = $tag->innertext;
		}

		$illegal_tags = implode( ',', apply_filters( 'amphtml_illegal_tags', array( 'script, noscript, style, link' ) ) );

		foreach ( $this->content->find( $illegal_tags ) as $tag ) {
			$tag->outertext = "";
		}

		return $this->content;
	}

	public function set_content( $content ) {
		$this->content = $content;
	}

	public function get_amp_images( $size ) {

		$this->template->add_embedded_element( array(
			'slug' => 'amp-carousel',
			'src'  => 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js'
		) );

		$images = '';
		foreach ( $this->content->find( 'img' ) as $img ) {
			$img->outertext = $this->template->render_element( 'carousel-image', array(
				$img->src,
				$size['width'],
				$size['height']
			) );
			$img->class     = '';
			$images .= $img;
		}

		return $images;
	}

	public function get_dom_model() {
		return new simple_html_dom();
	}

	public function get_html_tag_whitelist() {
		return array(
			'body',
			'article',
			'section',
			'nav',
			'aside',
			'footer',
			'address',
			'h1',
			'h2',
			'p',
			'hr',
			'pre',
			'blockquote',
			'ol',
			'ul',
			'li',
			'dl',
			'dt',
			'dd',
			'figure',
			'figcaption',
			'div',
			'main',
			'a',
			'em',
			'strong',
			'small',
			's',
			'cite',
			'q',
			'dfn',
			'abbr',
			'data',
			'time',
			'code',
			'var',
			'samp',
			'kbd',
			'sub',
			'sup',
			'i',
			'b',
			'u',
			'mark',
			'ruby',
			'rb',
			'rt',
			'rtc',
			'rp',
			'bdi',
			'bdo',
			'span',
			'br',
			'wbr',
			'ins',
			'del',
			'source',
			'table',
			'caption',
			'olgroup',
			'col',
			'tbody',
			'thead',
			'tfoot',
			'tr',
			'td',
			'th',
			'button',
			'acronym',
			'center',
			'dir',
			'hgroup',
			'listing',
			'multicol',
			'nextid',
			'nobr',
			'spacer',
			'strike',
			'tt',
			'xmp',
			'amp-img',
			'amp-video',
			'amp-ad',
			'amp-fit-text',
			'amp-font',
			'amp-carousel',
			'amp-anim',
			'amp-youtube',
			'amp-twitter',
			'amp-vine',
			'amp-instagram',
			'amp-iframe',
			'amp-pixel',
			'amp-audio',
			'amp-lightbox',
			'amp-image-lightbox',
			'svg',
			'g',
			'path',
			'glyph',
			'glyphref',
			'marker',
			'view',
			'circle',
			'line',
			'polygon',
			'polyline',
			'rect',
			'text',
			'textpath',
			'tref',
			'tspan',
			'clippath',
			'filter',
			'lineargradient',
			'radialgradient',
			'mask',
			'pattern',
			'vkern',
			'hkern',
			'defs',
			'use',
			'symbol',
			'desc',
			'title'
		);
	}

	protected function validate_attributes( $element, $allowed_attributes ) {
		foreach ( $element->attr as $attr => $value ) {

			//unset disallowed attributes
			if ( ! in_array( $attr, $allowed_attributes ) ) {
				$element->attr[ $attr ] = null;
			}

			//convert relative width and height to absolute values
			if ( in_array( $attr, array( 'width', 'height' ) ) && false !== strpos( $value, '%' ) ) {
				$value                  = (int) rtrim( $value, '%' );
				$element->attr[ $attr ] = ( $value / 100 ) * (int) get_option( 'amphtml_content_width' );
			}

			//convert frameborder string value to int
			if ( 'frameborder' == $attr ) {
				$element->attr[ $attr ] = ( 'yes' === $value || 1 === ( int ) $value ) ? 1 : 0;
			}
		}

		return $element;
	}

	public function remove_disallowed_tags( $element ) { // todo remove ?
		if ( ! in_array( $element->tag, $this->get_html_tag_whitelist() ) ) {
			$element->outertext = '';
		}
	}

	public function sanitize_a( $a ) {
		$a->rev = null;
		if ( $a->target && '_blank' === $a->target || '_new' === $a->target ) {
			$a->target = '_blank';
		} else {
			$a->target = null;
		}
	}
//
}