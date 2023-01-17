<?php 

require "dbround.php";


/**
 * 
 */
class Cursos 
{
	
	static public function index($table){

		$stmt = Conexion::conn()->prepare("SELECT * FROM $table");
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_CLASS);
		$stmt->close();
		$stmt = null;

	}
	
}