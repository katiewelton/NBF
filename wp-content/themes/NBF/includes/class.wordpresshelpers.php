<?php

Class WordPressHelpers {
  public function __construct() {
    add_filter('wp_nav_menu_args', [$this, 'omo_default_wp_nav_menu_args']);
    add_filter('the_content', [$this, 'omo_cleanup_shortcode_fix']);
    add_filter('the_content', [$this, 'omo_img_unautop'], LOAD_AFTER_THEME);
    add_filter(
      'post_thumbnail_html',
      [$this, 'omo_remove_thumbnail_dimensions']
    );
    add_filter(
      'image_send_to_editor',
      [$this, 'omo_remove_thumbnail_dimensions']
    );
    add_filter(
      'gform_field_content',
      [$this, 'gform_column_splits'],
      LOAD_AFTER_WP,
      5
    );
  }

  private function omo_default_menu_fallback($args) {
    $nav_el = $args['container'];
    $nav_class = $args['container_class'];
    $menu_class = $args['menu_class'];

    echo (!empty($nav_el) ? '<' . $nav_el . (!empty($nav_class) ? ' class="' .
     $nav_class . '">' : '>') : '')
     . '<ul class="' . (!empty($menu_class) ? $menu_class : '') . '">'
       . '<li class="menu-item">'
         . '<a href="' . admin_url('nav-menus.php?action=edit&menu=0') . '">Add Menu</a>'
       . '</li>'
     . '</ul>'
    . (!empty($nav_el) ? '</' . $nav_el . '>' : '');
  }

  public function omo_default_wp_nav_menu_args($args) {
    if(has_nav_menu($args['theme_location']) === false) {
      $args['fallback_cb'] = $this->omo_default_menu_fallback($args);
    }

    return $args;
  }

  public function omo_cleanup_shortcode_fix($content) {
    $array = [
      '<p>[' => '[',
      ']</p>' => ']',
      ']<br />' => ']',
      ']<br>' => ']'
    ];

    return strtr($content, $array);
  }

  public function omo_img_unautop($content) {
    return preg_replace(
      '/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
      '<div class="post-image">$1</div>',
      $content
    );
  }

  public function omo_remove_thumbnail_dimensions($html) {
   return preg_replace('/(width|height)=\"\d*\"\s/', '', $html);
  }

  public function gform_column_splits($content, $field, $value, $lead_id, $form_id) {
    if(is_admin()) return $content;

    $form = RGFormsModel::get_form_meta($form_id, true);
    $form_class = array_key_exists('cssClass', $form) ? $form['cssClass'] : false;
    $form_classes = preg_split(
      '/[\n\r\t ]+/',
      $form_class,
      -1,
      PREG_SPLIT_NO_EMPTY
    );
    $fields_class = array_key_exists('cssClass', $field) ?
      $field['cssClass'] :
      false;
    $field_classes = preg_split(
      '/[\n\r\t ]+/',
      $fields_class,
      -1,
      PREG_SPLIT_NO_EMPTY
    );

    if($field['type'] == 'section') {
      $form_class_matches = array_intersect($form_classes, ['two-column']);
      $field_class_matches = array_intersect($field_classes, ['gform_column']);
      if(!empty($form_class_matches) && !empty($field_class_matches)) {
        $ul_classes = GFCommon::get_ul_classes($form) . ' ' . $field['cssClass'];

        return '</li></ul><ul class="' . $ul_classes . '"><li class="gfield gsection empty">';
      }
    }

    return $content;
  }
}
