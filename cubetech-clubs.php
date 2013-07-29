<?php
/**
 * Plugin Name: cubetech Clubs
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Clubs - create list your clubs, easily
 * Version: 1.0
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-group.php');
include_once('lib/cubetech-metabox.php');

wp_enqueue_script('jquery');
wp_register_script('cubetech_clubs_js', plugins_url('assets/js/cubetech-clubs.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_clubs_js');

add_action('wp_enqueue_scripts', 'cubetech_clubs_add_styles');

function cubetech_clubs_add_styles() {
	wp_register_style('cubetech-clubs-css', plugins_url('assets/css/cubetech-clubs.css', __FILE__) );
	wp_enqueue_style('cubetech-clubs-css');
}

add_filter('nav_menu_css_class', 'cubetech_clubs_current_type_nav_class', 10, 2 );
function cubetech_clubs_current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');
    if(($key = array_search('current_page_parent', $classes)) !== false) {
	    unset($classes[$key]);
	}
    if ($item->attr_title != '' && $item->attr_title == $post_type) {
        array_push($classes, 'current-menu-item');
    }
    return $classes;
}

function cubetech_clubs_custom_colors() {
   echo '<style type="text/css">
           th#year { width: 10%; }
         </style>';
}

add_action('admin_head', 'cubetech_clubs_custom_colors');

/* Add button to TinyMCE */
function cubetech_clubs_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_clubs_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_clubs_button');
		add_action( 'admin_footer', 'cubetech_clubs_dialog' );
	}
}
 
function register_cubetech_clubs_button($buttons) {
   array_push($buttons, "|", "cubetech_clubs_button");
   return $buttons;
}
 
function add_cubetech_clubs_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_clubs'] = plugins_url('assets/js/cubetech-clubs-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_clubs_addbuttons');

function cubetech_clubs_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_clubs_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_clubs_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_clubs_dialog">
		<div>
			<p>Wählen Sie bitte die einzufügende Vereins-Gruppe:</p>
			<p><select name="cubetech_clubs_taxonomy" id="cubetech_clubs_taxonomy">
				<option value="">Bitte Gruppe auswählen</option>
				<option value="all">Alle Kategorien anzeigen</option>
				<?php
				foreach($taxonomies as $tax) :
					echo '<option value="' . $tax->term_id . '">' . $tax->name . '</option>';
				endforeach;
				?>
			</select></p>
			<p><input type="checkbox" name="cubetech_clubs_filter" id="cubetech_clubs_filter" /> Filterbar nach Kategorie</p>
		</div>
		<div>
			<p><input type="submit" class="button-primary" value="Vereinsliste einfügen" onClick="if ( cubetech_clubs_taxonomy.value != '' && cubetech_clubs_taxonomy.value != 'undefined' ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-clubs group=' + cubetech_clubs_taxonomy.value + ' filter=' + cubetech_clubs_filter.checked + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

?>
