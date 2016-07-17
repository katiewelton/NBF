<?php

Class TaxonomyTermImage {
  public $taxonomy_name;

  public function __construct($taxonomy_name) {
    add_action('admin_enqueue_scripts', [$this, 'taxonomy_scripts']);
    add_action('init', [$this, 'register_taxonomy_meta']);
    add_action('edit_' . $taxonomy_name, [$this, 'save_term_image']);
    add_action('create_' . $taxonomy_name, [$this, 'save_term_image']);
    add_action(
      $taxonomy_name . '_add_form_fields',
      [$this, 'add_term_image_field']
    );
    add_action(
      $taxonomy_name . '_edit_form_fields',
      [$this, 'edit_term_image_field']
    );

    $this->taxonomy_name = $taxonomy_name;
  }

  public function taxonomy_scripts() {
    $current_screen = get_current_screen();

    if(in_array($current_screen->base, ['edit-tags', 'term'])) {
      $template_uri = get_template_directory_uri();

      wp_enqueue_media();
      wp_register_script(
        'term-image-uploader',
        $template_uri . '/js/term-image-uploader.js',
        '',
        false,
        true
      );
      wp_enqueue_script('term-image-uploader');
      wp_register_style(
        'term-image-uploader-styles',
        $template_uri . '/css/term-image-uploader.css'
      );
      wp_enqueue_style('term-image-uploader-styles');
    }
  }

  public function register_taxonomy_meta() {
    register_meta($this->taxonomy_name . '_term', 'image', false);
    register_meta($this->taxonomy_name . '_term', 'image_id', false);
  }

  public function save_term_image($term_id) {
    if(!isset($_POST['term_image_nonce']) ||
      !wp_verify_nonce($_POST['term_image_nonce'], 'term_image')) return;

    $current_image_val = get_term_meta($term_id, 'term_image', true);
    $new_image_val = !empty($_POST['term_image']) ? $_POST['term_image'] : '';
    $new_image_id_val = !empty($_POST['term_image_id']) ?
                          $_POST['term_image_id'] :
                          '';

    if($current_image_val && $new_image_val === '') {
      delete_term_meta($term_id, 'term_image');
      delete_term_meta($term_id, 'term_image_id');
    } elseif($new_image_val !== $current_image_val) {
      update_term_meta($term_id, 'term_image', $new_image_val);
      update_term_meta($term_id, 'term_image_id', $new_image_id_val);
    }
  }

  public function add_term_image_field() {
    ?>
    <div class="form-field">

      <?php
      include locate_template('templates/admin/term-image-uploader-tpl.php');
      ?>

    </div>

    <?php
  }

  public function edit_term_image_field($term) {
    $term_image = get_term_meta($term->term_id, 'term_image', true);
    $term_image_id = get_term_meta($term->term_id, 'term_image_id', true);
    ?>

    <tr class="form-field">
      <th scope="row">
        <label>Select / Upload image</label>
      </th>
      <td>

        <?php
        include locate_template('templates/admin/term-image-uploader-tpl.php');

        if($term_image_value && $term_image_id_value) { ?>

          <img class="term-image-preview" src="<?php echo $term_image_value; ?>" alt="term image" />

        <?php } ?>

      </td>
    </tr>

    <?php
  }
}
