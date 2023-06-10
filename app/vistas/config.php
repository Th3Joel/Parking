<?php
$_SESSION['tokenConfigDatosEmpresa']= bin2hex(random_bytes(64));
$_SESSION['tokenConfigPerfil'] = bin2hex(random_bytes(64));
$_SESSION['tokenConfigUser'] = bin2hex(random_bytes(64));
$_SESSION['tokenConfigPass'] = bin2hex(random_bytes(64));
require_once "model/config.model.php";
$perfil = ConfigModelo::MostrarPerfil($_SESSION['id'],5);
$empresa = ConfigModelo::MostrarEmpresa();
?>



<link rel="stylesheet" type="text/css" href="app/vistas/css/config.css">

<div class="animate__animated animate__fadeIn">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><strong>Configuración</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sistema</a></li>
              <li class="breadcrumb-item active">Configuración</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

<script type="text/javascript">
  
 var on = true;
        $('#btnEmpresa').click(function(){
          if (on == true) {
            $("#DatoImg").html('<input type="file" onchange="" name="img" id="InputImg" class="form-control animate__animated animate__rubberBand" style="width: 300px;margin-top: 13px;padding:4px;">');
            $("#DatoImg").attr("onchange",'cambiar(document.querySelector("#img"),document.querySelector("#InputImg"),"<?php echo $empresa["logo"]; ?>");');
          $("#DatoNombre").html("<input type='text'  class='form-control animate__animated animate__rubberBand' name='nombre' style='width:230px;text-align:center;' value='<?php echo $empresa["nombre"]; ?>'>");
          $('#DatoRuc').html("<input type='text' class='form-control animate__animated animate__rubberBand' name='ruc' style='width:230px;text-align:center;' value='<?php echo $empresa["ruc"]; ?>'>");
          $('#DatoDireccion').html("<input type='text' class='form-control animate__animated animate__rubberBand' name='direccion' style='width:230px;text-align:center;' value='<?php echo $empresa["direccion"]; ?>'>");
          
          $('#DatoCorreo').html("<input type='text' class='form-control animate__animated animate__rubberBand' name='correo' style='width:230px;text-align:center;' value='<?php echo $empresa["correo"]; ?>'>");
          $('#DatoContacto').html("<input type='text' class='form-control animate__animated animate__rubberBand' name='contacto' style='width:230px;text-align:center;' value='<?php echo $empresa["contacto"]; ?>'>");
          $('#DatoContacto2').html("<input type='text' class='form-control animate__animated animate__rubberBand' name='contacto2' style='width:230px;text-align:center;' value='<?php echo $empresa["contacto2"]; ?>'>");
          
          $('#btnEmpresaDisplay').html("<button class='btn btn-primary animate__animated animate__rubberBand'>Guardar</button>");
          $("#img").removeClass("animate__animated animate__lightSpeedInLeft");
          $("#btnEmpresa").html("<i class='bi bi-x-circle'></i>");
          on = false;
        }else{
          $("#img").attr("src","<?php echo $empresa['logo']; ?>");
          $("#img").addClass("animate__animated animate__lightSpeedInLeft");
          $("#DatoImg").html('');
          $("#DatoNombre").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["nombre"]; ?></div>");
          $("#DatoRuc").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["ruc"]; ?></div>");
          $("#DatoDireccion").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["direccion"]; ?></div>");
          $("#DatoCorreo").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["correo"]; ?></div>");
          $("#DatoContacto").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["contacto"]; ?></div>");
          $("#DatoContacto2").html("<div class='animate__animated animate__lightSpeedInLeft'><?php echo $empresa["contacto2"]; ?></div>");
          $("#btnEmpresaDisplay").html("");
          $("#btnEmpresa").html("<i class='bi bi-pencil-square'></i>");
          on = true;
        }
          });
</script> 

<section class="content">
  <div class="container-fluid">
   <div class="card card-primary card-outline">
     <div class="card-header">
      <div class="row align-items-center">
        <div class="col" style="min-width:400px;">
           <p class="card-title" style="font-size:25px; margin-right: 10px;">
             Datos de la empresa
           </p>
          
         </div> 
         <div class="col">
            <button class="btn btn-primary" id="btnEmpresa"><i class="bi bi-pencil-square"></i></button>
         </div>
       </div>
     </div>
     <div class="card-body">
      <form id="formEmpresa" onsubmit="empresa(); return false;">
       <div class="row align-items-center">
         
         <div class="col" align="center" style="margin-bottom: 20px;">
           <div>
            <img src="<?php echo $empresa["logo"]; ?>" width="250px" id="img">
           </div>
           <div style="width:100%;" align="center" id="DatoImg">  
             
           </div>
         </div>
         <div class="col" align="center">
         
            <input type="hidden" name="token" value="<?php echo $_SESSION['tokenConfigDatosEmpresa']; ?>">
           <h4>Nombre:</h4>
           <h5 id="DatoNombre"><?php echo $empresa["nombre"]; ?></h5>
           <h4>RUC:</h4>
           <h5 id="DatoRuc"><?php echo $empresa["ruc"]; ?></h5>
           <h4>Dirección:</h4>
           <h5 id="DatoDireccion"><?php echo $empresa["direccion"]; ?></h5>
           <h4>Correo:</h4>
           <h5 id="DatoCorreo"><?php echo $empresa["correo"]; ?></h5>
           <h4>Contacto:</h4>
           <h5 id="DatoContacto"><?php echo $empresa["contacto"]; ?></h5>
           <h4>Contacto 2</h4>
           <h5 id="DatoContacto2"><?php echo $empresa["contacto2"]; ?></h5>
           <div id="btnEmpresaDisplay"></div>
          
         </div>

       </div>
        </form>
     </div>
   </div>
  <div class="row align-items-center">
    <div class="col text-center">
     <div class="card card-secondary card-outline" style="min-width:300px;">
      <div class="card-header">
        <p class="card-title" style="font-size: 25px;margin-right: 10px;">
          Información del perfil
        </p>
      </div>
      <div class="card-body">
        <form id="formPerfil" onsubmit="perfil(); return false;">
          <div class="pb-2" align="center">
            <img src="<?php echo $perfil["img"]; ?>" style="width: 120px; border-radius: 10px;padding-bottom: 4px;" id="img2">
            <input type="file" onchange="cambiar(document.querySelector('#img2'),document.querySelector('#InputImg2'),'<?php echo $perfil["img"]; ?>');" class="form-control" name="img" id="InputImg2" style="width: 300px;padding: 4px;">
          </div>
           <input type="hidden" name="token" value="<?php echo $_SESSION['tokenConfigPerfil']; ?>">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">Nombre</span>
            <input type="text" class="form-control" value="<?php echo $perfil["nombre"]; ?>" name="nombre" aria-describedby="basic-addon3" required>
           </div>

           <div class="input-group mb-3">
             <span class="input-group-text">Cédula</span>
             <input type="text" name="cedula" class="form-control" value="<?php echo $perfil["cedula"]; ?>">
           </div>

           <div class="input-group mb-3">
             <span class="input-group-text">Contacto</span>
             <input type="text" name="contacto" class="form-control" value="<?php echo $perfil["contacto"]; ?>">
           </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon3">Correo</span>
          <input type="email" class="form-control" value="<?php echo $perfil["correo"]; ?>" name="correo" aria-describedby="basic-addon3">
        </div>

        <button class="btn btn-primary" id="btnPerfil">Guardar</button>

        </form>

      </div>   
     </div>
   </div>
   <div class="col text-center">
    <div class="card card-secondary card-outline" style="min-width:300px;">
      <div class="card-header">
        <p class="card-title" style="font-size:25px;margin-right: 10px;">
          Cambiar usuario
        </p>
      </div>
      <div class="card-body">
        <form id="formUser" onsubmit="users(); return false;">
          <input type="hidden" name="token" value="<?php echo $_SESSION['tokenConfigUser']; ?>">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">
              Usuario
            </span>
            <input type="user" name="user" class="form-control" id="userConfig" value="<?php echo $perfil["user"]; ?>" aria-describedby="basic-addon3" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">
              <i class="bi bi-key"></i>
            </span>
            <input type="password" name="pass" class="form-control" id="pass" aria-describedby="basic-addon3" required>
          </div>
          <button class="btn btn-primary" id="btnUse">Guardar</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col text-center">
    <div class="card card-secondary card-outline" style="min-width:300px;">
      <div class="card-header">
        <p class="card-title" style="font-size:25px;margin-right: 10px;">
          Cambiar contraseña
        </p>
      </div>
      <div class="card-body">
        <form id="formPasswd" onsubmit="Pass(); return false;">
          <input type="hidden" name="token" value="<?php echo $_SESSION['tokenConfigPass']; ?>">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">
              Anterior
            </span>
            <input type="password" name="passwdAnte" id="passAnte" class="form-control" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">
              Nueva
            </span>
            <input type="password" name="pass" class="form-control" required>
          </div>
          <button class="btn btn-primary" id="btnPass">Guardar</button>
        </form>
      </div>
    </div>
  </div>

  </div>

</div>
</section>

<script type="text/javascript" src="app/vistas/js/config.js"></script>
  

