<?php
/**
 * The Template for displaying AMP HTML header logo and navigation menu
 *
 * This template can be overridden by copying it to yourtheme/wp-amp/nav.php.
 *
 * @var $this AMPHTML_Template
 */
?>

<div class="header">
	<div class="logo">
		<a href="<?php  echo esc_url( $this->get_logo_link() ); ?>">
			<?php if ( in_array( $this->options->get( 'logo_opt' ), array( 'icon_logo', 'icon_an_text' )) && $this->logo ) : ?>
				<amp-img src="<?php echo esc_url( $this->logo ); ?>" width="32" height="32"
				         class="amphtml-site-icon"></amp-img>
			<?php endif; ?>
			<?php if ( in_array( $this->options->get( 'logo_opt' ), array ( 'image_logo' ) ) && $this->logo ) : ?>
				<?php $size = $this->get_image_size_from_url($this->logo); ?>
				<amp-img src="<?php echo esc_url( $this->logo ); ?>" width="<?php echo $size['width']; ?>"
				         height="<?php echo $size['height']; ?>" class="amphtml-site-icon"></amp-img>
			<?php endif; ?>
			<?php if ( in_array( $this->options->get( 'logo_opt' ), array( 'text_logo', 'icon_an_text' )) && $this->blog_name ): ?>
				<?php echo esc_html( $this->blog_name ); ?>
			<?php endif; ?>
		</a>
	</div>
	<?php if ( $this->options->get( 'header_menu' ) ): ?>
		<amp-accordion>
			<section>
				<h4 class="accordion-header hamburger">
					<?php _e('Меню', 'amphtml' ) ?>
				</h4>
				<div class="main-navigation">
					<?php echo $this->nav_menu(); ?>
				</div>
			</section>
		</amp-accordion>
	<?php else: ?>
		<div class="hamburger"></div>
	<?php endif ?>
</div>