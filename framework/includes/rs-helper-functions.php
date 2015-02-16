<?php
/**
 * Requried functions for theme backend.
 *
 * @package cakes
 * @subpackage Template
 */


/**
 *
 * Set WPAUTOP for shortcode output
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cakes_set_wpautop' ) ) {
  function cakes_set_wpautop( $content, $force = true ) {
    if ( $force ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

/**
*
* @return null
* @param  none
* echo's menu widgets
*
**/
function cakes_menu_widget() {

}

function rs_shortcode_exists( $shortcode = false ) {

  global $shortcode_tags;

  if ( ! $shortcode )
    return false;
  if ( array_key_exists( $shortcode, $shortcode_tags ) )
    return true;

  return false;
}

/**
*
* @return slug name
* @param  none
* returns the home page id
*
**/
function get_home_ID() {

  $args = array(
    'post_type'  => 'page',
    //'meta_key'   => '_wp_page_template',
    //'meta_value' => 'template-home.php'
  );

  $home_pages = get_posts($args);

  if ( !empty($home_pages) ) {
    $home_page = reset($home_pages);
    return $home_page->ID;
  } else {
    return false;
  }

}

/**
*
* @return slug name
* @param  menu id
* returns the slug name via menu id
*
**/
function get_slug( $id ) {
global $post;
	if ( $id == null ) $id = $post->ID;
	$post_data = get_post( $id, ARRAY_A );
	$slug = $post_data['post_name'];

	return $slug;
}

/**
 *
 * is js_composer activated
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'is_vc_activated' ) ) {
  function is_vc_activated() {
    if ( class_exists( 'Vc_Manager' ) && defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, '4.2.3', '>=' ) ) { return true; } else { return false; }
  }
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cakes_element_values' ) ) {
  function cakes_element_values(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->post_title);
        }
      }
      break;

      case 'tags':
      case 'tag':

      $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
        if ( !empty($tags) ) {
          foreach ( $tags as $tag ) {
            $options[$tag->name] = $tag->term_id;
        }
      }
      break;

      case 'categories':
      case 'category':

      $categories = get_categories( $query_args );
      if ( !empty($categories) ) {
        foreach ( $categories as $category ) {
          $options[$category->name] = $category->term_id;
        }
      }
      break;

      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }

    return $options;

  }
}

/**
 *
 * Get first "url" from post content or string
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'get_first_url_from_string' ) ) {
  function get_first_url_from_string( $string ) {
    $pattern  = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    preg_match( $pattern, $string, $link );
    return ( !empty( $link[0] ) ) ? $link[0] : false;
  }
}

/**
 *
 * Custom Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('cakes_get_shortcode_regex') ) {
  function cakes_get_shortcode_regex( $tagregexp = '' ) {
    // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
    // Also, see shortcode_unautop() and shortcode.js.
    return
      '\\['                                // Opening bracket
      . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
      . "($tagregexp)"                     // 2: Shortcode name
      . '(?![\\w-])'                       // Not followed by word character or hyphen
      . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
      .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
      .     '(?:'
      .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
      .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
      .     ')*?'
      . ')'
      . '(?:'
      .     '(\\/)'                        // 4: Self closing tag ...
      .     '\\]'                          // ... and closing bracket
      . '|'
      .     '\\]'                          // Closing bracket
      .     '(?:'
      .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
      .             '[^\\[]*+'             // Not an opening bracket
      .             '(?:'
      .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
      .                 '[^\\[]*+'         // Not an opening bracket
      .             ')*+'
      .         ')'
      .         '\\[\\/\\2\\]'             // Closing shortcode tag
      .     ')?'
      . ')'
      . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
  }
}

/**
 *
 * Tag Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cakes_tagregexp' ) ) {
  function cakes_tagregexp() {
    return apply_filters( 'cakes_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|cs_media' );
  }
}

/**
 *
 * Helper Functions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists('is_explodable' ) ) {
  function is_explodable( $page_name ) {
    return (strpos($page_name, ',') === false ) ? false : true;
  }
}


/**
 *
 * POST FORMAT: VIDEO & AUDIO
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'cakes_post_media' ) ) {
  function cakes_post_media( $content ) {

    $is_video = ( get_post_format() == 'video' ) ? true : false;
    $media    = get_first_url_from_string( $content );

    if( ! empty( $media ) ) {

      global $wp_embed;
      $content  = do_shortcode( $wp_embed->run_shortcode( '[embed]'. $media .'[/embed]' ) );

    } else {

      $pattern = cakes_get_shortcode_regex( cakes_tagregexp() );
      preg_match( '/'.$pattern.'/s', $content, $media );

      if ( ! empty( $media[2] ) ) {

        if( $media[2] == 'embed' ) {
          global $wp_embed;
          $content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
        } else {
          $content = do_shortcode( $media[0] );
        }

      }

    }

    if( ! empty( $media ) ) {

      $output  = '<div class="entry-media">';
      $output .= ( $is_video ) ? '<div class="cakes-fluid"><div class="cakes-fluid-inner">' : '';
      $output .= $content;
      $output .= ( $is_video ) ? '</div></div>' : '';
      $output .= '</div>';

      return $output;

    }

    return false;
  }
}
