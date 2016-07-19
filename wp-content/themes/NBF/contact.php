<?php
/**
* Template Name: Contact Page
*/

get_header();
if(have_posts()): while(have_posts()): the_post();
?>

<article class="page-intro">
  <p>Got a query about hiring us?</p>
  <p>Want to buy a print from us?</p>
  <p>Or do you just have a question about light painting?</p>
  <p>Whatever it is, we'd love to hear from you! Get in touch!</p>
</article>

<?php wd_contact_form_maker(3); ?>

<section class="social-bar grid">
  <a href="https://www.facebook.com/nightbearfoto" target="_blank"><i class="fa fa-facebook-square"></i></a>
  <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
  <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
</section>

<?php
endwhile; endif;
get_footer();
