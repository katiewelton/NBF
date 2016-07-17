<?php

Class TaxonomyFields {
  public function __construct() {
    spl_autoload_register([$this, 'autoload_taxonomy_classes']);

    new TaxonomyTermImage('shoots');

    add_filter('manage_edit-project_sortable_columns', [$this, 'sortable_project_type_column']);
  }

  public function autoload_taxonomy_classes($name) {
    $class_name = format_class_filename($name);
    $class_path = get_template_directory() . '/includes/taxonomy-fields/class.'
                                           . $class_name . '.php';

    if(file_exists($class_path)) require_once $class_path;
  }

  public function sortable_project_type_column($columns) {
      $columns['taxonomy-shoots'] = 'shoots';

      return $columns;
  }
}
