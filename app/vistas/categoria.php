<?php 
 include "model/categoria.model.php";
 $_SESSION['tokenDel'] = bin2hex(random_bytes(64));
 $_SESSION['tokenAdd']= bin2hex(random_bytes(64));
 $_SESSION['tokenEdit'] = bin2hex(random_bytes(64));
 $categoria = ModeloCategoria::Mostrar(null);
 ?>
<link rel="stylesheet" type="text/css" href="app/vistas/css/categoria.css">
<div class="animate__animated animate__fadeIn">
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Categorías</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item">Productos</li>
              <li class="breadcrumb-item active">Categorías</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	</div>
	 <section class="content">
		  <div class="container-fluid">
		  	 <div class="card card-primary card-outline">
          <div class="card-header">
            <p class="card-title" style="font-size:25px;">
              <button class="btn btn-success rounded" id="AddCate">Agregar</button>
            </p>
          </div>
          <div class="card-body">
            <div style="padding:20px;">
              <table id="tableCate" class="table table-sm table-bordered table-hover" style="width:100%;border-radius: 20px;border: 1px solid blueviolet;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
                    foreach ($categoria as $key => $value) {
                      echo "<tr>
                      			<td class='align-middle' style='width:30px;'>".($key+1)."</td>
                      			<td class='align-middle'>".$value["nombre"]."</td>
                      			<td class='align-middle' style='width:90px;'>
                                  <button class='btn btn-primary' id='btnEdit' idEdit='".$value["id_categoria"]."'><i class='bi bi-pen'></i></button>
                                  <button class='btn btn-danger' token='".$_SESSION['tokenDel']."' id='btnElim' idElim='".$value["id_categoria"]."'><i class='bi bi-trash'></i></button>
                                </td>
                          </tr>
                      ";
                    }
                  ?>
              
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>

                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
		  </div>
	 </section>
</div>

<div class="modal fade" id="modalAddCate" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAdd" onsubmit="addCate(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Agregar categoría</h4>
      </div>
      <div class="modal-body">
      	<div class="input-group mt-3">
            <span class="input-group-text"><i class="bi bi-activity"></i></span>
            <input type="text" name="categoría" class="form-control" placeholder="Ingrese la categoría" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn btn-primary" id="btnAddCate">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEditCate" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEdit" onsubmit="EditCate(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenEdit']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Editar categoría</h4>
      </div>
      <div class="modal-body">
      	<div class="input-group mt-3">
            <span class="input-group-text"><i class="bi bi-activity"></i></span>
            <input type="text" name="categoría" class="form-control" id="categoria" placeholder="Ingrese la categoría" required>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" idEdit="" id="btnEditCate">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="app/vistas/js/categoria.js"></script>