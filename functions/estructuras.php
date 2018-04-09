<?php
// Asignar variables basicas
$fields = wire("fields");
$templates = wire("templates");
$modules = wire("modules");
$fieldgroups = wire("fieldgroups");
// Listar templates y campos
require("functions/estructuras_data.php");

function GenerarEstructuras($templates_fields) {
	// Asignar variables basicas
	$fields = wire("fields");
	$templates = wire("templates");
	$modules = wire("modules");
	$fieldgroups = wire("fieldgroups");
	$db = wire("db");

	// p_log("vars templates_fields",$templates_fields);

	list($acciones_templates, $acciones_fields, $fields_del_array) = CrearEditarTemplates($templates, $templates_fields, $fieldgroups, $fields);

	// Crear templates y campos
	foreach ($acciones_templates["crear"] as $template_name) {
		p_log("crear:",$acciones_templates["crear"]);
		$add_fields = $templates_fields[$template_name];
		$fg = new Fieldgroup();	//crear grupo de campos para el template
		$fg->name = $template_name;
		foreach ($add_fields as $field => $type) {	//Agegar campos al grupo
			if(!$fields->$field) { //Si el campo no existe, crearlo
				$f = new Field();
				$f->name = $field;
				$f->label = $field;
				$f->type = $type;
				$f->save();
			}
			$f = $fields->$field; //Si el campo ya existe, agregarlo
			$fg->add($f);
		}
		$fg->save();
		
		$t = new Template();	//Crear template
		$t->name = $template_name;
		$t->fieldgroup = $fg;
		$t->save();	//Guardar template
		if (!$templates->get($t)) echo "<p>template {$name} creada correctamente.</p>";
	}

	foreach ($acciones_templates["editar"] as $template_name) {
		$add_fields = $templates_fields[$template_name];
		$t = $templates->$template_name;
		$fg = $t->fieldgroup;
		foreach ($add_fields as $field => $type) {	//Agegar campos al grupo
			if(!$fields->$field) { //Si el campo no existe, crearlo
				$f = new Field();
				$f->name = $field;
				$f->label = $field;
				$f->type = $type;
				$f->save();
				echo "<p>template {$template_name} agregó field {$field}</p>";
			}
			$f = $fields->$field;
			$fg->add($f);
		}
		$fg->save();
		$remove_fields = $acciones_fields[$template_name]["eliminar"];
		foreach ($remove_fields as $r_field => $r_type) {
			$r_field_obj =$fields->$r_field;
			$fg->remove($r_field_obj);
			echo "<p>template {$template_name} eliminó field {$r_field}</p>";
		}
		$fg->save();
		
		$t->fieldgroup = $fg;
		$t->save();	//Guardar template
	}

	foreach ($acciones_templates["eliminar"] as $template_name) {
		p_log("eliminar:",$acciones_templates["eliminar"]);
		$t = $templates->get($template_name);
		$name = $t->name;
		$t->name = "d_{$t->name}_{$t->id}";
		$t->save();
		//eliminar template
		$templates->delete($t);
		// eliminar el fieldgroup de este template
		$fg = $fieldgroups->get($name);
		$fg->name = "d_{$t->name}_{$fg->id}";
		$fg->save();
		$fieldgroups->delete($fg);
        // verificar eliminacion
		if (!$templates->get($t)) echo "<p>template {$name} se eliminó correctamente.</p>";
	}

	foreach ($paginas as $key => $pagina) {
		$existe = $pages->get("name=".$pagina["slug"])->id;
		if(!$existe) {
			$p = new Page();// crear objeto de página
		} else {
			$p = $pages->get("name=".$slug);
		}
		$p->template = $pagina["template"]; // definir template
		$p->parent = $pages->get($pagina["parent"]); // definir padre
		$p->name = $slug; // definir slug
		$p->title = $pagina["nombre"]; // definir nombre
		$p->save();
	}
	
	// limpiar templates, fieldgroups y fields que no aparecen en templates_fields
	foreach ($fields_del_array as $key => $field) {
      $f = $fields->get($field);
      $fgs = $f->getFieldgroups();
      foreach ($fgs as $fg) {
        // eliminar campo de fieldgroups
        foreach(array('admin_column_left', 'admin_column_left_END', 'admin_column_right', 'admin_column_right_END') as $ff) {
		    if(!$fg->get($ff)) continue;
		    $fg->softRemove($ff);
		    $fg->save();
		    wire('fields')->delete(wire('fields')->get($ff));
		}
		$fg->softRemove($f);
	    $fg->save();
	    // wire('fields')->delete(wire('fields')->get($ff));
      }
      //eliminar campo
      $fields->delete($f);
	}


    foreach($fields->fieldgroup as $field){
    	$used_by=$field->getTemplates();
        if($used_by == ""){
        	$fieldgroup = $template->fieldgroup;
            $fieldgroup->remove($field);
            $fieldgroup->name = "delete_".$template->fieldgroup->name;
            $fieldgroup->save();
            $fieldgroups->remove($fieldgroup);
            $fieldgroups->save();
   //          $field->name = $field->label."_deleted_".$field->id;
			// $field->save();
			// $fields->remove($field);
			// $fields->save();
        }
    }
}	//fin add_templates_fields
GenerarEstructuras($templates_fields);

function CrearEditarTemplates($templates, $templates_fields, $fieldgroups, $fields) {
	// crear array con templates agregados en templates_fields.php
	$templates_array = array();
	$fields_array = array();
	foreach ($templates_fields as $template_name => $add_fields) {
		$templates_array[$template_name][]="crear";
		foreach ($add_fields as $field => $type) {
			$fields_array[$template_name][$field]["crear"]=$type;
		}
	}

	// crear array con templates existentes en base de datos
	foreach ($templates as $template) {
		if ($template->flags!="0") {continue;} //saltar templates de sistema
		$templates_array[$template->name][]="eliminar";
		$template_fields = $template->fields;
		foreach ($template_fields as $key => $field) {
			if ($field == "title") {continue;}
			$fields_array[$template->name][$field->name]["eliminar"]=$field->type->name;
		}
	}
	
	// asignar acciones por ejecutar a templates
	$acciones_templates = array();
	foreach ($templates_array as $key => $value) {
		//si el template ya fue agregado anteriormente y sigue en template_fields.php
		//agregar a array para buscar modificaciones en campos posteriormente
		if (count($value) > 1) {$acciones_templates["editar"][]=$key;}
		/*
		si el template solo está en template_fields.php se debe crear
		si el template solo está en base de datos se debe eliminar
		se agrega a array según la acción que corresponda
		*/
		else {$acciones_templates[$value[0]][]=$key;}
	}

	// asignar acciones por ejecutar a fields
	$acciones_fields = array();
	foreach ($fields_array as $template => $listed_fields) {
		//si el template ya fue agregado anteriormente y sigue en template_fields.php
		//agregar a array para buscar modificaciones en campos posteriormente
		foreach ($listed_fields as $field => $acciones) {
			foreach ($acciones as $accion => $type) {
				if (count($acciones) > 1) {$acciones_fields[$template]["editar"][$field]=$type;} 
				/*
				si el template solo está en template_fields.php se debe crear
				si el template solo está en base de datos se debe eliminar
				se agrega a array según la acción que corresponda
				*/
				else {$acciones_fields[$template][$accion][$field]=$type;}
			}
		}
	}

	$fields_del_array = array();
	foreach ($fields as $key => $field) {
		if ($field->flags!="0") { continue;}
		$fields_del_array[$field->name]=$field->name;
	}
	foreach ($fields_array as $template => $listed_fields) {
		foreach ($listed_fields as $field => $acciones) {
			unset($fields_del_array[$field]);
		}
	}

	return array($acciones_templates, $acciones_fields,$fields_del_array);
};
?>