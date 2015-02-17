<?php
/**
 * The main template file.
 * @package cakes
 */

get_header();
global $cakes_opt; ?>

  <div id="page">
    <?php echo '<div class="main-image" style="background-image: url(\''.T_IMG.'/blog_header_bg.jpg\');"></div>'; ?>

    <?php if ($cakes_opt['blog-style'] == 1) : ?>

      <?php get_template_part( 'blog-style-1' ); ?>

    <?php else : ?>

      <?php get_template_part( 'blog-style-2' ); ?>

    <?php endif; ?>

  </div><!-- #page -->

<?php get_footer(); ?>
