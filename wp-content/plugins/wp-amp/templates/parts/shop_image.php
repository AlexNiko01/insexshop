<?php
echo ( $this->options->get( 'shop_image' ) ) ? $this->render_element( 'image', $this->featured_image ) : '';