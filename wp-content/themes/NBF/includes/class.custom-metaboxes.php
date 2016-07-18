<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Night Bear Foto
 * @package  CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

Class CustomMetaboxes {
  public function __construct() {
    if(file_exists(__DIR__ . '/CMB2/init.php')) {
      require_once __DIR__ . '/CMB2/init.php';
    }

    add_action('cmb2_init', [$this, 'cmb2_nbf_metaboxes']);
    add_action('cmb2_admin_init', [$this, 'cmb2_nbf_register_taxonomy_metabox']);
  }

  public function cmb2_nbf_metaboxes() {
    $prefix = '_nbf_cmb2_';

    $cmb2_field_files = new DirectoryIterator(__DIR__ . '/custom-metaboxes');

    foreach($cmb2_field_files as $file) {
      if($file->isFile()) require_once($file->getPathname());
    }
  }

  public function cmb2_nbf_register_taxonomy_metabox() {
    $terms_prefix = '_nbf_cmb2_term_';

    $cmb2_term = new_cmb2_box([
      'id'           => $terms_prefix . 'edit',
      'title'        => __( 'Category Metabox', 'cmb2'),
      'object_types' => ['term'],
      'taxonomies'   => ['category', 'shoots'],
    ]);

    $cmb2_term->add_field([
      'name'     => __( 'Order', 'cmb2' ),
      'id'       => $terms_prefix . 'order',
      'type'     => 'title',
      'on_front' => false,
    ]);

    $cmb2_term->add_field([
      'name' => __( 'Add the order number to this project type', 'cmb2' ),
      'desc' => __( 'The order is ascending - 1 will appear first', 'cmb2' ),
      'id'   => $terms_prefix . 'order_number',
      'type' => 'text',
    ]);
  }
}
