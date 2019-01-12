<?php get_header(); ?>

<div class="container">
  <div class="row">

    <section class="col-lg-10 offset-lg-1" id="firs">

      <?php
      the_archive_title('<div class="taxanomy-heading"><h1>', '</h1>');
      the_archive_description('<div class="taxanomy-heading">', '</div>');
      ?>
      <hr>
      <?php get_template_part('loop'); ?>

    </section>

  </div>
</div>

<?php get_footer(); ?>
