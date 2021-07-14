<?php
/*
Plugin Name:  GymBud
Description:  Easily generate informative posts for exercise descriptions tailored to your workout needs.
Plugin URI:   https://neildalydev.com
Author:       Neil Daly
Version:      1.0
Text Domain:  gymbud
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/

// disable direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_admin() ) {
	include_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	include_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	include_once plugin_dir_path( __FILE__ ) . 'admin/enqueue-scripts.php';
}
