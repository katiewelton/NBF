<?php

get_header();
$taxonomy_type = get_queried_object();
$taxonomy_page_id = get_the_id();
$name = $taxonomy_type->name;
$description = $taxonomy_type->description;
$image = get_term_meta($taxonomy_type->term_id, 'term_image', true);
?>

<div class="page-intro">
  <?php echo $name; ?>
  <?php echo $description; ?>
</div>


<?php
$photos = new Query('photos');
$args = [
  'posts_per_page' => -1,
  'tax_query'      => [
    [
      'taxonomy' => 'shoots',
      'field'    => 'name',
      'terms'    => $taxonomy_type->name
    ]
  ]
];

$results = $photos->query($args);
if($results->have_posts()):
?>

  <div class="gallery-container grid">

    <?php  while($results->have_posts()): $results->the_post();
      $photo_id = get_the_ID();
      $photo_fields = new CMB2Fields($photo_id);
      $date = $photo_fields->field('photo_date');
      $location = $photo_fields->field('photo_location');

      $image_thumbnail = wp_get_attachment_image_src(
        get_post_thumbnail_id(get_the_ID()),
        'gallery-block'
      )[0];

      $image_full = wp_get_attachment_image_src(
        get_post_thumbnail_id(get_the_ID()),
        'max-size'
      )[0];

    ?>

      <a href="<?php echo $image_full; ?>" class="gallery-block">
        <img src="<?php echo $image_thumbnail; ?>" class="gallery-image">
        <div class="image-hover grid">
          <p><?php echo $date; ?></p>
          <p><?php echo $location; ?></p>
        </div>
      </a>

    <?php endwhile; ?>

  </div>
  <section class="social-bar grid">
    <a href="https://www.facebook.com/areyoubearenough" target="_blank"><i class="fa fa-facebook-square"></i></a>
    <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
    <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
  </section>


<?php endif;
get_footer();
