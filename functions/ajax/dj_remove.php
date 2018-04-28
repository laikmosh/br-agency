<?
$conexion = true;
$campos = $templates_fields["dj_profile"];
$id = $datos["id"];
$p = $pages->get($id);
$pages->trash($p);
$respuesta->status = $id." eliminado"
?>