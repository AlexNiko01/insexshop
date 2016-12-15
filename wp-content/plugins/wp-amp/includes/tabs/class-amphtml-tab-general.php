<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_General extends AMPHTML_Tab_Abstract {

	public function get_fields() {
		return array(
			array(
				'id'                    => 'google_analytic',
				'title'                 => __( 'Google Analytics Code', 'amphtml'),
				'placeholder'           => 'UA-XXXXXXXX-Y',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'google_analytic' ),
				'sanitize_callback'     => array( $this, 'sanitize_google_analytic' ),
				'description'           => __( 'Setup Google Analytics tracking ID', 'amphtml' ),
			),
			array(
				'id'               => 'endpoint',
				'title'            => __( 'AMP Endpoint', 'amphtml' ),
				'default'          => 'amp',
				'display_callback' => array( $this, '' ),
				'description'      => __('This string will be added to the end of URL for all pages with AMP content', 'amphtml' )
			),
			array(
				'id'                    => 'mobile_amp',
				'title'                 => __( 'Redirect Mobile Users', 'amphtml' ),
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'mobile_amp' ),
				'description'           => __( 'Redirect all mobile users to AMP version of your site by default', 'amphtml' )
			),
			array(
				'id'                => 'content_width',
				'title'             => __( 'AMP Content Max-Width', 'amphtml' ),
				'default'           => 600,
				'display_callback'  => array( $this, 'display_content_width' ),
				'sanitize_callback' => array( $this, 'sanitize_content_width' ),
				'description'       => __( 'Setup maximum width for AMP page content (in pixels)', 'amphtml' )
			),
			array(
				'id'                    => 'post_types',
				'title'                 => __( 'Post Types', 'amphtml' ),
				'default'               => array( 'post', 'page' ),
				'display_callback'      => array( $this, 'display_multiple_select' ),
				'display_callback_args' => array(
					'id'             => 'post_types',
					'select_options' => $this->get_post_types()
				),
				'description'           => __( 'Show AMP version for selected post types', 'amphtml' )
			),
			array(
				'id'                    => 'archives',
				'title'                 => __( 'Archives', 'amphtml' ),
				'default'               => array( 'date', 'author', 'category', 'tag' ),
				'display_callback'      => array( $this, 'display_multiple_select' ),
				'display_callback_args' => array(
					'id'             => 'archives',
					'select_options' => $this->get_archives()
				),
				'description'           => __( 'Show AMP version for selected archive pages.', 'amphtml' )
			),
			array(
				'id'                    => 'ad_enable',
				'title'                 => __( 'Enable Ads', 'amphtml' ),
				'default'               => 0,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'ad_enable' ),
				'description'           => '',
			),
			array(
				'id'                    => 'default_the_content',
				'title'                 => __( 'Compatibility mode', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'default_the_content' ),
				'description'           => __( "Remove third-party the_content hooks for better compatibility", 'amphtml' )
			),
			array(
				'id'                    => 'debug_mode',
				'title'                 => __( 'Debug mode', 'amphtml' ),
				'default'               => 0,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'debug_mode' ),
				'description'           => __( "Show errors, warnings and notices", 'amphtml' )
			)
		);
	}

	public function sanitize_google_analytic( $google_analytics_id ) {
		$google_analytics_id = sanitize_text_field( $google_analytics_id );
		if ( empty( $google_analytics_id ) ) {
			return '';
		}
		if ( 0 === preg_match( "/^UA-([0-9]{4,9})-([0-9]{1,4})/i", $google_analytics_id ) ) {
			add_settings_error( $this->options->get( 'google_analytic', 'name' ), 'hc_error', __( 'Insert a valid google analytics id', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( 'google_analytic' );
		} else {
			$valid_field = $google_analytics_id;
		}

		return $valid_field;
	}

	public function sanitize_content_width( $content_width ) {
		$content_width = sanitize_text_field( $content_width );
		if ( 0 === preg_match( '/^[1-9][0-9]*$/', $content_width ) ) {
			add_settings_error( $this->options->get( 'content_width', 'name' ), 'cw_error', __( 'Insert a valid content width', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( 'content_width' );
		} else {
			$valid_field = $content_width;
		}

		return $valid_field;
	}

	public function sanitize_endpoint( $endpoint ) {
		$endpoint = sanitize_title( $endpoint );
		if ( ! $endpoint ) {
			add_settings_error( $this->options->get( 'endpoint', 'name' ), 'endpoint_error', __( 'Insert a valid endpoint', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( 'endpoint' );
		} else {
			$valid_field = $endpoint;
		}

		return $valid_field;
	}

	public function display_content_width() {
		?>
		<input style="width: 28%" type="text"
		       name="<?php echo $this->options->get( 'content_width', 'name' ) ?>"
		       id="custom_content_width" value="<?php echo esc_attr( $this->options->get( 'content_width' ) ) ?>"
		       required
		/>
		<?php if ( $this->options->get( 'content_width', 'description' ) ): ?>
			<p class="description"><?php esc_html_e( $this->options->get( 'content_width', 'description' ), 'amphtml' ) ?></p>
		<?php endif; ?>
		<script>
			jQuery(function ($) {
				$("#custom_content_width").keydown(function (e) {
					// Allow: backspace, delete, tab, escape, enter and .
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
							// Allow: Ctrl+A, Command+A
						(e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) ||
							// Allow: home, end, left, right, down, up
						(e.keyCode >= 35 && e.keyCode <= 40)) {
						// let it happen, don't do anything
						return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});
			})
		</script>
		<?php
	}

	public function get_archives() {

		$archives   = array(
			'date'     => 'Dates',
			'author'   => 'Authors',
			'category' => 'Categories',
			'tag'      => 'Tags',
		);
		$taxonomies = get_taxonomies(
			array(
				'public'   => true,
				'_builtin' => false,
			),
			'object'
		);
		foreach ( $taxonomies as $taxonomy ) {
			if( $taxonomy->show_ui ) {
				$archives[ $taxonomy->name ] = $taxonomy->label;
			}
		}

		$archives = array_merge( $archives, $this->get_post_types( array( 'public' => true, 'has_archive' => true ) ) );

		return $archives;
	}

	public function get_post_types( $args = '' ) {
		$types        = array();
		$default_args = array(
			'public' => true
		);
		$args         = is_array( $args ) ? $args : $default_args;
		$post_types   = get_post_types( $args, 'object' );

		foreach ( $post_types as $type ) {
			$types[ $type->name ] = $type->label;
		}

		return $types;
	}



}