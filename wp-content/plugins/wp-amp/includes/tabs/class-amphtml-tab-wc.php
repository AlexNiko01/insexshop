<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_Tab_Wc extends AMPHTML_Tab_Abstract {

		public function __construct( $name, $options, $is_current ) {
		parent::__construct( $name, $options, $is_current );
		if ( $this->is_current() && 'wc_archives' == $this->get_current_section() ) {
			add_action( 'amphtml_after_settings_form', array( $this, 'add_sortable_archives' ) );
		} else if( $this->is_current() && 'add_to_cart' !== $this->get_current_section() ) {
			add_action( 'amphtml_after_settings_form', array( $this, 'add_sortable' ) );
		}
		if ( $this->is_ajax() ) {
			$this->save_order();
		}
	}

	public function get_sections() {
		return array(
			'product'     => __( 'Product Page', 'amphtml' ),
			'shop'        => __( 'Shop Page', 'amphtml' ),
			'wc_archives' => __(  'Product Archives', 'amphtml' ),
			'add_to_cart' => __( 'Add to Cart', 'amphtml' ),
		);
	}

	public function get_fields() {
		return array_merge(
			$this->get_add_to_cart_fields( 'add_to_cart' ),
			$this->get_product_fields( 'product' ),
			$this->get_shop_fields( 'shop' ),
			$this->get_archives_fields( 'wc_archives' )
		);
	}

	public function get_product_fields( $section ) {
		return array(
			array(
				'id'                    => 'product_image',
				'title'                 => __( 'Image', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_image' ),
				'section'               => $section,
				'description'           => __( 'Show product image', 'amphtml' ),
			),
			array(
				'id'                    => 'product_title',
				'title'                 => __( 'Title', 'amphtml'),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_title', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'product_sku',
				'title'                 => __( 'SKU', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_sku' ),
				'section'               => $section,
				'description'           => __( 'Show product SKU', 'amphtml' ),
			),
			array(
				'id'                    => 'product_add_to_cart_block',
				'title'                 => __( 'Add To Cart Block', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_add_to_cart_block' ),
				'sanitize_callback'     => array( $this, 'sanitize_add_to_cart_block' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'product_price',
				'title'                 => __( 'Price', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'product_price', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => __( 'Show product price', 'amphtml' ),
			),
			array(
				'id'                    => 'product_stock_status',
				'title'                 => __( 'Stock Status', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'product_stock_status' ),
				'section'               => $section,
				'description'           => __( 'Show product stock status', 'amphtml' ),
			),
			array(
				'id'                    => 'product_add_to',
				'title'                 => __( 'Add To Cart', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'product_add_to', 'disabled', 'checked' ),
				'section'               => $section,
				'description'           => __( 'Show add to cart button', 'amphtml' ),
			),
			array(
				'id'                    => 'product_categories',
				'title'                 => __( 'Categories', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_categories' ),
				'section'               => $section,
				'description'           => __( 'Show product categories', 'amphtml' ),
			),
			array(
				'id'                    => 'product_tags',
				'title'                 => __( 'Tags', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_tags' ),
				'section'               => $section,
				'description'           => __( 'Show product tags', 'amphtml' ),
			),
			array(
				'id'                    => 'product_short_desc',
				'title'                 => __( 'Short Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_short_desc' ),
				'section'               => $section,
				'description'           => __( 'Show product short description', 'amphtml' ),
			),
			array(
				'id'                    => 'product_desc',
				'title'                 => __( 'Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_desc' ),
				'section'               => $section,
				'description'           => __( 'Show product description', 'amphtml' ),
			),
			array(
				'id'                    => 'product_social_share',
				'title'                 => __( 'Social Share Buttons', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'product_social_share' ),
				'section'               => $section,
				'description'           => __( 'Show social share buttons', 'amphtml'),
			)
		);
	}

	public function get_shop_fields( $section ) {
		return array(
			array(
				'id'                    => 'shop_image',
				'title'                 => __( 'Image', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'shop_image' ),
				'section'               => $section,
				'description'           => __( 'Show product images', 'amphtml' ),
			),
			array(
				'id'                    => 'shop_short_desc',
				'title'                 => __( 'Short Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'shop_short_desc' ),
				'section'               => $section,
				'description'           => __( 'Show product short descriptions', 'amphtml' ),
			),
			array(
				'id'                    => 'shop_add_to_cart_block',
				'title'                 => __( 'Add To Cart Block', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_shop_add_to_cart_block' ),
				'sanitize_callback'     => array( $this, 'sanitize_shop_add_to_cart_block' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'shop_price',
				'title'                 => __( 'Price', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'shop_price' ),
				'section'               => $section,
				'description'           => __( 'Show product prices', 'amphtml' ),
			),
			array(
				'id'                    => 'shop_add_to_cart',
				'title'                 => __( 'Add to Cart', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'shop_add_to_cart' ),
				'section'               => $section,
				'description'           => __( 'Show "Add to Cart" button', 'amphtml' ),
			)
		);
	}

	public function get_archives_fields( $section ) {
		return array(
			array(
				'id'                    => 'wc_archives_desc',
				'title'                 => __( 'Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'wc_archives_desc' ),
				'section'               => $section,
				'description'           => __( 'Show description of archive page', 'amphtml' ),
			),
			array(
				'id'                    => 'wc_archives_image',
				'title'                 => __( 'Image', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'wc_archives_image' ),
				'section'               => $section,
				'description'           => __( 'Show product images', 'amphtml' ),
			),
			array(
				'id'                    => 'wc_archives_short_desc',
				'title'                 => __( 'Short Description', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_checkbox_field' ),
				'display_callback_args' => array( 'wc_archives_short_desc' ),
				'section'               => $section,
				'description'           => __( 'Show product short descriptions', 'amphtml' ),
			),
			array(
				'id'                    => 'wc_archives_add_to_cart_block',
				'title'                 => __( 'Add To Cart Block', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, 'display_wc_archives_add_to_cart_block' ),
				'sanitize_callback'     => array( $this, 'sanitize_wc_archives_add_to_cart_block' ),
				'section'               => $section,
				'description'           => '',
			),
			array(
				'id'                    => 'wc_archives_price',
				'title'                 => __( 'Price', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'wc_archives_price' ),
				'section'               => $section,
				'description'           => __( 'Show product prices', 'amphtml' ),
			),
			array(
				'id'                    => 'wc_archives_add_to_cart',
				'title'                 => __( 'Add to Cart', 'amphtml' ),
				'default'               => 1,
				'display_callback'      => array( $this, '' ),
				'display_callback_args' => array( 'wc_archives_add_to_cart' ),
				'section'               => $section,
				'description'           => __( 'Show "Add to Cart" button', 'amphtml' ),
			)
		);
	}

	public function get_add_to_cart_fields( $section ) {
		return array(
			array(
				'id'                    => 'add_to_cart_text',
				'title'                 => __( 'Add to Cart Text', 'amphtml' ),
				'default'               => __( 'Add To Cart', 'amphtml' ),
				'section'               => $section,
				'display_callback'      => array( $this, 'display_text_field' ),
				'display_callback_args' => array( 'add_to_cart_text' ),
				'description'           => __( '"Add to Cart" button text', 'amphtml' )
			),
			array(
				'id'               => 'add_to_cart_behav',
				'title'            => __( 'Add to Cart Behavior', 'amphtml' ),
				'default'          => 'add_to_cart',
				'section'          => $section,
				'display_callback' => array( $this, 'display_add_to_cart_behav' ),
				'description'      => __( '"Add to Cart" button click action', 'amphtml' ),
			),
		);
	}

	/*
	 * Add To Cart Section
	 */
	public function display_add_to_cart_behav() {
		?>
		<label for="logo_opt">
		<select style="width: 28%" id="add_to_cart_behav"
		        name="<?php echo $this->options->get( 'add_to_cart_behav', 'name' ) ?>">
			<option value="add_to_cart" <?php selected( $this->options->get( 'add_to_cart_behav' ), 'add_to_cart' ) ?>>
				<?php _e( 'Add To Cart And Redirect', 'amphtml' ); ?>
			</option>
			<option value="redirect" <?php selected( $this->options->get( 'add_to_cart_behav' ), 'redirect' ) ?>>
				<?php _e( 'Redirect', 'amphtml' ); ?>
			</option>
		</select>
		<p class="description"><?php esc_html_e( $this->options->get( 'add_to_cart_behav', 'description' ), 'amphtml' ) ?></p>
		<?php
	}

	public function display_add_to_cart_block() {
	?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Add To Cart Block', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'product_price', 'disabled', 'checked' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'product_stock_status' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'product_add_to', 'disabled', 'checked' ) ); ?></p>
		</fieldset>
	<?php
	}

	public function sanitize_add_to_cart_block() {
		$this->update_fieldset( array( 'product_stock_status' ) );
	}

	public function display_wc_archives_add_to_cart_block() {
	?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Add To Cart Block', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'wc_archives_price' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'wc_archives_add_to_cart' ) ); ?></p>
		</fieldset>
	<?php
	}

	public function sanitize_wc_archives_add_to_cart_block() {
		$this->update_fieldset( array(
			'wc_archives_price',
			'wc_archives_add_to_cart'
		) );
	}

	public function display_shop_add_to_cart_block() {
	?>
		<fieldset>
			<legend class="screen-reader-text">
				<span><?php _e( 'Add To Cart Block', 'amphtml' ) ?></span>
			</legend>
			<p><?php $this->display_checkbox_field( array( 'shop_price' ) ); ?></p>
			<p><?php $this->display_checkbox_field( array( 'shop_add_to_cart' ) ); ?></p>
		</fieldset>
	<?php
	}

	public function sanitize_shop_add_to_cart_block() {
		$this->update_fieldset( array(
			'shop_price',
			'shop_add_to_cart'
		) );
	}

	public function add_sortable() {
		?>
		<script>
			jQuery(document).ready(function ($) {
				var templateElements = $('.form-table tbody');
				templateElements.sortable();
				$('#submit').click(function (event) {
					var data = {
						positions: templateElements.sortable("toArray", {attribute: 'data-name'}),
						action: amphtml.action,
						current_section: amphtml.current_section
					};
					$.post(amphtml.ajaxUrl, data)
				});
			});
		</script>
		<?php
	}

	public function add_sortable_archives() {
		?>
		<script>
			jQuery(document).ready(function ($) {
				var templateElements = $('.form-table tbody');
				templateElements.sortable( { items: 'tr[data-name!="wc_archives_desc"]' } );
				$('#submit').click(function (event) {
					var positions = templateElements.sortable("toArray", {attribute: 'data-name'});
					positions.unshift('wc_archives_desc');
					var data = {
						positions: positions,
						action: amphtml.action,
						current_section: amphtml.current_section
					};
					$.post(amphtml.ajaxUrl, data)
				});
			});
		</script>
		<?php
	}

	public function get_section_fields( $id ) {
		$fields_order = get_option( self::ORDER_OPT );
		$fields_order = maybe_unserialize( $fields_order );
		$fields_order = isset( $fields_order[ $id ] ) ? maybe_unserialize( $fields_order[ $id ] ) : array();
		if ( ! count( $fields_order ) ) {
			return parent::get_section_fields( $id );
		}
		$fields = array();
		foreach ( $fields_order as $field_name ) {
			$fields[] = $this->search_field_id( $field_name );
		}

		return $fields;
	}

	public function get_section_callback( $id ) {
		switch ( $id ) {
			case 'product':
			case 'shop':
			case 'wc_archives':
		        return array( $this, 'product_section_callback' );
			default:
                return parent::get_section_callback($id);
		}
	}

	public function product_section_callback( $page, $section ) {
		global $wp_settings_fields;

		$row_id = 0;

		foreach ( (array) $wp_settings_fields[ $page ][ $section ] as $field ) {
			$class = '';

			if ( ! empty( $field['args']['class'] ) ) {
				$class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
			}
			echo "<tr data-name='{$field['id']}' id='pos_{$row_id}' {$class}>";
			echo '<th class="drag"></th>';
			if ( ! empty( $field['args']['label_for'] ) ) {
				echo '<th scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></th>';
			} else {
				echo '<th scope="row">' . $field['title'] . '</th>';
			}
			echo '<td>';
			call_user_func( $field['callback'], $field['args'] );
			echo '</td>';
			echo '</tr>';
			$row_id ++;
		}
	}

}
