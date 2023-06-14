<?php 
 include "model/cliente.model.php";
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 $clientes = ModelCliente::Mostrar(null);
 ?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/clientes.css">

<div class="animate__animated animate__fadeIn">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Clientes</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	</div>

  <section class="content">
      <div class="container-fluid">
         <div class="card card-primary card-outline">
          <div class="card-header ">
            <p class="card-title" style="font-size:25px;">
              <button class="btn btn-success rounded" id="btnAdd">Agregar</button>
            </p>
          </div>
          <div class="card-body">
            <div style="padding:20px;">
              <table id="tableClientes" class="table table-sm table-bordered table-hover" style="width:100%;border-radius: 20px;border: 1px solid blueviolet;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    foreach ($clientes as $key => $value) {
                      echo "<tr>
                            <td class='align-middle' style='width:30px;'>".($key+1)."</td>
                            <td class='align-middle'>".$value["Nombre"]."</td>
                            <td class='align-middle'>".$value["Apellido"]."</td>
                            <td class='align-middle'>".$value["Correo"]."</td>
                            <td class='align-middle'>".$value["Telefono"]."</td>
                            <td class='align-middle'>".$value["Direccion"]."</td>
                            <td class='align-middle' style='width:90px;'>
                                  <button class='btn btn-primary' id='btnEdit' idEdit='".$value["Id_Cliente"]."'><i class='bi bi-pen'></i></button>
                                  <button class='btn btn-danger' token='".$_SESSION['tokenDel']."' id='btnElim' idElim='".$value["Id_Cliente"]."'><i class='bi bi-trash'></i></button>
                                </td>
                          </tr>
                      ";
                    }
                  ?>
              
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
      <form id="formAdd" onsubmit="add(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body txtModalBody">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Apellido</span>
            <input type="text" name="apellido" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Dirección</span>
            <input type="text" name="direccion" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Teléfono</span>
            <input type="text" name="telefono" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Correo Electrónico</span>
            <input type="email" name="correo" class="form-control">
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
        <h4 class="modal-title">Editar cliente</h4>
      </div>
      <div class="modal-body">
        <div class="input-group mt-3">
            <span class="input-group-text">Nombre</span>
            <input type="text" name="nombre" id="txtNombre" class="form-control"  required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Apellido</span>
            <input type="text" name="apellido" id="txtApellido" class="form-control" required>
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Direccion</span>
            <input type="text" name="direccion" id="txtDireccion" class="form-control" >
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Teléfono</span>
            <input type="text" name="telefono" id="txtTelefono" class="form-control">
          </div>
          <div class="input-group mt-3">
            <span class="input-group-text">Correo</span>
            <input type="email" name="correo" id="txtCorreo" class="form-control">
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

<script type="text/javascript" src="app/vistas/js/clientes.js"></script>