<?
$conexion = true;
$id = $datos["id"];
$p = $pages->get($id);
$pages->restore($p); 
$respuesta->dj_elem = grid_elem($p,true);
$respuesta->status = $id." restaurada"
?>