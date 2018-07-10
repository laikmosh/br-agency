<?
$conexion = true;
$campos = $templates_fields["dj_profile"];
$id = $datos["id"];
$p = $pages->get($id);
foreach ($campos as $campo => $fieldtype) {
	$valor = $p->$campo;
	if ($fieldtype == "FieldtypeImage") {
		foreach ($valor as $key => $value) {
			$respuesta->dj->$campo = $p->$campo->url.$key;
		}
	} elseif ($fieldtype == "FieldtypeFile") {
		foreach ($valor as $key => $value) {
			$respuesta->dj->$campo = "<b>".$p->$campo->name."</b> ".$p->$campo->filesizeStr;
			if ($p->$campo->name == "") {
				$respuesta->dj->$campo = "";
			}
		}
	} else {
		$respuesta->dj->$campo = $p->$campo;
	}
}

?>