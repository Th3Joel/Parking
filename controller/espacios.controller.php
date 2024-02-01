<?php

require "../model/espacios.model.php";
require "permiso.php";
session_start();
class ControlEspacios{
	static public function Mostrar($d){
		return ModelEspacios::Mostrar($d);
	}
	static public function Add($n){
		try {
			//code...
			$f = ModelEspacios::Add($n);
		} catch (Exception $th) {
			echo $th;
		}
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"El espacio { '.$f["name"].' } es igual o parecido a la entrada ('.$n.')!",
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
							title: 'Espacio creado correctamente'
							});
							
							$('#modalAdd').modal('hide');
							$('#btnAddModal').attr('disabled',false);
	 						$('#btnAddModal').html('Guardar');
							datos();
						

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


	static public function Edit($n,$id){
		$f = ModelEspacios::Edit($n,$id);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡El espacio { '.$f["name"].' } es igual o parecido a la entrada ('.$n.')!",
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
							title: 'Espacio editado correctamente'
							});
							
							$('#modalEdit').modal('hide');
							$('#btnEditModal').attr('disabled',false);
	 						$('#btnEditModal').html('Guardar');
							datos();
						

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
		$f = ModelEspacios::Del($id);
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
							title: 'Espacio eliminado correctamente'
							});
									datos();
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

if (isset($_POST['op'])) {
	switch ($_POST['op']) {
		case '1':
				if ($_POST['token'] == $_SESSION['tokenAdd']) {
					ControlEspacios::Add($_POST['nombre']);
				}
			break;
		case '2':
				
				echo json_encode(ControlEspacios::Mostrar($_POST['id']));
				
			break;
		case '3':
				if ($_POST['token'] == $_SESSION['tokenEdit']) {
					ControlEspacios::Edit($_POST['nombre'],$_POST['id']);
				}
			break;
		case '4':
				
					ControlEspacios::Del($_POST['id']);
				
			break;
		
		default:
			echo json_encode(ControlEspacios::Mostrar(null));
			break;
	}
}