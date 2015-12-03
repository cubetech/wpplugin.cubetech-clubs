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
			'has_archive' => true,
			'rewrite' => array('slug' => 'clubs', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title'),
			'capability_type' => 'clubs',
			'capabilities' => array(
		        'edit_post' => 'edit_club',
		        'edit_posts' => 'edit_clubs',
		        'edit_others_posts' => 'edit_other_clubs',
		        'publish_posts' => 'publish_clubs',
		        'read_post' => 'read_club',
		        'read_private_posts' => 'read_private_clubs',
		        'delete_post' => 'delete_clubs'
		    ),
			'map_meta_cap'	=> true
		)
	);
}
add_action('init', 'cubetech_clubs_create_post_type');
add_action( 'admin_init', 'add_theme_caps');
function add_theme_caps() {
	    // gets the administrator role
	    $admins = get_role( 'administrator' );
	    
	    $caps = array('capabilities' => array(
		        'edit_post' => 'edit_club',
		        'edit_posts' => 'edit_clubs',
		        'edit_others_posts' => 'edit_other_clubs',
		        'publish_posts' => 'publish_clubs',
		        'read_post' => 'read_club',
		        'read_private_posts' => 'read_private_clubs',
		        'delete_post' => 'delete_clubs'
		    ));

	    
	    foreach($caps as $cap) {
			$admins->add_cap( $cap ); 	    
	    }
}
?>
