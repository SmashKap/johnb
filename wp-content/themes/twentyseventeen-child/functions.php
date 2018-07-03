<?php
/**
 * Twenty Seventeen Child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

// Enqueue scripts and styles
function twentyseventeen_child_scripts(){
	wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'twentyseventeen-style' ));
  wp_enqueue_style('twentyseventeen-child-google-fonts','//fonts.googleapis.com/css?family=Permanent+Marker|Roboto');
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_child_scripts' );
