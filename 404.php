<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package cakes
 */

get_header(); ?>

	<div id="page" class="content-area">
  <?php echo '<div class="main-image" style="background-image: url(\''.T_IMG.'/blog_header_bg.jpg\');"></div>'; ?>
		<main id="main" class="container" role="main">

      <section class="error-404 not-found ">
        <header class="page-header">
          <h1 class="page-title"><?php echo esc_html($cakes_opt['error-name']); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
          <p><?php echo esc_html($cakes_opt['error-msg']); ?></h2></p>

          <?php get_search_form(); ?>

        </div><!-- .page-content -->
      </section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
