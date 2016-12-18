<?php

// Фильтры
add_filter('script_loader_src', 'remove_version_data', 15, 1);
add_filter('style_loader_src', 'remove_version_data', 15, 1);
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');

// Удаление лишнего из Wordpress
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Удаление версии CSS и JS
function remove_version_data($src)
{
    $parts = explode('?ver', $src);
    return $parts[0];
}

// Отключаем сам REST API
/*add_filter('rest_enabled', '__return_false');*/

// Отключаем фильтры REST API
/*remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );*/

// Отключаем события REST API
/*remove_action( 'init', 'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );*/

// Отключаем Embeds связанные с REST API
/*remove_action( 'rest_api_init', 'wp_oembed_register_route');
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );*/
// если не собираетесь выводить вставки из других сайтов на своем, то расскомментируйте
/*remove_action( 'wp_head', 'wp_oembed_add_host_js');*/

// Отложенная загрузка скрипта корзины Woocommerce
/*add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
function dequeue_woocommerce_cart_fragments() {
if (is_front_page()) wp_dequeue_script('wc-cart-fragments');
}*/

// Удаление связанных товаров
function wc_remove_related_products($args)
{
    return array();
}

/*add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);*/

// Upsales на странице товара
//add_action( 'woocommerce_after_main_contents', 'woocommerce_cross_sell_display',40);

// Удаление лишней OpenGraph разметки
add_action('wp_loaded', 'et_insert_fb_in_head');
function et_insert_fb_in_head()
{
}

// Удаление табов на странице товара
/*add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}*/

// Изменение порядка табов
/*add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {
	$tabs['additional_information']['priority'] = 5;	// Additional information third
	$tabs['description']['priority'] = 10;			// Description second
	$tabs['reviews']['priority'] = 15;			// Reviews first
	return $tabs;
}*/

// Дополнительнный таб на странице товара
/*add_filter ('woocommerce_attribute', 'rb_link_attributes', 10, 3);
	function rb_link_attributes($attributes_string, $attribute, $terms) {
		global $post;
		$taxonomy = get_taxonomy( $attribute['name'] );

		if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
			$attribute_string = '';
			$terms = wp_get_post_terms( $post->ID, $taxonomy->name );

			if ( !empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if (strlen($attribute_string) > 0) {
						$attribute_string .= ', ';
					}
					$archive_link = get_term_link( $term->slug, $attribute['name'] );
					$attribute_string .= '<a href="' . $archive_link . '">'. $term->name . '</a>';
				}
			}
		}
		return '<div>'.$attribute_string.'</div>';
	}*/

// Удаление мини-описания товаров
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Количество товаров в категории
//add_filter( 'loop_shop_per_page', 'products_per_page_category', 20 );
// Количество товаров в категории
/*function products_per_page_category( $count ) {
    if( is_product_category( "vibratory" ) ) :
        return 15;
    elseif( is_product_category( "falloimitatory" ) ) :
        return 15;
    elseif( is_product_category( "strapony" ) ) :
        return 9;
    elseif( is_product_category( "vaginalnye-shariki" ) ) :
        return 15;
    elseif( is_product_category( "analnye-igrushki" ) ) :
        return 15;
    elseif( is_product_category( "probki" ) ) :
        return 15;
    elseif( is_product_category( "shariki" ) ) :
        return 15;
    elseif( is_product_category( "iskusstvennye-vaginy" ) ) :
        return 15;
    elseif( is_product_category( "kukly-dlya-seksa" ) ) :
        return 9;
    elseif( is_product_category( "masturbatory" ) ) :
        return 15;
    elseif( is_product_category( "erekcionnye-kolca" ) ) :
        return 15;
    elseif( is_product_category( "uvelichenie-penisa" ) ) :
        return 9;
    elseif( is_product_category( "vakuumnye-pompy" ) ) :
        return 15;
    elseif( is_product_category( "lubrikanty" ) ) :
        return 15;
    elseif( is_product_category( "preparaty" ) ) :
        return 15;
    elseif( is_product_category( "bdsm" ) ) :
        return 9;
    else :
        return $count;
    endif;
}*/

// Скрытие товаров в категории
/*function exclude_product_cat_children($wp_query) {
if ( isset ( $wp_query->query_vars['product_cat'] ) && $wp_query->is_main_query()) {
    $wp_query->set('tax_query', array( 
                                    array (
                                        'taxonomy' => 'product_cat',
                                        'field' => 'slug',
                                        'terms' => $wp_query->query_vars['product_cat'],
                                        'include_children' => false
                                    ) 
                                 )
    );
  }
}  
add_filter('pre_get_posts', 'exclude_product_cat_children');*/

// Курс валют ГРН
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'UAH':
            $currency_symbol = 'грн.';
            break;
    }
    return $currency_symbol;
}

// Текст в корзине
add_filter('gettext', 'translate_reply');
add_filter('ngettext', 'translate_reply');
function translate_reply($translated)
{
    $translated = str_ireplace('Cart Subtotal', 'Все товары', $translated);
    $translated = str_ireplace('Shipping and Handling', 'Доставка', $translated);
    $translated = str_ireplace('Sort by availability', 'Секс-игрушки в наличии', $translated);
    return $translated;
}

// Текст в кнопке КУПИТЬ
add_filter('add_to_cart_text', 'custom_cart_button_text');
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_cart_button_text');
add_filter('woocommerce_product_add_to_cart_text', 'custom_cart_button_text');
function custom_cart_button_text()
{
    return __('Купить', 'woocommerce');
}

// Замена ссылки в кнопке КУПИТЬ на форму
/*remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'my_woocommerce_template_loop_add_to_cart', 10 );
function my_woocommerce_template_loop_add_to_cart() {
    global $product;
    echo '<form class="cart" method="post">
	 	<input type="hidden" name="add-to-cart" value="'.$product->id.'" />
	 	<button type="submit" class=" filled big font2 single_add_to_cart_button button big alt">Купить</button>
			</form>';
}*/

// Интеграция WooCommerce в Google Analytics
/*function devise_wc_ga_integration( $order_id ) {
	$order = new WC_Order( $order_id ); ?>
	
	<script type="text/javascript">
	ga('require', 'ecommerce', 'ecommerce.js'); // Подгружаем плагин отслеживания электронной коммерции
		
		// Данные о транзакциях
		ga('ecommerce:addTransaction', {
			'id': '<?php echo $order_id;?>',
			'affiliation': '<?php echo get_option( "blogname" );?>',
			'revenue': '<?php echo $order->get_total();?>',
			'shipping': '<?php echo $order->get_total_shipping();?>',
			'tax': '<?php echo $order->get_total_tax();?>',
			'currency': '<?php echo get_woocommerce_currency();?>'
		});
	
	<?php
		//Данные о товарах
	if ( sizeof( $order->get_items() ) > 0 ) {
		foreach( $order->get_items() as $item ) {
			$product_cats = get_the_terms( $item["product_id"], 'product_cat' );
				if ($product_cats) { 
					$cat = $product_cats[0];
				} ?>
			ga('ecommerce:addItem', {
				'id': '<?php echo $order_id;?>',
				'name': '<?php echo $item['name'];?>',
				'sku': '<?php echo get_post_meta($item["product_id"], '_sku', true);?>',
				'category': '<?php echo $cat->name;?>',
				'price': '<?php echo $item['line_subtotal'];?>',
				'quantity': '<?php echo $item['qty'];?>',
				'currency': '<?php echo get_woocommerce_currency();?>'
			});
	<?php
		}	
	} ?>
		ga('ecommerce:send');
		</script>
<?php }
add_action( 'woocommerce_thankyou', 'devise_wc_ga_integration' );

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");*/

// Remove default WooCommerce breadcrumbs and add Yoast ones instead
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content', 'my_yoast_breadcrumb', 20);
if (!function_exists('my_yoast_breadcrumb')) {
    function my_yoast_breadcrumb()
    {
        yoast_breadcrumb('<div id="breadcrumb">', '</div>');
    }
}
function adjust_single_breadcrumb($link_output)
{
    if (strpos($link_output, 'breadcrumb_last') !== false) {
        $link_output = '';
    }
    return $link_output;
}

add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb');

// Удаляем nofollow в комментах
function remove_nofollow($string)
{
    $string = str_ireplace(' rel="nofollow"', '', $string);
    return $string;
}

//add_filter('the_content', 'remove_nofollow'); // удаляем nofollow для текстов статей
add_filter('comment_text', 'remove_nofollow'); // удаляем nofollow для текстов комментариев
add_filter('comment_text', 'do_shortcode'); //шорткоды в комментариях

/////////////////////////////////////////////////////////////////////////


/**
 * Include redefinition functions
 */

require_once get_stylesheet_directory() . '/functions-parts/redefinition.php';


/**
 *  Styles
 */

function thim_child_enqueue_styles()
{
    wp_dequeue_style('responsive');
    wp_enqueue_style('style-child', get_stylesheet_directory_uri() . '/style.css', null, null);
    wp_enqueue_style('responsive-child', get_stylesheet_directory_uri() . '/css/responsive.css', null, null);
}

add_action('wp_enqueue_scripts', 'thim_child_enqueue_styles', 131);


