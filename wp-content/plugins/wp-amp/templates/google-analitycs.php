<?php
/**
 * The Template for including AMP HTML google analytics component
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/google-analytics.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<amp-analytics type="googleanalytics" id="analytics">
	<script type="application/json"><?php echo json_encode( $this->google_analytics ); ?></script>
</amp-analytics>
