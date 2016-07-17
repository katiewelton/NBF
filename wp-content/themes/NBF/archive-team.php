<?php
/**
* Template Name: About Us Page
*/
get_header();
$team_page_id = get_template_page_id('archive-team.php');
$team_fields = new CMB2Fields($team_page_id);
$team = new Query('team');
$query_args = [
  'posts_per_page' => get_option('posts_per_page'),
  'order' => 'ASC'
];
$results = $team->query($query_args);
?>

<div class="site-intro">
  <p>NightBearFoto began with two friends sharing a passion.
  <p>The team has since grown to five permanent members</p>
  <p>who have honed their photographic skills,</p>
  <p>adapted their light sources and now work together to create</p>
  <p>portrait, landscape and abstract lightpaintings.</p>
</div>

<?php if($results->have_posts()): ?>

  <div class="team grid">

    <?php while($results->have_posts()): $results->the_post();?>

    <div class="team-box grid">
      <img src="<?php echo $team_fields->get_featured_image('team-image'); ?>" class="team-image" />
      <h2 class="team-name"><?php the_title(); ?></h2>
      <div class="team-details"><?php the_content(); ?></div>
    </div>

    <?php endwhile; ?>

  </div>

<?php
endif;
get_footer();
