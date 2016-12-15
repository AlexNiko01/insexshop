<?php
/**
 * The Template for displaying AMP HTML carousel component images
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/carousel-image.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<?php if ( isset( $element[0] ) ): ?>
	<amp-img src="<?php echo $element[0] ?>"
		<?php echo ( isset( $element[1] ) && $element[1] ) ? 'width=' . $element[1] : ''; ?>
		<?php echo ( isset( $element[2] ) && $element[2] ) ? 'height=' . $element[2] : ''; ?> layout="responsive">
	</amp-img>
<?php endif; ?>