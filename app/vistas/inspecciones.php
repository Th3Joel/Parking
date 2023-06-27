<?php 
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 require "model/inspecciones.model.php";
$vehiculos = ModelInspecciones::vehiculo();
 ?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/vehiculo.css">

<div class="animate__animated animate__fadeIn">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Inspecciones</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">inspecciones</li>
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
                    <th>Placa</th>
                    <th>Cliente</th>
                    <th>Clasificación</th>
                    <th>Fecha</th>
                    <th>Hora Ingreso</th>
                    <th>Hora Salida</th>
                    <th>Observaciones</th>
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
        <h4 class="modal-title">Agregar Inspección</h4>
      </div>
      <div class="modal-body txtModalBody">
          <div class="input-group mt-3"> 
            <span class="input-group-text">Vehiculo</span>
            <select name="vehiculo" id="" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($vehiculos as $key => $value) {
                    echo "
                        <option value=".$value["Id_Vehiculo"].">".$value["cliente"]." ( ".$value["clasificacion"]." | ".$value["Placa"]." )</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Fecha</span>
            <input type="date" name="fecha" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Hora Ingreso</span>
            <input type="time" name="HoraIngreso" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Hora Salida</span>
            <input type="time" name="HoraSalida" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Observaciones</span>
            <input type="text" name="observaciones" class="form-control">
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
        <h4 class="modal-title">Editar Vehiculo</h4>
      </div>
      <div class="modal-body">
      <div class="input-group mt-3"> 
            <span class="input-group-text">Vehiculo</span>
            <select name="vehiculo" id="txtVehiculo" class="form-control" required>
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($vehiculos as $key => $value) {
                    echo "
                        <option value=".$value["Id_Vehiculo"].">".$value["cliente"]."( ".$value["clasificacion"]." | ".$value["Placa"]." )</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Fecha</span>
            <input type="date" name="fecha" id="txtFecha" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Hora Ingreso</span>
            <input type="time" name="HoraIngreso" id="txtHoraIngreso" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Hora Salida</span>
            <input type="time" name="HoraSalida" id="txtHoraSalida" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Observaciones</span>
            <input type="text" name="observaciones" id="txtObservaciones" class="form-control">
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

<script type="text/javascript" src="app/vistas/js/inspeccion.js"></script>