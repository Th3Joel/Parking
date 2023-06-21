<?php 
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 require "model/vehiculo.model.php";
 $cliente = ModelVehiculo::clientes();
 $tipo = ModelVehiculo::tipo();
 ?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/vehiculo.css">

<div class="animate__animated animate__fadeIn">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Vehiculo</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Vehiculo</li>
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
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
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
        <h4 class="modal-title">Agregar Vehiculo</h4>
      </div>
      <div class="modal-body txtModalBody">
        <div class="input-group mt-3">
            <span class="input-group-text">Placa</span>
            <input type="text" name="placa" class="form-control" required>
          </div>
          <div class="input-group mt-3"> 
            <span class="input-group-text">Cliente</span>
            <select name="cliente" id="" class="form-control">
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($cliente as $key => $value) {
                    echo "
                        <option value=".$value["Id_Cliente"].">".$value["Nombre"]." ".$value["Apellido"]."</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Clasificación</span>
            <select name="tipo" id="" class="form-control">
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($tipo as $key => $value) {
                    echo "
                        <option value=".$value["Id_Clasificacion"].">".$value["TipoVehiculo"]."</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Marca</span>
            <input type="text" name="marca" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Modelo</span>
            <input type="text" name="modelo" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Color</span>
            <input type="text" name="color" class="form-control">
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
            <span class="input-group-text">Placa</span>
            <input type="text" name="placa" id="txtPlaca" class="form-control"  required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Cliente</span>
            <select name="cliente" id="txtCliente" class="form-control">
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($cliente as $key => $value) {
                    echo "
                        <option value=".$value["Id_Cliente"].">".$value["Nombre"]." ".$value["Apellido"]."</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Clasificacion</span>
            <select name="tipo" id="txtClasificacion" class="form-control">
              <option value="">---Seleccionar---</option>
              <?php
                  foreach ($tipo as $key => $value) {
                    echo "
                        <option value=".$value["Id_Clasificacion"].">".$value["TipoVehiculo"]."</option>
                    ";
                  }
              ?>
            </select>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Marca</span>
            <input type="text" name="marca" id="txtMarca" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Modelo</span>
            <input type="text" name="modelo" id="txtModelo" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Color</span>
            <input type="text" name="color" id="txtColor" class="form-control">
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

<script type="text/javascript" src="app/vistas/js/vehiculo.js"></script>