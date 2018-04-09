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
		'venue'=>"FieldtypeText",
		'genero'=>"FieldtypeText",
		'lineup'=>"FieldtypeText",
	),
	"usr_images" => array(
		//Campos:
		'profile_image'=>"FieldtypeImage",
		'gallery'=>"FieldtypeImage",
	),
);

$paginas = array(
	1=>array(
		"nombre"=>"DJs",
		"slug"=>"djs",
		"template"=>"dj_profile",
		"parent"=>1,
	),
	2=>array(
		"nombre"=>"usr_images",
		"slug"=>"usr_images",
		"template"=>"usr_images",
		"parent"=>1,
	),
	// 2=>array(
	// 	"nombre"=>"Clientes",
	// 	"slug"=>"clientes",
	// 	"template"=>"clientes",
	// 	"parent"=>1,
	// ),
);

?>