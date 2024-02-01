<?php
$_SESSION['tokenDel'] = bin2hex(random_bytes(64));
$_SESSION['tokenAdd'] = bin2hex(random_bytes(64));
$_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
require "model/suscripciones.model.php";
$vehiculos = ModelSuscripciones::vehiculos(null);
$planes = ModelSuscripciones::planes(null);
$parqueos = ModelSuscripciones::parqueos();

?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/suscripcion.css">

<div class="animate__animated animate__fadeIn">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><strong>Suscripciones</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Sistema</a></li>
            <li class="breadcrumb-item active">Suscripciones</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-header ">

          <div class="title busqueda">
            <button class="btn btn-success rounded" id="btnAdd">Agregar</button>
            <input type="search" class="form-control" id="txtSearch" placeholder="Buscar">
          </div>

        </div>
        <div class="card-body">
          <div class="cuerpoTabla">
            <table id="tableVehiculos" class="table table-sm table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Vehiculo</th>
                  <th>Plan de Suscripción</th>
                  <th>Parqueo</th>
                  <th>Vencimiento</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<div class="modal fade" id="modalAdd" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAdd" onsubmit="formAdd(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Suscripcion</h4>
        </div>
        <div class="modal-body txtModalBody">

          <div class="input-group mt-3">
            <span class="input-group-text">Clientes</span>
            <select name="vehiculo" id="" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
              foreach ($vehiculos as $key => $value) {
                echo "
                    <option value=" . $value["Id_Vehiculo"] . ">" . $value["Cliente"] . " (" . $value["Marca"] . "-" . $value["Placa"] . ")" . "</option>
                      ";
              }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Planes</span>
            <select name="plan" id="" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
              foreach ($planes as $key => $value) {
                echo "
                        <option value=" . $value["Id_Planes"] . ">" . $value["NombrePlan"] . " (" . $value["Duracion"] . " C$" . $value["PrecioPlan"] . ")" . "</option>
                    ";
              }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Cantidad de tiempo</span>
            <input type="number" name="cantidad" id="" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Parqueos</span>
            <select name="parqueo" id="opSel" class="form-control" required>

            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button class="btn btn btn-primary" id="btnAddModal">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEdit" onsubmit="formEdit(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
        <div class="modal-header">
          <h4 class="modal-title">Editar Suscripcion</h4>
        </div>
        <div class="modal-body">
          <div class="input-group mt-3">
            <span class="input-group-text">Clientes</span>
            <select name="vehiculo" id="txtVehiculo" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
              foreach ($vehiculos as $key => $value) {
                echo "
                    <option value=" . $value["Id_Vehiculo"] . ">" . $value["Cliente"] . " (" . $value["Marca"] . "-" . $value["Placa"] . ")" . "</option>
                    ";
              }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Planes</span>
            <select name="plan" id="txtTipo" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
              foreach ($planes as $key => $value) {
                echo "
                <option value=" . $value["Id_Planes"] . ">" . $value["NombrePlan"] . " (" . $value["Duracion"] . " C$" . $value["PrecioPlan"] . ")" . "</option>
                ";
              }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Cantidad de tiempo</span>
            <input type="number" name="cantidad" id="txtCantidad" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Parqueos</span>
            <select name="parqueo" id="txtParqueo" class="form-control" placeholder="Cambia a espacio libre">

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" idEdit="" id="btnEditModal">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="modalDetalle" role="dialog" data-backdrop="static">
  <div class="modal-dialog" style="max-width: 800px;">
    <div class="modal-content">
      <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
      <div class="modal-header">
        <h4 class="modal-title" style="display: flex;width:100%;">Detalle Suscripcion <div id="EstadoSuscripcion"
            align="right" style="width: 70%;"></div>
        </h4>
      </div>
      <div class="modal-body">
        <div id="detalle">
          <div class="row">
            <div class="col">
              <div class="input-group mt-3">
                <span class="input-group-text">Registrado por</span>
                <input type="text" id="usuario" class="form-control" readonly>
              </div>

              <div class="input-group mt-3">
                <span class="input-group-text">Cliente</span>
                <input type="text" id="cliente" class="form-control" readonly>
              </div>

              <div class="input-group mt-3">
                <span class="input-group-text">Parqueo</span>
                <input type="text" id="parqueo" class="form-control" readonly>
              </div>
              <div class="input-group mt-3">
                <span class="input-group-text">Plan</span>
                <input type="text" id="txtplan" class="form-control" readonly>
              </div>
              <div class="input-group mt-3">
                <span class="input-group-text">Facturacion</span>
                <input type="text" id="facturacion" class="form-control" readonly>
              </div>

              <div class="input-group mt-3">
                <span class="input-group-text">Duracion</span>
                <input type="text" id="duracion" class="form-control" readonly>
              </div>

              <div class="input-group mt-3">
                <span class="input-group-text">Fecha de inicio</span>
                <input type="text" id="DateInicio" class="form-control" readonly>
              </div>

              <div class="input-group mt-3">
                <span class="input-group-text">Vencimiento</span>
                <input type="text" id="vencimiento" class="form-control" readonly>
              </div>
            </div>
            <div class="col">
              <h3>Facturación</h3>
              <div class="facturaDetalle">
                <table id="tablaFactura" class="table table-sm table-bordered table-hover">
                  <thead>
                    <th id="Encabezado"></th>
                    <th>Fecha</th>
                    <th>Deuda</th>
                    <th>Subtotal</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>

            </div>
          </div>



        </div>
      </div>
      <div class="modal-footer">

        <button class="btn btn-primary" idEdit="" id="btnDetalleModal" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="app/vistas/js/suscripciones.js"></script>