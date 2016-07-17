<?php
$term_image_value = !empty($term_image) ? $term_image : false;
$term_image_id_value = !empty($term_image_id) ? $term_image_id : false;
wp_nonce_field('term_image', 'term_image_nonce');
?>

<input class="term-image-upload-field" type="text" name="term_image" value="<?php echo $term_image_value; ?>" readonly />
<input class="term-image-attachment-id" type="hidden" name="term_image_id" value="<?php echo $term_image_id_value; ?>" readonly />
<button class="button button-secondary term-image-upload-btn">
  Upload Image
</button>
