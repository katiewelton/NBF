<?php

class MetaData {
  public $title,
         $url,
         $image,
         $excerpt;

  public function __construct($title, $url, $image, $excerpt) {
    $this->title = $title;
    $this->url = $url;
    $this->image = $this->get_image_for_meta($image);
    $this->excerpt = $excerpt;

    return $this->generate_meta_data_array();
  }

  private function generate_meta_data_array() {
    return [
      'title'   => $this->title,
      'url'     => $this->url,
      'image'   => $this->image,
      'excerpt' => $this->excerpt
    ];
  }

  private function get_image_for_meta($image) {
    return !empty($image) ?
      $image :
      get_template_directory_uri() . '/images/fb-share-logo.png';
  }
}
