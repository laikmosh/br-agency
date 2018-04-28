<?
$conexion = true;
$campos = $templates_fields["dj_profile"];
$id = $datos["id"];
$p = $pages->get($id);
foreach ($campos as $campo => $fieldtype) {
	$valor = $p->$campo;
	if ($fieldtype == "FieldtypeImage") {
		foreach ($valor as $key => $value) {
			$respuesta->dj->$campo[] = $p->$campo->url.$key;
		}
	} else {
		$respuesta->dj->$campo = $p->$campo;
	}
}

?>