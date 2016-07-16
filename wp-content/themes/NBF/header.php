<!doctype html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?php echo (is_front_page()) ? get_bloginfo('name') . ' - ' . get_bloginfo('description') : wp_title(''); ?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
    <?php wp_head(); ?>

    <?php if($meta_data): ?>

      <meta property="og:title" content="<?php echo $meta_data->title; ?>" />
      <meta property="og:type" content="website"/>
      <meta property="og:url" content="<?php echo $meta_data->url; ?>" />
      <meta property="og:image" content="<?php echo $meta_data->image; ?>" />
      <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
      <meta property="og:description" content="<?php echo $meta_data->excerpt; ?>" />

    <?php endif; ?>

  </head>
  <body <?php body_class(); ?>>
