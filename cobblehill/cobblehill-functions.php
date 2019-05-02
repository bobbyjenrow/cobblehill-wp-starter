<?php
/*
* Cobble Hill Functions Compendium
*
*/

// Import Cleanup
include_once 'cobblehill-cleanup.php';

// Custom Functions
function handleize($slug){
  return  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

// Enqueue Scripts
function queue_CH_scripts(){
  $relative_uri = '/assets/index';
  wp_register_script('cobblehill-js', get_template_directory_uri() . $relative_uri . '.js', array('jquery'), filemtime(get_stylesheet_directory() . $relative_uri . '.js'), true );
  wp_enqueue_style( 'cobblehill-style', get_stylesheet_uri() . $relative_uri . '.css', filemtime( get_stylesheet_directory() . $relative_uri . '.css'), '');
}
add_action('wp_enqueue_scripts', 'queue_CH_scripts');

// Enable Options Page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}
























 ?>
