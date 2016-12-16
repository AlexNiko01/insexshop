<?php
/**
 * The Base Template for displaying AMP HTML page.
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/base.php.
 *
 * @var $this AMPHTML_Template
 */
?>
<!doctype html>
<html amp>
<head>
	<?php echo $this->render( 'header' ) ?>
</head>

<body>
<div class="wrapper">
	<nav class="amphtml-title">
		<?php echo $this->render( 'nav' ) ?>
	</nav>
	<div id="main">
		<div class="inner">
			<?php do_action( AMPHTML::TEXT_DOMAIN . '_template_content' ); ?>
		</div>
	</div>
	<?php $footer = $this->get_footer(); ?>
	<?php if ( $footer ): ?>
		<div class="footer">
			<div class="inner">
				<?php echo $footer; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( $this->google_analytics ): ?>
		<?php echo $this->render( 'google-analitycs' ); ?>
	<?php endif; ?>
</div>

</body>
</html>