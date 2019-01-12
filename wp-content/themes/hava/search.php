<?php get_header(); ?>

<div class="container">
  <div class="row">

    <section class="col-lg-10 offset-lg-1" id="firs">
      <div class="taxanomy-heading"><p><?php echo sprintf( __( '%s Search Results for ', 'hava' ), $wp_query->found_posts ); echo get_search_query(); ?></p>
        <hr>
      </div>

      <?php get_template_part('loop'); ?>

    </section>
  </div>
</div>

<?php get_footer(); ?>
