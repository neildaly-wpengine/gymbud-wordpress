<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function load_gymbud_admin_styles() {
	enqueue_styles();
	enqueue_scripts();
}
add_action( 'admin_enqueue_scripts', 'load_gymbud_admin_styles' );

function enqueue_styles() {
	wp_enqueue_style( 'gymbud', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/gymbud.css', array(), null, 'screen' );
}

function enqueue_scripts() {
	$script_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/gymbud.js';
	wp_enqueue_script( 'gymbud', $script_url, array( 'jquery' ) );
}
