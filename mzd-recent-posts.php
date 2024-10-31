<?php 
/*
 * Plugin Name: MZD Recent Posts 
 * Plugin URI: https://www.mazedulislam27.com
 * Description: This plugin includs recent posts support in any themes
 * Author: Mazedul Islam
 * Author URI: http://mazedulislam27.com/
 * Version: 1.0.1
 * Text Domain: mzd-recent-posts
 * Domain Path: /languages/
 */
defined( 'ABSPATH' ) || exit;

/**
* Define Plugin DIR
*/
define( 'MZD_RECENT_POSTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/*
* The Widget Configure
*/
require_once( MZD_RECENT_POSTS_PLUGIN_DIR . 'mzd-widget-config.php' ); 

/*
* All widgets here included
*/

require_once( MZD_RECENT_POSTS_PLUGIN_DIR . 'widgets/recent-posts-one/class-widget-recent-posts-one.php' );
	


