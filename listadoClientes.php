<?php
require_once'includes\header.php';
require_once'classes\Cliente.php';

if (isset($_GET['action']) && $_GET['action'] != null) {
	switch ($_GET['action']) {
		case 'add':
			header('Location: cliente.php?action=add');
			break;
		case 'edit':
			if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
				header('Location: cliente.php?action=edit&id='.$_GET['id']);
			}
			break;
		case 'remove':
			if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
				header('Location: cliente.php?action=remove&id='.$_GET['id']);
			}
			break;
		default:
			header('Location: index.php');
	}
}

$cliente = new Cliente($base);
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
				<a href="?action=add" class="btn btn-success">Agregar Cliente</a>
				<h2>Listado de Clientes</h2>
				<?php
				$clientela = $cliente->getclientesActivos();
				if (isset($clientela) && $clientela != null) {
					// Hay al menos cliente
					?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Apellido</th>
								<th>Nombre</th>
								<th>Teléfonos</th>
								<th>Celular</th>
								<th>Opciones</th>
							</tr>
						</thead>
					<?php
					foreach ($clientela as $clienteIndividual) { ?>

						<tbody>
							<tr>
								<td><?=$clienteIndividual['cliente_id']?></td>
								<td><?=$clienteIndividual['apellido']?></td>
								<td><?=$clienteIndividual['nombre']?></td>
								<td><?=$clienteIndividual['telefono']?></td>
								<td><?=$clienteIndividual['celular']?></td>
								<td><a href="?action=edit&id=<?=$clienteIndividual['cliente_id']?>" title="Editar"><i class="icon-edit"></i></a> <a href="?action=remove&id=<?=$clienteIndividual['cliente_id']?>" title="Eliminar"><i class="icon-remove-circle"></i></a></td>
							</tr>
					<?php
					}
					?>
						</tbody>
					</table>
					<?php
				} else {
					// No existen clientes
					?>
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Atención!</strong> No existen clientes en la cochera.
					</div>
					<?php
				}
				?>
				
			</div>
      </div>

<?php
require_once'includes\footer.php';
?>