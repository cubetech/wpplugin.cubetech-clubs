<?php
function cubetech_clubs_create_post_type() {
	register_post_type('cubetech_clubs',
		array(
			'labels' => array(
				'name' => __('Vereine'),
				'singular_name' => __('Verein'),
				'add_new' => __('Verein hinzufügen'),
				'add_new_item' => __('Neuer Verein hinzufügen'),
				'edit_item' => __('Verein bearbeiten'),
				'new_item' => __('Neuer Verein'),
				'view_item' => __('Verein betrachten'),
				'search_items' => __('Verein durchsuchen'),
				'not_found' => __('Keine Verein gefunden.'),
				'not_found_in_trash' => __('Keine Verein gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => array('cubetech_clubs_group'),
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'clubs', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title')
		)
	);
}
add_action('init', 'cubetech_clubs_create_post_type');
?>
