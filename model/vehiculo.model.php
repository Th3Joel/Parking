<?php

require "db.php";

class ModelVehiculo{
	static public function Mostrar($id){
		if ($id == null) {
			$t = Conexion::conectar()->prepare("SELECT * FROM clientes");
			if ($t->execute()) {
				return $t->fetchAll();
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT * from clientes where Id_Cliente = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch();
			}
			$g->close();
		}
	}
}