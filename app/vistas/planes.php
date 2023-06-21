<?php 
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 ?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/planes.css">

<div class="animate__animated animate__fadeIn">

	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Planes</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Planes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	</div>

  <section class="content">
      <div class="container-fluid">

        <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pajinaPlanes" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Administración</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pajinaVehiculos" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tipos de Vehículos</a>
            </li>
            <div style="margin-top: 4px;margin-left: 5px;">
              <button class="btn btn-success" op="" id="btnAdd" style="max-height: 35px;"><p style="margin-top: -2px;">Agregar</p></button>
            </div>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
            

              <div align="center">
                <div class="tablaEstilosPlanes">
                  <input type="search" id="txtBusPlanes" class="form-control" placeholder="Búsqueda">
                <table id="tablePlanes" class="table table-sm table-striped nowrap table-hover w-100">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Duracion</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="bodyPlanes">
                    
                  
                </tbody>
              </table>



            </div>
            </div>

           </div>
           <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
            
            
             <div align="center">
                <div class="tablaEstilosClasificacion">
                <input type="search" id="txtBusTipos" class="form-control" placeholder="Búsqueda">
                 <table id="tableClasificacion" class="table table-sm table-striped nowrap table-hover w-100">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Clasificación</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="bodyTipos">
                    

                </tbody>
              </table>
            </div>
            </div>
              
          
        
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>

      </div>
    </section>

  </div>


<!-- Modales para Los planes -->
<div class="modal fade" id="modalAddPlanes" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAddPlanes">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Plan</h4>
      </div>
      <div class="modal-body txtModalBody">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Precio C$</span>
            <input type="text" name="precio" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Duracion</span>
            <select name="duracion" class="form-control">
              <option value="">--Seleccionar</option>
              <option value="Diario">Diario</option>
              <option value="Semanal">Semanal</option>
              <option value="Mensual">Mensual</option>
              <option value="Anual">Anual</option>
            </select>
          </div>
        
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn btn-primary" id="btnAddModalPlanes">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditPlanes" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditPlanes">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Editar plan</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" id="txtNombre" class="form-control"  required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Precio C$</span>
            <input type="text" name="precio" id="txtPrecio" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Duracion</span>
          <select name="duracion" id="txtDuracion" class="form-control" required>
              <option value="">--Seleccionar---</option>
              <option value="Diario">Diario</option>
              <option value="Semanal">Semanal</option>
              <option value="Mensual">Mensual</option>
              <option value="Anual">Anual</option>
            </select>
          </div>
         
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" idEdit="" id="btnEditModalPlanes">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modales para la clasificacion de vehiculos -->

<div class="modal fade" id="modalAddTipo" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAddTipo">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Agregar clasificación de vehículo</h4>
      </div>
      <div class="modal-body txtModalBody">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" class="form-control" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn btn-primary" id="btnAddModalTipo">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditTipo" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditTipo">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Editar Clasificación</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" id="txtNombreTipo" class="form-control"  required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" idEdit="" id="btnEditModalTipo">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>


  <script type="text/javascript" src="app/vistas/js/planes.js"></script>