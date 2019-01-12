<footer>
  <div class="container-fluid blog-ass">

    <?php
    if (is_active_sidebar('widget-area-1')
    && is_active_sidebar('widget-area-2')
    && is_active_sidebar('widget-area-3')
    ) :
    ?>

    <aside class="row widget-area">
      <div class="col-md widget">
        <?php dynamic_sidebar('widget-area-1'); ?>
      </div>

      <div class="col-md widget">
        <?php dynamic_sidebar('widget-area-2'); ?>
      </div>

      <div class="col-md widget">
        <?php dynamic_sidebar('widget-area-3'); ?>
      </div>

    </aside>

  <?php endif; ?>

	<?php get_search_form(); ?>

  <div class="footer-icons">
    <?php hava_footer_icon(); ?>
  </div>

  <p><span class="abouttext"><?php echo esc_html(get_theme_mod('footer_text')); ?></span></p>
  <p><span class="copytext"><?php echo esc_html(get_theme_mod('copyright_text', 'Crafted by Huseyn A. / Proudly powered by WordPress')); ?></span></p>
</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
