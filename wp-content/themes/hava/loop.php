<?php
if (have_posts()) :
  while (have_posts()) : the_post();
  ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>" class="post-box" style="background-image: url(
      <?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); ?> )">
      <?php
      } else {
        echo esc_attr( get_theme_mod('default_thumbnail')); ?>)">
      <?php } ?>
      <div class="post-inner">
        <h3><?php the_title(); ?></h3>
        <hr>
        <p><?php the_time('d.m.Y'); ?></p>
      </div>
    </a>
  </article>

<?php endwhile; ?>

<div class="button"><?php next_posts_link(__('Older Posts', 'hava')); ?></div>
<div class="button"><?php previous_posts_link(__('Go Back', 'hava')); ?></div>

<?php else : ?>
  <div class="not-found">
    <i class="fas fa-exclamation-circle fa-4x" style="margin-top: 30px; margin-bottom: 30px;"></i>
    <p><?php _e('Sorry, no posts matched your criteria.', 'hava'); ?></p>
  </div>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="button"><?php _e('Go Back', 'hava'); ?></a>
<?php endif; ?>
