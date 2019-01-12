<?php get_header(); ?>

<div class="container">
  <div class="row">

    <section class="col-lg-10 offset-lg-1" id="firs">
      <div class="not-found">
        <i class="fas fa-exclamation-circle fa-4x" style="margin-top: 30px; margin-bottom: 30px;"></i>
        <h1><?php _e('404', 'hava'); ?></h1>
        <p><?php _e('Nothing was found at this location.', 'hava'); ?></p>
      </div>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="button"><?php _e('Go Back', 'hava'); ?></a>
    </section>

  </div>
</div>

<?php get_footer(); ?>
