<?php

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SLUG', 'gymbud' );

// add top-level administrative menu
function gymbud_add_top_level_menu() {
	add_menu_page(
		esc_html__( 'GymBud', SLUG ),
		esc_html__( 'GymBud', SLUG ),
		'publish_posts',
		SLUG,
		'gymbud_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'gymbud_add_top_level_menu' );
