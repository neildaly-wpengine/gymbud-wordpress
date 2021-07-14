<?php // MyPlugin - Settings Page

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// display the plugin settings page
function gymbud_display_settings_page() {
	if ( ! current_user_can( 'publish_posts' ) ) {
		return;
	}

	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p>Some content here..</p>
	</div>
	<?php
}
