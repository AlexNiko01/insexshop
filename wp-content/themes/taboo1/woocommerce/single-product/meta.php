<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<div id="table-features">
	<div class="icon-features">
	<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left mb0">
	<div class="vc_icon_element-inner vc_icon_element-color-sky  vc_icon_element-size-lg mb0p0">
   <span class="vc_icon_element-icon fa icon-gift" ></span>
  </div>
  </div>
  </div>
	<div class="features-text">
		<p>Полная конфиденциальность.</p>
  </div> 
	<div class="clear"></div>
	<div class="icon-features">
	<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left mb0">
	<div class="vc_icon_element-inner vc_icon_element-color-sky  vc_icon_element-size-lg mb0p0">
   <span class="vc_icon_element-icon fa icon-credit-card" ></span>
  </div>
  </div>
  </div>
	<div class="features-text">
		<p>Оплата при получении.</p>
  </div> 
	<div class="clear"></div>
	<div class="icon-features">
	<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left mb0">
	<div class="vc_icon_element-inner vc_icon_element-color-sky  vc_icon_element-size-lg mb0p0">
   <span class="vc_icon_element-icon fa icon-user" ></span>
  </div>
  </div>
  </div>
	<div class="features-text">
		<p>Доставка по Киеву: 40 грн.</p>
  </div> 
	<div class="clear"></div>
	<div class="icon-features">
	<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left mb0">
	<div class="vc_icon_element-inner vc_icon_element-color-sky  vc_icon_element-size-lg mb0p0">
   <span class="vc_icon_element-icon fa icon-truck" ></span>
  </div>
  </div>
  </div>
	<div class="features-text">
		<p>Доставка по Украине: 25-40 грн.</p>
  </div> 
	<div class="clear"></div>
</div>
	
<!--<div class="product_meta">-->
<!---->
<!--	--><?php //do_action( 'woocommerce_product_meta_start' ); ?>
<!---->
<!--	--><?php
//		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
//		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . ' ', '.</span>' );
//	?>
<!---->
<!--	--><?php //do_action( 'woocommerce_product_meta_end' ); ?>
<!---->
<!--</div>-->