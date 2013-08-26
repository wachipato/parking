<?php
require_once'includes\header.php';
?>

		<!-- Example row of columns -->
		<div class="row">
			<div class="span4">
				<h2>Lugares</h2>
				<p>Desde este apartado podrá ver el total de los lugares en la cochera, el estado de los mismos, si están ocupados, disponibles, para qué tipo de vehículo está apto, etc.</p>
				<p><a class="btn btn-success" href="listadoLugares.php">Lugares &raquo;</a></p>
			</div>
			<div class="span4">
				<h2>Vehículos</h2>
				<p>Obtenga información detallada de todos los vehículos que están usando actualmente el servicio de la cochera, puede también consultar el historial para observar detalles de aquellos autos/motos que fueron dados de baja.</p>
				<p><a class="btn btn-info" href="listadoVehiculos.php">Vehículos &raquo;</a></p>
			</div>
			<div class="span4">
				<h2>Clientes</h2>
				<p>Aquí encontrará detalles sobre los clientes actuales de la cochera, puede también consultar los vehículos pertenecientes a cada uno y la facturación de los mismos.</p>
				<p><a class="btn btn-warning" href="listadoClientes.php">Clientes &raquo;</a></p>
			</div>
		</div>

<?php
require_once'includes\footer.php';
?>