<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function load_gymbud_admin_styles() {
	gymbud_enqueue_styles();
	gymbud_enqueue_scripts();
}
add_action( 'admin_enqueue_scripts', 'load_gymbud_admin_styles' );

function gymbud_enqueue_styles() {
	wp_enqueue_style( 'gymbud', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/gymbud.css', array(), null, 'screen' );
}

function gymbud_enqueue_scripts() {
	$script_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/gymbud.js';
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
