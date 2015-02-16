<?php
/**
 * Blog Style 2 template file.
 * @package cakes
 */
?>

<section class="blog-archive-content container">
  <div class="wrap">
    <div class="inner">
      <div class="page-title">
        <h1><?php single_cat_title( '', true ); ?></h1>
      </div>
      <div class="events loaded-content" id="content">

      <?php $year_check = ''; $y = 1; ?>
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php $year = get_the_date('Y'); ?>

        <div class="post">
          <?php if ($year !== $year_check): ?>
            <div class="ico_year_shape"><span><?php echo $year; ?></span></div>
          <?php endif; ?>
          <?php $year_check = $year; ?>

          <article class="<?php if ($y++ % 2 == 0) {echo 'fl';} else {echo 'fr';}; ?> scale-text">
            <div class="ico_date_shape">
              <span><?php the_time('d'); ?><br><?php the_time('M'); ?></span>
            </div>
            <div class="blog-item-wrap">
              <div class="img-block">
                <figure>
                  <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('history', array( 'class' => 'imgBorder' )); ?>
                    </a>
                  <?php endif; ?>
                </figure>
              </div>
              <div class="text-block">
                <h2 class="title post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="description"><?php the_excerpt(); ?></div>
              </div>
            </div>
          </article>
        </div>

        <?php endwhile; // end of the loop. ?>

        <div class="clr"></div>

      </div><!-- .events loaded-content -->

      <p id="articleLoad">
        <a href="#" class="show-more-items ico arrow-down large"><span class="rounded-ico large red"></span></a>
      </p>



    </div><!-- .inner -->
  </div><!-- .wrap -->

  <?php else : ?>

  <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

</section>
