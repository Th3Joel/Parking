<?php
session_start();
require "../model/planes.model.php";
require "permiso.php";

class ControlPlanes{

	static public function Mostrar($id){
		return ModelPlanes::Mostrar($id);
	}
	static public function Add($data){ 
		$f = ModelPlanes::Add($data);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"El plan { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnAddModalPlanes").attr("disabled",false);
	 					$("#btnAddModalPlanes").html("Guardar");
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
							title: 'Plan creado correctamente'
							});
							
							$('#modalAddPlanes').modal('hide');
							$('#btnAddModalPlanes').attr('disabled',false);
	 					$('#btnAddModalPlanes').html('Guardar');
							datosTablas(1);
						

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
								
								 $('#btnAddModalPlanes').attr('disabled',false);
	 								$('#btnAddModalPlanes').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function Edit($data,$id){
		$f = ModelPlanes::Edit($data,$id);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡El Plan { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnEditModalPlanes").attr("disabled",false);
	 					$("#btnEditModalPlanes").html("Guardar");
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
							title: 'Plan editado correctamente'
							});
							
							$('#modalEditPlanes').modal('hide');
							$('#btnEditModalPlanes').attr('disabled',false);
	 					    $('#btnEditModalPlanes').html('Guardar');
							datosTablas(1);
						

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
								
								 $('#btnEditModalPlanes').attr('disabled',false);
	 								$('#btnEditModalPlanes').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function Del($id){
		$f = ModelPlanes::Del($id);
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
							title: 'Plan eliminado correctamente'
							});
									datosTablas(1);
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

class ControlTipos{
	static public function Mostrar($id){
		return ModelTipos::Mostrar($id);
	}
	static public function Add($data){ 
		$f = ModelTipos::Add($data);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"La clasificación { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnAddModalTipo").attr("disabled",false);
	 					$("#btnAddModalTipo").html("Guardar");
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
							title: 'Clasificación creada correctamente'
							});
							
							$('#btnAddModalTipo').attr('disabled',false);
	 						$('#btnAddModalTipo').html('Guardar');
							$('#modalAddTipo').modal('hide');
							datosTablas(2);
						

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
								
								 $('#btnAddModalTipo').attr('disabled',false);
	 								$('#btnAddModalTipo').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function Edit($data,$id){
		$f = ModelTipos::Edit($data,$id);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡La clasificación { '.$f["name"].' } es igual o parecido a la entrada ('.$data["nombre"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnEditModalTipo").attr("disabled",false);
	 					$("#btnEditModalTipo").html("Guardar");
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
							title: 'Clasificación editada correctamente'
							});
							
							$('#btnEditModalTipo').attr('disabled',false);
	 						$('#btnEditModalTipo').html('Guardar');
							$('#modalEditTipo').modal('hide');
							datosTablas(2);
						

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
								
								 $('#btnEditModalTipo').attr('disabled',false);
	 								$('#btnEditModalTipo').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function Del($id){
		$f = ModelTipos::Del($id);
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
							title: 'Clasificación eliminado correctamente'
							});
									datosTablas(2);
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
		case 0:
				echo json_encode(ControlPlanes::Mostrar(null));
			break;
		case 1:
				echo json_encode(ControlPlanes::Mostrar($_POST['id']));
			break;
		case 2:
				ControlPlanes::Add(array(
					"nombre" => $_POST['nombre'],
					"precio" => $_POST['precio']
				));
			break;
		case 3:
				ControlPlanes::Edit(array(
					"nombre" => $_POST['nombre'],
					"precio" => $_POST['precio']
				),$_POST['id']);
			break;
		case 4:
				ControlPlanes::Del($_POST['id']);
			break;
		case 5:
				echo json_encode(ControlTipos::Mostrar(null));
			break;
		case 6:
				echo json_encode(ControlTipos::Mostrar($_POST['id']));
			break;
		case 7:
				ControlTipos::Add(array("nombre" => $_POST['nombre']));
			break;
		case 8:
				ControlTipos::Edit(array("nombre" => $_POST['nombre']),$_POST['id']);
			break;
		case 9:
				ControlTipos::Del($_POST['id']);
			break;
		
	}
}