<?php
/**
 * cakes functions and definitions
 *
 * @package cakes
 */

defined( 'F_PATH' )     or  define( 'F_PATH', 'framework' );
defined( 'T_NAME' )     or  define( 'T_NAME', 'cakes');
defined( 'F_DIR' )      or  define( 'F_DIR',  F_PATH . '/includes' );
defined( 'T_URI' )      or  define( 'T_URI',  get_template_directory_uri() );
defined( 'T_PATH' )     or  define( 'T_PATH', get_template_directory() );
defined( 'T_IMG' )      or  define( 'T_IMG',  T_URI . '/img' );
defined( 'T_JS' )       or  define( 'T_JS',   T_URI . '/js' );
defined( 'T_CSS' )      or  define( 'T_CSS',  T_URI . '/css' );

/**
 * Redux Integration
 */
require_once( dirname( __FILE__ ) . '/'. F_PATH . '/redux-panel/ReduxCore/framework.php' );
require_once( dirname( __FILE__ ) . '/'. F_PATH . '/redux-panel/options/options.php' );

locate_template ( F_DIR . '/rs-actions-config.php',   true );
locate_template ( F_DIR . '/rs-helper-functions.php', true );
locate_template ( F_DIR . '/rs-include-config.php',   true );
locate_template ( F_DIR . '/rs-filters-config.php', true );
// locate_template ( F_DIR . '/rs-widgets-config.php',   true );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}

if ( ! function_exists( 'cakes_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cakes_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cakes, use a find and replace
	 * to change 'cakes' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cakes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
  add_image_size( 'products-carousel-thumb', 254, 254, true );
  add_image_size( 'related-products-thumb', 370, 370, true );
  add_image_size( 'products_slider', 457, 457, true );
  add_image_size( 'testimonials', 506, 579, true );
  add_image_size( 'single_slider', 970, 416, true );
  add_image_size( 'best_offers-thumb', 270, 176, true );
  add_image_size( 'blog_style_1', 335, 335, true );
  add_image_size( 'history', 336, 144, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
    'left' => __( 'Left Menu', 'cakes' ),
		'right' => __( 'Right Menu', 'cakes' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

}
endif; // cakes_setup
add_action( 'after_setup_theme', 'cakes_setup' );


/**
 * If is custom post type
 */
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

/**
 * Page featured image for background
 */
function page_background() {
  if ( has_post_thumbnail() ) {
    $dom = simplexml_load_string(get_the_post_thumbnail());
    $src = $dom->attributes()->src;
    echo $src;
  }
  return $src;
}

// Register Sidebar
function sidebar() {

  $args = array(
    'id'            => 'sidebar',
    'name'          => __( 'Sidebar', 'cakes' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
  );
  register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'sidebar' );

/**
 * Customize the comments template
 */
function wordpressapi_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  $time = 4; ?>

  <li <?php comment_class('scale-text'); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="fade-anime time-<?php echo 100 * $time++ ?>">
      <div>
        <div class="comment-avatar col-sm-3">
          <?php echo get_avatar($comment, $size = '134'); ?>
        </div>

        <div class="comment-right col-sm-9">
          <div class="comment-meta">
            <time datetime="<?php comment_date('c'); ?>"><?php comment_date('G:i M j, Y'); ?></time>
            <?php edit_comment_link(__('(Edit)', 'cakes') , '&nbsp; ', '') ?>
          </div>

          <?php $user_name_str = substr(get_comment_author() , 0, 20); ?>

          <div class="comment-content"><?php comment_text() ?></div>

          <div class="comment-author"><?php comment_author(); ?> </div>

          <?php comment_reply_link(array_merge($args, array(
            'depth' => $depth,
            'max_depth' => $args['max_depth']
            )))
          ?>
          </div>
      </div>

      <?php if ($comment->comment_approved == '0'): ?>
        <em><?php _e('Your comment is awaiting moderation.', 'cakes') ?></em>
        <br />
      <?php endif; ?>

    </div>
  </li>
  <?php
}

/**
  * PBD AJAX Load Posts
  * Initialization. Add our script if needed on this page.
  */
function pbd_alp_init($loop=0) {
  if (empty($loop) && ($loop == 0)) {
    global $wp_query;
    $loop = $wp_query;
  }


  // Add code to index pages.
  if( is_page() || is_category() ) {

    wp_enqueue_script( 'pbd-alp-load-posts', T_JS . '/load-posts.js', array('jquery'), '1.0', true );

    // What page are we on? And what is the pages limit?
    $max = $loop->max_num_pages;
    $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

    // Add some parameters for the JS.
    wp_localize_script(
      'pbd-alp-load-posts',
      'pbd_alp',
      array(
        'startPage' => $paged,
        'maxPages' => $max,
        'nextLink' => next_posts($max, false)
      )
    );
  }
 }
 add_action('template_redirect', 'pbd_alp_init');

/**
 * Related Products
 */
function related_products( ) {

  $args = array(
    'post_type'  => 'product',
  );
?>

  <div class="swiper-container">
    <div class="swiper-wrapper">
    <?php
      $loop = new WP_Query($args);
      while ( $loop->have_posts() ) : $loop->the_post();
    ?>

      <div class="swiper-slide">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
          <?php the_post_thumbnail('related-products-thumb'); ?>
          </a>
        <?php endif; ?>
        <h4 class="name">
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_title(); ?>
          </a>
        </h4>
        <div class="description"><?php the_excerpt(); ?></div>
        <strong class="price">
          <span class="through"><?php echo rwmb_meta('old_product_price'); ?></span>
          <?php echo ' ' . rwmb_meta('product_price'); ?>
        </strong>
      </div><!-- .swiper-slide -->

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
    </div><!-- .swiper-wrapper -->
    <ul class="flex-direction-nav">
      <li>
        <a class="flex-prev" href="#"></a>
      </li>
      <li>
        <a class="flex-next" href="#"></a>
      </li>
    </ul>
  </div><!-- .swiper-container -->

<?php }

/**
 * Single Header Image
 */
function single_header_image() {
  $header_img = rwmb_meta('header_img');

  if (is_numeric($header_img) && !empty($header_img)) {
    $url = wp_get_attachment_url($header_img);
    echo '<div class="main-image" style="background-image: url('.$url.');"></div>';
  }

  else {
    echo '<div class="main-image" style="background-image: url(\''.T_IMG.'/blog_header_bg.jpg\');"></div>';
  }
}

/**
 * Product Header Image
 */
function product_header_image() {
  $header_img = rwmb_meta('header_img');

  if (is_numeric($header_img) && !empty($header_img)) {
    $url = wp_get_attachment_url($header_img);
    echo '<div class="main-image detailed" style="background-image: url('.$url.');"></div>';
  }

  else {
    echo '<div class="main-image detailed" style="background-image: url(\''.T_IMG.'/bg_top_product_detail.jpg\');"></div>';
  }
}
