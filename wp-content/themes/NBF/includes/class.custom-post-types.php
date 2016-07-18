<?php

Class CustomPostTypes {
  public function __construct() {
    add_action('init', [$this, 'initialize_cpts']);
    add_action('init', [$this, 'initialize_taxonomies']);
  }

  public function initialize_cpts() {
    $custom_post_types['photos'] = [
      'labels'          => [
        'name'          => 'Photos',
        'singular_name' => 'Photo'
      ],
      'public'            => true,
      'menu_position'     => '27',
      'menu_icon'         => 'dashicons-camera',
      'capability_type'   => 'post',
      'taxonomies'        => ['shoots'],
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

    $custom_post_types['team'] = [
      'labels'          => [
        'name'          => 'Team',
        'singular_name' => 'Team Member'
      ],
      'public'            => true,
      'menu_position'     => '28',
      'menu_icon'         => 'dashicons-groups',
      'capability_type'   => 'post',
      'has_archive'       => true,
      'supports'          => [
        'title',
        'editor',
        'thumbnail',
        'page-attributes'
      ],
      'rewrite'      => [
        'slug'       => 'about-us',
        'with_front' => false
      ]
    ];

    $this->register_custom_post_types($custom_post_types);
  }

  public function initialize_taxonomies() {
    $custom_taxonomies['shoots'] = [
      'post_type' => 'photos',
      'taxonomy_args' => [
        'labels'              => [
          'name'              => __('Shoots'),
          'singular_name'     => __('Shoot'),
          'all_items'         => __('All Shoots'),
          'parent_item'       => __('Parent Shoot'),
          'parent_item_colon' => __('Parent Shoot:'),
          'edit_item'         => __('Edit Shoot'),
          'update_item'       => __('Update Shoot'),
          'add_new_item'      => __('Add New Shoot'),
          'new_item_name'     => __('New Shoot Name'),
          'menu_name'         => __('Shoots')
        ],
        'show_admin_column' => true,
        'rewrite'      => [
          'slug'       => 'gallery'
        ],
        'hierarchical' => true
      ]
    ];

    $this->register_custom_taxonomies($custom_taxonomies);
  }


  private function register_custom_post_types($cpts) {
    foreach($cpts as $cpt => $cpt_args) {
      register_post_type($cpt, $cpt_args);
    }
  }

  private function register_custom_taxonomies($taxonomies) {
    foreach($taxonomies as $taxonomy => $taxonomy_options) {
      register_taxonomy(
        $taxonomy,
        $taxonomy_options['post_type'],
        $taxonomy_options['taxonomy_args']
      );
    }
  }
}
