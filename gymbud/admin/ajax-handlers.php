<?php

function gymbud_exercise_submit() {
	check_ajax_referer( 'gymbud', 'nonce' );
	if ( ! current_user_can( 'publish_posts' ) ) {
		return;
	}
	$title       = $_POST['title'];
	$description = $_POST['description'];

	$post_id = wp_insert_post(
		array(
			'post_content'  => $description,
			'post_title'    => $title,
			'post_status'   => 'publish',
			'post_category' => array( '6' ),
		)
	);

	if ( is_wp_error( $post_id ) ) {
		wp_send_json_error( array( 'result' => '0' ) );
	} else {
		wp_send_json_success(
			array(
				'result' => '1',
				'link'   => get_permalink( $post_id ),
			)
		);
	}

	wp_die();
}
add_action( 'wp_ajax_gymbud-exercise-submit', 'gymbud_exercise_submit' );
