<?php
/**
 * The Template for displaying Post meta author
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/meta-author.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<?php $author = $this->author; ?>
<li class="amphtml-meta-author">
	<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
		<amp-img src="<?php echo esc_url( get_avatar_url( $author->user_email, array(
			'size' => 24,
		) ) ); ?>" width="24" height="24" layout="fixed"></amp-img>
	<?php endif; ?>
	<a href="<?php echo esc_url( get_author_posts_url( $author->ID ) ) ?>">
		<?php echo esc_html( $author->display_name ); ?>
	</a>
</li>