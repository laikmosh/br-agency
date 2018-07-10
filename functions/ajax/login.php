<?php 
$conexion = true;
$email = $sanitizer->email($datos['email']); 
$pass = $datos['password'];

   //get user name
$who = $users->get("email=$email")->name;
if ($who) {
//start a session if they exist
$user = $session->login($who, $pass);
}
// if they are a logged in, it must match
if ($user && $user->name != "guest") {
	$respuesta->status = "logueado";
} else {
	$respuesta->message = 'HTTP/1.1 500 Datos incorrectos';
	header('HTTP/1.1 500 Datos de inicio de sesión no coinciden');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($respuesta));
}
 
?>
