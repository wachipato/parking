<?php
require_once'includes\header.php';

require_once'classes\Lugar.php';

$lugar = new Lugar($base);
if (isset($_GET['action']) && $_GET['action'] == 'add') {
	header('Location: addLugar.php');
}
?>

		<!-- Example row of columns -->
		<div class="row">
			<div class="span12">
				<a href="?action=add" class="btn btn-success">Agregar Lugar</a>
				<h2>Listado de Lugares</h2>
				<?php
				$lugares = $lugar->getLugares();
				if ($lugares) {
					foreach ($lugares as $lugarIndividual) {
						if ($lugar->detectarOcupado($lugarIndividual['lugar_id'])) {
						
							$datosOcupante = $lugar->detectarOcupado($lugarIndividual['lugar_id']);
							echo '<a href="#"><span class="label label-important">Ocupado: '.$datosOcupante[0]['apellido'].' - '.$datosOcupante[0]['marca'].' '.$datosOcupante[0]['color'].'</span></a>';
						} else {
							echo '<a href="#"><span class="label label-success">Vacío N#: '.$lugarIndividual['lugar_id'].'</span></a>';
						}
						echo '<br />';
					}
				} else { ?>
					<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Atención!</strong> No se agregaron lugares en la cochera.
					</div>
				<?php
				}
				?>
			</div>
      </div>

<?php
require_once'includes\footer.php';
?>