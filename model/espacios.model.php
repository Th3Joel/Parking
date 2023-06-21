<?php

require "db.php";

class ModelEspacios{
	public static function Mostrar($id){
		if ($id == null) {
			$t = Conexion::conectar()->
							prepare("SELECT 
											par.Id_Parqueo,
											par.NumeroParqueo AS Ubicacion,
											par.Estado AS Estado,
											cl.Nombre + ' ' + cl.Apellido AS Cliente,
											cla.TipoVehiculo,
											veh.Placa
										FROM
											parqueos par
											LEFT JOIN suscripciones sus ON par.Id_Parqueo = sus.Id_Parqueo
											LEFT JOIN vehiculos veh ON sus.Id_Vehiculo = veh.Id_Vehiculo
											LEFT JOIN clientes cl ON cl.Id_Cliente = veh.Id_Cliente
											LEFT JOIN clasificacion cla ON cla.Id_Clasificacion = veh.Id_Clasificacion");
			if ($t->execute()) {
				return $t->fetchAll(PDO::FETCH_ASSOC);//Para traer solo las claves de texto
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT * from parqueos where Id_Parqueo = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch(PDO::FETCH_ASSOC);
			}
			$g=null;
		}
		
	}

	public static function Add($n){
		$h = Conexion::conectar()->prepare("SELECT NumeroParqueo from parqueos where REPLACE(LOWER(NumeroParqueo),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$n,PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["NumeroParqueo"]);
		}else{
			$k = Conexion::conectar()->prepare("INSERT into parqueos (Estado,NumeroParqueo) values ('Libre',:nombre)");
			$k->bindParam(":nombre",$n,PDO::PARAM_STR);
			if ($k->execute()) {
				return "ok";
			}else{
				return "error";
			}
		}
		$h=null;
		$hh=null;
		$k=null;
	}
	public static function Edit($n,$id){
		$t = ModelEspacios::Mostrar($id);
		$h = Conexion::conectar()->prepare("SELECT NumeroParqueo from parqueos where REPLACE(LOWER(NumeroParqueo),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$n,PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh) && $n["nombre"] != $t["NumeroParqueo"]) {
			return array('status'=>'duplicado','name'=>$hh["NumeroParqueo"]);
		}else{
			$r = Conexion::conectar()->prepare("UPDATE parqueos SET NumeroParqueo=:nombre WHERE Id_Parqueo=:id");
			$r->bindParam(":id",$id,PDO::PARAM_INT);
			$r->bindParam(":nombre",$n,PDO::PARAM_STR);
			if ($r->execute()) {
				return "ok";
			}else{
				return "error";
			}
		}
		$t=null;
		$h=null;
		$hh=null;
		$r=null;
	}

		static public function Del($id){
				$f = Conexion::conectar()->prepare("DELETE from parqueos where Id_Parqueo = :id");
				$f->bindParam(":id",$id,PDO::PARAM_INT);
				if ($f->execute()) {
					return "ok";
				}else{
					return "error";
				}
				$f=null;
			
			$o=null;
			$oo=null;
		}

		

}