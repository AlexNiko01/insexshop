<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class AMPHTML_WC {
	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 9 );
		add_action( 'before_load_amphtml', array( $this, 'exclude_pages' ) );
		add_filter( 'amphtml_is_mobile_get_redirect_url', array( $this, 'add_to_cart_redirect' ) );
		add_filter( 'amphtml_admin_tab_list', array( $this, 'add_wc_options_tab' ) );
		add_filter( 'amphtml_template_load_callback', array( $this, 'template_load' ) );
		add_filter( 'amphtml_color_fields', array( $this, 'add_colors' ), 10, 3 );
		add_filter( 'amphtml_schemaorg_tab_fields', array( $this, 'add_schema_org_type' ), 10, 2 );
		add_filter( 'amphtml_schema_type', array( $this, 'set_wc_schema_type' ), 10, 2 );
	}

	public function pre_get_posts( $q ) {

		if ( ! $q->is_main_query() ) {
			return '';
		}

		if ( AMPHTML()->is_amp() && $q->is_home() && 'page' === get_option( 'show_on_front' ) && absint( get_option( 'page_on_front' ) ) === wc_get_page_id( 'shop' ) && ! isset( $q->query['pagename'] ) ) {

			$q->is_page              = true;
			$q->is_home              = false;
			$q->is_post_type_archive = true;
			$q->set( 'post_type', 'product' );

			global $wp_post_types;

			$shop_page = get_post( wc_get_page_id( 'shop' ) );

			$wp_post_types['product']->ID         = '';
			$wp_post_types['product']->post_title = $shop_page->post_title;
			$wp_post_types['product']->post_name  = $shop_page->post_name;
			$wp_post_types['product']->post_type  = $shop_page->post_type;
			$wp_post_types['product']->ancestors  = get_ancestors( $shop_page->ID, $shop_page->post_type );
		}
	}

	public function exclude_pages( $queried_object_id ) {

		//exclude woocommerce form based pages
		if ( is_cart() || is_checkout() || is_account_page() ) {
			update_post_meta( $queried_object_id, 'amphtml-exclude', "true" );
		}
	}

	public function add_to_cart_redirect( $is_mobile ) {
		return $is_mobile && false == isset( $_GET['add-to-cart-redirect'] );
	}

	public function add_wc_options_tab($tab_list) {
		$tab_list['wc'] = __( 'WooCommerce', 'amphtml' );
		return $tab_list;
	}

	public function template_load( $callback ) {
		return array( $this, 'load_template' );
	}

	public function add_colors( $fields, $tab, $section ) {
		$fields[] = array(
			'id'                    => 'add_to_cart_button_color',
			'title'                 => __( 'Add to Cart Button', 'amphtml' ),
			'default'               => '#0087be',
			'display_callback'      => array( $tab, 'display_text_field' ),
			'display_callback_args' => array( 'add_to_cart_button_color' ),
			'sanitize_callback'     => array( $tab, 'sanitize_add_to_cart_button_color' ),
			'section'               => $section
		);
		return $fields;
	}

	public function is_home_shop_page() {
		return  AMPHTML()->is_posts_page() && absint( get_option( 'page_on_front' ) ) === wc_get_page_id( 'shop' ) && absint (AMPHTML()->get_queried_object_id() ) === wc_get_page_id( 'shop' );
	}

	public function add_schema_org_type( $fields, $schema_tab ) {
		$fields[] = array(
			'id'                    => 'wc_schema_type',
			'title'                 => __( 'WooCommerce Content Type', 'amphtml' ),
			'display_callback'      => array( $schema_tab, 'display_select' ),
			'default'               => 'Product',
			'display_callback_args' => array(
				'id'             => 'wc_schema_type',
				'select_options' => array(
					'NewsArticle' => 'NewsArticle',
					'BlogPosting' => 'BlogPosting',
					'Product'     => 'Product'
				)
			),
			'description'           => '',
		);

		return $fields;
	}

	public function set_wc_schema_type( $type, $template ) { //todo refactoring
		if ( is_product() || is_shop() || $this->is_home_shop_page() || is_product_taxonomy() ) {
			$type = $template->get_option( 'wc_schema_type' );
		}
		return $type;
	}

	/**
	 * @var $template AMPHTML_Template
	 */
	public function load_template( $template ) {
		global $wp_query;

		$social_share_script = array(
			'slug' => 'amp-social-share',
			'src'  => 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js'
		);

		switch ( true ) {
			case $this->is_home_shop_page() :

				$template->set_template_content( 'wc-product-shop' )
				         ->set_default_embedded_elements();
				$template->set_blocks( 'shop' );
				$shop_page_id    = wc_get_page_id( 'shop' );
				$template->title = woocommerce_page_title( false );
				$template->set_schema_metadata();
				break;
			case is_front_page():

			case ( $wp_query->is_posts_page ):
				$template->set_template_content( 'archive' )
				         ->set_default_embedded_elements();
				$template->doc_title = $template->title = $template->get_option( 'blog_page_title' );
				add_filter( 'aioseop_title', array( $template, 'get_doc_title' ) );
				$template->set_blocks( 'blog' );
				$template->set_schema_metadata();
				break;
			case is_home():

				$template->set_template_content( 'single-content' );
				$current_post_id = get_option( 'page_on_front' );
				$template->set_post( $current_post_id );
				$template->doc_title = $template->post->post_title;
				add_filter( 'aioseop_title', array( $template, 'get_doc_title' ) );
				$template->set_blocks( 'pages' );
				if ( $template->get_option( 'page_social_share' ) ) {
					$template->add_embedded_element( $social_share_script );
				}
				break;
			case is_product():
				$template->set_template_content( 'single-content' )
				         ->set_default_embedded_elements();
				$template->set_blocks( 'product' );
				$current_post_id   = get_the_ID();
				$product_factory   = new WC_Product_Factory();
				$template->product = $product_factory->get_product( $current_post_id );
				$template->set_post( $current_post_id );
				if ( $template->get_option( 'product_social_share' ) ) {
					$template->add_embedded_element( $social_share_script );
				}
				break;
			case is_shop():
				$template->set_template_content( 'wc-product-shop' )
				         ->set_default_embedded_elements();
				$template->set_blocks( 'shop' );
				$shop_page_id    = wc_get_page_id( 'shop' );
				$template->title = woocommerce_page_title( false );
				$template->set_schema_metadata();
				break;
			case is_product_taxonomy():
				$template->set_template_content( 'wc-product-archive' )
				         ->set_default_embedded_elements();
				$template->set_blocks( 'wc_archives' );
				$template->title = woocommerce_page_title( false );
				$template->set_schema_metadata();
				break;
			case is_single():
				$template->set_template_content( 'single-content' );
				$current_post_id = get_the_ID();
				$template->set_post( $current_post_id );
				$template->set_blocks( 'posts' );
				if ( $template->get_option( 'post_social_share' ) ) {
					$template->add_embedded_element( $social_share_script );
				}
				break;
			case is_page():
				$template->set_template_content( 'single-content' );
				$current_post_id = get_the_ID();
				$template->set_post( $current_post_id );
				$template->set_blocks( 'pages' );
				if ( $template->get_option( 'page_social_share' ) ) {
					$template->add_embedded_element( $social_share_script );
				}
				break;
			case is_archive():
				$template->set_template_content( 'archive' )
				         ->set_default_embedded_elements();
				$template->set_blocks( 'archives' );
				$template->title = get_the_archive_title();
				$template->set_schema_metadata( get_the_archive_description() );
				break;
			case is_404():
				$template->set_template_content( 'single-content' );
				$template->set_blocks( '404' );
				break;
			case is_search():
				$template->set_template_content( 'archive' );
				$template->set_blocks( 'search' );
				$template->title = __( 'Search Results', 'amphtml' );
				$template->set_schema_metadata();
				break;
		}
	}

}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	new AMPHTML_WC();
}