<?php

require_once("functions/dj_listelem.php");
if($config->ajax) {
  require_once("login/login.php");
    require("functions/ajax.php"); 
    exit;
}

$djs = $pages->get("/djs/")->children();

switch ($_SERVER['HTTP_HOST']){
	//definir ambiente de ejecución
  case 'www.elbedroom.mx': case 'elbedroom.mx': define('DEV_ENVIROMENT', 'LIVE'); break;
  case 'beta.elbedroom.mx': define('DEV_ENVIROMENT', 'BETA'); break;
  case 'localhost': define('DEV_ENVIROMENT','LOCALHOST'); break;
}

require_once("functions/estructuras.php");
require_once("functions/dj_listelem.php");


function cacher ($file = "wa") {
	//función para eliminar cachés automáticamente al hacer ediciones
  $cache_num =filemtime($_SERVER["DOCUMENT_ROOT"].$file);
  if ($cache_num == "") {
  } else {
  echo $file."?v=".$cache_num;
	}
} //fin cacher

function p_log($data="nodata",$array="-") {
	//función para loguear datos
	$backtrace = debug_backtrace();
	$last = $backtrace[0];
	$file = pathinfo($last['file'], PATHINFO_FILENAME);
	$array = object_to_array($array);
	ob_start();
		print_r($array);
	$array = ob_get_clean();
	$data_log = $data.": ".$array; 

	ProcessWire\wire('log')->save($file."_log", $data_log." @".$file.' - linea '.$last['line']);
  if(!$file == "ajax") {
    ?>
    <div><h2><?=$data?></h2><pre><?print_r($array)?></pre></div>
    <?
  } else {
    return $data_log;
  }
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

require_once("login/login.php");


?>