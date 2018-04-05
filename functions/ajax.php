<?php 
$datos = $_POST["datos"];
$function = $datos['function'];
$conexion = false;
include('functions/ajax/'.$function.'.php');
if ($conexion == false) {
	$respuesta->message = "ERROR";
	$respuesta->code = 1337;
	$respuesta->path = 'functions/ajax/'.$function.'.php';
	header('HTTP/1.1 500 No hubo conexion a '.$function.".php");
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($respuesta));
}
$respuesta->conexion = $conexion;

$respuesta = json_encode($respuesta);
echo $respuesta;
p_log($function,__file__,"end",$respuesta);
exit();
?>