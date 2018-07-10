<?
login_check($user);
$conexion = true;
$campos = $templates_fields["clientes"];

// validar campos obligatorios
if ($datos["nombre"] == "" || $datos["apellido"] == "" || $datos["email"] == "") {
	$respuesta->message = "Incompleto";
	$respuesta->code = 1337;
	header('HTTP/1.1 500 Faltaron campos por rellenar');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($respuesta));
}


	p_log("creando pedido");
	$p = new ProcessWire\Page(); // create new page object
	$p->template = 'clientes'; // set template
	$p->parent = $pages->get("/clientes/"); // set the parent
	$p->name = $datos["nombre"].$datos["apellido"].date("d-m-Y H:i:s") . " - " . uniqid();; // give it a name used in the url for the page
	$p->title = $datos["evento"]." ".$datos["fecha"]; // set page title (not neccessary but recommended)
	$p->save();

foreach ($campos as $campo => $fieldtype) {
	$p->$campo=$datos[$campo];
}
$p->save();

?>