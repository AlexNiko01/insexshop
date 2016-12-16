<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_Ad extends AMPHTML_Tab_Abstract {

	public function get_sections() {
		return array(
			'top'    => __( 'Ad Block #1', 'amphtml' ),
			'bottom' => __( 'Ad Block #2', 'amphtml' )
		);
	}

	public function get_fields() {
		return array(
			array(
				'id'                    => 'ad_top_height',
				'title'                 => __( 'Height', 'amphtml' ),
				'section'               => 'top',
				'default'               => '50',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_top_height', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_top_height' ),
				'description'           => __( 'Top ad block height (in pixels)', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_bottom_height',
				'title'                 => __( 'Height', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => '50',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_bottom_height', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_bottom_height' ),
				'description'           => __( 'Bottom ad block height (in pixels)', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_top_width',
				'title'                 => __( 'Width', 'amphtml' ),
				'section'               => 'top',
				'default'               => '200',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_top_width', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_top_width' ),
				'description'           => __( 'Top ad block width (in pixels)', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_bottom_width',
				'title'                 => __( 'Width', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => '200',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_bottom_width', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_bottom_width' ),
				'description'           => __( 'Bottom ad block width (in pixels)', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_type_top',
				'title'                 => __( 'Type', 'amphtml' ),
				'default'               => 'adsense',
				'section'               => 'top',
				'display_callback'      => array( $this, 'display_ad_type' ),
				'display_callback_args' => array( 'ad_type_top' ),
				'description'           => __( 'Top ad network', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_type_bottom',
				'title'                 => __( 'Type', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => 'adsense',
				'display_callback'      => array( $this, 'display_ad_type' ),
				'display_callback_args' => array( 'ad_type_bottom' ),
				'description'           => __( 'Bottom ad network', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_doubleclick_data_slot_bottom',
				'title'                 => __( 'Data Slot', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_doubleclick_data_slot_bottom', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_doubleclick_data_slot_bottom' ),
				'description'           => __( 'data-slot', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_data_id_client_bottom',
				'title'                 => __( 'AdSense Client', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_data_id_client_bottom', true ),
				'description'           => __( 'data-ad-client', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_adsense_data_slot_bottom',
				'title'                 => __( 'Data Slot', 'amphtml' ),
				'section'               => 'bottom',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_adsense_data_slot_bottom', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_adsense_data_slot_bottom' ),
				'description'           => __( 'data-ad-slot', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_doubleclick_data_slot_top',
				'title'                 => __( 'Data Slot', 'amphtml' ),
				'section'               => 'top',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_doubleclick_data_slot_top', true ),
				'sanitize_callback'     => array( $this, 'sanitize_ad_doubleclick_data_slot_top' ),
				'description'           => __( 'data-slot', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_data_id_client_top',
				'title'                 => __( 'AdSense Client', 'amphtml' ),
				'section'               => 'top',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_data_id_client_top', true ),
				'description'           => __( 'data-ad-client', 'amphtml' ),
			),
			array(
				'id'                    => 'ad_adsense_data_slot_top',
				'title'                 => __( 'Data Slot', 'amphtml' ),
				'section'               => 'top',
				'default'               => '',
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'ad_adsense_data_slot_top', true ),
				'description'           => __( 'data-ad-slot', 'amphtml' ),
			),
		);
	}

	public function sanitize_digits( $key, $val, $message ) {
		$val = sanitize_text_field( $val );
		if ( strlen( $val ) === 0 ) {
			return '';
		}
		if ( 0 === preg_match( '/^[1-9][0-9]*$/', $val ) ) {
			add_settings_error( $this->options->get( $key, 'name' ), 'cw_error', $message, 'error' );
			$valid_val = $this->options->get( $key );
		} else {
			$valid_val = $val;
		}

		return $valid_val;
	}

	public function sanitize_ad_top_width( $width ) {
		return $this->sanitize_digits( 'ad_top_width', $width, __( 'Insert a valid ad top block width', 'amphtml' ) );
	}

	public function sanitize_ad_bottom_width( $width ) {
		return $this->sanitize_digits( 'ad_bottom_width', $width, __( 'Insert a valid ad bottom block width', 'amphtml' ) );
	}

	public function sanitize_ad_bottom_height( $height ) {
		return $this->sanitize_digits( 'ad_bottom_height', $height, __( 'Insert a valid ad bottom block height', 'amphtml' ) );
	}

	public function sanitize_ad_top_height( $height ) {
		return $this->sanitize_digits( 'ad_top_height', $height, __( 'Insert a valid ad top block height', 'amphtml' ) );
	}

	public function sanitize_ad_doubleclick_data_slot_bottom( $data_slot ) {
		return sanitize_text_field( $data_slot );
	}

	public function sanitize_ad_doubleclick_data_slot_top( $data_slot ) {
		return sanitize_text_field( $data_slot );
	}

	public function sanitize_ad_adsense_data_slot_bottom( $data_slot ) {
		return $this->sanitize_digits( 'ad_adsense_data_slot_bottom', $data_slot, __( 'Insert a valid ad adsense data slot', 'amphtml' ) );
	}

	public function sanitize_ad_adsense_data_slot_top( $data_slot ) {
		return $this->sanitize_digits( 'ad_adsense_data_slot_top', $data_slot, __( 'Insert a valid ad adsense data slot', 'amphtml' ) );
	}


	public function display_ad_type( $args ) {
		$id = current( $args );
		?>
		<label for="ad_type">
			<select style="width: 28%" id="<?php echo $id ?>" name="<?php echo $this->options->get( $id, 'name' ) ?>">
				<option value="adsense" <?php selected( $this->options->get( $id ), 'adsense' ) ?>>
					<?php _e( 'AdSense', 'amphtml' ); ?>
				</option>
				<option value="doubleclick" <?php selected( $this->options->get( $id ), 'doubleclick' ) ?>>
					<?php _e( 'Doubleclick', 'amphtml' ); ?>
				</option>
			</select>
			<p class="description"><?php esc_html_e( $this->options->get( $id, 'description' ), AMPHTML::TEXT_DOMAIN ) ?></p>
		</label>
		<?php
	}

}