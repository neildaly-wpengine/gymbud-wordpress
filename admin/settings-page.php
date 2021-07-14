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
		<?php render_gymbud_overview(); ?>
		<?php render_gymbud_category_selection(); ?>
		<?php render_gymbud_exercise_selection(); ?>
	</div>
	<?php
}

function render_gymbud_overview() {
	?>
	<p style="max-width: 60%;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit sunt dignissimos temporibus vitae nam magnam, adipisci laborum asperiores dolorem in!</p>
	<?php
}

function render_gymbud_category_selection() {
	?>
	<div class="category-section">
		<label for="category" class="category-label">Category</label>
		<select name="category" id="category-select">
			<option value="none">Select</option>
		</select>
		<pre class="gymbud-categories-response"></pre>
	</div>
	<?php
}

function render_gymbud_exercise_selection() {
	?>
	<div class="exercise-section" id="exercise-section">
		<label for="exercise" class="exercise-label">Exercise</label>
		<select name="exercise" id="exercise-select">
			<option value="none">Select</option>
		</select>
		<pre class="gymbud-categories-response"></pre>
	</div>
	<?php
}

function gymbud_exercise_preview()
{
    check_ajax_referer('gymbud', 'nonce');
    if ( ! current_user_can( 'publish_posts' ) ) {
		return;
	}
	echo $_POST['name'];
    wp_die();
}
add_action('wp_ajax_gymbud-exercise-preview', 'gymbud_exercise_preview');
