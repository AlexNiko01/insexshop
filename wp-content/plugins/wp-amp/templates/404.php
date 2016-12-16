<?php //todo remove
/**
 * The Template for displaying 404 Page
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/404.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<div class="amphtml-content">
	<h2 class="amphtml-title">
		<?php printf( __( '%s', 'amphtml' ), esc_html( $this->options->get( 'title_404' ) ) ); ?>
	</h2>
	<p><?php printf( __( '%s', 'amphtml' ), esc_html( $this->options->get( 'content_404' ) ) ); ?></p>
	<?php if ( $this->options->get( 'search_form' ) ): ?>
		<p><?php echo $this->render( 'searchform' ); ?></p>
	<?php endif; ?>
</div>