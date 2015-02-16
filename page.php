<?php
/**
 * The template for displaying all pages.
 * @package cakes
 */

get_header(); ?>

<div id="page">
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="main-image" style="background-image: url('<?php page_background() ?>');"></div>
  <?php else: ?>
    <div class="main-image" style="background-image: url(http://lorempixel.com/1920/341/food);"></div>
  <?php endif; ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>

  <?php else : ?>

    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

</div><!-- #page -->

<?php get_footer(); ?>
