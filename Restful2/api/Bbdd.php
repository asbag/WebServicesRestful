<?php
require_once 'data.inc';

/**
 * 
 * @author David Mezquíriz
 *
 */
class Bbdd {
	private $conn = null;
	/**
	 * @param null
	 * @throws PDOException
	 */
	public function __construct() {
		try {
			$dsn = DATABASE_ENGINE . ':' . 'host=' . HOST . ';dbname=' . DATABASE_NAME;
			$conn = new PDO($dsn, DATABASE_USERNAME, DATABASE_PASSWORD);
			$conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	}
	
	/**
	 * @return PDO
	 * @throws PDOException
	 */
	public function getConnection () {
		if (is_resource($this->conn)) {
			return $this->conn;
		} else {
			throw new PDOException();
		}
	}
}