<?php
$templates_fields = array(
	"home" => array(	//Template de administración: crear, editar y eliminar djs de la agencia
		//Campos:
		"updated_estructura"=>"FieldtypeText",	//Descripción del campo
	),
	"basic-page" => array(	
		//Campos:
	),
	"administrador" => array(	//Template de administración: crear, editar y eliminar djs de la agencia
		//Campos:
	),
	"dj_profile" => array(	//Template de administración: formulario de alta de djs
		//Campos:
		'dj_name'=>"FieldtypeText",
		'nombre'=>"FieldtypeText",
		'apellido'=>"FieldtypeText",
		'email'=>"FieldtypeEmail",
		'telefono'=>"FieldtypeText",
		'edad'=>"FieldtypeText",
		'location'=>"FieldtypeText",
		'mixcloud'=>"FieldtypeText",
		'bio'=>"FieldtypeText",
		'venue'=>"FieldtypeText",
		'genero'=>"FieldtypeText",
		'lineup'=>"FieldtypeText",
		'presskit'=>"FieldtypeFile",
		'profile_image'=>"FieldtypeImage",
		'gallery'=>"FieldtypeImage",
	),
	"usr_images" => array(
		//Campos:
		'profile_image'=>"FieldtypeImage",
		'gallery'=>"FieldtypeImage",
		'presskit'=>"FieldtypeFile",
	),
	"clientes" => array(
		//Campos:
		'djs'=>"FieldtypeText",
		'nombre'=>"FieldtypeText",
		'apellido'=>"FieldtypeText",
		'email'=>"FieldtypeEmail",
		'telefono'=>"FieldtypeText",
		'evento'=>"FieldtypeText",
		'fecha'=>"FieldtypeText",
		'lugar'=>"FieldtypeText",
		'mensaje'=>"FieldtypeText",
	),
);

$paginas = array(
	1=>array(
		"nombre"=>"Admin",
		"slug"=>"admin",
		"template"=>"administrador",
		"parent"=>1,
	),
	2=>array(
		"nombre"=>"DJs",
		"slug"=>"djs",
		"template"=>"dj_profile",
		"parent"=>1,
	),
	3=>array(
		"nombre"=>"usr_images",
		"slug"=>"usr_images",
		"template"=>"usr_images",
		"parent"=>1,
	),
	4=>array(
		"nombre"=>"Clientes",
		"slug"=>"clientes",
		"template"=>"clientes",
		"parent"=>1,
	),
);

?>