<?php
$post_link = $this->get_amphtml_link( get_permalink() );
$read_mode = ' ... <a href="' . $post_link . '">' . __( 'Read more', 'amphtml' ) . '</a>'
?>

<div>
	<?php echo ( $this->options->get( 'shop_short_desc' ) ) ? wp_trim_words( $this->content, 100, $read_mode ) : ''; ?>
</div>
