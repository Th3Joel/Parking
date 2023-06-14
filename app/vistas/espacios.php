<?php 
 include "model/espacios.model.php";
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 $espacios = ModelEspacios::Mostrar(null);
 ?>
<link rel="stylesheet" type="text/css" href="app/vistas/css/espacios.css">
 <div class="animate__animated animate__fadeIn">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Espacios</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Espacios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
         <div class="card card-primary card-outline">
          <div class="card-header ">
            <div class="card-title w-100">
                <div class="row" style="font-size:25px;margin-bottom: -10px;">
                    <div class="col">
                     <button class="btn btn-success rounded" id="btnAdd">Agregar</button>
                    </div>
                    <div class="col d-flex justify-content-end">
                       <input type="search" class="form-control" id="txtBuscar" placeholder="Buscar" name=""> 
                    </div>
                </div>
            </div>
          </div>
          <div class="card-body">
            <div class="container text-center">
              <div class="row justify-content-center tarjetas">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<div class="modal fade" id="modalAdd" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAdd" onsubmit="add(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Espacio</h4>
      </div>
      <div class="modal-body txtModalBody">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" class="form-control" required>
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
      <form id="formEdit" onsubmit="Edit(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Editar espacio</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" id="txtNombre" class="form-control"  required>
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



<script type="text/javascript" src="app/vistas/js/espacios.js"></script>