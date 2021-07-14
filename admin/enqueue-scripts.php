<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function load_gymbud_admin_styles() {
	wp_enqueue_style( 'gymbud', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/gymbud.css', array(), null, 'screen' );
}

add_action( 'admin_enqueue_scripts', 'load_gymbud_admin_styles' );
