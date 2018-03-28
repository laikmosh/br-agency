<?php
if($config->ajax) {
    require("functions/ajax.php"); 
    exit;
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
				$grupo->add($field);
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
				if(!$fields->$field) {	//Si el campo no existe, crearlo
					$f = new Field();
					$f->type = $modules->get($type);
					$f->name = $field;
					$f->label = $field;
					$f->save();
				}
				if(!$grupo->$field) {	//si el campo no existe ya en el grupo, agregarlo
					$grupo->add($field);
				}
			}
			$grupo->save();	//guardar grupo
			$template->save();	//guardar template
		}
	}
}	//fin add_templates_fields


?>