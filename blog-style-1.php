<?php
/**
 * Blog Style 1 template file.
 * @package cakes
 */
?>

<section class="blog-list-content container">
  <div class="wrap">
    <div class="inner">
      <div class="page-title">
        <h1><?php single_cat_title( '', true ); ?></h1>
      </div>
      <div class="posts container-mix">

  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <article class="mix date">
        <figure class="circle-thumb time-500">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail('blog_style_1'); ?>
          <span class="blog-img-mask"></span>
          </a>
        <?php endif; ?>
        </figure>
        <div class="meta">
          <time datetime="<?php the_date('Y-m-d'); ?>"><?php the_time('M j, Y'); ?></time>
          <a href="<?php the_permalink(); ?>#comments-blog" class="comments"><?php echo $post->comment_count ?></a>
          <?php the_tags(''); ?>
        </div>
        <h2 class="title post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="description">
          <p><?php the_excerpt(); ?></p>
        </div>
      </article>

    <?php endwhile; // end of the loop. ?>

    <?php get_template_part( 'pagination' ); ?>

      </div><!-- .posts container-mix -->
    </div><!-- .inner -->
  </div><!-- .wrap -->

  <?php else : ?>

  <?php get_template_part( 'content', 'none' ); ?>

  <?php endif; ?>

</section>
