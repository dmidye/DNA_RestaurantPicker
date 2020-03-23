<?php
require('../model/database_oo.php');
require('../model/restaurant_db_oo.php');
require('../model/restaurant.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'restaurant_list';
    }
}

switch($action) {
	
	case 'restaurant_list':	
		$restaurants = RestaurantDB::get_restaurants();
		include('list_restaurants.php');
		break;
}

?>