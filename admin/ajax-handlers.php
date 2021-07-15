<?php

function gymbud_exercise_submit() {
	check_ajax_referer( 'gymbud', 'nonce' );
	if ( ! current_user_can( 'publish_posts' ) ) {
		return;
	}
	$title       = $_POST['title'];
	$description = $_POST['description'];

	wp_insert_post(
		array(
			'post_content'  => $description,
			'post_title'    => $title,
			'post_status'   => 'publish',
			'post_category' => array('6'),
		)
	);

	wp_die();
}
add_action( 'wp_ajax_gymbud-exercise-submit', 'gymbud_exercise_submit' );
