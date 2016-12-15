<?php
/**
 * The Template for displaying WooCommerce Archive Pages
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/wc-product-archive.php.
 *
 * @var $this AMPHTML_Template
 */
?>
<header class="page-header">
	<h1 class="amphtml-title"><?php woocommerce_page_title(); ?></h1>
	<?php if( $this->options->get( 'wc_archives_desc' ) ): ?>
		<?php do_action( 'woocommerce_archive_description' ); ?>
	<?php  endif; ?>
</header>

<div>
	<?php
	if ( have_posts() ):
		while ( have_posts() ): the_post();
			$id = get_the_ID();
			$this->set_post( $id );
			echo $this->render( 'wc-content-product' );
		endwhile;
	endif;
	?>
</div>

<?php echo $this->render('pagination'); ?>

