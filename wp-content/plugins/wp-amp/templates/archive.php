<?php
/**
 * The Template for displaying Archive Page
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/archive.php.
 *
 * @var $this AMPHTML_Template
 */
?>
<div class="amphtml-content" >
	<?php foreach ( $this->get_blocks() as $element ): ?>
		<?php echo $this->render( $element ); ?>
	<?php endforeach; ?>
</div>
<?php echo $this->render('pagination'); ?>


