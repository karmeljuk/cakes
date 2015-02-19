<?php
/**
 * The template for displaying all pages.
 * @package cakes
 */

get_header(); ?>

<div id="page">
  <?php single_header_image(); ?>

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>

  <?php else : ?>

    <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

</div><!-- #page -->

<?php get_footer(); ?>
