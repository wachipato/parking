<?php
require_once'includes\header.php';
require_once'classes\Vehiculo.php';

if (isset($_GET['action']) && $_GET['action'] != null) {
	switch ($_GET['action']) {
		case 'add':
			header('Location: vehiculo.php?action=add');
			break;
		case 'edit':
			if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
				header('Location: vehiculo.php?action=edit&id='.$_GET['id']);
			}
			break;
		case 'remove':
			if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
				header('Location: vehiculo.php?action=remove&id='.$_GET['id']);
			}
			break;
		default:
			header('Location: index.php');
	}
}

$vehiculo = new Vehiculo($base);
?>

		<!-- Example row of columns -->
		<div class="row">
			<div class="span12">
				<?php
				if (isset($_SESSION['aviso']) && $_SESSION['aviso'] != null) {?>
				<div class="alert <?=$_SESSION['aviso']['clase']?>">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong><?=$_SESSION['aviso']['principal']?></strong> <?=$_SESSION['aviso']['mensaje']?>
				</div>
				<?php
				unset($_SESSION['aviso']);
				}
				?>
				<a href="?action=add" class="btn btn-success">Agregar Vehículo</a>
				<h2>Listado de Vehículos</h2>
				<?php
				$vehiculos = $vehiculo->getVehiculosActivos();
				if (isset($vehiculos) && $vehiculos != null) {
					// Hay al menos un vehículo
					?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Tipo</th>    
								<th>Marca</th>
								<th>Modelo</th>
								<th>Color</th>
								<th>Matrícula</th>
								<th>Dueño</th>
							</tr>
						</thead>
					<?php
					foreach ($vehiculos as $vehiculoIndividual) {
						$duenio = $vehiculo->getNomClientePorVehiculo($vehiculoIndividual['cliente_id']);
						$tipo = $vehiculo->getTipoDeVehiculo($vehiculoIndividual['vehiculo_id']);
						?>
						<tbody>
							<tr>
								<td><?=$tipo['nombre']?></td>
								<td><?=$vehiculoIndividual['marca']?></td>
								<td><?=$vehiculoIndividual['modelo']?></td>
								<td><?=$vehiculoIndividual['color']?></td>
								<td><?=$vehiculoIndividual['matricula']?></td>
								<td><?=$duenio['apellido']?>, <?=$duenio['nombre']?></td>
								<td><a href="?action=edit&id=<?=$vehiculoIndividual['cliente_id']?>" title="Editar"><i class="icon-edit"></i></a> <a href="?action=remove&id=<?=$vehiculoIndividual['cliente_id']?>" title="Eliminar"><i class="icon-remove-circle"></i></a></td>
							</tr>
					<?php
					}
					?>
						</tbody>
					</table>
					<?php
				} else {
					// No existen vehículos
					?>
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Atención!</strong> No existen vehículos en la cochera.
					</div>
					<?php
				}
				?>
				
			</div>
      </div>

<?php
require_once'includes\footer.php';
?>