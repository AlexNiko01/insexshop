<?php $buttons = $this->options->get( 'social_share_buttons' ); ?>
<?php if ( $buttons ): ?>
	<div class="social-box">
		<?php foreach ( $buttons as $social_link ): ?>
			<amp-social-share
				type="<?php echo $social_link ?>" <?php echo ( 'facebook' == $social_link ) ? 'data-param-app_id="145634995501895"' : '' ?>
			>
			</amp-social-share>
		<?php endforeach; ?>
	</div>
<?php endif; ?>