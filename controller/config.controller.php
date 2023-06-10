<?php 
require "../model/config.model.php"; 
session_start();

if (isset($_POST["opcion"])) {
	if ($_POST['opcion'] == 1 && $_POST['token'] == $_SESSION['tokenConfigDatosEmpresa']) {
		$u = ConfigModelo::MostrarEmpresa();

		$nombre_temporal = $_FILES['img']['tmp_name'];
		$nombre_original = $_FILES['img']['name'];
		$extension = pathinfo($nombre_original,PATHINFO_EXTENSION);
		$nombre_archivo ='logo.' . $extension;
		$ubicacion = "app/vistas/img/" . $nombre_archivo;
		if (!move_uploaded_file($nombre_temporal, '../app/vistas/img/'.$nombre_archivo)) {

			$ubicacion = $u["logo"];
		}

		$data = ConfigModelo::UpdateEmpresa(1,array(
			"nombre"=>$_POST['nombre'],
			"ruc"=>$_POST["ruc"],
			"direccion"=>$_POST['direccion'],
			"correo"=>$_POST['correo'],
			"contacto"=>$_POST['contacto'],
			"contacto2"=>$_POST['contacto2'],
			"logo"=>$ubicacion
		));

		if($data == "ok"){
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
							title: 'Datos actualizados correctamente, Reiniciando aplicacion...'
							});
							setTimeout(function(){window.location.reload();},1300);
							

				</script>
			";
		}
	}
	else if ($_POST['opcion'] == 2 && $_POST['token'] == $_SESSION['tokenConfigPerfil']) {  
		$u = ConfigModelo::MostrarPerfil($_SESSION['id'],34);

		$nombre_temporal = $_FILES['img']['tmp_name'];
		$nombre_original = $_FILES['img']['name'];
		$extension = pathinfo($nombre_original,PATHINFO_EXTENSION);
		$nombre_archivo =$u["user"].'.' . $extension;
		$ubicacion = "app/vistas/img/perfil" . $nombre_archivo;
		if (!move_uploaded_file($nombre_temporal, '../app/vistas/img/perfil'.$nombre_archivo)) {

			$ubicacion = $u["img"];
		}

		$data = ConfigModelo::UpdateUser(array(
			"id" => $_SESSION['id'],
			"nombre" => $_POST['nombre'],
			"cedula" => $_POST['cedula'],
			"contacto" => $_POST['contacto'],
			"correo" => $_POST['correo'],
			"img"=>$ubicacion
		));
		if($data == "ok"){
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
							title: 'Datos actualizados correctamente, Reiniciando aplicacion...'
							});
							setTimeout(function(){window.location.reload();},1300);
				</script>
			";
		}else if ($data == "fail") {
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
							title: 'Ocurrió algun error'
							});
							$('#btnPerfil').attr('disabled',false);
				</script>
			";
		}
	}else if ($_POST['opcion'] == 3 && $_POST['token'] == $_SESSION['tokenConfigUser']) {
		$data = ConfigModelo::UpdatePerfil(array(
			"id"=>$_SESSION['id'],
			"user"=>$_POST['user'],
			"pass"=>$_POST['pass']
		));
		if ($data == "ok") {
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
							title: 'Datos actualizados correctamente, Vuelva a inciar sesión'
							});
							
							setTimeout(function(){
									    $('#joel').load('app.php',{ruta:'salir'});							     
								},1300);
							
				</script>
			";
		}else if ($data == "duplicado") {
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
							title: 'Hay un usuario yá registrado con este usuario'
							});
							$('#userConfig').attr('style','border:1px solid red;transition:1s;');
							setTimeout(function(){
								$('#userConfig').attr('style','transition:1s;');
								},1000);
								$('#btnUse').attr('disabled',false);
				</script>
			";
		}else if ($data == "incorrecta") {
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
							title: 'La contraseña es incorrecta'
							});
							$('#pass').attr('style','border:1px solid red;transition:1s;');
							setTimeout(function(){
								$('#pass').attr('style','transition:1s;');
								},1000);
								$('#btnUse').attr('disabled',false);
				</script>
			";
		}
	}else if($_POST['opcion'] == 4 && $_POST['token'] == $_SESSION['tokenConfigPass']){
		$joel = ConfigModelo::UpdatePass(array(
			"id"=>$_SESSION['id'],
			"passAnte"=>$_POST['passwdAnte'],
			"pass"=>$_POST['pass']
		));
		if ($joel == "ok") {
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
							title: 'Datos actualizados correctamente, Vuelva a inciar sesión'
							});
							
							setTimeout(function(){
									    $('#joel').load('app.php',{ruta:'salir'});							     
								},1300);

							
				</script>
			";
		}else if ($joel == "error") {
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
							$('#btnPass').attr('disabled',false);
				</script>
			";
		}else if ($joel == "incorrecta") {
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
							title: 'La contraseña es incorrecta'
							});
							$('#passAnte').attr('style','border:1px solid red;transition:1s;');
							setTimeout(function(){
								$('#passAnte').attr('style','transition:1s;');
								},1000);
								$('#btnPass').attr('disabled',false);
				</script>
			";
		}
	}
}