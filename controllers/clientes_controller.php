<?php 

/**
 * 
 */
class Clientes_controller
{
	
	public function create($datos) 
	{
		if (valparm($datos)) {

		$datos = sanparm($datos);

		if (isset($datos) && !ctype_alpha($datos['nombre'])) {

				$response = [
				"status" => 404,
				"detalle" => "Error en los datos recibidos"
			];

			echo json_encode($response, true);
			return;
			
		}

		if (isset($datos) && !ctype_alpha($datos['apellido'])) {

				$response = [
				"status" => 404,
				"detalle" => "Error en los datos recibidos"
			];

			echo json_encode($response, true);
			return;
			
		}
		
		if (isset($datos) && !filter_var($datos["email"], FILTER_VALIDATE_EMAIL)) {

				$response = [
				"status" => 404,
				"detalle" => "Error en los datos recibidos"
			];

			echo json_encode($response, true);
			return;
			
		}

		$clientes = Clientes::find("clientes", "email", $datos["email"]);

		if ($clientes) {

			$response = [
				"status" => 404,
				"detalle" => "Error, email en uso"
			];

			echo json_encode($response, true);
			return;
			
		}

		$id_cliente = hash('ripemd160', $_POST['nombre'].$_POST['apellido'].$_POST['email']);
		$secret_key = hash('ripemd160', $_POST['nombre'].$_POST['email'].$_POST['apellido']);


		$data = [
			'nombre' => $_POST['nombre'],
			'apellido' => $_POST['apellido'],
			'email' => $_POST['email'],
			'id_cliente' => $id_cliente,
			'llave_secreta' => $secret_key,
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];

		$create = Clientes::create("clientes", $data);

		if ($create == "ok") {

			$response = [
			"status" => 200,
			"detalle" => "Credenciales registradas",
			"id_cliente" => $id_cliente,
			"llave_secreta" => $secret_key
			];

			echo json_encode($response, true);
			return;
			
		}

		else {

			$response = [
			"status" => 404,
			"detalle" => "Error"
			];

			echo json_encode($response, true);
			return;

		}
		

	}

	else {

		$response = [
				"status" => 404,
				"detalle" => "Error en los datos recibidos"
			];

			echo json_encode($response, true);
			return;

	}


}
}