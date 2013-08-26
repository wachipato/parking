<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/Cliente.php';

$base = new Database();

$cliente = new Cliente($base);

$id = $_GET['id'];

if ($cliente->bajaCliente($id)) {
	$_SESSION['aviso']['clase'] = 'alert-success';
	$_SESSION['aviso']['principal'] = 'Excelente!';
	$_SESSION['aviso']['mensaje'] = 'El cliente fue dado de baja correctamente.';
	header('Location: listadoClientes.php');
}

?>