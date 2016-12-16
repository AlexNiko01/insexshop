<?php
/**
 * The Template for displaying Post meta categories
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/meta-cats.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<?php $categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ) ); ?>
<?php if ( $categories ) : ?>
	<li class="amphtml-meta-tax-category">
		<span class="screen-reader-text">Categories:</span>
		<?php echo $categories; ?>
	</li>
<?php endif; ?>
