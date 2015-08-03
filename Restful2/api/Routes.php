<?php
/**
 * @author David Mezquíriz Osés
 */
 
/**
 * We have created 6 API methods

    getUsers
    getUser
    findByName
    addUser
    updateUser
    deleteUser
 
 */
require_once 'Bbdd.php';
require_once '../vendor/slim/slim/Slim/Slim.php';

use \Slim\Slim as Slim;

Slim::registerAutoloader();

class Routes  {
	public $app = null;
	
	/**
	 * contructor
	 */
	function __construct() {
		$this->app = new Slim();
		$this->app->get('/api/users', function() { 
			$sql_query = "SELECT `name`, `email`, `date`, `ip` FROM restAPI ORDER BY name";
			
			try  {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $conn->query($sql_query);
				$users = $stmt->fetchAll(PDO::FETCH_OBJ);
				$conn = null;
				echo '{"users":' . json_encode($users) . '}';
			} catch (PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
				
		}); // Using Get HTTP Method and process getUsers function
		$this->app->get('/api/users/:id', function($id) { 
			$sql_query = "select `name`, `email`, `date`, `ip` FROM restAPI WHERE id=:id";
			try {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $conn->prepare($sql_query);
				$stmt->bindParam(":id", $id);
				$stmt->execute();
				$user = $stmt->fetchObject();
				$conn = null;
				echo json_encode($user);
			} catch (PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}); // Using Get HTTP Method and process getUser function
		$this->app->get('/api/users/search/:query', function($query) { 
			$sql = "SELECT * FROM restAPI WHERE UPPER(name) LIKE :query ORDER BY name";
			try {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $dbCon->prepare($sql);
				$query = "%".$query."%";
				$stmt->bindParam(":query", $query);
				$stmt->execute();
				$users = $stmt->fetchAll(PDO::FETCH_OBJ);
				$conn = null;
				echo '{"user": ' . json_encode($users) . '}';
			} catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
				
		}); // Using Get HTTP Method and process findByName function
		$this->app->post('/api/users', function () { 
			$req = $this->app->request(); // Getting parameter with names
			$paramName = $req->params('name'); // Getting parameter with names
			$paramEmail = $req->params('email'); // Getting parameter with names
			
			$sql = "INSERT INTO restAPI (`name`,`email`,`ip`) VALUES (:name, :email, :ip)";
			try {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(":name", $paramName);
				$stmt->bindParam(":email", $paramEmail);
				$stmt->bindParam(":ip", $_SERVER['REMOTE_ADDR']);
				$stmt->execute();
				$user->id = $conn->lastInsertId();
				$conn = null;
				echo json_encode($user);
			} catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}); // Using Post HTTP Method and process addUser function
		$this->app->put('/api/users/:id', function($id) { 
			$req = $this->app->request();
			$paramName = $req->params('name');
			$paramEmail = $req->params('email');
			
			$sql = "UPDATE restAPI SET name=:name, email=:email WHERE id=:id";
			try {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $dbCon->prepare($sql);
				$stmt->bindParam(":name", $paramName);
				$stmt->bindParam(":email", $paramEmail);
				$stmt->bindParam(":id", $id);
				$status->status = $stmt->execute();
			
				$conn = null;
				echo json_encode($status);
			} catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}); // Using Put HTTP Method and process updateUser function
		$this->app->delete('/api/users/:id', function ($id) { 
			$sql = "DELETE FROM restAPI WHERE id=:id";
			try {
				$bd = new Bbdd();
				$conn = $bd->getConnection();
				$stmt = $dbCon->prepare($sql);
				$stmt->bindParam(":id", $id);
				$status->status = $stmt->execute();
				$conn = null;
				echo json_encode($status);
			} catch(PDOException $e) {
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		}); // Using Delete HTTP Method and process deleteUser function
		$this->app->run();
	}
	
	/**
	 * /users
	 * This function simply return all users information as you can see in this query, 
	 * to call this API use this URL http://localhost/api/users this is it for your first API using get route.
	 * @param null
	 * @return string
	 * @throws PDOException
	 */
	
	/**
	 * /users/:id
	 * This function check record of given id and return if found any thing,  
	 * to call this API use this URL http://localhost/api/users/1
	 * @param integer $id
	 * @return string
	 * @throws PDOException
	 */
	
	/**
	 * /users/search/:query
	 * This function search in database for your given query, 
	 * to call this API use this URL http://localhost/api/users/search/phpgang
	 * @param string $query
	 * @return string
	 * @throws PDOException
	 */
	
	/**
	 * /users/
	 * This function search in database for your given query, 
	 * to call this API use this URL http://localhost/api/users/search/phpgang
	 * @param null
	 * @return string
	 * @throws PDOException
	 */
	
	
	/**
	 * /users/:id
	 * @param integer $id
	 * @return string
	 * @throws PDOException
	 */
	
	/**
	 * /users/:id
	 * @param integer $id
	 * @return string
	 * @throws PDOException
	 */
}