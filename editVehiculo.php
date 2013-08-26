<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Cliente.php';

$base = new Database();

$cliente = new Cliente($base);

$tabla = 'clientes';

$datos = array(
	'cliente_id'	=>	$_POST['cliente_id'],
	'dni'			=>	$_POST['dni'],
	'apellido'		=>	$_POST['apellido'],
	'nombre'		=>	$_POST['nombre'],
	'direccion'		=>	$_POST['direccion'],
	'provincia'		=>	$_POST['provincia'],
	'telefono'		=>	$_POST['telefono'],
	'celular'		=>	$_POST['celular']
);

$where = '`cliente_id`='.$datos['cliente_id'].'';

if ($cliente->actualizarCliente($tabla, $where, $datos)) {
	$_SESSION['aviso']['clase'] = 'alert-success';
	$_SESSION['aviso']['principal'] = 'Excelente!';
	$_SESSION['aviso']['mensaje'] = 'El cliente N#'.$datos['cliente_id'].' fue actualizado correctamente.';
	header('Location: listadoClientes.php');
}

?>