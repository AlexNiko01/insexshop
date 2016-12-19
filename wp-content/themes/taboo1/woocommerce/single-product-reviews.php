<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

if ( ! comments_open() )
	return;
?>
<div id="reviews">
	<div id="comments">
		<div class="widgettitle"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
				printf( _n('%s отзыв для %s', '%s отзывов для %s', $count, ETHEME_DOMAIN), $count, get_the_title() );
			else
				_e( 'Reviews', ETHEME_DOMAIN );
		?></div>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
<li class="comment byuser comment-author-admin bypostauthor odd alt depth-2" id="first-comment">
<div class="comment_container"><img width="100" height="100" alt="Эксперт секс-шопа Игорь" src="https://insexshop.com.ua/wp-content/themes/taboo/images/igor.jpg" class="first-avatar avatar-60 photo">
<div class="comment-text">
<div class="description"><p>Здравствуйте, меня зовут Игорь. Я являюсь экспертом интернет-магазина Табу.</p>
<p>Не можете определится с товаром из категории <?php $size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
echo $product->get_categories( ', ' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ) . ' ' ); ?>? Остались вопросы перед покупкой секс-игрушки популярного бренда? - Вы можете смело задавать их мне! Буду признателен за отзывы тех, кто купил или использовал <?php the_title(); ?>.</p>
			
</div></div></div>
</li>
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' 	=> '&larr;',
					'next_text' 	=> '&rarr;',
					'type'			=> 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<ol class="commentlist">
<li class="comment byuser comment-author-admin bypostauthor odd alt depth-2" id="first-comment">
<div class="comment_container"><img width="100" height="100" alt="Эксперт секс-шопа Игорь" src="https://insexshop.com.ua/wp-content/themes/taboo/images/igor.jpg" class="first-avatar avatar-60 photo">
<div class="comment-text">
<div class="description"><p>Здравствуйте, меня зовут Игорь. Я являюсь экспертом интернет-магазина Табу.</p>
<p>Задавайте свои вопросы, я постараюсь ответить на каждый из них. Если Вы являетесь Клиентом нашего секс-шопа - жду Ваши отзывы, предложения или замечания по сервису и конечно же комментарии!</p></div></div></div>
</li>
			</ol>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', ETHEME_DOMAIN ) : __( 'Be the first to review', ETHEME_DOMAIN ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', ETHEME_DOMAIN ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', ETHEME_DOMAIN ) . ' <span class="required">*</span></label> ' .
							            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', ETHEME_DOMAIN ) . ' <span class="required">*</span></label> ' .
							            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
						),
						'label_submit'  => __( 'Submit', ETHEME_DOMAIN ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', ETHEME_DOMAIN ) .'</label><select name="rating" id="rating">
							<option value="">' . __( 'Rate&hellip;', ETHEME_DOMAIN ) . '</option>
							<option value="5">' . __( 'Perfect', ETHEME_DOMAIN ) . '</option>
							<option value="4">' . __( 'Good', ETHEME_DOMAIN ) . '</option>
							<option value="3">' . __( 'Average', ETHEME_DOMAIN ) . '</option>
							<option value="2">' . __( 'Not that bad', ETHEME_DOMAIN ) . '</option>
							<option value="1">' . __( 'Very Poor', ETHEME_DOMAIN ) . '</option>
						</select></p>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', ETHEME_DOMAIN ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' . wp_nonce_field( 'woocommerce-comment_rating', '_wpnonce', true, false ) . '</p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', ETHEME_DOMAIN ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>