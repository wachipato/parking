<?php
require_once 'classes/Database.php';
require_once 'classes/Cliente.php';
require_once 'classes/Lugar.php';

$base = new Database();

$cliente = new Cliente($base);


$clientela = $cliente->getclientes();
var_dump($clientela);
?>