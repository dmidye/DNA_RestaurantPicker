<?php
require('../model/database_oo.php');
require('../model/restaurant_db_oo.php');
require('../model/restaurant.php');
require('../model/category_db_oo.php');
require('../model/category.php');
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
        $action = 'show_restaurant';
    }
}

switch($action) {
	
	case 'show_restaurant':	
		if(isset($_GET['restaurant_id'])) {
			$restaurant_id = $_GET['restaurant_id'];
		} else {
			$restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
		}
		$restaurant = RestaurantDB::get_restaurant_by_id($restaurant_id);
		include('show_restaurant.php');
		break;
	case 'edit_restaurant':	
		$type = filter_input(INPUT_POST, 'type');
		$restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
		$restaurant = RestaurantDB::get_restaurant_by_id($restaurant_id);
		
		if($type == "details") {
			$categories = CategoryDB::get_categories();
			include('edit_restaurant_details.php');
		} else {
			include('edit_restaurant_ratings.php');
		}
		break;
	case 'update_restaurant':	
		$type = filter_input(INPUT_POST, 'type');
		$cancel = filter_input(INPUT_POST, 'cancel');
		$restaurant_id = filter_input(INPUT_POST, 'restaurant_id');
		$restaurant = RestaurantDB::get_restaurant_by_id($restaurant_id);
		if($cancel) {
			include('show_restaurant.php');
		} else {
			if($type == "details") {
				$name = trim(filter_input(INPUT_POST, 'name'));
				$genre = trim(filter_input(INPUT_POST, 'genre'));
				$city = trim(filter_input(INPUT_POST, 'city'));
				$state = trim(filter_input(INPUT_POST, 'state'));
				$time = trim(filter_input(INPUT_POST, 'time_closes'));
				$website = trim(filter_input(INPUT_POST, 'website'));
				$description = trim(filter_input(INPUT_POST, 'description'));
				$address = trim(filter_input(INPUT_POST, 'address'));
				$category_id = trim(filter_input(INPUT_POST, 'category_id'));
				RestaurantDB::update_restaurant_details($restaurant_id, $name, $genre, 
														$website, $time, $city, $state, 
														$description, $address, $category_id);
				$restaurant = RestaurantDB::get_restaurant_by_id($restaurant_id);
				include('show_restaurant.php');
			} else {
				$q_fresh = filter_input(INPUT_POST, 'q_fresh');
				$q_taste = filter_input(INPUT_POST, 'q_taste');
				$quantity = filter_input(INPUT_POST, 'quantity');
				$amount_spent = filter_input(INPUT_POST, 'amount_spent');
				$go_back_rating = filter_input(INPUT_POST, 'go_back_rating');
				RestaurantDB::update_restaurant_ratings($restaurant_id, $q_fresh, $q_taste, $quantity, $amount_spent, $go_back_rating);
				$restaurant = RestaurantDB::get_restaurant_by_id($restaurant_id);
				include('show_restaurant.php');
			}
		}
		break;
}


?>