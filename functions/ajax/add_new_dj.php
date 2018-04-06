<?
$conexion = true;
$campos = $templates_fields["dj_profile"];

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