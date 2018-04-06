<?php
if($config->ajax) {
    require("functions/ajax.php"); 
    exit;
}

switch ($_SERVER['HTTP_HOST']){
	//definir ambiente de ejecución
  case 'www.elbedroom.mx': case 'elbedroom.mx': define('DEV_ENVIROMENT', 'LIVE'); break;
  case 'beta.elbedroom.mx': define('DEV_ENVIROMENT', 'BETA'); break;
  case 'localhost': define('DEV_ENVIROMENT','LOCALHOST'); break;
}

function add_templates_fields() {
	// Asignar variables para acceder mas fácil
	$fields = wire("fields");
	$templates = wire("templates");
	$modules = wire("modules");

	// Listar templates y campos
	require("functions/templates_fields.php");


	// Crear templates y campos
	foreach ($templates_fields as $template_name => $add_fields) {
		if(!$templates->$template_name) {	//Si el template no existe, crear uno nuevo
			$grupo = new Fieldgroup();	//crear grupo de campos para el template
			$grupo->name = $template_name;
			foreach ($add_fields as $field => $type) {	//Agegar campos al grupo
				if(!$fields->$field) { //Si el campo no existe, crearlo
					$f = new Field();
					$f->type = $modules->get($type);
					$f->name = $field;
					$f->label = $field;
					$f->save();
				}
				$grupo->add($f);
			}
			$grupo->save();
			
			$template = new Template();	//Crear template
			$template->name = $template_name;
			$template->fieldgroup = $grupo;
			$template->save();	//Guardar template

		} else {	//Si el template ya existe, solo agregar nuevos campos
			$template = $templates->$template_name;
			$grupo = $template->fieldgroup;
			foreach ($add_fields as $field => $type) {	//Agegar campos al grupo
				if(!$fields->$field) { //Si el campo no existe, crearlo
					$f = new Field();
					$f->type = $modules->get($type);
					$f->name = $field;
					$f->label = $field;
					$f->save();
				}
				$grupo->add($f);
				if(!$grupo->$field) {	//si el campo no existe ya en el grupo, agregarlo
					$grupo->add($field);
				}
			}
			$grupo->save();	//guardar grupo
			$template->save();	//guardar template
		}
	}
}	//fin add_templates_fields
add_templates_fields();

function add_pages($paginas) {
	foreach ($paginas as $key => $pagina) {
		$nombre = $pagina["nombre"];
		$slug = $pagina["slug"];
		$template = $pagina["template"];
		$parent = $pagina["parent"];
		p_log("pre-creada:".$slug,__file__,__line__);
		if(!$pages->$slug) {
			p_log("creada:".$slug,__file__,__line__);
			$p = new Page();// crear objeto de página
			$p->template = $template; // definir template
			$p->parent = wire('pages')->get($parent); // definir padre
			$p->name = $slug; // definir slug
			$p->title = $nombre; // definir nombre
			$p->save();
		}
	}
};
add_pages($paginas);

function cacher ($file = "wa") {
	//función para eliminar cachés automáticamente al hacer ediciones
  $cache_num =filemtime($_SERVER["DOCUMENT_ROOT"].$file);
  if ($cache_num == "") {
  } else {
  echo $file."?v=".$cache_num;
	}
} //fin cacher

function p_log($data="nodata",$file = "p",$line="-",$array="-") {
	//función para loguear datos
  $file = pathinfo($file, PATHINFO_FILENAME);
  $array = object_to_array($array);
  if ( is_array( $array ) ) {
    ob_start();
    print_r($array);
    $array = ob_get_contents();
    ob_end_clean();
  }
  $data = $data.": ".$array; 

  ProcessWire\wire('log')->save($file."_log", $data." @".$file.' - linea '.$line);
} //fin logger

function object_to_array($data) {
	//deconstructor de arrays
  if (is_array($data) || is_object($data)) {
    $result = array();
    	foreach ($data as $key => $value) {
      		$result[$key] = object_to_array($value);
    	}
    return $result;
  }
  return $data;
} //fin decons_arrays

function slugify($text) {
  $text = preg_replace('~[^\pL\d]+~u', '_', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '_');
  $text = preg_replace('~-+~', '_', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
};


?>