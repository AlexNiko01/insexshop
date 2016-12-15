<?php
/**
 * @var $this AMPHTML_Template
 */
?>
<?php
$count = 3; // related posts count
$related = $this->get_related_posts( $this->post, $count );
?>
<?php if ( $related && $related->have_posts()) : ?>
	<aside>
		<h3><?php _e('You May Also Like', 'amphtml' ) ?></h3>
		<ul>
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
				<?php $link = get_permalink( get_the_id() ); ?>
				<li><a href="<?php echo $this->get_amphtml_link( $link ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
	</aside>
<?php endif;