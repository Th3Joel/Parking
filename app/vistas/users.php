 <?php
 $_SESSION['tokenUserAdd'] = bin2hex(random_bytes(64));
require_once "model/config.model.php";
$perfil=ConfigModelo::MostrarPerfil($_SESSION['id'],1);
$_SESSION['tokenUserDel'] = bin2hex(random_bytes(64));
$_SESSION['tokenUserEdit'] = bin2hex(random_bytes(64));
$_SESSION['tokenUserEstado'] = bin2hex(random_bytes(64));
 ?>

<link rel="stylesheet" type="text/css" href="app/vistas/css/user.css">

 <div class="animate__animated animate__fadeIn">
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Usuarios</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
 </div>


 <section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div  class="card-header">
        <p class="card-title" style="font-size:25px;">
          <button class="btn btn-success rounded" data-toggle="modal"  data-target="#modalUser">Agregar</button>
        </p>
        
      </div>
      <div class="card-body">
        <div style="padding:20px;">
          <table id="tableUser" class="table table-sm table-bordered table-hover" style="width:100%;border-radius: 20px;border:1px solid blueviolet;">
            <input type="hidden" id="tokenEstado" value="<?php echo $_SESSION['tokenUserEstado']; ?>">
        <thead>
            <tr>
              <th>#</th>
                <th>Imajen</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Cédula</th>
                <th>Contacto</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
         
            <?php
              foreach ($perfil as $key => $value) {
                echo "
                  <tr>
                  <td class='align-middle'>".($key+1)."</td>
                    <td class='align-middle'><img src='".$value["img"]."' style='width:40px;border-radius:8px;'></td>
                    <td class='align-middle'>".$value["nombre"]."</td>
                    <td class='align-middle'>".$value["correo"]."</td>
                    <td class='align-middle'>".$value["usuario"]."</td>
                    <td class='align-middle'>".$value["cedula"]."</td>
                    <td class='align-middle'>".$value["contacto"]."</td>
                    <td class='align-middle'>".$value["tipo"]."</td>
                    <td class='align-middle' id='estado'>
                    ";
                    if ($value["estado"] == "Activado") {
                       echo "
                          <button class='btn btn-success' id='btnEstado' status='1' idUser=".$value["id_user"].">Activado</button>
                      ";
                    }else if($value["estado"] == "Desactivado"){
                      echo "
                         <button class='btn btn-danger' id='btnEstado' status='0' idUser=".$value["id_user"].">Desactivado</button>
                      ";
                    }
                   
                    echo "
                    </td>
                    <td class='align-middle' style='min-width:90px;'>
                    <button class='btn btn-primary' id='btnEdit' idUser=".$value["id_user"]."><i class='bi bi-pen'></i></button>
                    <button class='btn btn-danger' token=".$_SESSION['tokenUserDel']." id='btnElim' idUser=".$value["id_user"]."><i class='bi bi-trash'></i></button>
                    </td>
                  </tr>
                ";
              }
            ?>
            
        </tbody>
        <tfoot>
            <tr>
              <th>#</th>
                <th>Imajen</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Cédula</th>
                <th>Contacto</th>
                <th>Tipo</th>
                <th>Estado</th>
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



<!-- Agregar Usuario -->
<div class="modal fade" id="modalUser" role='dialog' data-backdrop='static'>
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formUsuario" onsubmit="AddUsuario(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenUserAdd']; ?>">
      <div class="modal-header">
        <h4 class="modal-title">Crear un usuario</h4>
      </div>
      <div class="modal-body">
        <div style="width:100%;">
          <div class="row justify-content-center">
            <img src="app/vistas/img/perfil/avatar.png" id="img" width="90px">
          </div>
          <div class="row justify-content-center">
            <div class="mt-2">
            <input type="file" name="img" id="InputImg" onchange="cambiar(document.querySelector('#img'),document.querySelector('#InputImg'),'app/vistas/img/perfil/avatar.png');" class="form-control" style="width:300px;padding: 4px;">
            </div>
          </div>

          <div class="row" style="margin-top:15px;padding-right: 50px;padding-left: 50px;">
               <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Nombre</span>
                <input type="text" class="form-control" name="nombre" required>
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Correo</span>
                <input type="email" class="form-control" name="correo">
               </div>
               <div class="input-group mb-3">
                 <span class="input-group-text">Contacto</span>
                 <input type="text" name="contacto" class="form-control">
               </div>
               <div class="input-group mb-3">
                 <span class="input-group-text">Cédula</span>
                 <input type="text" name="cedula" class="form-control">
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text">Usuario</span>
                <input type="user" class="form-control" name="user" required>
               </div>
               <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Contraseña</span>
                <input type="password" class="form-control" name="pass" required>
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">Tipo de cuenta</span>
                <select class="form-control text-center" name="tipo" required>
                  <option value="">--------Selecione--------</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Registrador">Registrador</option>
                </select>
               </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn btn-primary" id="btnAddUser">Guardar</button>
      </div>
      </form>
    </div>
  </div>

</div>

<!--Modal editar-->

<div class="modal fade" id="modalUserEdit" role='dialog' data-backdrop='static'>
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formUserEdit" onsubmit="EditUser(); return false;">
        <input type="hidden" name="token" value="<?php echo $_SESSION['tokenUserEdit']; ?>">
        <input type="hidden" name="id" value="" id="idEdit">
      <div class="modal-header">
        <h4 class="modal-title">Editar usuario</h4>
      </div>
      <div class="modal-body">
        <div style="width:100%;">
          <div class="row justify-content-center">
            <img src="" im="" id="img2" width="90px">
          </div>
          <div class="row justify-content-center">
            <div class="mt-2">
            <input type="file" name="img" id="InputImg2" onchange="cambiar(document.querySelector('#img2'),document.querySelector('#InputImg2'),$('#img2').attr('im'));" class="form-control" style="width:300px;padding: 4px;">
            </div>
          </div>

          <div class="row" style="margin-top:15px;padding-right: 50px;padding-left: 50px;">
               <div class="input-group mb-3">
                <span class="input-group-text">Nombre</span>
                <input type="text" class="form-control" name="nombre" id="nombreEdit" required>
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text">Correo</span>
                <input type="email" class="form-control" name="correo" id="correoEdit">
               </div>
               <div class="input-group mb-3">
                 <span class="input-group-text">Contacto</span>
                 <input type="text" name="contacto" class="form-control" id="contactoEdit">
               </div>
               <div class="input-group mb-3">
                 <span class="input-group-text">Cédula</span>
                 <input type="text" name="cedula"  class="form-control" id="cedulaEdit">
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text">Usuario</span>
                <input type="user" class="form-control" name="user" id="userEdit" required>
               </div>
               <div class="input-group mb-3">
                <span class="input-group-text">Nueva Contraseña</span>
                <input type="password" class="form-control" name="pass">
               </div>
                <div class="input-group mb-3">
                <span class="input-group-text">Tipo de cuenta</span>
                <select class="form-control text-center" name="tipo" required id="tipoEdit">
                  <option value="">--------Selecione--------</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Registrador">Registrador</option>
                </select>
               </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button class="btn btn btn-primary" id="btnEditUser">Guardar</button>
      </div>
      </form>
    </div>
  </div>

</div>


 <script  type="text/javascript" src="app/vistas/js/users.js"></script>
