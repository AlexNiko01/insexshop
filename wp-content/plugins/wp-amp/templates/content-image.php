<?php
/**
 * The Template for render AMP HTML page images
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/image.php.
 *
 * @var $this AMPHTML_Template
 */
//todo remove
?>
<p>
	<amp-img
		<?php foreach ( $element->attr as $attr => $value ): ?>
			<?php echo ( $value ) ? sprintf( "%s='%s'", $attr, $value ) : ''; ?>
		<?php endforeach; ?>
	>
	</amp-img>
</p>