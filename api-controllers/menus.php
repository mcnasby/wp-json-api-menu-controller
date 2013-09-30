<?php

class JSON_API_Menus_Controller {

  public function get_menu() {
    global $json_api;

	// Make sure we have key/value query vars
	if ( !$json_api->query->menu_id ) {
		$json_api->error("Include the parameter 'menu_id' with an appropriate string value.");
	}

	$menuid = $json_api->query->menu_id;

	$menu_output = wp_get_nav_menu_items( $menuid );
	
	$filtered_items = array_map(function($el){
		$filter = array(
			"menu_order"=>$el->menu_order,
			"label"=>$el->title,
			"taxonomy_type"=>$el->object,
			"taxonomy_id"=>$el->object_id
		);
		return $filter;
	}, $menu_output);

	$output = ( $json_api->query->dev == '1' ? $menu_output : $filtered_items );

	$count = count($output);

    return array(
      "count" => $count,
      "menu_id" => $menuid,
      "menu" => $output,
    );
  }

}

?>