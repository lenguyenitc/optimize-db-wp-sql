//de enqueue scripts
add_action('wp_print_scripts','bt_remove_wp_enqueue_scripts',999);
function bt_remove_wp_enqueue_scripts(){
	$scripts = array();
	if(is_front_page() || is_product_category() || is_shop() ){
    $scripts = array(
      'script',
  	);
  }
	foreach ($scripts as $script) {
		wp_dequeue_script($script);
		wp_deregister_script($script);
	}
}
//de enqueue styles
add_action('wp_print_styles','bt_remove_wp_enqueue_styles',999);
function bt_remove_wp_enqueue_styles(){
	$styles = array();
  if(is_front_page() || is_product_category() || is_shop()){
    $styles = array(
  		'script',
  	);
  }
	foreach ($styles as $style) {
		wp_dequeue_style($style);
	}
}
