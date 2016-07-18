<?php
/**
* Template Name: Gallery Page
*/

get_header();
$gallery_id = get_template_page_id('archive-photos.php');
$gallery_fields = new CMB2Fields($gallery_id);

if(have_posts()): while(have_posts()): the_post();

  $terms = get_terms([
    'taxonomy' => 'shoots',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
      [
        'key' => '_nbf_cmb2_term_order_number',
        'compare' => 'EXISTS'
      ]
    ]
  ]);
?>

<article class="page-intro">
  <p>Night Bear Foto are available for weddings, parties, festivals and other events</p>
  <p>We also offer photoshoots for bands, groups and companies</p>
  <p>We have a number of lightpainting packages available</p>
  <p>Or we can work with you to build a custom package for your event</p>
</article>
<main class="image-listing grid">

<?php
foreach($terms as $term):
  $image_id = get_term_meta($term->term_id, 'term_image_id', true);
  $image = wp_get_attachment_image_src($image_id, 'shoots-cover')[0];
  $link = get_term_link($term);
  $name = $term->name;
  ?>

  <a href ="<?php echo $link; ?>" class="gallery-box">
    <h2><?php echo $name; ?></h2>
    <img alt="<?php echo $name; ?> category" src="<?php echo $image; ?>" class="cover" />
  </a>

<?php endforeach; ?>

</main>
<section class="social-bar grid">
  <a href="https://www.facebook.com/areyoubearenough" target="_blank"><i class="fa fa-facebook-square"></i></a>
  <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
  <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
</section>

<?php
endwhile; endif;
get_footer();
