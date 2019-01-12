<?php get_header(); ?>

<div class="container">
  <div class="row">

    <div class="col-lg-10 offset-lg-1" id="firs">

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <div class="post-thumbnail" style="background-image: url(
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail_url();
            ?>
            )">
            <?php
          } else {
            echo esc_url( get_template_directory_uri() ); ?>/images/default-thumbnail.jpg)">
          <?php } ?>

        <div class="post-c-heading">
          <h1><?php the_title(); ?></h1>
        </div>
      </div>

      <div class="post-content">
        <span class="postinfo"><?php the_time(get_option('date_format')); ?> <br /> <?php echo get_the_author_link(); ?></span>
        <?php the_content();

        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hava' ),
          'after'  => '</div>',
        ) );
        ?>

        <hr class="single-end">
        <div class="tags"><?php the_tags(__('Tags:', 'hava'), ',', '<br>'); ?></div>
        <div class="tags"><?php _e('Categorised in: ', 'hava'); the_category(', '); ?></div>

        <?php comments_template(); ?>
      </div>

    <?php endwhile; ?>
  <?php else: ?>

    <article>
      <h1><?php _e('Sorry, nothing to display.', 'hava'); ?></h1>
    </article>

  <?php endif; ?>

    </div>
  </div>
</div>

<?php get_footer(); ?>
