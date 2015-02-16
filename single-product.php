<?php
/**
 * The template for displaying all product posts.
 *
 * @package cakes
 */

get_header();
$header_img = rwmb_meta('header_img');
?>

<?php
if (is_numeric($header_img) && !empty($header_img)) {
    $url = wp_get_attachment_url($header_img);
    echo '<div class="main-image detailed" style="background-image: url('.$url.');"></div>';
  }

else {
  echo '<div class="main-image detailed" style="background-image: url(\''.T_IMG.'/bg_top_product_detail.jpg\');"></div>';
  }
?>
  <div id="page">
    <section class="product-detail-content container container1200">
      <div class="wrap">
        <main id="main" class="site-main" role="main">
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="page-title">
              <strong class="price">
                <span class="through"><?php echo rwmb_meta('old_product_price'); ?></span>
                <?php echo ' ' . rwmb_meta('product_price'); ?>
              </strong>
              <h1><?php the_title(); ?></h1>
            </div>
            <article><?php the_content(); ?></article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </main><!-- #main -->

        <?php if($cakes_opt['product-social-share'] == 1): ?>
          <?php get_template_part( 'content', 'share' ); ?>
        <?php endif; ?>

        <?php if($cakes_opt['related-products'] == 1): ?>
          <div class="related-products scale-text act">
            <div class="section-title">
              <h2>Related <b>Products</b></h2>
            </div>
            <?php related_products();  ?>
          </div>
        <?php endif; ?>

      </div>
    </section>
  </div>

<?php get_footer(); ?>
