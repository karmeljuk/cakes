<?php

/*-----------------------------------------------------------------------------------*/
/*	Defining Meta Boxes
/*-----------------------------------------------------------------------------------*/

global $meta_boxes;
$meta_boxes = array();

//Feature Options
$meta_boxes[] = array(

  'id' => 'feature',
  'title' => __( 'Feature Options', 'cakes' ),
  'pages' => array( 'feature' ),
  'context' => 'normal',
  'priority' => 'low',
  'fields' => array(
    array(
      'name' => __('Top Text:', 'cakes' ),
      'id'   => 'f_top_text',
      'type' => 'text',
      'desc' => 'Enter Top Text.'
    ),
    array(
      'name' => __('Bottom Text:', 'cakes' ),
      'id'   => 'f_bottom_text',
      'type' => 'text',
      'desc' => 'Bottom Text.'
    ),
    array(
      'name' => __('Link URL:', 'cakes' ),
      'id'   => 'f_link_url',
      'type' => 'text',
      'desc' => 'Enter Link URL.'
    ),
    array(
      'name' => __('Link Text:', 'cakes' ),
      'id'   => 'f_link_text',
      'type' => 'text',
      'desc' => 'Enter Link Text.'
    ),
  )
);

//Product Options
$meta_boxes[] = array(

  'id' => 'product',
  'title' => __( 'Product Options', 'cakes' ),
  'pages' => array( 'product' ),
  'context' => 'normal',
  'priority' => 'low',
  'fields' => array(
    array(
      'name' => __('Product Price:', 'cakes' ),
      'id'   => 'product_price',
      'type' => 'text',
      'desc' => 'Enter Product Price.'
    ),
    array(
      'name' => __('Old Product Price:', 'cakes' ),
      'id'   => 'old_product_price',
      'type' => 'text',
      'desc' => 'Old Product Price. Leave blank to hide'
    ),
    array(
      'name' => __('Product Intro:', 'cakes' ),
      'id'   => 'product_intro',
      'type' => 'textarea',
      'desc' => 'Enter Product Intro. Leave blank to hide'
    )
  )
);

//Background Options
$meta_boxes[] = array(

  'id' => 'service',
  'title' => __( 'Background Options', 'cakes' ),
  'pages' => array( 'post', 'product', 'content', 'page' ),
  'context' => 'normal',
  'priority' => 'high',
  'fields' => array(
    array(
        'name' => __( 'Custom Header Image', 'cakes'),
        'id'   => "header_img",
        'type' => 'image_advanced',
        'desc' => __( 'Change custom image for header. If the image is not set, the default image will be used', 'cakes'),
    ),
    array(
        'name' => __( 'Disable Header Image on this page', 'cakes' ),
        'id'   => "header_img_check",
        'type' => 'checkbox',
        'std'  => 0,
        // 'value'  => 1,
    ),
  )
);



/*-----------------------------------------------------------------------------------*/
/*	Regestring Meta Boxes
/*-----------------------------------------------------------------------------------*/

function cakes_register_meta_boxes() {
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box ) {
		if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ) {
				continue;
			}
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'cakes_register_meta_boxes' );


/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions ) {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
			break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
			break;
			case 'slug':
				$post_slug = $post->post_name;
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
			break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) ) {
					return true;
				}
			break;
		}
	}

	// If no condition matched
	return false;
}
