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

// AGREGAR PROFILE IMAGE SINGLE
$images = $pages->get($datos["temp_id"])->profile_image->first()->filename;
$p->profile_image->add($images);

// $source = $pages->get($datos["temp_id"]);
// $dest = $p;
// $dest->of(false);
// $source->of(false);
// $gallery = $source->gallery;
// p_log($gallery);
// foreach ($gallery as $key => $file) {
// 	$dest->gallery->add("/agency/site/assets/files/".$datos["temp_id"]."/".$file);
// }
// $dest->gallery->add($source->gallery);
// p_log($source->gallery);

$p->save();
$temp_id = $datos["temp_id"];
if ($temp_id != "null") {
	$temp_id = $pages->get($temp_id);
	if ($temp_id->template == "usr_images" ) {
		$pages->delete($temp_id, true);
		p_log("eliminar TEMPLATE=".$temp_id->template);
	}
}
//FIN AGREGAR PROFILE IMAGE SINGLE

// AGREGAR PDF SINGLE
if ($datos["temp_id_pdf"] == "delete") {
	$p->presskit->removeAll();
	$p->save();
} else {
	if ($datos["temp_id_pdf"] != "null") {
		$pdf = $pages->get($datos["temp_id_pdf"])->presskit->filename;
		if ($pdf) {
			p_log("pdf id=",$datos["temp_id_pdf"]);
			$p->presskit->add($pdf);
			$p->save();
			$temp_id = $datos["temp_id_pdf"];
			if ($temp_id != "null") {
				$temp_id = $pages->get($temp_id);
				if ($temp_id->template == "usr_images" ) {
					$pages->delete($temp_id, true);
					p_log("eliminar TEMPLATE=".$temp_id->template);
				}
			}
		}
	}
}
p_log("Linea");
//FIN AGREGAR PDF SINGLE

//carga de pdf
$uploads = $_FILES;
$upload_path = $config->paths->assets . 'files/temp/';
foreach ($uploads as $file_fieldname => $data) {
	$u = new ProcessWire\WireUpload($file_fieldname);
	$u->setMaxFiles(15);
	$u->setMaxFileSize(1*6024*6024);
	$u->setOverwrite(false);
	$u->setDestinationPath($upload_path);
	$u->setValidExtensions(array('jpg', 'jpeg', 'gif', 'png', 'pdf'));
	$files = $u->execute(); // execute upload and check for errors
	if(!$u->getErrors()) {

	    foreach ($files as $key => $filename) {
	    	$image = $p->presskit->add($upload_path . $filename);
	        unlink($upload_path . $filename);    
	    }
	        // save page
		$p->save();
	        // remove all tmp files uploaded
	} else {
	    foreach ($files as $key => $filename) {
	        unlink($upload_path . $filename);    
	    }
	};
}
//fin carga pdf

$respuesta->dj_elem = grid_elem($p,true,"empty");
$respuesta->id = $p->id;
// p_log("fin add/edit",$respuesta->dj_elem);
?>