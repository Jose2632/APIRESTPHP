<?php 
/**
 * Controlador cursos
 */

class Cursos_controller
{
	
	public function index() 
	{

		$cursos = Cursos::index("cursos");

		$response = [
			"detalle" => $cursos	
		];

		echo json_encode($response, true);
		return;
	}

	public function create() 
	{

		$response = [
			"detalle" => "Creando Curso"
		];

		echo json_encode($response, true);
		return;
	}


	public function show($id) 
	{

		$response = [
			"detalle" => "Viendo Curso Numero $id"
		];

		echo json_encode($response, true);
		return;
	}

	public function update($id) 
	{

		$response = [
			"detalle" => "Atualizando Curso $id"
		];

		echo json_encode($response, true);
		return;
	}

	public function delete($id) 
	{

		$response = [
			"detalle" => "Eliminando Curso $id"
		];

		echo json_encode($response, true);
		return;
	}
}