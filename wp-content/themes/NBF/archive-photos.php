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
  <p>Welcome to our gallery!</p>
  <p>Some of these albums are added to regularly, other's are one offs from events</p>
  <p>Have you been part of a shoot recently? Check below to find your event album</p>
  <p>Event albums are added within 1 month of the event finishing</p>
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
    <div class= "image-container">
      <img alt="<?php echo $name; ?> category" src="<?php echo $image; ?>" class="cover" />
      <div class="hover">
        <div class="hover-plus"><i class="fa fa-plus"></i></div>
      </div>
    </div>
  </a>

<?php endforeach; ?>

</main>
<section class="social-bar grid">
  <a href="https://www.facebook.com/nightbearfoto" target="_blank"><i class="fa fa-facebook-square"></i></a>
  <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
  <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
</section>

<?php
endwhile; endif;
get_footer();
