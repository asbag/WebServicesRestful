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
	private $db;

	function __construct()  {
		$this->username = USERNAME;
		$this->password = PASSWORD;
		$this->engine = DBENGINE;
		$this->database = DBNAME;
		
		$dsn = $this->engine . ':host=localhost;dbname='  . $this->database . ';charset=utf8';
		$db = new PDO($dsn, $this->username, $this->password);
		
	}
}