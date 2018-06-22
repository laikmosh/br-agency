<?
login_check($user);
$conexion = true;

$temp_id = $_POST["temp_id"];
p_log("temp_id=".$temp_id);
if ($temp_id != "null") {
	$temp_id = $pages->get($temp_id);
	if ($temp_id->template == "usr_images" ) {
		$pages->delete($temp_id, true);
		p_log("eliminar TEMPLATE=".$temp_id->template);
	}
}

$upload_path = $config->paths->assets . 'files/temp/';
if(!is_dir($upload_path)) { if(!wireMkdir($upload_path)) throw new WireException("No upload path!");}

$uploadpag = new Page();
$uploadpag->of(false);
$uploadpag->name = date("d-m-Y H:i:s") . " - " . uniqid();
$uploadpag->template = "usr_images";
$uploadpag->parent = $pages->get("/usr_images/");
$uploadpag->save();

$uploads = $_FILES;
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
	    	$image = $uploadpag->$file_fieldname->add($upload_path . $filename);
	        unlink($upload_path . $filename);    
	    }
	        // save page
		$uploadpag->save();
	        // remove all tmp files uploaded
	} else {
	    foreach ($files as $key => $filename) {
	        unlink($upload_path . $filename);    
	    }
	};
}; //fin foreach
$respuesta->temp_img = $uploadpag->id;
?>