<?php

Class CustomPostTypes {
  public function __construct() {
    add_action('init', [$this, 'initialize_cpts']);
  }

  public function initialize_cpts() {
    $custom_post_types['project'] = [
      'labels'          => [
        'name'          => 'Projects',
        'singular_name' => 'Project'
      ],
      'public'            => true,
      'menu_position'     => '26.982',
      'menu_icon'         => 'dashicons-edit',
      'capability_type'   => 'post',
      'taxonomies'        => ['project-type'],
      'supports'          => [
        'title',
        'editor',
        'thumbnail',
        'page-attributes'
      ],
      'rewrite'      => [
        'slug'       => 'our-work',
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
