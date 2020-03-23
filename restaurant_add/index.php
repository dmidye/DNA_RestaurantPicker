<?php
require_once('../model/database_oo.php');
require('../model/restaurant_db_oo.php');
require('../model/restaurant.php');
require('../model/category_db_oo.php');
require('../model/category.php');
require('../model/user.php');
require('../model/image_db_oo.php');

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
        $action = 'restaurant_add';
    }
}

switch($action) {
	
	case 'restaurant_add':	
		$categories = CategoryDB::get_categories();
		include('restaurant_add.php');
		break;
		
	case 'continue_add':
		$filename = pathinfo($_FILES['logo']['name'], PATHINFO_FILENAME);
		$ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
		$filename = $filename . "." . $ext;
		$tmp_name = $_FILES['logo']['tmp_name'];
		$path = $_SERVER['DOCUMENT_ROOT'] . '/DnA/' . DIRECTORY_SEPARATOR . 'images';
		$full_path = $path . DIRECTORY_SEPARATOR . $_FILES['logo']['name'];
		if (is_uploaded_file($tmp_name)) {
			move_uploaded_file($tmp_name, $full_path);
		}
		$name = filter_input(INPUT_POST, 'name');
		$genre = filter_input(INPUT_POST, 'genre');
		$city = filter_input(INPUT_POST, 'city');
		$state = filter_input(INPUT_POST, 'state');
		$time = filter_input(INPUT_POST, 'time_closes');
		$website = filter_input(INPUT_POST, 'website');
		$description = filter_input(INPUT_POST, 'description');
		$address = filter_input(INPUT_POST, 'address');
		$category_id = filter_input(INPUT_POST, 'category_id');
		include('continue_add.php');
		break;
	case 'add_restaurant':
		$name = trim(filter_input(INPUT_POST, 'name'));
		$genre = trim(filter_input(INPUT_POST, 'genre'));
		$website = trim(filter_input(INPUT_POST, 'website'));
		$time = trim(filter_input(INPUT_POST, 'time'));
		$city = trim(filter_input(INPUT_POST, 'city'));
		$state = trim(filter_input(INPUT_POST, 'state'));
		$description = trim(filter_input(INPUT_POST, 'description'));
		$address = trim(filter_input(INPUT_POST, 'address'));
		$category_id = filter_input(INPUT_POST, 'category_id');
		$q_fresh = trim(filter_input(INPUT_POST, 'q_fresh'));
		$q_taste = trim(filter_input(INPUT_POST, 'q_taste'));
		$quantity = trim(filter_input(INPUT_POST, 'quantity'));
		$amount_spent = trim(filter_input(INPUT_POST, 'amount_spent'));
		$go_back_rating = trim(filter_input(INPUT_POST, 'go_back_rating'));
		$user_id = $_SESSION['user']->getId();
		$restaurant_id = RestaurantDB::add_restaurant($name, $genre, $website, $time, $city, $state, $description, $address,
						$q_fresh, $q_taste, $quantity, $amount_spent, $go_back_rating, $category_id, $user_id);
	    $filename = trim(filter_input(INPUT_POST, 'filename'));
		$img_path = "images/" . $filename;
		ImageDB::add_image($restaurant_id, $img_path, "logo");
		header("Location: /DnA/show_restaurant?restaurant_id=$restaurant_id");
		break;
}

?>