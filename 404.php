<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package cakes
 */

get_header(); ?>

	<div id="page" class="content-area">
  <?php echo '<div class="main-image" style="background-image: url(\''.T_IMG.'/blog_header_bg.jpg\');"></div>'; ?>

    <div class="wrap">
      <div class="inner">
        <main id="main" class="container center-align" role="main">

          <section class="error-404 not-found ">
            <header class="page-header">
              <h1 class="page-title"><?php echo esc_html($cakes_opt['error-name']); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
              <p><h2><?php echo esc_html($cakes_opt['error-msg']); ?></h2></p>

              <div class="search">
                <?php get_template_part( 'searchform' ); ?>
              </div>

            </div><!-- .page-content -->
          </section><!-- .error-404 -->

        </main><!-- #main -->
      </div>
    </div>

	</div><!-- #primary -->

<?php get_footer(); ?>
