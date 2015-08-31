<?php
/**
 * 
 * @author David Mezquíriz Osés
 * @copyright David Mezquíriz 2015
 * Structure of wishes keeped in database by the table meta
 */

require_once('Database.php');
class Meta {
	function __construct() {}
	
	
	/**
	 * Returns the selected row from 'meta' table
	 * @param void
	 * @return array statement
	 */
	public static function getAll () {
		$query = "select * from meta";
		try {
			$statement = Database::getInstance()->getDb()->prepare($query);
			$statement->execute();
			return $statement->fetchAll(pdo::FETCH_ASSOC);
		} catch (PDOException $e) {
			return false;
		}
	}

	/**
	 * Get Meta row by idMeta column
	 * @param int $id
	 * @return array 
	 */
	public static function getById ($id) {
		$query = "select * from meta where idMeta = :idMeta";
		
		try {
			$statement = Database::getInstance()->getDb()->prepare($query);
			$statement->bindParam(":idMeta", $id);
			$statement->execute();
			$row = $statement->fetch(pdo::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {
			//Can clasify the error depend on the exception and show it by JSON
			return -1;
		}	
	}
	/**
	 * Updating meta row data
	 * @param integer $idMeta
	 * @param string $titulo
	 * @param string $descripcion
	 * @param DateTime $fechaLim
	 * @param string $categoria
	 * @param integer $prioridad
	 * @return PDOStatement|number
	 */
	public static function update (        
		$idMeta,
        $titulo,
        $descripcion,
        $fechaLim,
        $categoria,
        $prioridad
		) {
		//Creating UPDATE statement
		$query = "UPDATE meta " .
				 "SET titulo=:titulo, descripcion=:descripcion, fechaLim=:fechaLim, categoria=:categoria, prioridad=:prioridad " .
				 "WHERE idMeta = :idMeta";
		try {
			//Preparing statement
			$statement = DATABASE::getInstance()->getDb()->prepare($query);
			//Relationing and executing statement
			$statement->execute(array(":titulo"=>$titulo, ":descripcion"=>$descripcion, ":fechaLim"=>$fechaLim, ":categoria"=>$categoria, ":prioridad"=>$prioridad));
			return $statement;
		} catch (PDOException $e) {
			return -1;
		}
	}
	
	/**
	 * Inserting a full row into meta table
	 * @param string $titulo
	 * @param string $descripcion
	 * @param DateTime $fechaLim
	 * @param string $categoria
	 * @param string $prioridad
	 * @return PDOStatement|number
	 */
	public static function insert (
			$titulo,
			$descripcion,
			$fechaLim,
			$categoria,
			$prioridad
			) {
		$query = "insert into meta (titulo, descripcion, fechaLim, categoria, prioridad) values (:titulo,:descripcion,:fechaLim,:categoria,:prioridad)";
		try {
			$statement = Database::getInstance()->getDb()->prepare($query);
			$statement->execute(array(":titulo"=>$titulo,":descripcion"=>$descripcion,":fechaLim"=>$fechaLim,":categoria"=>$categoria,":prioridad"=>$prioridad));
			return $statement;
		} catch (PDOException $e) {
			return -1;
		}
	}
	
	public static function delete ($idMeta) {
		$query = "delete from meta where idMeta = :idMeta";
		try {
			$statement = Database::getInstance()->getDb()->prepare($query);
			$statement->execute(array(":idMeta"=>$idMeta));
			return $statement;
		} catch (PDOException $e) {
			return -1;
		}
	}
}