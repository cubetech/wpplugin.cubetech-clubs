<?php
function cubetech_clubs_shortcode($atts)
{
	extract(shortcode_atts(array(
		'group'			=> false,
		'filter'		=> false,
		'orderby' 		=> false,
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	if ( $group == false )
		return "Keine Gruppe angegeben";
		
	if ( $group == 'all' )
		$tax_query = false;
	else {
		$tax_query = array(
		    array(
		        'taxonomy' => 'cubetech_clubs_group',
		        'terms' => $group,
		        'field' => 'id',
		    )
		);
	}
	
	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_clubs',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
		'tax_query'			=> $tax_query,
	);
		
	$posts = get_posts($args);
	$class = '';
	$return = '';
	
	if($filter == true) {
		
		$childof = 0;
		if($group != false && $group != 'all' && $group > 0) {
			$childof = $group;
		}

		$args=array(
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC',
			'child_of' => $childof,
		);

		$taxonomies = get_terms('cubetech_clubs_group', $args);

		$return .= '<div class="cubetech-clubs-filter">
						<p>Kategorie</p>
						<p><select name="cubetech-clubs-filter-select" id="cubetech-clubs-filter-select">
							<option value="all">Alle</option>';
		foreach($taxonomies as $tax) :
			$return .= '<option value="' . $tax->slug . '">' . $tax->name . '</option>';
		endforeach;
		
		$return .= '</select></p></div>';
		
	}
		
	$return .= '<div class="cubetech-clubs-container' . $class . '"><table>';
	$return .= '<thead><tr><td>Verein</td><td>Kontaktperson</td><td class="cubetech-clubs-phone">Telefonnummer</td></tr></thead><tbody>';
	
	foreach ($posts as $post) {
	
		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_clubs_group');
		$filterclass = '';

		if($filter == true) {
		
			foreach( $terms as $term ) {
				$filterclass .= ' cubetech-clubs-group-' . $term->slug;
			}
		
		}
		
		$mailfield = '';
		if(isset($post_meta_data['cubetech_clubs_mail'][0]) && $post_meta_data['cubetech_clubs_mail'][0] != '')
			$mailfield = '<br /><a href="mailto:' . $post_meta_data['cubetech_clubs_mail'][0] . '">' . $post_meta_data['cubetech_clubs_mail'][0] . '</a>';
		
		$urlfield = '';
		if($post_meta_data['cubetech_clubs_url'][0] != '') {
			if (0 !== strpos($post_meta_data['cubetech_clubs_url'][0], 'http://') && 0 !== strpos($post_meta_data['cubetech_clubs_url'][0], 'https://')) {
				$post_meta_data['cubetech_clubs_url'][0] = "http://{$post_meta_data['cubetech_clubs_url'][0]}";
			}
			$urlfield = '<br /><a href="' . $post_meta_data['cubetech_clubs_url'][0] . '" target="_blank">' . $post_meta_data['cubetech_clubs_url'][0] . '</a>';
		}

		
		$return .= '
		<tr class="cubetech-clubs' . $filterclass . '">
			<td class="cubetech-clubs-title"><strong>' . $post->post_title .'</strong>
			' . $urlfield . $mailfield . '</td>
			<td>' . $post_meta_data['cubetech_clubs_contact'][0] . '</td>
			<td class="cubetech-clubs-phone">' . $post_meta_data['cubetech_clubs_phone'][0] . '</td>
		</tr>';

	}

	return $return . '</tbody></table></div>';

}
add_shortcode('cubetech-clubs', 'cubetech_clubs_shortcode');
?>
