<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

get_header('shop'); ?>

<?php
extract(etheme_get_shop_sidebar());
$sidebarname = 'shop';
?>

    <div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
        <div class="container">
            <div class="row-fluid">
                <div class="span12 a-center">
                    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

                        <h1 class="title"><span><?php woocommerce_page_title(); ?></span></h1>

                    <?php endif; ?>
                    <?php
                    /**
                     * woocommerce_before_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action('woocommerce_before_main_content');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-content sidebar-position-<?php echo $position; ?> responsive-sidebar-<?php echo $responsive; ?>">

            <div class="row-fluid">
                <?php if ($position != 'without' && ($position == 'left' || $responsive == 'top')): ?>
                    <div class="<?php echo $sidebar_span; ?> sidebar sidebar-left">
                        <?php etheme_get_sidebar($sidebarname); ?>
                    </div>
                <?php endif; ?>

                <div class="content <?php echo $content_span; ?>">


                    <?php if (have_posts()) : ?>

                        <div class="contentwatch"><?php do_action('woocommerce_archive_description'); ?></div>

                    <?php if (woocommerce_products_will_display()): ?>

                        <div class="toolbar toolbar-top">
                            <?php
                            /**
                             * woocommerce_before_shop_loop hook
                             *
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action('woocommerce_before_shop_loop');
                            ?>
                            <div class="clear"></div>
                        </div>

                    <?php endif ?>

                    <?php $cats_displayed = woocommerce_product_subcategories(array('before' => '<div class="loop-subcategories">', 'after' => '<div class="clear"></div></div>')); ?>

                    <?php woocommerce_product_loop_start(); ?>


                    <?php while (have_posts()) : the_post(); ?>

                        <?php woocommerce_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop. ?>

                    <?php if (etheme_get_option('product_img_hover') == 'tooltip'): ?>
                        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'));</script>
                    <?php endif ?>

                        <div class="clear"></div>

                    <?php woocommerce_product_loop_end(); ?>

                        <div class="toolbar toolbar-bottom">
                            <?php
                            /*
                             * woocommerce_after_shop_loop hook
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            do_action('woocommerce_after_shop_loop');
                            ?>
                        </div>
                        <div class="clear"></div>
                    <?php if (get_query_var('paged') == 0) : ?>
                        <div class="bgpb">
                            <div class="row-fluid vc_row-fluid">
                                <div class="wpb_column span3">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div class="tac">Доставка по Киеву</div>
                                                <div class="tac">1-2 рабочих дня</div>
                                            </div>
                                        </div>
                                        <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                            <div class="vc_icon_element-inner vc_icon_element-color-sky vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                                                <span class="vc_icon_element-icon fa icon-user"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column span3">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div class="tac">Оплата без проблем</div>
                                                <div class="tac">Наличными, Приват24</div>
                                            </div>
                                        </div>
                                        <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                            <div class="vc_icon_element-inner vc_icon_element-color-sky vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                                                <span class="vc_icon_element-icon fa icon-credit-card"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column span3">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div class="tac">Конфиденциальность заказа</div>
                                                <div class="tac">Гарантирована</div>
                                            </div>
                                        </div>
                                        <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                            <div class="vc_icon_element-inner vc_icon_element-color-sky vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                                                <span class="vc_icon_element-icon fa icon-archive"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column span3">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element">
                                            <div class="wpb_wrapper">
                                                <div class="tac">Консультации по телефону</div>
                                                <div class="tac">Поддержка чата 12/7</div>
                                            </div>
                                        </div>
                                        <div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-center">
                                            <div class="vc_icon_element-inner vc_icon_element-color-sky vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey">
                                                <span class="vc_icon_element-icon fa icon-headphones"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                        <?php woocommerce_get_template('loop/no-products-found.php'); ?>

                    <?php endif; ?>

                    <?php
                    /**
                     * woocommerce_after_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action('woocommerce_after_main_content');
                    ?>
                    <?php if (get_query_var('paged') == 0) : ?>
                        <div class="contentwatch"><?php etheme_category_header(); ?></div>
                    <?php endif; ?>
                </div>
                <?php if (function_exists('echo_crp')) {
                    echo_crp();
                } ?>
            </div>

        </div>
    </div>
<?php get_footer('shop'); ?>