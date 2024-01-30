<?php 
add_action('permalink_manager_updated_post_uri', 'bt_permalink_manager_updated_post_uri', 30, 5);
function bt_permalink_manager_updated_post_uri($id, $new_uri, $old_uri, $native_uri, $default_uri){
	//print_r($new_uri);die;
	$my_post = array(
		'ID'           => $id,
		'post_name'   => $new_uri,
	);
   
  	// Update the post into the database
	wp_update_post( $my_post );
}

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'publications';
    $query_vars[] = 'news';
    $query_vars[] = 'events';
    $query_vars[] = 'successes';
    $query_vars[] = 'people';
    $query_vars[] = 'peoples';
    return $query_vars;
} );

function bt_custom_rewrite_rules() {
	global $wp_rewrite;
	add_rewrite_tag('%publications%', '([^&]+)');
	add_rewrite_tag('%news%', '([^&]+)');
	add_rewrite_tag('%events%', '([^&]+)');
	add_rewrite_tag('%successes%', '([^&]+)');
	add_rewrite_tag('%people%', '([^&]+)');
	add_rewrite_tag('%peoples%', '([^&]+)');
	// persons posttype
	$args = array(
		'numberposts' => -1,
		'post_type'   => 'persons'
	);
	$postslist = get_posts( $args );
	foreach ( $postslist as $page_data ) {
		if( ! is_object($page_data) ) { // post not there
			return;
		}
		add_rewrite_rule(
			$page_data->post_name . '/([^/]*)/?',
			'index.php?name='.$page_data->post_name.'&post_type=persons&$matches[1]=1',
			'top'
		);
	}
	// services posttype
	$args = array(
		'numberposts' => -1,
		'post_type'   => 'services'
	);
	$postslist = get_posts( $args );
	foreach ( $postslist as $page_data ) {
		if( ! is_object($page_data) ) { // post not there
			return;
		}
		add_rewrite_rule(
			$page_data->post_name . '/([^/]*)/?',
			'index.php?name='.$page_data->post_name.'&post_type=services&$matches[1]=1',
			'top'
		);
	}
	// debug
	// if(isset($_REQUEST['test'])):
	// 	echo "<pre>";
	// 	print_r($wp_rewrite);
	// 	echo "<pre>";die;
	// endif;

	flush_rewrite_rules();
}
add_action( 'init', 'bt_custom_rewrite_rules', 999 );
