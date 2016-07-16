<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?php echo (is_front_page()) ? get_bloginfo('name') . ' - ' . get_bloginfo('description') : wp_title(''); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
    <?php wp_head(); ?>

  </head>
  <body <?php body_class(); ?>>

    <header>
      <a href="<?php echo get_site_url(); ?>" class="logo"></a>

      <?php
      wp_nav_menu([
        'theme_location' => 'main_menu',
        'container'      => false,
        'menu_class'     => 'header-menu'
      ]);

      get_template_part('templates/footer', 'tpl');
      ?>

      <a href="<?php echo get_site_url(); ?>" class="logo"></a>
    </header>
