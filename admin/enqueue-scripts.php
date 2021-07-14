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

function gymbud_exercise_preview() {
	check_ajax_referer( 'gymbud', 'nonce' );
	if ( ! current_user_can( 'publish_posts' ) ) {
		return;
	}
	$name        = $_POST['name'];
	$description = $_POST['description'];
	$id          = $_POST['id'];
	$category    = $_POST['category'];
	$muscles     = $_POST['muscles'];

	// wp_insert_post(
	// 	array(
	// 		'post_content' => $description,
	// 		'post_title'   => $name,
	// 		'post_status'  => 'publish',
	// 	)
	// );

	wp_die();
}
add_action( 'wp_ajax_gymbud-exercise-preview', 'gymbud_exercise_preview' );
