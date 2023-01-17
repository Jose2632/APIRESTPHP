<?php 

require_once "controllers/route_controller.php";
require_once "controllers/cursos_controller.php";
require_once "controllers/clientes_controller.php";
require_once "models/Clientes.php";
require_once "models/Cursos.php";
require_once "bin/functions.php";

$routes = new Routes();
$routes->inicio();