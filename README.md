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

### Request:
> http://www.foo.com/api/get_menu?menu_id=[string]

### Argument Notes:
* **menu_id** - this is the menu id that's set when registering a menu (...usually found in your theme file)
* **dev** - if enabled (eg: dev=1), the output will be the unfiltered wp_get_nav_menu_items object

### Example Request:
> http://www.foo.com/api/menus/get_menu/?menu_id=primary

### Response Object
* Menu
    * menu_order - Integer  (note: this is the output of the order set in WP Admin)
    * label - String
    * taxonomy_type - String (e.g., category or tag)
    * taxonomy_id - Integer

