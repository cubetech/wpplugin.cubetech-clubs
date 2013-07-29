<?php
function cubetech_clubs_create_taxonomy() {
	
	$labels = array(
		'name'                => __( 'Gruppen'),
		'singular_name'       => __( 'Gruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Gruppen' ),
		'edit_item'           => __( 'Gruppe bearbeiten' ), 
		'update_item'         => __( 'Gruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Gruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Gruppen' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'cubetech_clubs' )
	);

	register_taxonomy( 'cubetech_clubs_group', array( 'cubetech_clubs' ), $args );
	flush_rewrite_rules();
}
add_action('init', 'cubetech_clubs_create_taxonomy');
?>
