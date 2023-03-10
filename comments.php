<?php
/**
 * The template file for displaying the comments and comment form for the
 * mehnaz theme.
 *
 * @package WordPress
 * @subpackage mehnaz
 * @since mehnaz 1.0
*/

if ( $comments ) {
	?>

	<div class="comments" id="comments">

		<?php
		$comments_number = absint( get_comments_number() );
		?>

		<div class="comments-header section-inner">

			<h2 class="comment-reply-title">
			<?php
			if ( ! have_comments() ) {
				_e( 'Leave a comment', 'mehnaz' );
			} elseif ( 1 === $comments_number ) {
				
				printf( _x( 'One reply on &ldquo;%s&rdquo;', 'comments title', 'mehnaz' ), get_the_title() );
			} else {
				printf(
					
					_nx(
						'%1$s reply on &ldquo;%2$s&rdquo;',
						'%1$s replies on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'mehnaz'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}

			?>
			</h2>

		</div>

		<div class="comments-inner section-inner">

			<?php
			wp_list_comments(
				array(
					'avatar_size' => 120,
					'style'       => 'div',
				)
			);

			$comment_pagination = paginate_comments_links(
				array(
					'echo'      => false,
					'end_size'  => 0,
					'mid_size'  => 0,
					'next_text' => __( 'Newer Comments', 'mehnaz' ) . ' <span aria-hidden="true">&rarr;</span>',
					'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __( 'Older Comments', 'mehnaz' ),
				)
			);

			if ( $comment_pagination ) {
				$pagination_classes = '';

				
				if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
					$pagination_classes = ' only-next';
				}
				?>

				<nav class="comments-pagination pagination<?php echo $pagination_classes; ?>" aria-label="<?php esc_attr_e( 'Comments', 'mehnaz' ); ?>">
					<?php echo wp_kses_post( $comment_pagination ); ?>
				</nav>

				<?php
			}
			?>

		</div>

	</div>

	<?php
}

if ( comments_open() || pings_open() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	comment_form(
		array(
			'class_form'         => 'section-inner thin max-percentage',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		)
	);

} elseif ( is_single() ) {

	if ( $comments ) {
		echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
	}

	?>

	<div class="comment-respond" id="respond">

		<p class="comments-closed"><?php _e( 'Comments are closed.', 'mehnaz' ); ?></p>

	</div>
	
	<?php
}
