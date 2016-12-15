<?php
/**
 * The Template for displaying Post meta tags
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/meta-tags.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<?php $tags = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ) ); ?>
<?php if ( $tags ) : ?>
	<li class="amphtml-meta-tax-tag">
		<span class="screen-reader-text">Tags:</span>
		<?php echo $tags; ?>
	</li>
<?php endif; ?>
