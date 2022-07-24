<?php
/**
 * Plugin Name:       Dive Log
 * Plugin URI:        https://github.com/wdsides/dive-log
 * Description:       Allows the user to maintain a dive log using the custom post type 'Dive' and a block template to capture the relevant information
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Will Sides
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dive-log
 *
 * @package           willsides
 */

function willsides_dive_log_custom_post_types() {
    $labels = array(
      'name' => __( 'Dives' ),
      'singular_name' => __( 'Dive' ),
      'add_new' => 'Log dive',
      'all_items' => 'Dive Log',
      'add_new_item' => 'Log dive',
      'edit_item' => 'Edit dive',
      'new_item' => 'New dive',
      'view_item' => 'View dive',
      'search_item' => 'Search dive log',
      'not_found' => 'No dives found',
      'not_found_in_trash' => 'No dives found in trash'
    );
    $divetemplate = array(
      array( 'willsides/dive-location', array (
        'location' => ''
      ) ),
    );
    $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'show_in_rest' => true,
      'supports' => array( 
        'title',
        'editor', 
        'thumbnail',
        'revisions',
        'custom-fields',
      ),
      'taxonomies' => array(),
      'menu_position' => 5,
      'exclude_from_search' => false,
      'menu_icon' => 'dashicons-palmtree',
      'template' => $divetemplate,
    );
    register_post_type( 'dive-log', $args);  
    }

add_action( 'init', 'willsides_dive_log_custom_post_types' );

function willsides_divelog_enqueue_styles() {
    wp_enqueue_style(
		'willsides-divelog-styles',
		plugins_url( 'style.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
	);	
}
add_action( 'wp_enqueue_scripts', 'willsides_divelog_enqueue_styles' );