<?php
require 'db.php';
require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/users','getUsers');
$app->get('/users/get/:id', 'getUserUpdate');
$app->get('/updates','getUserUpdates');
$app->put('/updates/:id', 'insertUpdate');
$app->delete('/updates/delete/:update_id','deleteUpdate');
$app->get('/users/search/:query','getUserSearch');

$app->run();

// GET http://www.yourwebsite.com/api/users
function getUsers() {
	$sql = "SELECT user_id,username,name,profile_pic FROM users ORDER BY user_id DESC";
	try {
		$db = getDB();
		$stmt = $db->query($sql);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// GET http://www.yourwebsite.com/api/updates
function getUserUpdates() {
	$sql = "SELECT A.user_id, A.username, A.name, A.profile_pic, B.update_id, B.user_update, B.created FROM users A, updates B WHERE A.user_id=B.user_id_fk  ORDER BY B.update_id DESC";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"updates": ' . json_encode($updates) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// DELETE http://www.yourwebsite.com/api/updates/delete/10
function deleteUpdate($update_id)
{
	$sql = "DELETE FROM users WHERE user_id=:update_id";


	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":update_id", $update_id);
		$stmt->execute();
		
		
		//Debugging
		ob_start();
		debug_print_backtrace();
		error_log(ob_get_clean());
		error_log('Identifying string: ' . $sql);
		error_log('Identifier: ' . $update_id);
		//End Debugging
		
		$db = null;
		echo '{"success":{"text":"Request deleted"}}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// POST http://www.yourwebsite.com/api/updates
function insertUpdate($id) {
	$app = \Slim\Slim::getInstance();
	$req = $app->request();
	(!is_null($req->put('user_name')))? $username = $req->put('user_name'):$username="";
	(!is_null($req->put('user_update')))? $fullname = $req->put('user_update'):$fullname="";

	try {
		$sql = "UPDATE users SET username = :username, name = :fullname WHERE user_id = :id";

		
		//Debug trace
		/*
		ob_start();
		debug_print_backtrace();
		error_log(ob_get_clean());
		$sql2 = "UPDATE users SET username = $username, name = $fullname WHERE user_id = $id";
		error_log('Update query ' . $sql2 . ' with id: ' . $id . '/username: ' . $username . '/fullname: ' . $fullname);
		*/
		//End debug trace
		
		$conn = getDB();
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":username", $username);
		$stmt->bindParam(":fullname", $fullname);
		$stmt->bindParam(":id", $id);
		$count = $stmt->execute();

		$val = "user_id" . $id . "user_name" . $username . "user_update" . $fullname;
		error_log($val);
		
		$json_value = array("user_id" => $id, "user_name" => $username, "user_update" => $fullname);
		
		$conn = null;
		error_log('Ladies and Gentlements 2:');
		
		echo json_encode($json_value);
	} catch (PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// GET http://www.yourwebsite.com/api/users/get/10
function getUserUpdate($update_id) {
	$sql = "SELECT user_id,username,name,profile_pic FROM users where user_id=:update_id";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':update_id',$update_id);
		$stmt->execute();
		$user = $stmt->fetch();
		
		$db = null;
		//Debug trace
		ob_start();
		debug_print_backtrace();
		error_log(ob_get_clean());
		error_log('Select query ' . $sql . ' with id: ' . $update_id . ' result is: ' . json_encode($user));
		//End debug trace
		
		echo json_encode($user);
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

// GET http://www.yourwebsite.com/api/users/search/sri
function getUserSearch($query) {
//.....
//....
}
?>