<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_Appearance extends AMPHTML_Tab_Abstract {

	public function get_fields() {
		return array_merge(
			$this->get_color_fields( 'colors' ),
			$this->get_font_fields( 'fonts' ),
			$this->get_header_fields( 'header' ),
			$this->get_footer_fields( 'footer' ),
			$this->get_post_meta_data_fields( 'post_meta_data' ),
			$this->get_social_share_buttons_fields( 'social_share_buttons' )
		);
	}

	public function get_sections() {
		return array(
			'colors'                => __( 'Colors', 'amphtml' ),
			'fonts'                 => __( 'Fonts', 'amphtml' ),
			'header'                => __( 'Header', 'amphtml' ),
			'footer'                => __( 'Footer', 'amphtml' ),
			'post_meta_data'        => __( 'Post Meta Data', 'amphtml' ),
			'social_share_buttons'  => __( 'Social Share Buttons', 'amphtml' )
		);
	}

	public function get_font_fields( $section ) {
		return array(
			array(
				'id'                    => 'logo_font',
				'title'                 => __( 'Logo', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'logo_font' ),
				'section'               => $section
			),
			array(
				'id'                    => 'menu_font',
				'title'                 => __( 'Menu', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'menu_font' ),
				'section'               => $section
			),
			array(
				'id'                    => 'title_font',
				'title'                 => __( 'Title', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'title_font' ),
				'section'               => $section
			),
			array(
				'id'                    => 'post_meta_font',
				'title'                 => __( 'Post Meta', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'post_meta_font' ),
				'section'               => $section
			),
			array(
				'id'                    => 'content_font',
				'title'                 => __( 'Content', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'content_font' ),
				'section'               => $section
			),
			array(
				'id'                    => 'footer_font',
				'title'                 => __( 'Footer', 'amphtml' ),
				'default'               => 'Merriweather',
				'description'           => '',
				'display_callback'      => array( $this, 'display_font_select' ),
				'display_callback_args' => array( 'footer_font' ),
				'section'               => $section
			),
		);
	}

	public function get_color_fields( $section ) {
		$fields = array(
			array(
				'id'                    => 'header_color',
				'title'                 => __( 'Header Background', 'amphtml' ),
				'default'               => '#0087be',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'header_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_header_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'footer_color',
				'title'                 => __( 'Footer Background', 'amphtml' ),
				'default'               => '#0087be',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'footer_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_footer_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'background_color',
				'title'                 => __( 'Page Background', 'amphtml' ),
				'default'               => '#FFFFFF',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'background_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_background_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'main_title_color',
				'title'                 => __( 'Main Title', 'amphtml' ),
				'default'               => '#2e4453',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'main_title_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_main_title_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'link_color',
				'title'                 => __( 'Link Text', 'amphtml' ),
				'default'               => '#0087be',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'link_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_link_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'main_text_color',
				'title'                 => __( 'Main Text', 'amphtml'),
				'default'               => '#3d596d',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'main_text_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_main_text_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'header_text_color',
				'title'                 => __( 'Header Text', 'amphtml' ),
				'default'               => '#FFFFFF',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'header_text_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_header_text_color' ),
				'section'               => $section
			),
			array(
				'id'                    => 'footer_text_color',
				'title'                 => __( 'Footer Text', 'amphtml' ),
				'default'               => '#FFFFFF',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'footer_text_color' ),
				'sanitize_callback'     => array( $this, 'sanitize_footer_text_color' ),
				'section'               => $section
			),
		);
		$fields = apply_filters( 'amphtml_color_fields', $fields, $this, $section );
		return $fields;
	}

	public function get_header_fields( $section ) {
		return array(
			array(
				'id'                    => 'header_menu',
				'title'                 => __( 'Header Menu', 'amphtml' ),
				'default'               => 1,
				'description'           => '',
				'display_callback'      => array( $this, 'display_header_menu' ),
				'section'               => $section
			),
			array(
				'id'                    => 'logo_opt',
				'title'                 => __( 'Logo Type', 'amphtml' ),
				'default'               => 'text_logo',
				'description'           => '',
				'display_callback'      => array( $this, 'display_logo_opt' ),
				'section'               => $section
			),
			array(
				'id'                    => 'logo_text',
				'title'                 => __( 'Logo Text', 'amphtml'),
				'default'               => get_bloginfo( 'name' ),
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'logo_text' ),
				'description'           => '',
				'section'               => $section
			),
			array(
				'id'                    => 'logo',
				'title'                 => __( 'Logo Icon', 'amphtml' ),
				'description'           => '',
				'display_callback'      => array( $this, 'display_logo' ),
				'section'               => $section
			),
		);
	}

	public function get_footer_fields( $section ) {
		return array(
			array(
				'id'                => 'footer_content',
				'title'             => __( 'Footer Content', 'amphtml'),
				'default'           => '',
				'section'           => $section,
				'display_callback'  => array( $this, 'display_footer_content' ),
				'sanitize_callback' => array( $this, 'sanitize_footer_content' ),
				'description'       => __( 'This is the footer content block for all AMP pages. <br>'
				                 . 'Leave empty to hide footer at all. <br>'
				                 . 'Plain html without inline styles allowed. '
				                 . '(<a href="https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md#html5-tag-whitelist" target="_blank">HTML5 Tag Whitelist</a>)', 'amphtml' ),
			),
		);
	}

	public function get_post_meta_data_fields( $section ) {
		return array(
			array(
				'id'                    => 'post_meta_author',
				'title'                 => __( 'Author', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_meta_author' ),
				'section'               => $section,
				'description'           => __( 'Show post author', 'amphtml' ),
			),
			array(
				'id'                    => 'post_meta_categories',
				'title'                 => __( 'Categories', 'amphtml'),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_meta_categories' ),
				'section'               => $section,
				'description'           => __( 'Show post categories', 'amphtml' ),
			),
			array(
				'id'                    => 'post_meta_tags',
				'title'                 => __( 'Tags', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'post_meta_tags' ),
				'section'               => $section,
				'description'           => __( 'Show post tags', 'amphtml' ),
			),
			array(
				'id'                    => 'post_meta_date_format',
				'title'                 => __( 'Date Format', 'amphtml'),
				'default'               => 'default',
				'display_callback'      => array( $this, 'display_date_format' ),
				'section'               => $section,
				'description'           => '(<a href="https://codex.wordpress.org/Formatting_Date_and_Time#Examples">Examples of Date Format</a>)',
			),
			array(
				'id'                    => 'post_meta_date_format_custom',
				'title'                 => '',
				'display_callback'      => array( $this, 'display_date_format_custom' ),
				'section'               => $section,
				'description'           => '',
			),
		);
	}

	public function get_social_share_buttons_fields( $section ) {
		return array(
			array(
				'id'                    => 'social_share_buttons',
				'title'                 => __( 'Social Share Buttons', 'amphtml' ),
				'default'               => array( 'facebook', 'twitter', 'linkedin', 'gplus' ),
				'display_callback'      => array( $this, 'display_multiple_select' ),
				'display_callback_args' => array(
					'id' => 'social_share_buttons',
					'select_options' => array(
						'facebook'  => __( 'Facebook', 'amphtml' ),
						'twitter'   => __( 'Twitter', 'amphtml' ),
						'linkedin'  => __( 'LinkedIn', 'amphtml' ),
						'gplus'     => __( 'Google Plus', 'amphtml' ),
					)
				),
				'section'               => $section,
			),
		);
	}

	public function display_date_format_custom() {
		return '';
	}

	/*
	 * Color Section
	 */
	public function sanitize_background_color( $background_color ) {
		return $this->sanitize_header_color( $background_color, 'background_color' );
	}

	public function sanitize_header_color( $header_color, $id = 'header_color' ) {

		// Validate Background Color
		$background = trim( $header_color );
		$background = strip_tags( stripslashes( $background ) );

		// Check if is a valid hex color
		if ( false === $this->options->check_header_color( $background ) ) {
			add_settings_error( $this->options->get( $id, 'name' ), 'hc_error', __( 'Insert a valid color', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( $id );

		} else {
			$valid_field = $background;
		}

		return $valid_field;
	}

	public function sanitize_link_color( $link_color ) {
		return $this->sanitize_header_color( $link_color, 'link_color' );
	}

	public function sanitize_add_to_cart_button_color( $add_to_cart_button_color ) {
		return $this->sanitize_header_color( $add_to_cart_button_color, 'add_to_cart_button_color' );
	}

	public function sanitize_main_text_color( $main_text_color ) {
		return $this->sanitize_header_color( $main_text_color, 'main_text_color' );
	}

	public function sanitize_main_title_color( $main_title_color ) {
		return $this->sanitize_header_color( $main_title_color, 'main_title_color' );
	}

	public function sanitize_header_text_color( $main_text_color ) {
		return $this->sanitize_header_color( $main_text_color, 'header_text_color' );
	}

	public function sanitize_footer_text_color( $main_text_color ) {
		return $this->sanitize_header_color( $main_text_color, 'footer_text_color' );
	}

	public function sanitize_footer_color( $footer_color ) {
		return $this->sanitize_header_color( $footer_color, 'footer_color' );
	}

	/*
	 *  Font Section
	 */
	public function get_fonts_list() {
		return array(
			'Work Sans',
			'Alegreya',
			'Fira Sans',
			'Lora',
			'Merriweather',
			'Open Sans',
			'Roboto',
			'Lato',
			'Cardo',
			'Arvo',
		);
	}

	public function display_font_select( $args ) {
	$id = current( $args );
	?>
	<label for="<?php echo $id ?>">
		<select style="width: 28%" id="<?php echo $id ?>" name="<?php echo $this->options->get( $id, 'name' ) ?>">
			<?php foreach( $this->get_fonts_list() as $title ): ?>
				<?php $name = str_replace(' ', '+', $title )  ?>
				<option value="<?php echo $name ?>" <?php selected( $this->options->get( $id ), $name ) ?>>
					<?php printf( __( '%s', 'amphtml' ), $title ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</label>
	<?php
	}

	/*
	 *  Header Section
	 */
	public function display_header_menu() {
		$this->display_checkbox_field( array('header_menu') );
		$locations = add_query_arg( array( 'action' => 'locations' ), admin_url( 'nav-menus.php' ) );

		_e( 'Show header menu', 'amphtml' );
		echo ' (<a href="' . $locations . '" target="_blank">';
		_e( 'set AMP menu', 'amphtml' );
		echo '</a>)';

	}

	public function display_logo_opt() {
		?>
		<label for="logo_opt">
		<select style="width: 28%" id="logo_opt" name="<?php echo $this->options->get( 'logo_opt', 'name' ) ?>">
			<option value="icon_logo" <?php selected( $this->options->get( 'logo_opt' ), 'icon_logo' ) ?>>
				<?php _e( 'Icon Logo', 'amphtml' ); ?>
			</option>
			<option value="text_logo" <?php selected( $this->options->get( 'logo_opt' ), 'text_logo' ) ?>>
				<?php _e( 'Text Logo', 'amphtml' ); ?>
			</option>
			<option value="icon_an_text" <?php selected( $this->options->get('logo_opt'), 'icon_an_text' ) ?>>
				<?php _e( 'Icon and Text Logo', 'amphtml' ); ?>
			</option>
			<option value="image_logo" <?php selected( $this->options->get('logo_opt'), 'image_logo' ) ?>>
			    <?php _e( 'Image Logo', 'amphtml' ); ?>
			</option>
		</select>
		<?php
	}

	public function display_logo() {
		?>
		<label for="upload_image">
			<p class="logo_preview" <?php if ( ! $this->options->get( 'logo' ) ): echo 'style="display:none"'; endif; ?>>
				<img src="<?php echo esc_url( $this->options->get( 'logo' ) ); ?>" alt="<?php _e( 'Site Logo', 'amphtml' ) ?>"
				     style="width: auto; height: 100px">
			</p>
			<input class="upload_image" type="hidden" name="<?php echo $this->options->get( 'logo', 'name' ) ?>"
			       value="<?php echo esc_url( $this->options->get( 'logo' ) ); ?>"/>
			<input class="upload_image_button button" type="button" value="<?php _e( 'Upload Image', 'amphtml' ) ?>"/>
			<input <?php if ( ! $this->options->get( 'logo' ) ): echo 'style="display:none"'; endif; ?>
				class="reset_image_button button" type="button" value="<?php _e( 'Reset Image', 'amphtml' ) ?>"/>
			<p class="img_text_size_full" style="display:none" ><?php _e( 'The image will be have full size.', 'amphtml' ) ?></p>
			<p class="img_text_size" ><?php _e( 'The image will be resized to fit in a 32x32 box (but not cropped)', 'amphtml' ) ?></p>
		</label>
		<?php
	}

	/*
	 * Footer Section
	 */
	public function sanitize_footer_content( $footer_content ) {
		$tags        = wp_kses_allowed_html( 'post' );
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
		$content = wp_kses( $footer_content, $tags );

		if ( $content !== $footer_content ) {
			add_settings_error( $this->options->get( 'footer_content', 'name' ), 'hc_error', __( 'Content contains disallowed tags. Please correct and try again.', 'amphtml' ), 'error' );
			$valid_field = $this->options->get( 'footer_content' );
		} else {
			$valid_field = $content;
		}

		return $valid_field;
	}

	public function display_footer_content() {
		?>
		<textarea name="<?php echo $this->options->get( 'footer_content', 'name' ) ?>" rows="6" cols="60"><?php echo trim( $this->options->get( 'footer_content' ) ); ?></textarea>
		<?php if ( $this->options->get( 'footer_content', 'description' ) ): ?>
			<p class="description"><?php _e( $this->options->get( 'footer_content', 'description' ), 'amphtml' ) ?></p>
		<?php endif;
	}

	public function display_date_format() {
	?>
	<fieldset><legend class="screen-reader-text"><span><?php _e('Date Format', 'amphtml') ?></span></legend>
	<?php

	$custom = true;

	echo "\t<label><input type='radio' name='". $this->options->get( 'post_meta_date_format', 'name' ). "' value='none'";
	if ( 'none' === $this->options->get( 'post_meta_date_format' ) ) {
		echo " checked='checked'";
		$custom = false;
	}
	echo ' /></span> ' . __('None', 'amphtml' ) . "</label><br />\n";


	echo "\t<label><input type='radio' name='". $this->options->get( 'post_meta_date_format', 'name' ). "' value='relative'";
	if ( 'relative' === $this->options->get( 'post_meta_date_format' ) ) {
		echo " checked='checked'";
		$custom = false;
	}

	echo ' /> <span class="date-time-text format-i18n">'
	. esc_html( sprintf( _x( '%s ago', '%s = human-readable time difference', 'amphtml' ), human_time_diff( get_the_date( ) )) )
	. '</span> (' . __('Relative', 'amphtml') . ")</label><br />\n";


	echo "\t<label><input type='radio' name='". $this->options->get( 'post_meta_date_format', 'name' ). "' value='default'";
	if ( 'default' === $this->options->get( 'post_meta_date_format' ) ) {
		echo " checked='checked'";
		$custom = false;
	}
	echo ' /> <span class="date-time-text format-i18n">' . date_i18n( get_option('date_format') ) . '</span> (' . __('Default system format', 'amphtml' ) . ")</label><br />\n";

	$custom_value = strlen( get_option( 'amphtml_post_meta_date_format_custom' ) ) ? get_option( 'amphtml_post_meta_date_format_custom' ) : __( 'F j, Y', 'amphtml' );

	echo '<label><input type="radio" name="'. $this->options->get( 'post_meta_date_format', 'name' ) .'" id="date_format_custom_radio" value="custom"';
	checked( $custom );
	echo '/> <span class="date-time-text date-time-custom-text">' . __( 'Custom:', 'amphtml' ) . ' <span class="screen-reader-text"> ' . __( 'enter a custom date format in the following field', 'amphtml' ) . '</span></label>' .
		'<label for="date_format_custom" class="screen-reader-text">' . __( 'Custom date format:', 'amphtml' ) . '</label>' .
		'<input type="text" name="amphtml_post_meta_date_format_custom" id="amphtml_date_format_custom" value="' . esc_attr( $custom_value ) . '" style="width:60px" /></span>' .
		'<span class="screen-reader-text">' . __( 'example:', 'amphtml' ) . ' </span> <span class="example">' . date_i18n( $custom_value ) . '</span>' .
		"<span class='spinner'></span>\n";
	?>
	<span class="description"><?php _e( $this->options->get( 'post_meta_date_format', 'description' ), 'amphtml' ) ?></span>
	</fieldset>
	<?php
	}

	public function get_submit() {
		?>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __( 'Save Changes', 'amphtml' ); ?>">
			<?php if ( 'colors' == $this->get_current_section() ): ?>
					<input type="submit" name="reset" id="reset" class="button"
					value="<?php echo __( 'Default theme settings', 'amphtml' ); ?>" style="margin-left: 10px;"
					onclick="return confirm('Your changes will be overridden. Are you sure?')">
			<?php endif; ?>
		</p>
	<?php
	}

}