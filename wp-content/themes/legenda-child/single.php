<?php
get_header();
?>

<?php
extract(etheme_get_page_sidebar());
$blog_slider = etheme_get_option('blog_slider');
$postspage_id = get_option('page_for_posts');
?>


<?php if ($page_heading != 'disable' && ($page_slider == 'no_slider' || $page_slider == '')): ?>
    <div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
        <div class="container">
            <div class="row-fluid">
                <div class="span12 a-center">
                    <h1 class="title"><span><?php the_title(); ?></span></h1>
                    <?php /*<h1 class="title"><span><?php echo get_the_title($postspage_id); ?></span></h1>*/ ?>
                    <?php if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumb">', '</div>');
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if ($page_slider != 'no_slider' && $page_slider != ''): ?>

    <?php echo do_shortcode('[rev_slider_vc alias="' . $page_slider . '"]'); ?>

<?php endif; ?>


<div class="container">
    <div class="page-content sidebar-position-<?php echo $position; ?> responsive-sidebar-<?php echo $responsive; ?>">
        <div class="row-fluid">
            <?php if ($position == 'left' || ($responsive == 'top' && $position == 'right')): ?>
                <div class="<?php echo $sidebar_span; ?> sidebar sidebar-left">
                    <?php etheme_get_sidebar($sidebarname); ?>
                </div>
            <?php endif; ?>

            <div class="content <?php echo $content_span; ?>">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <div class="contentwatch">
                        <article <?php post_class('blog-post post-single'); ?> id="post-<?php the_ID(); ?>">

                            <?php $images = etheme_get_images(1000, 1000, false); ?>

                            <?php the_content(); ?>

                            <div class="post-info">
							<span class="posted-on">

                                <?php _e('Дата публикации') ?>
                                <?php the_date(get_option('date_format')); ?>

							</span> <?php if (function_exists('the_ratings')) {
                                    the_ratings();
                                } ?>

                            </div>

                            <?php if (has_tag()): ?>
                                <p class="tag-container"><?php the_tags(); ?></p>
                            <?php endif ?>
                            <div class="post-navigation">
                                <?php wp_link_pages(); ?>
                            </div>

                            <div class="clear"></div>

                            <?php if (etheme_get_option('post_share')): ?>
                                <div class="row-fluid post-share">
                                    <div class="span12"><?php echo do_shortcode('[share]'); ?></div>
                                </div>
                            <?php endif; ?>

                            <?php if (etheme_get_option('posts_links')): ?>
                                <div class="row-fluid post-next-prev">
                                    <div class="span6"><?php previous_post_link() ?></div>
                                    <div class="span6 a-right"><?php next_post_link() ?></div>
                                </div>
                            <?php endif; ?>

                        </article>
                    </div>

                <?php endwhile; else: ?>

                    <h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

                <?php endif; ?>

                <?php comments_template('', true); ?>

            </div>

            <?php if ($position == 'right' || ($responsive == 'bottom' && $position == 'left')): ?>
                <div class="<?php echo $sidebar_span; ?> sidebar sidebar-right">
                    <?php etheme_get_sidebar($sidebarname); ?>
                </div>
            <?php endif; ?>

        </div>

    </div>
</div>

<?php
get_footer();
?>
