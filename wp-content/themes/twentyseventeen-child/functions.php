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
  wp_enqueue_style('twentyseventeen-child-google-fonts','//fonts.googleapis.com/css?family=Permanent+Marker|Roboto|Raleway|Montserrat|Assistant');
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_child_scripts' );


function contact_form_sidebar() {
	register_sidebar(
		array(
			'name' => __( 'Contact form sidebar', 'twentyseventeen-child' ),
			'id' => 'contact-form-sidebar',
			'description' =>__( 'Appears on the static front page template', 'twentyseventeen-child'),
			'before_widget' => '<aside class="widget-content contact-form-sidebar">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'contact_form_sidebar' );
