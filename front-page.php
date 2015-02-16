<?php
/**
 * The main template file.
 * @package cakes
 */

get_header(); ?>

  <div id="page">

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php the_content(); ?>

      <?php endwhile; // end of the loop. ?>

    <?php else : ?>

      <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

  </div><!-- #page -->

<?php get_footer(); ?>
