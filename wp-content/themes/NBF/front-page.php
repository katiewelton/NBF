<?php
/**
* Template Name: Front Page
*/

get_header();
?>

  <h1>HELLO WORLD</h1>

<?php
if(have_posts()): while(have_posts()): the_post();


endwhile; endif;
get_footer();
