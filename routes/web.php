<?php 

$routes_array = explode("/", $_SERVER['REQUEST_URI']);

if (count(array_filter($routes_array)) == 0) {

	$response = [
		"detalle" => "No encontrado"
	];

	echo json_encode($response, true);
	return;
} 

else {

	if (count(array_filter($routes_array)) == 1) { 

		if (array_filter($routes_array)[1] == "cursos") {


			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST") {

				$cursos = new Cursos_controller();
				$cursos->create();
				
			}

			elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "GET") {

				$cursos = new Cursos_controller();
				$cursos->index();
				
			}



			

		}
	}

	if (count(array_filter($routes_array)) == 1) { 

		if (array_filter($routes_array)[1] == "registro") {

			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "GET") {

			$clientes = new Clientes_controller();
			$clientes->create();
		}

		if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST") {

			$datos = [ 
				"nombre" => $_POST['nombre'],
				"apellido" => $_POST['apellido'],
				"email" => $_POST['email']
			];

			$clientes = new Clientes_controller();
			$clientes->create($datos);
		}

		}
	}

	else {

		if (array_filter($routes_array)[1] == "cursos" && is_numeric(array_filter($routes_array)[2])) {

				if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "GET") {

			$curso = new Cursos_controller();
			$curso->show(array_filter($routes_array)[2]);
		}


			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "PUT") {

			$editar_curso = new Cursos_controller();
			$editar_curso->update(array_filter($routes_array)[2]);
		}

			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "DELETE") {

			$eliminar_curso = new Cursos_controller();
			$eliminar_curso->delete(array_filter($routes_array)[2]);
		}
	}
}
}