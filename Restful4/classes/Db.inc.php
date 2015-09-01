<?php
/**
* @author David Mezquíriz Osés
* Load all the variables of the database
*/

require('Db_vars.php');

class Db {
	private $username;
	private $password;
	private $database;
	private $engine;

	public static $_singleton;
	private $dbh;
	
	function __construct()  {
		$this->username = USERNAME;
		$this->password = PASSWORD;
		$this->engine = DBENGINE;
		$this->database = DBNAME;
		
		// set error level to warnings
		$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		
	}
	
	private function connect ($host, $user, $pass, $db) {
		try {
			$dsn = $this->engine . ':host=localhost;dbname='  . $this->database . ';charset=utf8';
			$this->dbh = new PDO($dsn, $this->username, $this->password);
				
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}
	
	public function getInstance() {
		if (!isset(self::$_singleton)) {
			self::$_singleton = new Db();
		}
		return self::$_singleton;
	}
	
	
}