<?php
/**
* Template Name: About Us Page
*/
get_header();
$team_page_id = get_template_page_id('archive-team.php');
$team_page = get_post($team_page_id);
$team_fields = new CMB2Fields($team_page_id);
$team = new Query('team');
$query_args = [
  'posts_per_page' => get_option('posts_per_page'),
  'order' => 'ASC'
];
$results = $team->query($query_args);
?>

<article class="page-intro">

  <?php echo $team_page->post_content; ?>

</article>

<?php if($results->have_posts()): ?>

  <section class="team grid">

    <?php
    while($results->have_posts()):
      $results->the_post();
      $team_fields->post_id = get_the_ID();
    ?>

      <div class="team-box grid">
        <img src="<?php echo $team_fields->get_featured_image('team-image'); ?>" class="team-image" />
        <h2 class="team-name"><?php the_title(); ?></h2>
        <div class="team-details"><?php the_content(); ?></div>
      </div>

    <?php endwhile; ?>

  </section>

<?php endif; ?>

<section class="social-bar grid">
  <a href="https://www.facebook.com/nightbearfoto" target="_blank"><i class="fa fa-facebook-square"></i></a>
  <a href="https://www.instagram.com/nightbearfoto/" target="_blank"><i class="fa fa-instagram"></i></a>
  <a href="https://twitter.com/nightbearfoto" target="_blank"><i class="fa fa-twitter-square"></i></a>
</section>

<?php get_footer();
