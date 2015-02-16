<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package cakes
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments-blog" class="comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>

    <div class="comments-title">
      <h2><?php _e( 'Comments', 'cakes' ) ; ?></h2>
      <div class="comments-count">
      <?php
        printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'cakes' ),
          number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
      ?>
      </div>
    </div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'cakes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cakes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cakes' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list animate-blog">
      <?php wp_list_comments('callback=wordpressapi_comments'); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'cakes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cakes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cakes' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'cakes' ); ?></p>
	<?php endif; ?>

  <div class="comment-form animete-form">
	<?php
  // Customize the comments template
  $comment_args = array(
    'fields' => apply_filters(
      'comment_form_default_fields', array(
        'author' =>'<div class="form-item fade-anime time-300">' .
          '<input type="email" name="name" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Your email" required aria-required="true">'.
          '</div>'
          ,
        'email'  => '<div class="form-item fade-anime time-400">' .
          '<input type="email" name="name" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="Your email" required aria-required="true">'  .
          '</div>',
        'url'    => ''
      )
    ),
    'comment_field' => '<div class="form-item fade-anime time-500">' .
      '<textarea name="comment" placeholder="' . __( 'Comment', 'cakes'  ) . '" required aria-required="true"></textarea>' .
      '</div>',
      'comment_notes_before' => '',
      'comment_notes_after' => '',
      'title_reply' => __( 'Leave <b>Your Comment</b>', 'cakes'  ),
      'label_submit'      => __( 'submit', 'cakes'  )
  );

  comment_form($comment_args); ?>
  </div>


</div><!-- #comments -->
