<?php
/**
* Template Name: Contact Page
*/

get_header();
?>

  <h1>NIGHT BEAR FOTO</h1>

<?php
if(have_posts()): while(have_posts()): the_post();


endwhile; endif;
get_footer();
