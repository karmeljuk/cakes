<?php
/**
 * The template for displaying all single posts.
 *
 * @package cakes
 */

get_header();
$post_col = ($cakes_opt['single-sidebar'] == 1) ? 'col-sm-9':'';
?>
<?php single_header_image(); ?>
<div id="page">
  <section class="blog-detail-content container">
    <div class="wrap">
      <div class="inner">
		    <main id="main" class="site-main" role="main">

    		<?php while ( have_posts() ) : the_post(); ?>

        <div class="post <?php echo $post_col; ?>">
          <div class="page-title">
            <?php if($cakes_opt['single-date'] == 1): ?>
              <time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time('M j, Y'); ?></time>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
          </div>
          <div class="article"><?php the_content(); ?></div>

          <p><?php the_tags(); ?></p>
        </div>

        <?php if($cakes_opt['single-sidebar'] == 1): ?>
          <div class="sidebar col-sm-3"><?php get_sidebar(); ?></div>
        <?php endif; ?>

        <?php if($cakes_opt['single-social-share'] == 1): ?>
          <?php get_template_part( 'content', 'share' ); ?>
        <?php endif; ?>

  			<?php
  				// If comments are open or we have at least one comment, load up the comment template
  				if ( is_post_type('post') && (comments_open() || get_comments_number()) ) :
  					comments_template();
  				endif;
  			?>

    		<?php endwhile; // end of the loop. ?>

    		</main><!-- #main -->
    	</div><!-- .inner -->
    </div><!-- .wrap -->
  </section>
</div><!-- #page -->

<?php get_footer(); ?>
