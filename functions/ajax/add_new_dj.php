<?
login_check($user);
$conexion = true;
$campos = $templates_fields["dj_profile"];

// validar campos obligatorios
if ($datos["dj_name"] == "" || $datos["nombre"] == "" || $datos["apellido"] == "" || $datos["email"] == "") {
	$respuesta->message = "Incompleto";
	$respuesta->code = 1337;
	header('HTTP/1.1 500 Faltaron campos por rellenar');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($respuesta));
}
$p = new ProcessWire\Page(); // create new page object
$p->template = 'dj_profile'; // set template
$p->parent = $pages->get("/djs/"); // set the parent
$p->name = $datos["dj_name"]; // give it a name used in the url for the page
$p->title = $datos["dj_name"]; // set page title (not neccessary but recommended)
foreach ($campos as $campo => $fieldtype) {
	$p->$campo=$datos[$campo];
}
$p->save();

?>