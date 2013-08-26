<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Cliente.php';

$base = new Database();

$cliente = new Cliente($base);

$tabla = 'clientes';

$datos = array(
	'dni'		=>	$_POST['dni'],
	'apellido'	=>	$_POST['apellido'],
	'nombre'	=>	$_POST['nombre'],
	'direccion'	=>	$_POST['direccion'],
	'provincia'	=>	$_POST['provincia'],
	'telefono'	=>	$_POST['telefono'],
	'celular'	=>	$_POST['celular'],
	'fecha_alta'	=>	date('Y-m-d')
);

if ($cliente->insertarCliente($tabla, $datos)) {
	$_SESSION['aviso']['clase'] = 'alert-success';
	$_SESSION['aviso']['principal'] = 'Felicitaciones!';
	$_SESSION['aviso']['mensaje'] = 'El cliente fue ingresado correctamente a la base de datos.';
	header('Location: listadoClientes.php');
}

?>