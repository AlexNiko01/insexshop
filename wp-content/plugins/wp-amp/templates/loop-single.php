<?php
/**
 * The Template for render AMP HTML page loop content
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/loop-single.php.
 *
 * @var $this AMPHTML_Template
 */

$post_link = $this->get_amphtml_link( get_permalink() );
?>

<div class="amphtml-content">
	<h2 class="amphtml-title">
		<a href="<?php echo $post_link; ?>"
		   title="<?php echo wp_kses_data( $this->title ); ?>">
			<?php echo wp_kses_data( $this->title ); ?>
		</a>
	</h2>
	<?php if ( $this->is_featured_image() ): ?>
		<?php echo $this->render_element( 'image', $this->featured_image ) ?>
	<?php endif; ?>
	<?php if ( $this->is_enabled_meta() ): ?>
		<ul class="amphtml-meta">
			<?php echo $this->get_post_meta() ?>
		</ul>
	<?php endif; ?>
	<?php $read_mode = ' ... <a href="' . $post_link . '">' . __( 'Read more', 'amphtml' ) . '</a>' ?>
	<?php $desc = !empty( $this->properties['post']->post_excerpt ) ? $this->properties['post']->post_excerpt : $this->content; ?>
	<?php echo wp_trim_words( $desc, 100, $read_mode ); ?>
</div>