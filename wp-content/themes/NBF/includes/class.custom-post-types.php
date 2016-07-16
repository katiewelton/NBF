<?php

Class CustomPostTypes {
  public function __construct() {
    add_action('init', [$this, 'initialize_cpts']);
  }

  public function initialize_cpts() {
    $custom_post_types['photos'] = [
      'labels'          => [
        'name'          => 'Photos',
        'singular_name' => 'Photo'
      ],
      'public'            => true,
      'menu_position'     => '26.982',
      'menu_icon'         => 'dashicons-camera',
      'capability_type'   => 'post',
      'supports'          => [
        'title',
        'editor',
        'thumbnail',
        'page-attributes'
      ],
      'rewrite'      => [
        'slug'       => 'gallery',
        'with_front' => false
      ],
    ];
    $this->register_custom_post_types($custom_post_types);
  }

  private function register_custom_post_types($cpts) {
    foreach($cpts as $cpt => $cpt_args) {
      register_post_type($cpt, $cpt_args);
    }
  }
}
