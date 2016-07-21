<?php

define('LOAD_ON_INIT', 1);
define('LOAD_AFTER_WP', 10);
define('LOAD_AFTER_THEME', 100);

function style_script_includes() {
  $template_uri = get_template_directory_uri();
  $stylesheet_uri = get_stylesheet_uri();

  wp_enqueue_script('jquery');
  wp_register_script('respond', '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js', '', '1.4.2', true);
  wp_enqueue_script('respond');
  wp_register_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', '', '2.8.3', true);
  wp_enqueue_script('modernizr');
  wp_register_script('selectivizr', '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js', '', '1.0.2', true);
  wp_enqueue_script('selectivizr');
  wp_register_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', '', '4.4.0');
  wp_enqueue_style('font_awesome');
  wp_register_script('magnific-lib-js', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', '', '1.1.0', true);
  wp_enqueue_script('magnific-lib-js');
  wp_register_style('magnific-lib-css', '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', '', '1.1.0');
  wp_enqueue_style('magnific-lib-css');
  wp_register_script('owlslider-lib-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js', '', '2.0.0-beta.2.4', true);
  wp_enqueue_script('owlslider-lib-js');
  wp_register_style('owlslider-lib-css', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.css', '', '2.0.0-beta.2.4');
  wp_register_script('magnific', $template_uri . '/js/magnific.js', '', '', true);
  wp_enqueue_script('magnific');
  wp_register_style('theme_style', $stylesheet_uri);
  wp_enqueue_style('theme_style');
}
add_action('wp_enqueue_scripts', 'style_script_includes');

add_theme_support('html5', ['comment-list', 'comment-form', 'search-form']);
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

register_nav_menus([
  'main_menu'   => 'Primary navigation menu (in header)',
  'footer_menu' => 'Secondary navigation menu (in footer)'
]);

function format_class_filename($filename) {
  return strtolower(
    implode(
      '-',
      preg_split('/(?=[A-Z])/', $filename, -1, PREG_SPLIT_NO_EMPTY)
    )
  );
}

function autoload_classes($name) {
  $class_name = format_class_filename($name);
  $class_path = get_template_directory() . '/includes/class.'
                . $class_name . '.php';

  if(file_exists($class_path)) require_once $class_path;
}
spl_autoload_register('autoload_classes');

function autoload_lib_classes($name) {
  $lib_class_name = get_template_directory() . '/includes/class.'
                    . strtolower($name) . '.php';

  if(file_exists($lib_class_name)) require_once($lib_class_name);
}
spl_autoload_register('autoload_lib_classes');

if(function_exists('__autoload')) {
  spl_autoload_register('__autoload');
}

function include_additional_files() {
  new WordPressHelpers();
  new CustomPostTypes();
  new TaxonomyFields();

  if(is_admin()) {
    new CustomMetaboxes();
    $nbfAdmin = new nbfAdmin();
    $nbfAdmin->hooks();
  }
}
add_action('init', 'include_additional_files', LOAD_ON_INIT);

function add_ie_xua_header() {
  if(isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
    header('X-UA-Compatible: IE=edge,chrome=1');
  }
}
add_action('send_headers', 'add_ie_xua_header');

add_image_size('team-image', 220, 220, true);
add_image_size('shoots-cover', 940, 630, true);
add_image_size('gallery-block', 500, 360, true);
add_image_size('max-size', 1800, 9999);

function get_template_output($file) {
  ob_start();
  include $file;
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function get_template_page_id($template) {
  global $wpdb;

  $sql = 'SELECT post_id FROM ' . $wpdb->postmeta . '
    WHERE meta_key = "_wp_page_template"
    AND meta_value = "' . $template . '"';

  return $wpdb->get_var($sql);
}
