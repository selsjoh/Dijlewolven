<?php

function hava_logo_col_class() {

  $blogname = get_bloginfo('name');

  if ((strlen($blogname)) < 6 or has_custom_logo()){
    $cls = "col-xs-auto";
  } elseif ((strlen($blogname)) > 6 && (strlen($blogname)) < 13 ) {
    $cls = "col-sm-auto";
  } elseif ((strlen($blogname)) > 13 && (strlen($blogname)) < 18 ) {
    $cls = "col-md-auto";
  } elseif ((strlen($blogname)) > 18 && (strlen($blogname)) < 25 ) {
    $cls = "col-lg-auto";
  } else  {
    $cls = "col-xl-auto";
  }
  return $cls;
}

function hava_header_logo() {

  if (strlen(esc_html(get_theme_mod("url_1"))) or strlen(esc_html(get_theme_mod("url_2"))) or strlen(esc_html(get_theme_mod("url_3"))) > 0 ) {
    $class = 'class="title"';
  } else{
    $class = 'class="title" style="margin-right: 0px"';
  }
  ?>

  <div class="row">
    <div class="<?php echo hava_logo_col_class(); ?>">

      <?php
      if (has_custom_logo()) {
        the_custom_logo(); ?>
        <div class="header-icons-logo">
          <?php hava_header_icon(); ?>
        </div>
        <?php
      } else {
        if (is_front_page() && is_home()) : ?>
        <h1 <?php echo $class; ?>>
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <?php bloginfo('name'); ?>
          </a>
        </h1>
      <?php else : ?>
        <p <?php echo $class; ?>>
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <?php bloginfo('name'); ?>
          </a>
        </p>

      <?php endif; ?>
      <div class="header-icons">
        <?php hava_header_icon(); ?>
      </div>
    <?php }
    ?>
  </div>
</div>

<?php
}
