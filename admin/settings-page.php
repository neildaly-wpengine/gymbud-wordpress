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
		<?php render_gymbud_post_preview(); ?>
		<?php render_gymbud_success(); ?>
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
	</div>
	<?php
}

function render_gymbud_post_preview() {
	?>
	<form class="post-preview-section" id="post-preview-section" method="post">
		<label for="post-title" class="post-title-label">Post Title</label>
		<input type="text" id="post-title" name="post-title"/>
		<label for="post-description" class="post-description-label">Description</label>
		<textarea id="post-description" name="post-description" rows="10" cols="80"></textarea>
		<input type="submit" class="post-publish-button" value="Publish"/>
	</form>
	<?php
}

function render_gymbud_success() {
	?>
	<div class="success-section" id="success-section">
		<p id="success-message" class="success-message">Success! Your post has been created.</p>
		<a id="view-post-link" class="view-post-link" href="" target="_blank">View Post</a>
	</div>
	<?php
}
