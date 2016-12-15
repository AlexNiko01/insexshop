<?php
/**
 * The Template for displaying AMP HTML ad code
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/ad.php.
 *
 * @var $this AMPHTML_Template
 */
?>
<?php
$data_client = $this->options->get( 'ad_data_id_client_bottom' );
$data_slot   = $this->options->get( 'ad_adsense_data_slot_bottom' );
?>
<?php if ( empty( $data_client ) ): ?>
	<!--data client is empty -->
<?php endif; ?>
<?php if ( empty( $data_client ) ): ?>
	<!--data client is empty -->
<?php endif; ?>
<?php if ( $this->options->get( 'ad_enable' ) && ( !empty( $data_client ) ) && ( !empty( $data_slot ) ) ): ?>
	<p class="amphtml-ad">
		<amp-ad  type="<?php echo $this->options->get( 'ad_type_bottom' ) ?>"
		        width=<?php echo $this->options->get( 'ad_bottom_width' ) ?>
		        height=<?php echo $this->options->get( 'ad_bottom_height' ) ?>
		        layout=responsive
			<?php if ( 'doubleclick' == $this->options->get( 'ad_type_bottom' ) ): ?>
				data-slot="<?php echo $this->options->get( 'ad_doubleclick_data_slot_bottom' ) ?>"
			<?php elseif ( 'adsense' == $this->options->get( 'ad_type_bottom' ) ): ?>
				data-ad-client="<?php echo $data_client; ?>"
				data-ad-slot="<?php echo $data_slot; ?>"
			<?php endif; ?>
		></amp-ad>
	</p>
<?php endif; ?>