<?php
require_once'includes\header.php';
require_once'classes\Cliente.php';

$cliente = new Cliente($base);
?>

    <!-- Example row of columns -->
    <div class="row">
      <div class="offset3 span4">
          <?php
          if (isset($_GET['action']) && $_GET['action'] != null){
            switch ($_GET['action']) {
              case 'add':
                ?>

                <form class="form-horizontal" method="post" id="insertForm" action="addCliente.php">
                <fieldset>

                <!-- Form Name -->
                <legend>Agregar Nuevo Cliente</legend>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">DNI</label>
                  <div class="controls">
                    <input id="dni" name="dni" type="text" placeholder="DNI" class="input-xlarge" required="">
                    <p class="help-block">Ingrese el DNI SIN puntos.</p>
                  </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">Apellido</label>
                  <div class="controls">
                    <input id="apellido" name="apellido" type="text" placeholder="Apellido" class="input-xlarge" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">Nombre</label>
                  <div class="controls">
                    <input id="nombre" name="nombre" type="text" placeholder="Nombre" class="input-xlarge" required="">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">Dirección</label>
                  <div class="controls">
                    <input id="direccion" name="direccion" type="text" placeholder="Dirección" class="input-xlarge">
                    
                  </div>
                </div>

                <!-- Select Basic -->
                <div class="control-group">
                  <label class="control-label">Provincia</label>
                  <div class="controls">
                    <select id="provincia" name="provincia" class="input-xlarge">
                      <option>Buenos Aires</option>
                      <option>Catamarca</option>
                      <option>Chaco</option>
                      <option>Chubut</option>
                      <option selected="selected">Córdoba</option>
                      <option>Corrientes</option>
                      <option>Entre Ríos</option>
                      <option>Formosa</option>
                      <option>Jujuy</option>
                      <option>La Pampa</option>
                      <option>La Rioja</option>
                      <option>Mendoza</option>
                      <option>Misiones</option>
                      <option>Neuquen</option>
                      <option>Río Negro</option>
                      <option>Salta</option>
                      <option>San Juan</option>
                      <option>San Luis</option>
                      <option>Santa Cruz</option>
                      <option>Santa Fe</option>
                      <option>Santiago del Estero</option>
                      <option>Tierra del Fuego</option>
                      <option>Tucuman</option>
                    </select>
                  </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">Teléfono</label>
                  <div class="controls">
                    <input id="telefono" name="telefono" type="text" placeholder="Teléfono particular" class="input-xlarge">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                  <label class="control-label">Celular</label>
                  <div class="controls">
                    <input id="celular" name="celular" type="text" placeholder="Teléfono Celular" class="input-xlarge">
                    <p class="help-block">Por favor ingrese el código de área.</p>
                  </div>
                </div>

                <!-- Button (Double) -->
                <div class="control-group">
                  <label class="control-label"></label>
                  <div class="controls">
                    <button id="insertar" data-loading-text="Creando..." class="btn btn-success">Crear Nuevo</button>
                    <a href="listadoClientes.php" class="btn btn-danger">Cancelar</a>
                  </div>
                </div>

                </fieldset>
                </form>
                
                <?php
                break;
              case 'edit':
                if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
                  // Viene el ID y no está vacío
                  $clienteData = $cliente->getCliente($_GET['id']);
                  if (!$clienteData) {
                    // Si no existe cliente con ese ID muestro el mensaje de error
                    ?>
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h4>Atención!</h4>
                      Ese cliente no existe!
                    </div>
                    <?php
                  } else {
                    // Muestro el formulario
                    ?>
                    <form class="form-horizontal" method="post" id="updateForm" action="editCliente.php">
                      <fieldset>

                      <!-- Form Name -->
                      <legend>Editar Cliente (ID:<?=$clienteData['cliente_id']?>)</legend>

                      <input type="hidden" name="cliente_id" value="<?=$clienteData['cliente_id']?>">

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">DNI</label>
                        <div class="controls">
                          <input id="dni" name="dni" type="text" value="<?=$clienteData['dni']?>" placeholder="DNI" class="input-xlarge" required="">
                          <p class="help-block">Ingrese el DNI SIN puntos.</p>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">Apellido</label>
                        <div class="controls">
                          <input id="apellido" name="apellido" type="text" value="<?=$clienteData['apellido']?>" placeholder="Apellido" class="input-xlarge" required="">
                          
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">Nombre</label>
                        <div class="controls">
                          <input id="nombre" name="nombre" type="text" value="<?=$clienteData['nombre']?>" placeholder="Nombre" class="input-xlarge" required="">
                          
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">Dirección</label>
                        <div class="controls">
                          <input id="direccion" name="direccion" type="text" value="<?=$clienteData['direccion']?>" placeholder="Dirección" class="input-xlarge">
                          
                        </div>
                      </div>

                      <!-- Select Basic -->
                      <div class="control-group">
                        <label class="control-label">Provincia</label>
                        <div class="controls">
                          <select id="provincia" name="provincia" class="input-xlarge">
                            <option <?=($clienteData['provincia'])=='Buenos Aires'?'selected=\"selected\"':''?>>Buenos Aires</option>
                            <option <?=($clienteData['provincia'])=='Catamarca'?'selected=\"selected\"':''?>>Catamarca</option>
                            <option <?=($clienteData['provincia'])=='Chaco'?'selected=\"selected\"':''?>>Chaco</option>
                            <option <?=($clienteData['provincia'])=='Chubut'?'selected=\"selected\"':''?>>Chubut</option>
                            <option <?=($clienteData['provincia'])=='Córdoba'?'selected=\"selected\"':''?>>Córdoba</option>
                            <option <?=($clienteData['provincia'])=='Corrientes'?'selected=\"selected\"':''?>>Corrientes</option>
                            <option <?=($clienteData['provincia'])=='Entre Ríos'?'selected=\"selected\"':''?>>Entre Ríos</option>
                            <option <?=($clienteData['provincia'])=='Formosa'?'selected=\"selected\"':''?>>Formosa</option>
                            <option <?=($clienteData['provincia'])=='Jujuy'?'selected=\"selected\"':''?>>Jujuy</option>
                            <option <?=($clienteData['provincia'])=='La Pampa'?'selected=\"selected\"':''?>>La Pampa</option>
                            <option <?=($clienteData['provincia'])=='La Rioja'?'selected=\"selected\"':''?>>La Rioja</option>
                            <option <?=($clienteData['provincia'])=='Mendoza'?'selected=\"selected\"':''?>>Mendoza</option>
                            <option <?=($clienteData['provincia'])=='Misiones'?'selected=\"selected\"':''?>>Misiones</option>
                            <option <?=($clienteData['provincia'])=='Neuquen'?'selected=\"selected\"':''?>>Neuquen</option>
                            <option <?=($clienteData['provincia'])=='Río Negro'?'selected=\"selected\"':''?>>Río Negro</option>
                            <option <?=($clienteData['provincia'])=='Salta'?'selected=\"selected\"':''?>>Salta</option>
                            <option <?=($clienteData['provincia'])=='San Juan'?'selected=\"selected\"':''?>>San Juan</option>
                            <option <?=($clienteData['provincia'])=='San Luis'?'selected=\"selected\"':''?>>San Luis</option>
                            <option <?=($clienteData['provincia'])=='Santa Cruz'?'selected=\"selected\"':''?>>Santa Cruz</option>
                            <option <?=($clienteData['provincia'])=='Santa Fe'?'selected=\"selected\"':''?>>Santa Fe</option>
                            <option <?=($clienteData['provincia'])=='Santiago del Estero'?'selected=\"selected\"':''?>>Santiago del Estero</option>
                            <option <?=($clienteData['provincia'])=='Tierra del Fuego'?'selected=\"selected\"':''?>>Tierra del Fuego</option>
                            <option <?=($clienteData['provincia'])=='Tucuman'?'selected=\"selected\"':''?>>Tucuman</option>
                          </select>
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">Teléfono</label>
                        <div class="controls">
                          <input id="telefono" name="telefono" type="text" value="<?=$clienteData['telefono']?>" placeholder="Teléfono particular" class="input-xlarge">
                          
                        </div>
                      </div>

                      <!-- Text input-->
                      <div class="control-group">
                        <label class="control-label">Celular</label>
                        <div class="controls">
                          <input id="celular" name="celular" type="text" value="<?=$clienteData['celular']?>" placeholder="Teléfono Celular" class="input-xlarge">
                          <p class="help-block">Por favor ingrese el código de área.</p>
                        </div>
                      </div>

                      <!-- Button (Double) -->
                      <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                          <button id="actualizar" data-loading-text="Actualizando..." class="btn btn-success">Actualizar Datos</button>
                          <a href="listadoClientes.php" class="btn btn-danger">Cancelar</a>
                        </div>
                      </div>

                      </fieldset>
                    </form>
                <?php
              }
                } else {
                  ?>
                  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Atención!</h4>
                      URL incorrecta!
                  </div>
                  <?php
                }
                break;
              case 'remove':
                if (isset($_GET['id']) && $_GET['id'] != null && $_GET['id'] != '') {
                  // Viene el ID y no está vacío
                  $clienteData = $cliente->getCliente($_GET['id']);
                  if (!$clienteData) {
                    // Si no existe cliente con ese ID muestro el mensaje de error
                    ?>
                    <div class="alert alert-error">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h4>Atención!</h4>
                      Ese cliente no existe!
                    </div>
                    <?php
                  } else {
                    header('Location: bajaCliente.php?id='.$_GET['id']);
                  }
                } else {
                  ?>
                  <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Atención!</h4>
                      URL incorrecta!
                  </div>
                  <?php
                }
                break;
              default:
                header('Location: index.php');
            }
          }
        ?>
      </div>
    </div>
    <script>
    $('#insertar').click(function() {
      $('#updateForm').submit();
    });

    $('#actualizar').click(function() {
      $('#insertForm').submit();
    });
    </script>

<?php
require_once'includes\footer.php';
?>