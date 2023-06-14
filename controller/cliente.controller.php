<?php 
require "../model/cliente.model.php";
require "permiso.php";
session_start();
class ControlCliente{
	static public function Mostrar($id){
		return ModelCliente::Mostrar($id);
	}
	static public function Add($data){ 
		$f = ModelCliente::Add($data);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"El cliente { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnAddModal").attr("disabled",false);
	 					$("#btnAddModal").html("Guardar");
				</script>';
		}
	}else if ($f == "ok") {
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
							title: 'Cliente creado correctamente'
							});
							
							$('#modalAdd').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'clientes'});
								},500);
						

				</script>
			";
		}else if ($f = "error") {
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
								title: 'Ha ocurrido un erro'
								});
								
								 $('#btnAddModal').attr('disabled',false);
	 								$('#btnAddModal').html('Guardar');
							

					</script>
				";
			}
		
	}


	static public function Edit($data,$id){
		$f = ModelCliente::Edit($data,$id);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡El Cliente { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnEditModal").attr("disabled",false);
	 					$("#btnEditModal").html("Guardar");
				</script>';
		}
	}else if ($f == "ok") {
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
							title: 'Cliente editado correctamente'
							});
							
							$('#modalEdit').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'clientes'});
								},500);
						

				</script>
			";
		}else if ($f = "error") {
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
								title: 'Ha ocurrido un erro'
								});
								
								 $('#btnEditModal').attr('disabled',false);
	 								$('#btnEditModal').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function Del($id){
		$f = ModelCliente::Del($id);
		 if ($f == "ok") {
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
							title: 'Cliente eliminado correctamente'
							});
									setTimeout(function(){
									$('#app').load('app.php',{ruta:'clientes'});
								},500);
				</script>

			";
		}else if ($f = "error") {
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
								title: 'Ha ocurrido un erro'
								});

					</script>
				";
			}
	}

}

if (isset($_POST['op'])){
	if ($_POST['op'] == 1 && $_POST['token'] == $_SESSION['tokenAdd']) {
		ControlCliente::Add(array(
			"nombre" =>$_POST['nombre'],
			"apellido" => $_POST['apellido'],
			"direccion" =>$_POST['direccion'],
			"telefono"=>$_POST['telefono'],
			"correo"=>$_POST['correo']
		));
		
	}
	else if ($_POST['op'] == 2) {
		echo json_encode(ControlCliente::Mostrar($_POST['id']));
	}else if($_POST['op'] == 3 && $_POST['token'] == $_SESSION['tokenEdit']){

		ControlCliente::Edit(array(
			"nombre" =>$_POST['nombre'],
			"apellido" => $_POST['apellido'],
			"direccion" =>$_POST['direccion'],
			"telefono"=>$_POST['telefono'],
			"correo"=>$_POST['correo']
		),$_POST['id']);

	}else if ($_POST['op'] == 4 && $_POST['token'] == $_SESSION['tokenDel']) {
		ControlCliente::Del($_POST['id']);
	}
}