<?php
require "../model/usuarios.model.php";
session_start();

if (isset($_POST['opcion'])) {
	if ($_POST["opcion"] == "session" && $_POST['token'] == $_SESSION['token']) {
		$datos = ModelUsuarios::InitSession(array(
			"user"=>$_POST["user"]
		)); 
		
		if (is_array($datos)) {
			if ($datos["estado"] == "Desactivado") { 
				echo 2;
				return;
			}
			
		
		
				if (password_verify($_POST['passwd'],$datos["passwd"])) {
						$_SESSION['iniciar'] = "ok";
						$_SESSION['id'] = $datos["id_user"]; 
						echo "
							<script>
							window.location.reload(); 
							</script>
						     ";
				}else{
					echo 1;
				}
		}else{
			echo 1;
		}
	}else if ($_POST['opcion'] == "0" && $_POST['token'] == $_SESSION['tokenUserAdd']) {
		require "permiso.php";
		$nombre_temporal = $_FILES['img']['tmp_name'];
		$nombre_original = $_FILES['img']['name'];
		$extension = pathinfo($nombre_original,PATHINFO_EXTENSION);
		$nombre_archivo = $_POST['user'] . '.' . $extension;
		$ubicacion = "app/vistas/img/perfil/" . $nombre_archivo;
		if (!move_uploaded_file($nombre_temporal, '../app/vistas/img/perfil/'.$nombre_archivo)) {
			$ubicacion = "app/vistas/img/perfil/avatar.png";
		}

		$dato = ModelUsuarios::AddUser(array(
			"nombre"=>$_POST['nombre'],
			"correo"=>$_POST['correo'],
			"contacto"=>$_POST['contacto'],
			"cedula"=>$_POST['cedula'],
			"user"=>$_POST['user'],
			"pass"=>password_hash($_POST["pass"],PASSWORD_BCRYPT,['cost' => 10]),
			"tipo"=>$_POST['tipo'],
			"img"=>$ubicacion
		));

		if ($dato == "ok") {
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'success',
							title: 'Datos actualizados correctamente'
							});
							
							$('#modalUser').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'users'});
								},500);
						

				</script>
			";
		}else if ($dato =="error") {
			// code...
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'error',
							title: 'Ha ocurrido un error'
							});
							$('#btnAddUser').attr('disabled',false);
							$('#btnAddUser').html('Guardar');
							

				</script>
			";
		}else if ($dato = "duplicado") {
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'error',
							title: 'Este usuario ya existe'
							});
							$('#UserAdd').attr('style','border:1px solid red;transition:1s;');
							setTimeout(function(){
								$('#UserAdd').attr('style','transition:1s;');
								},1000);
							$('#btnAddUser').attr('disabled',false);
							$('#btnAddUser').html('Guardar');

				</script>
			";
		}
	}else if ($_POST['opcion'] == 2 && $_POST['token'] == $_SESSION['tokenUserDel']) {
		require "permiso.php";
		$img = ModelUsuarios::DatosUser($_POST['id']);
		$r = ModelUsuarios::DelUser($_POST['id']);
		if ($r == "ok") {
			if ($img["img"] != 'app/vistas/img/perfil/avatar.png') {
				 unlink("../".$img["img"]);
			}
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'success',
							title: 'Usuario borrado correctamente'
							});
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'users'});
								},500);
						

				</script>
			";
		}else if ($r == "error") {
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'error',
							title: 'Ha ocurrido un error al borrar'
							});
							$('#btnElim').attr('disabled',false);
							$('#btnElim').html('Guardar');
							

				</script>
			";
		}
	}else if ($_POST['opcion'] == 3) {
		 require "permiso.php";
		echo json_encode(ModelUsuarios::DatosUser($_POST['id']));
	}else if ($_POST['opcion'] == 4 && $_POST['token'] == $_SESSION['tokenUserEdit']) {
		require "permiso.php";
		$ubicacion="";
		if ($_FILES['img']['tmp_name'] != "") {
					// code...
				
				$nombre_temporal = $_FILES['img']['tmp_name'];
				$nombre_original = $_FILES['img']['name'];
				$extension = pathinfo($nombre_original,PATHINFO_EXTENSION);
				$nombre_archivo = $_POST['user'] . '.' . $extension;
				$ubicacion = "app/vistas/img/perfil/" . $nombre_archivo;
				if (!move_uploaded_file($nombre_temporal, '../app/vistas/img/perfil/'.$nombre_archivo)) {
					$ubicacion = "app/vistas/img/perfil/avatar.png";
				}
			}else{
				$imgBin = ModelUsuarios::DatosUser($_POST['id']);
				$ubicacion = $imgBin["img"];
				$imgBin = null;
			}
         $d="";
         if ($_POST['pass'] == "") {
	         	$d = ModelUsuarios::EditUser(array(
				"id" => $_POST['id'],
				"nombre"=>$_POST['nombre'],
				"correo"=>$_POST['correo'],
				"contacto"=>$_POST['contacto'],
				"cedula"=>$_POST['cedula'],
				"user"=>$_POST['user'],
				"pass"=>1,
				"tipo"=>$_POST['tipo'],
				"img"=>$ubicacion
			));
         }else{
         	$d = ModelUsuarios::EditUser(array(
				"id" => $_POST['id'],
				"nombre"=>$_POST['nombre'],
				"correo"=>$_POST['correo'],
				"contacto"=>$_POST['contacto'],
				"cedula"=>$_POST['cedula'],
				"user"=>$_POST['user'],
				"pass"=>password_hash($_POST["pass"],PASSWORD_BCRYPT,['cost' => 10]),
				"tipo"=>$_POST['tipo'],
				"img"=>$ubicacion
			));
         }
		
		if ($d == "ok") {
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'success',
							title: 'Usuario editado correctamente'
							});
							$('#modalUserEdit').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'users'});
								},500);
						

				</script>
			";
		}else if ($d == "error") {
			echo "
				<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'error',
							title: 'Ha ocurrido un error al borrar'
							});
							$('#btnEditUser').attr('disabled',false);
							$('#btnEditUser').html('Guardar');
							

				</script>
			";
		}else if ($d = "duplicado") {
			echo "<script>
					var Toast = Swal.mixin({
						toast:true,
						position: 'top-end',
						showConfirmButton:false,
						timer:1500,
						timerProgressBar:true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter',Swal.stopTimer);
							toast.addEventListener('mouseleave',Swal.resumeTimer);
						}
						});
						Toast.fire({
							icon:'error',
							title: 'Este usuario ya existe'
							});
							$('#userEdit').attr('style','border:1px solid red;transition:1s;');
							setTimeout(function(){
								$('#userEdit').attr('style','transition:1s;');
								},1000);
							$('#btnEditUser').attr('disabled',false);
							$('#btnEditUser').html('Guardar');

				</script>";
		}
	}else if($_POST['opcion'] == 5 && $_POST['token'] == $_SESSION['tokenUserEstado']){
		require "permiso.php";
		$f = ModelUsuarios::Estado($_POST['id']);
		if ($f["estado"] == "Activado") {
		echo 1;
		}else if ($f["estado"] == "Desactivado") {
			echo 0;
		}
	}
}

