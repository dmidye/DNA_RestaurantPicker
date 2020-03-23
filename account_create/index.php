<?php
require('../model/database_oo.php');
require('../model/user.php');
require('../model/user_db_oo.php');
require('../model/image_db_oo.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'account_create';
    }
}

switch($action) {
	
	case 'account_create':	
		include('create_account.php');
		break;
	
	case 'create_account':
		$first_name = filter_input(INPUT_POST, 'first_name');
		$last_name = filter_input(INPUT_POST, 'last_name');
		$email = filter_input(INPUT_POST, 'email');
		$password = filter_input(INPUT_POST, 'password');
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		
		$id = UserDB::create_account($first_name, $last_name, $email, $password);
		if($id != FALSE) {
			$_SESSION['user'] = UserDB::log_user_in($_SESSION['email'], $_SESSION['password']);
			header("Location: /DnA/");
		} else {
			$flag = FALSE;
			include('create_account.php');
		}	
}

?>