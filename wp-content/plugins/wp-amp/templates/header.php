<?php
/**
 * The Template for render AMP HTML page header
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/header.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo esc_html( $this->doc_title ); ?></title>

<?php echo $this->render( 'amp-boilerplate' ) ?>


<script async src="https://cdn.ampproject.org/v0.js"></script>

<?php foreach ( $this->get_embedded_elements() as $element ): ?>
	<?php echo $this->render_element( 'extended-component', $element ) ?>
<?php endforeach; ?>

<?php do_action( AMPHTML::TEXT_DOMAIN . '_template_head', $this ); ?>

<link rel="canonical" href="<?php echo $this->get_canonical_url(); ?>">

<style amp-custom>
	<?php  echo $this->get_style( 'style' ). PHP_EOL; ?>
	<?php do_action( AMPHTML::TEXT_DOMAIN. '_template_css', $this ); ?>
</style>
<script type="application/ld+json"><?php echo json_encode( $this->metadata ); ?></script>