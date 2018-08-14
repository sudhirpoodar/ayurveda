<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package magplus
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

<!-- Comments -->
<section class="coment-item">
  <!--<section class="post-comment" id="comments">-->
  <?php if(have_comments()): ?>
  <h4 class="tt-title-block-2 size-2 color-2"><?php echo get_comments_number(); ?> <?php esc_html_e('Comments', 'magplus'); ?></h4>
  <div class="empty-space marg-lg-b20"></div>

    <ol class="tt-comment commentlist">
      <?php
        wp_list_comments( array(
          'callback'     => 'magplus_comment',
          'end-callback' => 'magplus_close_comment',
          'style'        => 'ol',
          'short_ping'   => true,
        ) );
      ?>
    </ol>
    <div class="empty-space marg-lg-b60 marg-sm-b50 marg-xs-b30"></div>
    <div class="tt-devider"></div>
    <div class="empty-space marg-lg-b55 marg-sm-b50 marg-xs-b30"></div>

  <?php endif; ?>
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'magplus' ); ?></h2>
      <div class="nav-links">

        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'magplus' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'magplus' ) ); ?></div>

      </div><!-- .nav-links -->
    </nav><!-- #comment-nav-above -->
  <?php endif; // check for comment navigation ?>

  <!--</section>-->

  <!-- Add Comment -->
  <div class="tt-comment-form tt-comment-form clearfix">

    <?php
      $commenter = wp_get_current_commenter();
      $req       = get_option( 'require_name_email' );
      $aria_req  = ( $req ? " aria-required='true'" : '' );
      $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

      $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'comment_submit',
        'title_reply'       => magplus_get_opt( 'translation-leave-comment'),
        'title_reply_to'    => magplus_get_opt( 'translation-leave-comment').' %s',
        'cancel_reply_link' => magplus_get_opt( 'translation-cancel-comment'),
        'label_submit'      => magplus_get_opt( 'translation-post-comment'),
        'comment_field'     => '
          <textarea name="comment" id="text" ' . $aria_req . ' class="c-area type-2 form-white placeholder" rows="10" placeholder="'.magplus_get_opt( 'translation-your-comment').'"  maxlength="400"></textarea>
          ',
        'must_log_in'          => '<div class="simple-text font-poppins color-3"><p class="must-log-in">' .  wp_kses_post(sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'magplus' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) )) . '</p></div>',
        'logged_in_as'         => '<div class="simple-text font-poppins color-3"><p class="logged-in-as">' . wp_kses_post(sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  ,'magplus'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) ). '</p></div>',
        'comment_notes_before' => '<div class="simple-text size-5 font-poppins color-3"><p>Your email address will not be published. Required fields are marked *</p>',
        'comment_notes_after'  => '',
        'class_submit'         => '',
        'fields' => apply_filters( 'comment_form_default_fields',
          array(
            'author' => '
                <div class="row"><div class="col-sm-6">
                  <!-- Name -->
                  <input type="text" name="author" id="name" ' . $aria_req . ' class="c-input placeholder" placeholder="Name" maxlength="100">',

            'email' => '
                <input type="email" name="email" id="email" placeholder="'.magplus_get_opt( 'translation-email').'" class="c-input placeholder" maxlength="100">',

            'url' => '
              <input type="text" name="url" id="website" placeholder="'.magplus_get_opt( 'translation-website').'" class="c-input placeholder" maxlength="100"></div></div>',
             'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
            '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'magplus' ) . '</label></p></div>'
          )
        )
      );
      comment_form($args);
    ?>
  

  </div>
  <!-- End Add Comment -->
</section>
<!--end of comments-->
