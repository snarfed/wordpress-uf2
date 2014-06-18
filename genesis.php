<?php
/* The Genesis Framework (http://studiopress.com/themes/genesis/) has
 * additional hooks that allow adding microformat classes without needing to
 * add wrapper divs.  This file adjusts the uf2 plugin to take advantage of
 * those hooks when Genesis is present.
 */

add_action( 'init', 'uf2_genesis_init' );
function uf2_genesis_init() {
  if ( function_exists( 'genesis_html5' ) && genesis_html5() ) {
    // replace some post hooks
    remove_filter( 'the_title', 'uf2_the_title', 99, 1 );
    remove_filter( 'the_content', 'uf2_the_post', 99, 1 );
    remove_filter( 'the_excerpt', 'uf2_the_excerpt', 99, 1 );
    remove_filter( 'the_author', 'uf2_the_author', 99, 1 );

    add_filter( 'genesis_entry_header', 'uf2_genesis_entry_permalink' );
    add_filter( 'genesis_attr_entry-title', 'uf2_genesis_attr_entry_title', 20 );
    add_filter( 'genesis_attr_entry-content', 'uf2_genesis_attr_entry_content', 20 );
    add_filter( 'genesis_attr_entry-time', 'uf2_genesis_attr_entry_time', 20 );
    add_filter( 'genesis_attr_entry-author', 'uf2_genesis_attr_entry_author', 20 );
    add_filter( 'genesis_attr_entry-author-link', 'uf2_genesis_attr_entry_author_link', 20 );
    add_filter( 'genesis_attr_entry-author-name', 'uf2_genesis_attr_entry_author_name', 20 );

    // replace some comment hooks
    remove_filter( 'comment_text', 'uf2_comment_text', 99, 1 );
    remove_filter( 'get_comment_author_link', 'uf2_author_link' );
    remove_filter( 'comment_class', 'uf2_comment_classes' );

    add_filter( 'genesis_attr_comment', 'uf2_genesis_attr_comment', 20 );
  }
}

function uf2_genesis_entry_permalink() {
  echo '<a class="u-url" href="' . get_permalink() .'"></a>';
}

/**
 * Adds microformats v2 support to the post title.
 */
function uf2_genesis_attr_entry_title( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'p-name';
  return $attr;
}

/**
 * Adds microformats v2 support to the post.
 */
function uf2_genesis_attr_entry_content( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'e-content';
  return $attr;
}

function uf2_genesis_attr_entry_time( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'dt-published';
  return $attr;
}

function uf2_genesis_attr_entry_author( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'p-author h-card';
  return $attr;
}

function uf2_genesis_attr_entry_author_link( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'u-url';
  return $attr;
}

function uf2_genesis_attr_entry_author_name( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'p-name';
  return $attr;
}

/**
 * Adds custom classes to the array of comment classes.
 */
function uf2_genesis_attr_comment( $attr ) {
  $attr['class'] .= ( $attr['class'] ? ' ' : '' ) . 'p-comment h-entry';
  return $attr;
}

