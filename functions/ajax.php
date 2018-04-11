<?php 
$datos = $_POST["datos"];
$function = $datos['function'];
if ($function == "") {
	$function = $_POST["function"];
}
$conexion = false;
require("functions/estructuras_data.php");
include('functions/ajax/'.$function.'.php');
if ($conexion == false) {
	$respuesta->message = 'HTTP/1.1 500 No hubo conexion a '.$function.".php";
	$respuesta->code = 9;
	$respuesta->path = 'functions/ajax/'.$function.'.php';
	header('HTTP/1.1 500 No hubo conexion a '.$function.".php");
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($respuesta));
}
$respuesta->conexion = $conexion;

$respuesta = json_encode($respuesta);
echo $respuesta;
exit();
?>