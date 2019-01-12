<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php if (have_comments()) : ?>
    <h2>
      <?php
      $comment_count = get_comments_number();
      printf(
        esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'hava')),
        number_format_i18n($comment_count),
        '<span>' . get_the_title() . '</span>'
      );
      ?>
    </h2>

    <?php the_comments_navigation(); ?>

    <div class="comment-list">
      <?php
      wp_list_comments(array(
        'max_depth'         => 3,
        'style'             => 'ul',
        'avatar_size'       => 64,
        'short_ping'        => true
      ));
      ?>
    </div>

    <?php the_comments_navigation();

    if (! comments_open()) :
      ?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'hava'); ?></p>
      <?php
    endif;
  endif;

  comment_form();
  ?>

</div>
