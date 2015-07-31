<?php
require_once 'data.inc';

/**
 * 
 * @author David Mezquíriz
 *
 */
class Bbdd {
	/**
	 * @param null
	 * @return PDO
	 */
	function __construct() {
		try {
			$dsn = DATABASE_ENGINE . ':' . 'host=' . HOST . ';dbname=' . DATABASE_NAME;
			$conn = new PDO($dsn, DATABASE_USERNAME, DATABASE_PASSWORD);
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		return $conn;
	}
}