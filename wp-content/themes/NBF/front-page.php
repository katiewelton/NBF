<?php
/**
* Template Name: Front Page
*/

get_header();
?>

  <article class="hero grid">
    <h2>the night is our canvas</h2>
    <h1>NIGHT BEAR FOTO</h1>
    <h2>the light is our color</h2>
  </article>

  <section class="social-bar grid">
    <a href="https://www.facebook.com/areyoubearenough" target="_blank"><i class="fa fa-facebook-square"></i></a>
    <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
    <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
  </section>

  <article class="page-intro">
    <p>Night Bear Foto are available for weddings, parties, festivals and other events</p>
    <p>We also offer photoshoots for bands, groups and companies</p>
    <p>We have a number of lightpainting packages available</p>
    <p>Or we can work with you to build a custom package for your event</p>
  </article>

  <section class="cta grid">
    <div class="cta-box grid">
      <h3>Find out more</h3>
      <a href="/contact" class="cta-button">ABOUT US</a>
    </div>
    <div class="cta-box grid">
      <h3>Get in touch with us</h3>
      <a href="/contact" class="cta-button">CONTACT</a>
    </div>
    <div class="cta-box grid">
      <h3>Or view our gallery</h3>
      <a href="/gallery" class="cta-button">GALLERY</a>
    </div>
  </section>

<?php
if(have_posts()): while(have_posts()): the_post();


endwhile; endif;
get_footer();
