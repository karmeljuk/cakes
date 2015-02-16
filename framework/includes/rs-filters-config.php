<?php
/**
 * Filter Hooks
 *
 * @package cakes
 * @since 1.0
 */

/**
 * Changing Excerpt Length
 */
function new_excerpt_length($length) {
    return 15;
}
add_filter('excerpt_length', 'new_excerpt_length');

/**
 * Remove […] string using Filters
 */
function new_excerpt_more( $more ) {
  return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
