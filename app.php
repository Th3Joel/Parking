<?php
session_start();
if (isset($_SESSION['iniciar']) && $_SESSION['iniciar'] == "ok") {
	if (isset($_POST['ruta'])) {
		ob_start();
		include "app/vistas/".$_POST['ruta'].".php";
		echo ob_get_clean();
	}
	else{
		ob_start();
		include "app/plantilla.php";
		echo ob_get_clean();
	}
}else{
	ob_start();
	include "app/vistas/login.php";
	echo ob_get_clean();
}

