<?php
/**
 * The template for displaying search results pages.
 *
 * @package cakes
 */

get_header(); ?>

	<section id="page" class="content-area search">
    <?php echo '<div class="main-image" style="background-image: url(\''.T_IMG.'/blog_header_bg.jpg\');"></div>'; ?>
		<main id="main" class="container" role="main">

    <?php $loop = new WP_Query(array('posts_per_page'   => -1)); ?>
		<?php if ( $loop->have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cakes' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php //get_template_part( 'pagination' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
