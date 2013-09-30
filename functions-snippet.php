// setup menus controller
function add_menus_controller($controllers) {
  $controllers[] = 'menus';
  return $controllers;
}
add_filter('json_api_controllers', 'add_menus_controller');

function set_menus_controller_path() {
  return TEMPLATEPATH . '/api-controllers/menus.php';
}
add_filter('json_api_menus_controller_path', 'set_menus_controller_path');