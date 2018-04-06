<?php
$templates_fields = array(
	"administrador" => array(	//Template de administración: crear, editar y eliminar djs de la agencia
		//Campos:
		"fieldname"=>"FieldtypeText",	//Descripción del campo
	),
	"dj_profile" => array(	//Template de administración: crear, editar y eliminar djs de la agencia
		//Campos:
		'apellido'=>"FieldtypeText",
		'email'=>"InputfieldEmail",
		'telefono'=>"FieldtypeText",
		'dj_name'=>"FieldtypeText",
		'edad'=>"FieldtypeText",
		'genero'=>"FieldtypeText",
		'lineup'=>"FieldtypeText",
		'nombre'=>"FieldtypeText",
		'venue'=>"FieldtypeText",
	),
);

$paginas = array(
	1=>array(
		"nombre"=>"DJs",
		"slug"=>"djs",
		"template"=>"dj_profile",
		"parent"=>1,
	),
);

?>