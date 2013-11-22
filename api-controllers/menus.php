<?php

class JSON_API_Menus_Controller {

  public function get_menu() {
    global $json_api;

	// Make sure we have key/value query vars
	if ( $json_api->query->menu_id || $json_api->query->menu_location ) {
		
		function get_nav_items($id) {
			global $json_api;

			$menu_output = wp_get_nav_menu_items( $id );

			$filtered_items = array_map(function($el){
				$filter = array(
					"id"=>$el->ID,
					"parent_id"=>$el->menu_item_parent,
					"menu_order"=>$el->menu_order,
					"label"=>$el->title,
					"object_type"=>$el->object,
					"object_id"=>($el->object == "custom" ? "" : $el->object_id ),
					"url"=>($el->object == "custom" ? $el->url : "" )
				);
				return $filter;
			}, $menu_output);

			$output = ( $json_api->query->dev == "1" ? $menu_output : $filtered_items);
			$count = count($output);

			if ($count == "0") {
				$json_api->error("The menu you are looking for is empty or does not exist.");
			} else {
				return array(
					"output" => $output,
					"count" => $count
				);
				
			}
			
		}

		if ($json_api->query->menu_id) {

			$menuid = $json_api->query->menu_id;
			$menuloc = "";

			$menu_items = get_nav_items($menuid);
						
		} else if ($json_api->query->menu_location) {

			$menuloc = $json_api->query->menu_location;
			
			$locations = get_registered_nav_menus();
			$menus = wp_get_nav_menus();
			$menu_locations = get_nav_menu_locations();

			if (isset($menu_locations[ $menuloc ])) {
				foreach ($menus as $menu) {
					// If the ID of this menu is the ID associated with the location we're searching for
					if ($menu->term_id == $menu_locations[ $menuloc ]) {
						// This is the correct menu
						$menuid = $menu->slug;

						var_dump($menu->slug);

						// Get the items for this menu
						$menu_items = get_nav_items($menuid);

						break;
					} 
					//else if ($menu->term_id != $menu_locations[ $menuloc ]) {
					//	$json_api->error("There are no menus set for this location.");
					//}
				}
			} else {
				$json_api->error("Menu location: '" . $menuloc . "' does not exist");
			}

		} 

	    	return array(
	     	"count" => $menu_items["count"],
	     	"menu_location" => $menuloc,
	     	"menu_id" => $menuid,
	     	"menu" => $menu_items["output"]
		);

	} else {
		$json_api->error("Include the parameter 'menu_id' with an appropriate string value.");
	}

  }

}

?>