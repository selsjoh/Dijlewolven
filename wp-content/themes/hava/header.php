<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <header>
    <div class="container-fluid blog-head">
      <?php hava_header_logo(); ?>
      <nav class="nav justify-content-center">
        <div class="clearfix"></div>
        <?php hava_nav(); ?>
      </nav>
    </div>
  </header>
