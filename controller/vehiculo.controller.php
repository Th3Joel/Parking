<?php
session_start();
require "../model/vehiculo.model.php";
require "permiso.php";

class ControlVehiculo{

	static public function Mostrar($id){
		return ModelVehiculo::Mostrar($id);
	}
	static public function Add($data){ 
		$f = ModelVehiculo::Add($data);
		if (is_array($f)) {
			if ($f["status"] == "error") {
				echo '<script>
	                    Swal.fire({
	                      title:"Placa repetida",
	                      text:"'.$f["msj"].'",
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
							title: 'Vehículo creado correctamente'
							});
							
							$('#modalAdd').modal('hide');
							$('#btnAddModal').attr('disabled',false);
	 					$('#btnAddModalPlanes').html('Guardar');
						 datosTablas().TCar();
						

				</script>
			";
		}/*else if ($f = "error") {
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
			}*/
		
	}

	static public function Edit($data){
		$f = ModelVehiculo::Edit($data);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Placa repetida",
	                      text:"¡La placa { '.$f["name"].' } es igual o parecido a la entrada ('.$data["placa"].')!",
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
							title: 'Vehiculo editado correctamente'
							});
							
							$('#modalEdit').modal('hide');
							$('#btnEditModal').attr('disabled',false);
	 					    $('#btnEditModal').html('Guardar');
							 datosTablas().TCar();
						

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
		$f = ModelVehiculo::Del($id);
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
							title: 'Vehiculo eliminado correctamente'
							});
							datosTablas().TCar();
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
				echo json_encode(ControlVehiculo::Mostrar(null));
			break;
		case 1:
				echo json_encode(ControlVehiculo::Mostrar($_POST['placa']));
			break;
		case 2:
				ControlVehiculo::Add(array(
					"placa" => $_POST['placa'],
					"cliente" => $_POST['cliente'],
                    "tipo" => $_POST['tipo'],
                    "marca" => $_POST['marca'],
                    "modelo" => $_POST['modelo'],
                    "color" => $_POST['color']
				));
			break;
		case 3:
				ControlVehiculo::Edit(array(
					"placa" => $_POST['placa'],
					"cliente" => $_POST['cliente'],
                    "tipo" => $_POST['tipo'],
                    "marca" => $_POST['marca'],
                    "modelo" => $_POST['modelo'],
                    "color" => $_POST['color']
				));            
			break;
		case 4:
				ControlVehiculo::Del($_POST['placa']);
			break;
		
	}
}