<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class AMPHTML_Shortcode {

	/**
	 * @var AMPHTML_Template
	 */
	protected $template;

	protected $available_ads = array( 'adsense', 'doubleclick' );

	public function __construct( $template ) {
		$this->template = $template;
		add_shortcode( 'wp-amp-ad', array( $this, 'ad' ) );
		add_shortcode( 'wp-amp-related', array( $this, 'related' ) );
		add_shortcode( 'wp-amp-recent', array( $this, 'recent' ) );
		add_shortcode( 'wp-amp-share', array( $this, 'share' ) );
		add_shortcode( 'wp-amp-switcher', array( $this, 'do_switch' ) );
	}

	public function ad( $atts ) {
		$options = shortcode_atts( array(
			'type'           => false,
			'width'          => 150,
			'height'         => 50,
			'data-slot'      => false,
			'data-ad-client' => false,
			'data-ad-slot'   => false
		), $atts );

		$this->template->shortcode_atts = $options;
		if ( in_array( $options['type'], $this->available_ads )
		     && ( ( $options['data-ad-client'] && $options['data-ad-slot'] ) || $options['data-slot'] )
		) {
			return $this->template->render( 'ad-shortcode' );
		}

		return '';
	}

	public function related( $atts ) {
		$this->template->related_atts = shortcode_atts( array(
			'title' => __( 'You May Also Like', 'amphtml' ),
			'count' => 3,
		), $atts );

		return $this->template->render( 'related-shortcode' );
	}

	public function recent( $atts ) {
		$this->template->recent_atts = shortcode_atts( array(
			'title' => __( 'Latest blog posts', 'amphtml' ),
			'count' => 3,
		), $atts );

		return $this->template->render( 'recent-shortcode' );
	}

	public function share( $atts ) {

		$available_types = array( 'facebook', 'twitter', 'pinterest', 'linkedin', 'gplus', 'email', 'whatsapp', );

		if ( isset( $atts['types'] ) ) {
			$atts['types'] = explode( ',', $atts['types'] );
			$atts['types'] = array_intersect( $available_types , $atts['types'] );
		}

		$this->template->share_atts = shortcode_atts( array(
			'types'  => array( 'facebook', 'twitter', 'linkedin', 'email' ),
			'width'  => '60',
			'height' => '44'
		), $atts );

		return $this->template->render( 'social-share-shortcode' );
	}

	// [wp-amp-switcher title='Switch default version'][/wp-amp-switcher]
	public function do_switch( $atts ) {
		$atts = shortcode_atts( array(
				'title' => __( 'Switch to default version', 'amphtml' )
			), $atts
		);
		return sprintf( "<a href=%s>%s</a>", $this->template->get_canonical_url(), $atts['title'] );
	}


}