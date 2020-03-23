<?php

class UserDB {
	
	function find_user($email) {
		$db = Database::connect();
		$query = 'SELECT * FROM users
				  WHERE email = :email';
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	function create_account($first_name, $last_name, $email, $password) {
		$db = Database::connect();
		$query = 'INSERT INTO users
					 (first_name, last_name, email, password)
				  VALUES
					 (:first_name, :last_name, :email, :password)';
		$statement = $db->prepare($query);
		$statement->bindValue(':first_name', $first_name);
		$statement->bindValue(':last_name', $last_name);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':password', $password);
		if($statement->execute()) {
			$id = $db->lastInsertId();
			//echo "success.";
		} else {
			//echo "\nPDO::errorInfo():\n";
			//print_r($statement->errorInfo());
			return FALSE;
		}
		$statement->closeCursor();
		return $id;
	}
	
	function get_users() {
		$db = Database::connect();
		$query = 'select * from users
				  order by userID asc';
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();	
		foreach($results as $result) {
			$user = new User($result['name']);	
			$user->setID($result['userID']);
			$users[] = $user;		
		}			
		return $users;
	}
	
	function log_user_in($email, $password) {
		$db = Database::connect();
		$query = 'select * from users
				  where email = :email AND password = :password';
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':password', $password);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		if($result != NULL ) {
			$user = new User($result['first_name'], $result['last_name'], $result['email']);
			$user->setId($result['userID']);
		}
		if(isset($user)) {
			return $user;
		} 
		return false;
	}
}

?>