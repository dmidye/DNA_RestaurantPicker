<?php
require('../model/database_oo.php');
require('../model/restaurant_db_oo.php');
require('../model/restaurant.php');
require('../model/category_db_oo.php');
require('../model/category.php');
require('../model/user.php');
session_start();
$logout = filter_input(INPUT_POST, 'logout');
if(isset($logout)) {
	$_SESSION = array();
	session_destroy();
	$name = session_name();
	$expire = strtotime('-1 year');
	$params = session_get_cookie_params();
	$path = $params['path'];
	$domain = $params['domain'];
	$secure = $params['secure'];
	$httponly = $params['httponly'];
	setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
	header("Location: /DnA/");
}
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'decision_help';
    }
}
if(isset($_GET['category_id'])) {
	$action = 'list_restaurants';
}

switch($action) {
	
	case 'decision_help':	
		$categories = CategoryDB::get_categories();
		include('decision_helper.php');
		break;
		
	case 'list_restaurants':	
		$categories = CategoryDB::get_categories();
		$category_id = $_GET['category_id'];
		$restaurants = RestaurantDB::get_restaurants_by_cat_id($category_id, $_SESSION['user']->getId());

		include('list_restaurants.php');
		break;
}

?>