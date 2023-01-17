<?php 

class Clientes {

	static public function index($table){

		$stmt = Conexion::conn()->prepare("SELECT * FROM $table");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;

	}

	static public function find($table, $field, $parm) 
	{
		$stmt = Conexion::conn()->prepare("SELECT * FROM $table WHERE $field = '$parm'");
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->close();
		$stmt = null;
	}

	static public function create($table, $data) {

		$sentencia = '';
		$values = '';
		foreach ($data as $key => $value) {
			$sentencia = $sentencia."$key".',';
			$values = $values.":$key".',';
		}

		$sentencia = substr($sentencia, 0, -1);
		$values = substr($values, 0, -1);

		$stmt=Conexion::conn()->prepare("INSERT INTO $table($sentencia) VALUES ($values)");

		foreach ($data as $key => &$value) {
			$stmt->bindParam(":$key", $value, PDO::PARAM_STR);
		}

		if($stmt->execute()) {
			return "ok";
		}
		else {
			print_r(Conexion::conn()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

}