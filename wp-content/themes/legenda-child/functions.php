<?php

// Фильтры
add_filter( 'script_loader_src', 'remove_version_data', 15, 1 );
add_filter( 'style_loader_src', 'remove_version_data', 15, 1 );
add_filter('xmlrpc_enabled', '__return_false');
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Удаление лишнего из Wordpress
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

// Удаление версии CSS и JS
function remove_version_data( $src ){
  $parts = explode( '?ver', $src );
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
function wc_remove_related_products( $args ) {
  return array();
}
/*add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);*/

// Upsales на странице товара
//add_action( 'woocommerce_after_main_contents', 'woocommerce_cross_sell_display',40);

// Удаление лишней OpenGraph разметки
add_action('wp_loaded','et_insert_fb_in_head');
function et_insert_fb_in_head () {}

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
function change_existing_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'UAH': $currency_symbol = 'грн.'; break;
     }
     return $currency_symbol;
}

// Текст в корзине
add_filter('gettext', 'translate_reply');
add_filter('ngettext', 'translate_reply'); 
function translate_reply($translated) {
$translated = str_ireplace('Cart Subtotal', 'Все товары', $translated);
$translated = str_ireplace('Shipping and Handling', 'Доставка', $translated);
$translated = str_ireplace('Sort by availability', 'Секс-игрушки в наличии', $translated);
return $translated;
}

// Текст в кнопке КУПИТЬ
add_filter( 'add_to_cart_text', 'custom_cart_button_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_cart_button_text' );
function custom_cart_button_text() {
  return __( 'Купить', 'woocommerce' );
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
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action( 'woocommerce_before_main_content','my_yoast_breadcrumb', 20, 0);
if (!function_exists('my_yoast_breadcrumb') ) {
	function my_yoast_breadcrumb() {
		yoast_breadcrumb('<div id="breadcrumb">','</div>');
	}
}
function adjust_single_breadcrumb( $link_output) {
	if(strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
   	return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb' );

// Удаляем nofollow в комментах
function remove_nofollow($string) {
 $string = str_ireplace(' rel="nofollow"', '', $string);
 return $string;
}
//add_filter('the_content', 'remove_nofollow'); // удаляем nofollow для текстов статей
add_filter('comment_text', 'remove_nofollow'); // удаляем nofollow для текстов комментариев
add_filter('comment_text', 'do_shortcode'); //шорткоды в комментариях
class Et_Navigation_Child extends Walker_Nav_Menu {
    public $styles = '';

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        if($depth > 0) {
            $output .= "\n$indent<div class=\"nav-sublist\">\n";
        }

        $output .= "\n$indent<ul>\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";

        if($depth > 0) {
            $output .= "\n$indent</div>\n";
        }
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $item_id =  $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);

        if(!empty($anchor)) {
            $item->url = $item->url.'#'.$anchor;
            if(($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if(($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'item-level-' . $depth;

        $design = $design2 = $columns = $icon = $label = '';
        $design = get_post_meta($item_id, '_menu-item-design', true);
        $design2 = get_post_meta($item_id, '_menu-item-design2', true);
        $columns = get_post_meta($item_id, '_menu-item-columns', true);
        $icon = get_post_meta($item_id, '_menu-item-icon', true);
        $label = get_post_meta($item_id, '_menu-item-label', true);
        $disable_titles = get_post_meta($item_id, '_menu-item-disable_titles', true);
        $widget_area = get_post_meta($item_id, '_menu-item-widget_area', true);
        $block = get_post_meta($item_id, '_menu-item-block', true);

        $widgets_content = $block_html = '';

        if( $depth == 0) {
            if($design != '') {
                $classes[] = 'menu-'.$design;
            } else {
                $classes[] = 'menu-dropdown';
            }
            if($columns != '') $classes[] = 'columns-'.$columns;
        } else {
            if($design2 != '') $classes[] = 'item-design2-'.$design2;
            if($widget_area != '') {
                $classes[] = 'item-with-widgets';
                ob_start();
                dynamic_sidebar( $widget_area );
                $widgets = ob_get_contents();
                ob_end_clean();
                $widgets_content = '<div class="menu-widgets">' . $widgets . '</div>';
            }
            if(!empty($block)) {
                $classes[] = 'item-with-block';
                ob_start();
                et_show_block($block);
                $block_html = ob_get_contents();
                ob_end_clean();
                $block_html = '<div class="menu-block">' . $block_html . '</div>';
            }
        }

        if( $depth < 2) {
            if($disable_titles == 1) $classes[]= 'menu-disable_titles';
        }

        if($icon != '') $icon = '<i class="fa fa-'.$icon.'"></i>';
        if($label != '') $classes[]= 'badge-'.$label;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .=  ' class="item-link"';
        $description = '';
        if($item->description != '') {
            if(strpos($class_names,'image-item') !== false){$description = '<img src="'.do_shortcode($item->description).'" alt="'.$item->title.'"/>';}
        }
        $tooltip = '';

        if ( has_post_thumbnail( $item_id ) && $depth > 0 ) {
            $tooltip = $this->et_get_tooltip_html($item_id);
        }

        $this->et_enque_styles($item_id, $depth);

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $icon;
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $description;
        $item_output .= $tooltip;
        $item_output .= '</a>';
        $item_output .= $widgets_content;
        $item_output .= $block_html;
        $item_output .= $args->after;

        if( $depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes) ) ){
            $item_output .="\n<div class=\"nav-sublist-dropdown\"><div class=\"container\">\n";
        }

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {

        $design = get_post_meta($item->ID, '_menu-item-design', true);
        $widgets_content = '';

        if( $depth == 0 && $design == 'posts-subcategories') {
            $widgets_content = $this->getPostsSubcategories($item);
        }


        if( $depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes) ) ){
            $output .= $widgets_content;
            $output .="\n</div></div><!-- .nav-sublist-dropdown -->\n";
        }

        $output .= "</li>\n";
    }

    function et_enque_styles($item_id, $depth) {
        $post_thumbnail = get_post_thumbnail_id( $item_id, 'thumb' );
        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail );
        $bg_position = get_post_meta($item_id, '_menu-item-background_position', true);
        $bg_repeat = get_post_meta($item_id, '_menu-item-background_repeat', true );
        $column_width = get_post_meta($item_id, '_menu-item-column_width', true );

        $bg_pos = $bg_rep = $styles = $styles_sublist = '';

        if($bg_position != '') {
            $bg_pos = "background-position: ".$bg_position.";";
        }

        if($bg_repeat != '') {
            $bg_rep = "background-repeat: ".$bg_repeat.";";
        }

        if(!empty($post_thumbnail_url)) {
            $styles_sublist .= $bg_pos.$bg_rep." background-image: url(".$post_thumbnail_url.");";
        }

        if( $depth == 1 && !empty($column_width)) {
            $styles .= 'width:' . $column_width . '%!important';
        }

        if( ! empty($styles) ) {
            echo '<style>.menu-item-'.$item_id.' {'.$styles.'}</style>';
        }

        if( ! empty($styles_sublist) ) {
            echo '<style>.menu-item-'.$item_id.' .nav-sublist-dropdown {'.$styles_sublist.'}</style>';
        }


        //add_action('wp_footer', function() use($styles) { die(); echo '<style>'.$styles.'</style>'; });

    }

    function et_get_tooltip_html($item_id) {
        $output = '';
        $post_thumbnail = get_post_thumbnail_id( $item_id );
        $post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail, 'large' );
        $output .= '<div class="nav-item-image">';
        $output .= '<img src="' . $post_thumbnail_url[0] . '" width="' . $post_thumbnail_url[1] . '" height="' . $post_thumbnail_url[2] . '" />';
        $output .= '</div>';
        return $output;
    }

    function getPostsSubcategories( $item ) {

        if( $item->object != 'category' ) return '';

        $cat_id = $item->object_id;
        $children = get_categories( array('child_of' => $cat_id) );

        $output = '<div class="posts-subcategories">';

        if( ! empty($children) ) {
            $cat_id = $children[0]->term_id;
            $output .= '<div class="subcategories-tabs"><ul>';

            foreach ($children as $child) {
                $output .= '<li data-cat="' . $child->term_id . '">' . $child->name . '</li>';
            }

            $output .= '</ul></div><!-- .posts-subcategories -->';
        }


        $output .= '<div class="posts-content">';

        $output .= $this->getPostsByCategory( $cat_id );

        $output .= '</div><!-- .posts-content -->';


        $output .= '</div><!-- .posts-subcategories -->';

        return $output;
    }

    function getPostsByCategory( $cat = false ) {

        if( defined( 'DOING_AJAX' ) && DOING_AJAX  && isset( $_GET['cat'] ) ) {
            $cat = (int) $_GET['cat'];
        }

        if( ! $cat ) {
            return '';
        }

        $category = get_category( $cat );

        $posts = get_posts( array(
            'category' => $cat,
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post_type' => 'post'
        ) );

        $output = '';

        if( ! empty($posts) ) {
            foreach ($posts as $post) {
                $output .= '<div class="post-preview">';

                $output .= '<div class="post-preview-thumbnail" onclick="window.location=\'' . get_the_permalink( $post->ID ) . '\'">';

                $output .= get_the_post_thumbnail( $post->ID, 'medium' );

                $output .= '<div class="post-category">' . $category->name . '</div>';

                $output .= '</div>';

                $output .= '<a href="'.get_the_permalink( $post->ID ).'">'. $post->post_title .'</a>';

                $output .= '</div>';
            }
        }


        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            echo $output;
            die();
        } else {
            return $output;
        }
    }
}
function etheme_cart_items ($limit = 3) {
    global $woocommerce;
    if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
        ?>
        <ul class='order-list'>
            <?php
            $counter = 0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $counter++;
                if($counter > $limit) continue;
                $_product = $cart_item['data'];

                if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) )
                    continue;

                if ( $_product->exists() && $cart_item['quantity'] > 0 ) {

                    $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

                    $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );

                    ?>
                    <li>
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-key="%s" class="close-order-li delete-btn" title="%s"><i class="icon-remove"></i></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), $cart_item_key, __('Remove this item', ETHEME_DOMAIN) ), $cart_item_key );
                        ?>
                        <div class="media">
                            <a class="pull-left product-image" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
                                <img class="media-object" src="<?php echo etheme_get_image(get_post_thumbnail_id($cart_item['product_id']), 70, 200, false); ?>">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ) ?></a></h4>
                                <div class="descr-box">
                                    <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
                                    <span class="coast"><?php _e('Qty: ', ETHEME_DOMAIN); echo $cart_item['quantity']; ?><span class='medium-coast pull-right'><?php echo $product_price; ?></span></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

        <?php
    }
    else {
        echo '<p class="empty a-center">' . __('No products in the cart.', ETHEME_DOMAIN) . '</p>';
    }


    if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
        do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
        ?>
        <div class="totals">
            <p class="small-h pull-left"><?php echo __('Total: ', ETHEME_DOMAIN); ?></p>
            <span class="big-coast pull-right">
					<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
				</span>
        </div>

        <div class="clearfix"></div>
        <div class='bottom-btn'>
            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class='btn text-center button left'><?php echo __('View Cart', ETHEME_DOMAIN); ?></a>
            <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class='btn text-center button active right'><?php echo __('Checkout', ETHEME_DOMAIN); ?></a>
        </div>

        <?php

    }
}

function etheme_top_cart() {
    global $woocommerce;
    ?>

    <div class="shopping-cart-widget a-right" <?php if(etheme_get_option('favicon_badge')) echo 'data-fav-badge="enable"' ?>>
        <div class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">


            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">
                <div class="cart-bag">
<!--                    --><?php //_e('Cart', ETHEME_DOMAIN); ?>

                    <?php etheme_cart_number(); ?>

                    <?php etheme_cart_totals(); ?>
                </div>
            </a>
        </div>
        <div class="widget_shopping_cart_content">
            <?php
            woocommerce_mini_cart();
            ?>
        </div>
    </div>

    <?php
}

function etheme_cart_number() {
    global $woocommerce;
    ?>
    <span class="badge-number"><?php echo $woocommerce->cart->cart_contents_count; _e(' items for', ETHEME_DOMAIN);?></span>
    <?php
}