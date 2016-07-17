<?php
/**
* Template Name: Gallery Page
*/

get_header();
$photos_page_id = get_template_page_id('archive-photos.php');
$photos_fields = new CMB2Fields($photos_page_id);
$photos = new Query('photos');
$query_args = [
  'posts_per_page' => get_option('posts_per_page'),
];
$results = $photos->query($query_args);
?>

  <h1>NIGHT BEAR FOTO</h1>

<?php
if($results->have_posts()): while($results->have_posts()): $results->the_post();

  the_title();

endwhile; endif;
get_footer();
