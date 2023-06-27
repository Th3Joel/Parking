<?php
//session_start();
require "../model/inspecciones.model.php";
require "permiso.php";

class ControlInspeccion{

	static public function Mostrar($id){
		return ModelInspecciones::Mostrar($id);
	}
	static public function Add($data){ 
		$f = ModelInspecciones::Add($data);
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
							title: 'Inspección creada correctamente'
							});
							
							$('#modalAdd').modal('hide');
							$('#btnAddModal').attr('disabled',false);
	 					$('#btnAddModalPlanes').html('Guardar');
						 datosTablas().Tins();
						

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

	static public function Edit($data){
		$f = ModelInspecciones::Edit($data);
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
							title: 'Inspección editada correctamente'
							});
							
							$('#modalEdit').modal('hide');
							$('#btnEditModal').attr('disabled',false);
	 					    $('#btnEditModal').html('Guardar');
							 datosTablas().Tins();
						

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
		$f = ModelInspecciones::Del($id);
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
							title: 'Inspección eliminada correctamente'
							});
							datosTablas().Tins();
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
				echo json_encode(ControlInspeccion::Mostrar(null));
			break;
		case 1:
			
				echo json_encode(ControlInspeccion::Mostrar($_POST['id']));
			break;
		case 2:
				ControlInspeccion::Add(array(
					"vehiculo" => $_POST['vehiculo'],
					"fecha" => $_POST['fecha'],
                    "hora_ingreso" => $_POST['HoraIngreso'],
                    "hora_salida" => $_POST['HoraSalida'],
                    "observaciones" => $_POST['observaciones']
				));
			break;
		case 3:
				ControlInspeccion::Edit(array(
                    "id" => $_POST['id'],
					"vehiculo" => $_POST['vehiculo'],
					"fecha" => $_POST['fecha'],
                    "hora_ingreso" => $_POST['HoraIngreso'],
                    "hora_salida" => $_POST['HoraSalida'],
                    "observaciones" => $_POST['observaciones']
				));            
			break;
		case 4:
				ControlInspeccion::Del($_POST['id']);
			break;
		
	}
}