<?php
/**
 * The main template file.
 * @package cakes
 */

get_header();
global $cakes_opt; ?>

  <div id="page">
    <div class="main-image" style="background-image: url(http://lorempixel.com/1920/341/food);"></div>

    <?php if ($cakes_opt['blog-style'] == 1) : ?>

      <?php get_template_part( 'blog-style-1' ); ?>

    <?php else : ?>

      <?php get_template_part( 'blog-style-2' ); ?>

    <?php endif; ?>

  </div><!-- #page -->

<?php get_footer(); ?>
