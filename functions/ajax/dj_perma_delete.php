<?
$conexion = true;
$id = $datos["id"];
$p = $pages->get($id);
$pages->delete($p); 
$respuesta->status = $id." eliminada permanentemente";
?>