<?php
function cubetech_clubs_create_taxonomy() {

	$labels = array(
		'name'                => __( 'Vereinsgruppen'),
		'singular_name'       => __( 'Vereinsgruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Gruppen' ),
		'edit_item'           => __( 'Vereinsgruppe bearbeiten' ),
		'update_item'         => __( 'Vereinsgruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Vereinsgruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Vereinsgruppe' )
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
}
add_action('init', 'cubetech_clubs_create_taxonomy');
?>
