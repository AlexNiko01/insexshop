<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_Extra_Css extends AMPHTML_Tab_Abstract {

	public function get_fields() {
		return array (
			array (
				'id'                    => 'extra_css_amp',
				'placeholder'           => __( 'Enter Your CSS Code', 'amphtml' ),
				'title'                 => __( 'Extra CSS', 'amphtml' ),
				'display_callback'      => array ( $this, 'display_textarea_field' ),
				'display_callback_args' => array ( 'extra_css_amp' ),
				'description'           => '',
			)
		);
	}

	public function display_textarea_field( $args ) {
		$id = current( $args );
		?>
		<textarea name="<?php echo $this->options->get( 'extra_css_amp', 'name' ) ?>" id="amp_css_entry"
		          style="width:100%;height:300px;"
			<?php echo ( $this->options->get( $id, 'placeholder' ) ) ? 'placeholder="' . $this->options->get( $id, 'placeholder' ) . '"' : '' ?>><?php
			echo esc_attr( $this->options->get( 'extra_css_amp' ) ); ?></textarea>
		<?php if ( $this->options->get( $id, 'description' ) ): ?>
			<p class="description"><?php esc_html_e( $this->options->get( $id, 'description' ), 'amphtml' ) ?></p>
		<?php endif;

	}

}