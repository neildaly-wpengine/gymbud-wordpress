<?php

// enqueue public style
function enqueue_public_gymbud_scripts() {
	wp_enqueue_style(
		'gymbud',
		plugin_dir_url( __FILE__ ) . 'public/css/gymbud.css',
		array(),
		null,
		'all'
	);

}
add_action( 'wp_enqueue_scripts', 'enqueue_public_gymbud_scripts' );
