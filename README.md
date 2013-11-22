wp-json-api-menu-controller
===========================

Custom controller for Wordpress JSON API allowing you to get registered menus


### Prerequisites:
[Wordpress JSON API](http://wordpress.org/plugins/json-api/) installed and activated

### Install Guide:
* Move "api-controllers" to your current theme's folder in Wordpress
* Add the text within "functions-snippet.php" to your theme's "functions.php" file
* Activate the "Menus" controller in WP Admin: Settings > JSON API > "Activate" (under the "menus" section)

## Usage

### End Point:
> /get_menu
 
### Required Arguments (one or the other):
* **menu_id** - String/Integer (can either be the ID or slug associated with a specific menu)
* **menu_location** -  String (slug of a menu location)

### Optional Arguments:
* **dev** - if enabled (eg: dev=1), the output will be the unfiltered wp_get_nav_menu_items object

### Example Request:
> http://www.foo.com/api/menus/get_menu/?menu_location=primary
> http://www.foo.com/api/menus/get_menu/?menu_id=2324

### Response Object
* Menu
    * id - Integer (arbitrary ID associated with current menu item)
    * menu_parent_id - Integer (if a menu item is set within WP Admin as a parent/child relationship, this id will refer to its parent within the current menu)
    * menu_order - Integer  (note: this is the output of the order set in WP Admin)
    * label - String 
    * object_type - String (e.g., category, tag, page, custom, etc)
    * object_id - Integer (ID used to pull back content from another api, eg: get_page)
    * url - String (URL for menu items with ‘object_type’ = ‘custom’, ie: custom menu items added in WP Admin)

