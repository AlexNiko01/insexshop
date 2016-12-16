<?php
/**
* functions redefinition
* */


class Et_Navigation_Child extends Walker_Nav_Menu
{
    public $styles = '';

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);

        if ($depth > 0) {
            $output .= "\n$indent<div class=\"nav-sublist\">\n";
        }

        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 1, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";

        if ($depth > 0) {
            $output .= "\n$indent</div>\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $item_id = $item->ID;

        $class_names = $value = '';

        $anchor = get_post_meta($item_id, '_menu-item-anchor', true);

        if (!empty($anchor)) {
            $item->url = $item->url . '#' . $anchor;
            if (($key = array_search('current_page_item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
            if (($key = array_search('current-menu-item', $item->classes)) !== false) {
                unset($item->classes[$key]);
            }
        }

        $classes = empty($item->classes) ? array() : (array)$item->classes;
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

        if ($depth == 0) {
            if ($design != '') {
                $classes[] = 'menu-' . $design;
            } else {
                $classes[] = 'menu-dropdown';
            }
            if ($columns != '') $classes[] = 'columns-' . $columns;
        } else {
            if ($design2 != '') $classes[] = 'item-design2-' . $design2;
            if ($widget_area != '') {
                $classes[] = 'item-with-widgets';
                ob_start();
                dynamic_sidebar($widget_area);
                $widgets = ob_get_contents();
                ob_end_clean();
                $widgets_content = '<div class="menu-widgets">' . $widgets . '</div>';
            }
            if (!empty($block)) {
                $classes[] = 'item-with-block';
                ob_start();
                et_show_block($block);
                $block_html = ob_get_contents();
                ob_end_clean();
                $block_html = '<div class="menu-block">' . $block_html . '</div>';
            }
        }

        if ($depth < 2) {
            if ($disable_titles == 1) $classes[] = 'menu-disable_titles';
        }

        if ($icon != '') $icon = '<i class="fa fa-' . $icon . '"></i>';
        if ($label != '') $classes[] = 'badge-' . $label;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="item-link"';
        $description = '';
        if ($item->description != '') {
            if (strpos($class_names, 'image-item') !== false) {
                $description = '<img src="' . do_shortcode($item->description) . '" alt="' . $item->title . '"/>';
            }
        }
        $tooltip = '';

        if (has_post_thumbnail($item_id) && $depth > 0) {
            $tooltip = $this->et_get_tooltip_html($item_id);
        }

        $this->et_enque_styles($item_id, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $icon;
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= $description;
        $item_output .= $tooltip;
        $item_output .= '</a>';
        $item_output .= $widgets_content;
        $item_output .= $block_html;
        $item_output .= $args->after;

        if ($depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes))) {
            $item_output .= "\n<div class=\"nav-sublist-dropdown\"><div class=\"container\">\n";
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {

        $design = get_post_meta($item->ID, '_menu-item-design', true);
        $widgets_content = '';

        if ($depth == 0 && $design == 'posts-subcategories') {
            $widgets_content = $this->getPostsSubcategories($item);
        }


        if ($depth === 0 && ($design == 'posts-subcategories' || in_array('menu-item-has-children', $item->classes))) {
            $output .= $widgets_content;
            $output .= "\n</div></div><!-- .nav-sublist-dropdown -->\n";
        }

        $output .= "</li>\n";
    }

    function et_enque_styles($item_id, $depth)
    {
        $post_thumbnail = get_post_thumbnail_id($item_id, 'thumb');
        $post_thumbnail_url = wp_get_attachment_url($post_thumbnail);
        $bg_position = get_post_meta($item_id, '_menu-item-background_position', true);
        $bg_repeat = get_post_meta($item_id, '_menu-item-background_repeat', true);
        $column_width = get_post_meta($item_id, '_menu-item-column_width', true);

        $bg_pos = $bg_rep = $styles = $styles_sublist = '';

        if ($bg_position != '') {
            $bg_pos = "background-position: " . $bg_position . ";";
        }

        if ($bg_repeat != '') {
            $bg_rep = "background-repeat: " . $bg_repeat . ";";
        }

        if (!empty($post_thumbnail_url)) {
            $styles_sublist .= $bg_pos . $bg_rep . " background-image: url(" . $post_thumbnail_url . ");";
        }

        if ($depth == 1 && !empty($column_width)) {
            $styles .= 'width:' . $column_width . '%!important';
        }

        if (!empty($styles)) {
            echo '<style>.menu-item-' . $item_id . ' {' . $styles . '}</style>';
        }

        if (!empty($styles_sublist)) {
            echo '<style>.menu-item-' . $item_id . ' .nav-sublist-dropdown {' . $styles_sublist . '}</style>';
        }


        //add_action('wp_footer', function() use($styles) { die(); echo '<style>'.$styles.'</style>'; });

    }

    function et_get_tooltip_html($item_id)
    {
        $output = '';
        $post_thumbnail = get_post_thumbnail_id($item_id);
        $post_thumbnail_url = wp_get_attachment_image_src($post_thumbnail, 'large');
        $output .= '<div class="nav-item-image">';
        $output .= '<img src="' . $post_thumbnail_url[0] . '" width="' . $post_thumbnail_url[1] . '" height="' . $post_thumbnail_url[2] . '" />';
        $output .= '</div>';
        return $output;
    }

    function getPostsSubcategories($item)
    {

        if ($item->object != 'category') return '';

        $cat_id = $item->object_id;
        $children = get_categories(array('child_of' => $cat_id));

        $output = '<div class="posts-subcategories">';

        if (!empty($children)) {
            $cat_id = $children[0]->term_id;
            $output .= '<div class="subcategories-tabs"><ul>';

            foreach ($children as $child) {
                $output .= '<li data-cat="' . $child->term_id . '">' . $child->name . '</li>';
            }

            $output .= '</ul></div><!-- .posts-subcategories -->';
        }


        $output .= '<div class="posts-content">';

        $output .= $this->getPostsByCategory($cat_id);

        $output .= '</div><!-- .posts-content -->';


        $output .= '</div><!-- .posts-subcategories -->';

        return $output;
    }

    function getPostsByCategory($cat = false)
    {

        if (defined('DOING_AJAX') && DOING_AJAX && isset($_GET['cat'])) {
            $cat = (int)$_GET['cat'];
        }

        if (!$cat) {
            return '';
        }

        $category = get_category($cat);

        $posts = get_posts(array(
            'category' => $cat,
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post_type' => 'post'
        ));

        $output = '';

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $output .= '<div class="post-preview">';

                $output .= '<div class="post-preview-thumbnail" onclick="window.location=\'' . get_the_permalink($post->ID) . '\'">';

                $output .= get_the_post_thumbnail($post->ID, 'medium');

                $output .= '<div class="post-category">' . $category->name . '</div>';

                $output .= '</div>';

                $output .= '<a href="' . get_the_permalink($post->ID) . '">' . $post->post_title . '</a>';

                $output .= '</div>';
            }
        }


        if (defined('DOING_AJAX') && DOING_AJAX) {
            echo $output;
            die();
        } else {
            return $output;
        }
    }
}

function etheme_cart_items($limit = 3)
{
    global $woocommerce;
    if (sizeof($woocommerce->cart->get_cart()) > 0) {
        ?>
        <div class="products-small">
            <?php
            $counter = 0;
            foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
                $counter++;
                if ($counter > $limit) continue;
                $_product = $cart_item['data'];

                if (!apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key))
                    continue;

                if ($_product->exists() && $cart_item['quantity'] > 0) {

                    $product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

                    $product_price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price($product_price), $cart_item, $cart_item_key);

                    ?>
                    <div class="product-item">
                        <a href="<?php echo get_permalink($cart_item['product_id']); ?>" title="Корзина заказов"
                           class="product-image">
                            <img src="<?php echo etheme_get_image(get_post_thumbnail_id($cart_item['product_id']), 100, 200, false); ?>"
                                 alt="Корзина заказов">
                        </a>
                        <?php
                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-key="%s" class="delete-btn" title="%s"><i class="icon-remove"></i></a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), $cart_item_key, __('Remove this item', ETHEME_DOMAIN)), $cart_item_key);
                        ?>
                        <h5>
                            <a href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product) ?></a>
                        </h5>

                        <div class="qty">
                            <span class="price"><span class="pricedisplay"><?php echo $product_price; ?></span></span>
                            <span class="quanity-label"><?php echo __('Qty', ETHEME_DOMAIN); ?>:</span>
                            <span><?php echo $cart_item['quantity']; ?></span>
                            <?php echo $woocommerce->cart->get_item_data($cart_item); ?>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <?php
    } else {
        echo '<p class="empty a-center">' . __('No products in the cart.', ETHEME_DOMAIN) . '</p>';
    }


    if (sizeof($woocommerce->cart->get_cart()) > 0) {
        ?>
        <div class="totals">
            <span class="items left"><?php echo $woocommerce->cart->cart_contents_count; ?><?php _e('items', ETHEME_DOMAIN); ?></span>
            <?php echo __('Total:', ETHEME_DOMAIN); ?> &nbsp;<span class="price"><span
                    class="pricedisplay"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>
        </div>
        <?php

        do_action('woocommerce_widget_shopping_cart_before_buttons');
        ?>

        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="Корзина заказов"
           class="button left"><span><?php echo __('View Cart', ETHEME_DOMAIN); ?></span></a>
        <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="Оформить заказ"
           class="button filled active right "><span><?php echo __('Checkout', ETHEME_DOMAIN); ?></span></a>

        <div class="clear"></div>

        <?php

    }
}

function etheme_cart_number()
{
    global $woocommerce;
    ?>
    <span class="badge-number"><?php echo $woocommerce->cart->cart_contents_count;
        _e(' items for', ETHEME_DOMAIN); ?></span>
    <?php
}

function etheme_top_cart()
{
    global $woocommerce;
    ?>

    <div class="shopping-cart-widget a-right" <?php if (etheme_get_option('favicon_badge')) echo 'data-fav-badge="enable"' ?>>
        <div class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">
            <span class="shopping-cart-link"><span
                    class="price-summ cart-totals"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>
        </div>
        <div class="cart-popup-container">
            <div class="cart-popup">
                <?php
                etheme_cart_items(3);
                ?>
            </div>
        </div>
    </div>

    <?php
}

function etheme_create_slider($args, $slider_args = array())
{//, $title = false, $shop_link = true, $slider_type = false, $items = '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]', $style = 'default'
    global $wpdb, $woocommerce_loop;
    $product_per_row = etheme_get_option('prodcuts_per_row');
    extract(shortcode_atts(array(
        'title' => false,
        'shop_link' => false,
        'slider_type' => false,
        'items' => '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]',
        'style' => 'default',
        'block_id' => false
    ), $slider_args));

    $box_id = rand(1000, 10000);
    $multislides = new WP_Query($args);
    $shop_url = get_permalink(woocommerce_get_page_id('shop'));
    $class = $title_output = '';
    if (!$slider_type) {
        $woocommerce_loop['lazy-load'] = true;
        $woocommerce_loop['style'] = $style;
    }

    if ($multislides->post_count > 1) {
        $class .= ' posts-count-gt1';
    }
    if ($multislides->post_count < 4) {
        $class .= ' posts-count-lt4';
    }
    if ($multislides->have_posts()) :
        if ($title) {
            $title_output = '<h2 class="title"><span>' . $title . '</span></h2>';
        }
        echo '<div class="slider-container ' . $class . '">';
        echo $title_output;
        if ($shop_link && $title)
//            echo '<a href="'.$shop_url.'" class="show-all-posts hidden-tablet hidden-phone">'.__('View more products', ETHEME_DOMAIN).'</a>';
            echo '<div class="items-slider products-slider ' . $slider_type . '-container slider-' . $box_id . '">';
        echo '<div class="slider ' . $slider_type . '-wrapper">';
        $_i = 0;
        if ($block_id && $block_id != '' && et_get_block($block_id) != '') {
            echo '<div class=" ' . $slider_type . '-slide">';
            echo et_get_block($block_id);
            echo '</div><!-- slide-item -->';
        }
        while ($multislides->have_posts()) : $multislides->the_post();
            $_i++;

            if (class_exists('Woocommerce')) {
                global $product;
                if (!$product->is_visible()) continue;
                echo '<div class="slide-item product-slide ' . $slider_type . '-slide">';
                woocommerce_get_template_part('content', 'product');
                echo '</div><!-- slide-item -->';
            }

        endwhile;
        echo '</div><!-- slider -->';
        echo '</div><!-- products-slider -->';
        echo '</div><!-- slider-container -->';
    endif;
    wp_reset_query();
    unset($woocommerce_loop['lazy-load']);
    unset($woocommerce_loop['style']);

    if ($items != '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]') {
        $items = '[[0, ' . $items['phones'] . '], [479,' . $items['phones'] . '], [619,' . $items['tablet'] . '], [768,' . $items['tablet'] . '],  [1200, ' . $items['notebook'] . '], [1600, ' . $items['desktop'] . ']]';
    }
    if (!$slider_type) {
        echo '

	            <script type="text/javascript">
	                jQuery(".slider-' . $box_id . ' .slider").owlCarousel({
	                    items:4,
	                    lazyLoad : true,
	                    navigation: true,
	                    navigationText:false,
	                    rewindNav: false,
	                    itemsCustom: ' . $items . '
	                });

	            </script>
	        ';
    } elseif ($slider_type == 'swiper') {
        echo '

	            <script type="text/javascript">
	              if(jQuery(window).width() > 767) {
		              jQuery(".slider-' . $box_id . '").etFullWidth();
					  var mySwiper' . $box_id . ' = new Swiper(".slider-' . $box_id . '",{
						keyboardControl: true,
						centeredSlides: true,
						calculateHeight : true,
						slidesPerView: "auto"
					  })
	              } else {
					  var mySwiper' . $box_id . ' = new Swiper(".slider-' . $box_id . '",{
						calculateHeight : true
					  })
	              }

				    jQuery(function($){
						$(".slider-' . $box_id . ' .slide-item").click(function(){
							mySwiper' . $box_id . '.swipeTo($(this).index());
							$(".lookbook-index").removeClass("active");
							$(this).addClass("active");
						});

						$(".slider-' . $box_id . ' .slide-item a").click(function(e){
							if($(this).parents(".swiper-slide-active").length < 1) {
								e.preventDefault();
							}
						});
				    }, jQuery);
	            </script>
	        ';
    }

}

add_action("init", function () {
    remove_shortcode("single_post");
    add_shortcode("single_post", function ($atts) {

        $a = shortcode_atts(array(
            'title' => '',
            'id' => '',
            'class' => '',
            'more_posts' => 1
        ), $atts);
        $limit = 1;
        $width = 300;
        $height = 300;
        $lightbox = etheme_get_option('blog_lightbox');
        $blog_slider = etheme_get_option('blog_slider');
        $posts_url = get_permalink(get_option('page_for_posts'));
        $args = array(
            'p' => $a['id'],
            'post_type' => 'post',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'posts_per_page' => $limit
        );

        $the_query = new WP_Query($args);
        ob_start();
        ?>

        <?php if ($the_query->have_posts()) : ?>

            <?php while ($the_query->have_posts()) : $the_query->the_post();
                $postId = get_the_ID(); ?>

                <div class="featured-posts <?php echo $a['class']; ?>">
                    <?php if ($a['title'] != ''): ?>
                        <h3 class="title a-left"><span><?php echo $a['title']; ?></span></h3>
                        <!--                        --><?php //if ($a['more_posts']): ?>
                        <!--                            --><?php //echo '<a href="' . $posts_url . '" class="show-all-posts hidden-tablet hidden-phone">' . __(' more posts', ETHEME_DOMAIN) . '</a>'; ?>
                        <!--                        --><?php //endif ?>
                    <?php endif ?>
                    <div class="featured-post row-fluid">
                        <div class="span6">
                            <?php
                            $width = etheme_get_option('blog_page_image_width');
                            $height = etheme_get_option('blog_page_image_height');
                            $crop = etheme_get_option('blog_page_image_cropping');
                            ?>

                            <?php $images = etheme_get_images($width, $height, $crop); ?>

                            <?php if (count($images) > 0 && has_post_thumbnail()): ?>
                                <div class="post-images nav-type-small<?php if (count($images) > 1): ?> images-slider<?php endif; ?>">
                                    <ul class="slides">
                                        <li><a href="<?php the_permalink(); ?>"><img
                                                    src="<?php echo $images[0]; ?>"></a></li>
                                    </ul>
                                    <div class="blog-mask">
                                        <div class="mask-content">
                                            <?php if ($lightbox): ?><a
                                                href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>"
                                                rel="lightbox"><i class="icon-resize-full"></i></a><?php endif; ?>
                                            <a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="span6">
                            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <div class="post-info">
                            <span class="posted-on">
                                <?php _e('Posted on', ETHEME_DOMAIN) ?>
                                <?php the_time(get_option('date_format')); ?>
                                <?php _e('at', ETHEME_DOMAIN) ?>
                                <?php the_time(get_option('time_format')); ?>
                            </span>
                                <span class="posted-by"> <?php _e('by', ETHEME_DOMAIN); ?><?php the_author_posts_link(); ?></span>
                            </div>
                            <div class="post-description">
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>"
                                   class="button read-more"><?php _e('Read More', ETHEME_DOMAIN) ?></a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        <?php else: ?>

            <p><?php _e('Sorry, no posts matched your criteria.', ETHEME_DOMAIN); ?></p>

        <?php endif; ?>

        <?php
        $output = ob_get_contents();
        ob_end_clean();

        return $output;

    });
});
