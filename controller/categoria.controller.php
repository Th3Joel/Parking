<?php 
require "../model/categoria.model.php";
session_start();
class ControlCate{
	static public function Mostrar($id){
		return ModeloCategoria::Mostrar($id);
	}
	static public function AddCate($nm){
		$f = ModeloCategoria::Add($nm);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡La categoría { '.$f["name"].' } es igual o parecido a la entrada ('.$nm.')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnAddCate").attr("disabled",false);
	 					$("#btnAddCate").html("Guardar");
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
							title: 'Categoría creada correctamente'
							});
							
							$('#modalAddCate').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'categoria'});
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
								
								 $('#btnAddCate').attr('disabled',false);
	 								$('#btnAddCate').html('Guardar');
							

					</script>
				";
			}
		
	}


	static public function EditCate($nm,$id){
		$f = ModeloCategoria::Edit($nm,$id);
		if (is_array($f)) {
			if ($f["status"] == "duplicado") {
				echo '<script>
	                    Swal.fire({
	                      title:"Nombre repetido",
	                      text:"¡La categoría { '.$f["name"].' } es igual o parecido a la entrada ('.$nm.')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
	                    $("#btnEditCate").attr("disabled",false);
	 					$("#btnEditCate").html("Guardar");
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
							title: 'Categoría creada correctamente'
							});
							
							$('#modalEditCate').modal('hide');
							setTimeout(function(){
									$('#app').load('app.php',{ruta:'categoria'});
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
								
								 $('#btnEditCate').attr('disabled',false);
	 								$('#btnEditCate').html('Guardar');
							

					</script>
				";
			}
		
	}

	static public function DelCate($id){
		$f = ModeloCategoria::Del($id);
		if (is_array($f)) {
			if ($f["error"] == "ok") {
				echo '<script>
	                    Swal.fire({
	                      title:"Categoría en uso",
	                      text:"¡Esta categoría { '.$f["categoria"].' } está en uso por el producto ('.$f["producto"].')!",
	                      icon:"error",
	                      confirmButtonText:"¡Cerrar!"
	                    });
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
							title: 'Categoría eliminada correctamente'
							});
									setTimeout(function(){
									$('#app').load('app.php',{ruta:'categoria'});
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
		$j = $_POST['categoría'];
		ControlCate::AddCate($j);
		$j=null;
	}
	else if ($_POST['op'] == 2) {
		echo json_encode(ControlCate::Mostrar($_POST['id']));
	}else if($_POST['op'] == 3 && $_POST['token'] == $_SESSION['tokenEdit']){

		ControlCate::EditCate($_POST['categoría'],$_POST['id']);
	}else if ($_POST['op'] == 4 && $_POST['token'] == $_SESSION['tokenDel']) {
		ControlCate::DelCate($_POST['id']);
	}
}