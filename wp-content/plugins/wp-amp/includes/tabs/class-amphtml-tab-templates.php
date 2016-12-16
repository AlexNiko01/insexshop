<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_Templates extends AMPHTML_Tab_Abstract {

	public function __construct( $name, $options, $is_current ) {
		parent::__construct( $name, $options, $is_current );
		if ( $this->is_current() && $this->is_sortable() ) {
			add_action( 'amphtml_after_settings_form', array( $this, 'add_sortable' ) );
		}
		if ( $this->is_ajax() ) {
			$this->save_order();
		}
	}

	public function get_sections() {
		return array(
			'posts'    => __( 'Posts', 'amphtml' ),
			'404'      => __( '404 Page', 'amphtml' ),
			'pages'    => __( 'Pages', 'amphtml' ),
			'search'   => __( 'Search', 'amphtml' ),
			'blog'     => __( 'Blog Page', 'amphtml' ),
			'archives' => __( 'Archives', 'amphtml' )
		);
	}

	public function get_fields() {
		return array_merge(
			$this->get_404_fields( '404' ),
			$this->get_posts_fields( 'posts' ),
			$this->get_page_fields( 'pages' ),
			$this->get_search_fields( 'search' ),
			$this->get_blog_fields( 'blog' ),
			$this->get_archive_fields( 'archives' )
		);
	}

	/*
	 * 404 Page Section
	 */
	public function get_404_fields( $section ) {
		return array(
			array(
				'id'                    => 'title_404',
				'title'                 => __( '404 Page Title', 'amphtml' ),
				'default'               => __( 'Oops! That page can&rsquo;t be found.', 'amphtml' ),
				'section'               => $section,
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'title_404' ),
				'description'           => ''
			),
			array(
				'id'                    => 'content_404',
				'title'                 => __( '404 Page Content', 'amphtml' ),
				'default'               => __( 'Nothing was found at this location.', 'amphtml' ),
				'section'               => $section,
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'content_404' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )
			),
			array(
				'id'                    => 'search_form',
				'title'                 => __( 'Search Form', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'search_form' ),
				'description'           => __( 'Enable search form', 'amphtml' )
			),
		);
	}

	public function sanitize_textarea_content( $textarea_content ) {
		$tags        = wp_kses_allowed_html( 'post' );
		$option_id = $this->current_option_id;
		$not_allowed = array(
			'font',
			'form',
			'menu',
			'nav'

		);
		foreach ( $tags as $key => $attr ) {
			if ( in_array( $key, $not_allowed ) ) {
				unset( $tags[ $key ] );
			}
		}
		$content = wp_kses( $textarea_content, $tags );

		if ( $content !== $textarea_content ) {
			add_settings_error( $this->options->get( $option_id, 'name' ), 'hc_error', __( 'Content contains disallowed tags. Please correct and try again.', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( $option_id );
		} else {
			$valid_field = $content;
		}

		return $valid_field;
	}

	public function display_textarea_field( $args ) {
		$id       = current( $args );
		$name     = sprintf( "%s", $this->options->get( $id, 'name' ) );
		?>
		<textarea id="<?php echo $id ?>" name="<?php echo $name ?>" rows="6" cols="46"><?php echo trim( $this->options->get( $id ) ); ?></textarea>
		<?php if ( $this->options->get( $id, 'description' ) ): ?>
			<p class="description"><?php echo $this->options->get( $id, 'description' ) ?></p>
		<?php endif;
	}

	/*
	 * Posts Section
	 */
	public function get_posts_fields( $section ) {

		$top_ad_block    = array();
		$bottom_ad_block = array();

		$fields = array(
			array(
				'id'                    => 'post_title',
				'title'                 => __( 'Post Title', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_title', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'post_custom_html',
				'title'                 => __( 'Custom HTML', 'amphtml' ),
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'post_custom_html' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'section'               => $section,
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )
			),
			array(
				'id'                    => 'post_featured_image',
				'title'                 => __( 'Featured Image', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_featured_image' ),
				'description'           => __( 'Show post thumbnail', 'amphtml' ),
			),
			array(
				'id'                    => 'post_meta',
				'title'                 => __( 'Post Meta Block', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_meta' ),
				'section'               => $section,
				'description'           => __( 'Show post author, categories and published time', 'amphtml' ),
			),
			array(
				'id'                    => 'post_content',
				'title'                 => __( 'Post Content', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_content', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'post_social_share',
				'title'                 => __( 'Social Share Buttons', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_social_share' ),
				'section'               => $section,
				'description'           => __( 'Show social share buttons', 'amphtml' ),
			),
			array(
				'id'                    => 'post_related',
				'title'                 => __( 'Related Posts', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_related' ),
				'section'               => $section,
				'description'           => __( 'Show related posts', 'amphtml' )
			)
		);

		if ( get_option( $this->options->get_field_name( 'ad_enable' ) ) ) {
			$top_ad_block[] = array(
				'id'                    => 'post_ad_top',
				'title'                 => __( 'Ad Block #1', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_ad_top' ),
				'description'           => __( 'Show ad block #1', 'amphtml' ),
			);

			$bottom_ad_block[] = array(
				'id'                    => 'post_ad_bottom',
				'title'                 => __( 'Ad Block #2', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_ad_bottom' ),
				'description'           => __( 'Show ad block #2', 'amphtml' ),
			);
		}

		return array_merge( $top_ad_block, $fields, $bottom_ad_block );
	}

	/*
	 * Pages Section
	 */
	public function get_page_fields( $section ) {
		$top_ad_block    = array();
		$bottom_ad_block = array();
		$socail_share    = array();

		$fields = array(
			array(
				'id'                    => 'page_title',
				'title'                 => __( 'Page Title', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_title', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'page_featured_image',
				'title'                 => __( 'Featured Image', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_featured_image' ),
				'description'           => __( 'Show page thumbnail', 'amphtml' ),
			),
			array(
				'id'                    => 'page_custom_html',
				'title'                 => __( 'Custom HTML', 'amphtml' ),
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'page_custom_html' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'section'               => $section,
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )

			),
			array(
				'id'                    => 'page_content',
				'title'                 => __( 'Page Content', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_content', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'page_social_share',
				'title'                 => __( 'Social Share Buttons', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_social_share' ),
				'section'               => $section,
				'description'           => __( 'Show social share buttons', 'amphtml' ),
			)
		);

		if ( get_option( $this->options->get_field_name( 'ad_enable' ) ) ) {
			$top_ad_block[]    = array(
				'id'                    => 'page_ad_top',
				'title'                 => __( 'Ad Block #1', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_ad_top' ),
				'description'           => __( 'Show ad block #1', 'amphtml' ),
			);
			$bottom_ad_block[] = array(
				'id'                    => 'page_ad_bottom',
				'title'                 => __( 'Ad Block #2', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'page_ad_bottom' ),
				'description'           => __( 'Show ad block #2', 'amphtml' ),
			);
		}

		return array_merge( $top_ad_block, $fields, $socail_share, $bottom_ad_block );

	}

	/*
	 * Search Page Section
	 */
	public function get_search_fields( $section ) {
		$top_ad_block    = array();
		$bottom_ad_block = array();

		$fields = array(
			array(
				'id'                    => 'search_page_title',
				'title'                 => __( 'Page Title', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'search_page_title', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'search_page_custom_html',
				'title'                 => __( 'Custom HTML', 'amphtml' ),
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'search_page_custom_html' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'section'               => $section,
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )

			),
			array(
				'id'                => 'search_page_content_block',
				'title'             => __( 'Content Block', 'amphtml' ),
				'default'           => 1,
				'display_callback'  => array( $this, 'display_search_page_content_block' ),
				'sanitize_callback' => array( $this, 'sanitize_search_page_content_block' ),
				'section'           => $section,
				'description'       => __( 'Search Page Content', 'amphtml' ),
			),
			array(
				'id'                    => 'search_page_post_featured_image',
				'title'                 => __( 'Featured Image', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'search_page_post_featured_image' ),
				'description'           => __( 'Show posts thumbnail', 'amphtml' ),
			),
			array(
				'id'                    => 'search_page_post_meta',
				'title'                 => __( 'Post Meta Block', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'search_page_post_meta' ),
				'description'           => __( 'Show posts author, categories and published time', 'amphtml' ),
			),
		);

		if ( get_option( $this->options->get_field_name( 'ad_enable' ) ) ) {
			$top_ad_block[]    = array(
				'id'                    => 'search_page_ad_top',
				'title'                 => __( 'Ad Block #1', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'search_page_ad_top' ),
				'description'           => __( 'Show ad block #1', 'amphtml' ),
			);
			$bottom_ad_block[] = array(
				'id'                    => 'search_page_ad_bottom',
				'title'                 => __( 'Ad Block #2', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'search_page_ad_bottom' ),
				'description'           => __( 'Show ad block #2', 'amphtml' ),
			);
		}

		return array_merge( $top_ad_block, $fields, $bottom_ad_block );
	}

	/*
	 * Blog Page Section
	 */
	public function get_blog_fields( $section ) {

		$top_ad_block    = array();
		$bottom_ad_block = array();

		$fields = array(
			array(
				'id'                    => 'blog_page_title',
				'title'                 => __( 'Blog Page Title', 'amphtml' ),
				'default'               => __( 'Blog', 'amphtml' ),
				'section'               => $section,
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'blog_page_title' ),
				'description'           => ''
			),
			array(
				'id'                    => 'blog_custom_html',
				'title'                 => __( 'Custom HTML', 'amphtml' ),
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'blog_custom_html' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'section'               => $section,
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )

			),
			array(
				'id'                => 'blog_content_block',
				'title'             => __( 'Content Block', 'amphtml' ),
				'default'           => 1,
				'display_callback'  => array( $this, 'display_blog_content_block' ),
				'sanitize_callback' => array( $this, 'sanitize_blog_content_block' ),
				'section'           => $section,
				'description'       => __( 'Blog Page Content', 'amphtml' )
			),
			array(
				'id'                    => 'blog_page_post_featured_image',
				'title'                 => __( 'Featured Image', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'blog_page_post_featured_image' ),
				'description'           => __( 'Show posts thumbnail', 'amphtml' ),
			),
			array(
				'id'                    => 'blog_page_post_meta',
				'title'                 => __( 'Post Meta Block', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'blog_page_post_meta' ),
				'description'           => __( 'Show posts author, categories and published time', 'amphtml' ),
			),
		);

		if ( get_option( $this->options->get_field_name( 'ad_enable' ) ) ) {
			$top_ad_block[]    = array(
				'id'                    => 'blog_page_ad_top',
				'title'                 => __( 'Ad Block #1', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'blog_page_ad_top' ),
				'description'           => __( 'Show ad block #1', 'amphtml' ),
			);
			$bottom_ad_block[] = array(
				'id'                    => 'blog_page_ad_bottom',
				'title'                 => __( 'Ad Block #2', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'blog_page_ad_bottom' ),
				'description'           => __( 'Show ad block #2', 'amphtml' ),
			);
		}

		return array_merge( $top_ad_block, $fields, $bottom_ad_block );
	}

	/*
	 * Archive Page Section
	 */
	public function get_archive_fields( $section ) {
		$top_ad_block    = array();
		$bottom_ad_block = array();

		$fields = array(
			array(
				'id'                    => 'archive_title',
				'title'                 => __( 'Archive Title', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'archive_title', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'archive_desc',
				'title'                 => __( 'Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'archive_desc' ),
				'section'               => $section,
				'description'           => __( 'Show description of archive page', 'amphtml' ),
			),
			array(
				'id'                    => 'archive_custom_html',
				'title'                 => __( 'Custom HTML', 'amphtml' ),
				'display_callback'      => array( $this, 'display_textarea_field' ),
				'display_callback_args' => array( 'archive_custom_html' ),
				'sanitize_callback'     => array( $this, 'sanitize_textarea_content' ),
				'section'               => $section,
				'description'           => __( 'Plain html without inline styles allowed. '
				                               . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' )

			),
			array(
				'id'                => 'archive_content_block',
				'title'             => __( 'Content BLock', 'amphtml' ),
				'default'           => 1,
				'display_callback'  => array( $this, 'display_archive_content_block' ),
				'sanitize_callback' => array( $this, 'sanitize_archive_content_block' ),
				'section'           => $section,
				'description'       => '',
			),
			array(
				'id'                    => 'archive_featured_image',
				'title'                 => __( 'Featured Images', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'archive_featured_image' ),
				'description'           => __( 'Show posts thumbnails', 'amphtml' ),
			),
			array(
				'id'                    => 'archive_meta',
				'title'                 => __( 'Post Meta Block', 'amphtml' ),
				'default'               => 1,
				'section'               => $section,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'archive_meta' ),
				'description'           => __( 'Show post author, categories and published time', 'amphtml' ),
			),
		);

		if ( get_option( $this->options->get_field_name( 'ad_enable' ) ) ) {
			$top_ad_block[]    = array(
				'id'                    => 'archive_ad_top',
				'title'                 => __( 'Ad Block #1', 'amphtml'),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'archive_ad_top' ),
				'description'           => __( 'Show ad block #1', 'amphtml' ),
			);
			$bottom_ad_block[] = array(
				'id'                    => 'archive_ad_bottom',
				'title'                 => __( 'Ad Block #2', 'amphtml' ),
				'default'               => 0,
				'section'               => $section,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'archive_ad_bottom' ),
				'description'           => __( 'Show ad block #2', 'amphtml' ),
			);
		}

		return array_merge( $top_ad_block, $fields, $bottom_ad_block );
	}

	public function add_sortable() {
		?>
		<script>
			jQuery(document).ready(function ($) {
				var templateElements = $('.form-table tbody');
				templateElements.sortable();
				$('#submit').click(function (event) {
					var data = {
						positions: templateElements.sortable("toArray", {attribute: 'data-name'}),
						action: amphtml.action,
						current_section: amphtml.current_section
					};
					$.post(amphtml.ajaxUrl, data)
				});
			});
		</script>
		<?php
	}

	public function get_section_fields( $id ) {
		$fields_order = get_option( self::ORDER_OPT );
		$fields_order = maybe_unserialize( $fields_order );
		$fields_order = isset( $fields_order[ $id ] ) ? maybe_unserialize( $fields_order[ $id ] ) : array();
		if ( ! count( $fields_order ) ) {
			return parent::get_section_fields( $id );
		}
		$fields = array();
		foreach ( $fields_order as $field_name ) {
			$fields[] = $this->search_field_id( $field_name );
		}

		return array_merge( $fields, parent::get_section_fields( $id ) );
	}

	public function display_archive_content_block() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Archive Content Block', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'archive_featured_image' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'archive_meta' ) ); ?></p>
		</fieldset>
		<?php
	}

	public function display_blog_content_block() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Blog Page Content', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'blog_page_post_featured_image' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'blog_page_post_meta' ) ); ?></p>
		</fieldset>
		<?php
	}

	public function display_search_page_content_block() {
		?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Search Page Content Block', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'search_page_post_featured_image' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'search_page_post_meta' ) ); ?></p>
		</fieldset>
		<?php
	}

	public function sanitize_blog_content_block() {
		$this->update_fieldset( array(
			'blog_page_post_featured_image',
			'blog_page_post_meta'
		) );
	}

	public function sanitize_archive_content_block() {
		$this->update_fieldset( array(
			'archive_featured_image',
			'archive_meta'
		) );
	}

	public function sanitize_search_page_content_block() {
		$this->update_fieldset( array(
			'search_page_post_featured_image',
			'search_page_post_meta',
		) );
	}

	public function is_sortable() {
		$is_sortable = true;
		if ( 'general' == $this->get_current_section() ) {
			$is_sortable = false;
		}
		return $is_sortable;
	}

	public function get_section_callback( $id ) {
		return array( $this, 'section_callback' );
	}

	public function section_callback( $page, $section ) {
		global $wp_settings_fields;

		if ( ! isset( $wp_settings_fields[ $page ][ $section ] ) ) {
			return;
		}
		$row_id = 0;
		foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
			$class = '';

			if ( ! method_exists( $field['callback'][0], $field['callback'][1] ) ) {
				continue;
			}

			if ( ! empty( $field['args']['class'] ) ) {
				$class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
			}

			echo "<tr data-name='{$field['id']}' id='pos_{$row_id}' {$class}>";
			echo '<th class="drag"></th>';
			if ( ! empty( $field['args']['label_for'] ) ) {
				echo '<th scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></th>';
			} else {
				echo '<th scope="row">' . $field['title'] . '</th>';
			}

			echo '<td>';
			call_user_func( $field['callback'], $field['args'] );
			echo '</td>';
			echo '</tr>';
			$row_id ++;
		}
	}

}
