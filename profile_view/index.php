<?php
require('../model/database_oo.php');
require('../model/restaurant_db_oo.php');
require('../model/restaurant.php');
require('../model/category_db_oo.php');
require('../model/category.php');
require('../model/user.php');
require('../model/user_db_oo.php');
require('../model/image_db_oo.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'profile_view';
    }
}

switch($action) {
	
	case 'profile_view':	
		include('profile_view.php');
		break;
	
	case 'create_account':
		$first_name = filter_input(INPUT_POST, 'first_name');
		$last_name = filter_input(INPUT_POST, 'last_name');
		$email = filter_input(INPUT_POST, 'email');
		$password = filter_input(INPUT_POST, 'password');
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		
		$id = UserDB::create_account($first_name, $last_name, $email, $password);
		$_SESSION['user'] = UserDB::log_user_in($_SESSION['email'], $_SESSION['password']);
		header("Location: /DnA/");
		break;
	case 'upload_profile_pic':
		$filename = pathinfo($_FILES['profile']['name'], PATHINFO_FILENAME);
		$ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
		$filename = $filename . "." . $ext;
		$tmp_name = $_FILES['profile']['tmp_name'];
		$path = $_SERVER['DOCUMENT_ROOT'] . '/DnA/' . DIRECTORY_SEPARATOR . 'images';
		$full_path = $path . DIRECTORY_SEPARATOR . $_FILES['profile']['name'];
		if (is_uploaded_file($tmp_name)) {
			move_uploaded_file($tmp_name, $full_path);
		}
		
		$file_path = "images/" . $filename;
		ImageDB::add_profile_image($_SESSION['user']->getId(), $file_path); 
		$_SESSION['profile_path'] = $file_path;
		header("Location: /DnA/profile_view");
		break;
}

?>