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

$p = "";

$editing_id = $datos["editing_id"];
if ($editing_id != "null") {
	$temp_id = $pages->get($editing_id);
	$p = $temp_id;
	$p->of(false);
	p_log("editando dj, template=".$temp_id->template);
} else {
	p_log("creando dj, template=".$temp_id->template);
	$p = new ProcessWire\Page(); // create new page object
	$p->template = 'dj_profile'; // set template
	$p->parent = $pages->get("/djs/"); // set the parent
	$p->name = $datos["dj_name"].date("d-m-Y H:i:s") . " - " . uniqid();; // give it a name used in the url for the page
	$p->title = $datos["dj_name"]; // set page title (not neccessary but recommended)
	$p->save();
}
foreach ($campos as $campo => $fieldtype) {
	if ($fieldtype == "FieldtypeImage") {
		continue;
	};
	$p->$campo=$datos[$campo];
}
$p->save();
$images = $pages->get($datos["temp_id"])->profile_image->first()->filename;
// $p->profile_image->deleteAll();
// $p->save();
$p->profile_image->add($images);
$p->save();

$temp_id = $datos["temp_id"];
if ($temp_id != "null") {
	$temp_id = $pages->get($temp_id);
	if ($temp_id->template == "usr_images" ) {
		$pages->delete($temp_id, true);
		p_log("eliminar TEMPLATE=".$temp_id->template);
	}
}

$respuesta->dj_elem = grid_elem($p,true);
?>