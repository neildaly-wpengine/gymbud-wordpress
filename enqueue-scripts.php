<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function load_gymbud_admin_styles( $hook ) {
	if ( $hook == 'toplevel_page_gymbud' ) {
		gymbud_enqueue_styles();
		gymbud_enqueue_scripts();
	}
}
add_action( 'admin_enqueue_scripts', 'load_gymbud_admin_styles' );

function gymbud_enqueue_styles() {
	wp_enqueue_style( 'gymbud', plugin_dir_url( __FILE__ ) . 'admin/css/gymbud.css', array(), null, 'screen' );
}

function gymbud_enqueue_scripts() {
	$script_url = plugin_dir_url( __FILE__  ) . 'admin/js/gymbud.js';
	$nonce      = wp_create_nonce( 'gymbud' );
	wp_enqueue_script( 'gymbud', $script_url, array( 'jquery' ) );
	wp_localize_script(
		'gymbud',
		'gymbud',
		array(
			'nonce' => $nonce,
		)
	);
}