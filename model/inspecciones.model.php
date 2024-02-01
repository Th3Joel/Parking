<?php

require "db.php";

class ModelInspecciones{
	public static function Mostrar($id){ 
		if ($id == null) {
			$t = Conexion::conectar()->prepare("SELECT 
			CONCAT(cli.Nombre,' ',cli.Apellido) AS cliente,
			ins.Id_Inspeccion,
			ins.Fecha,
			ins.Hora_Ingreso,
			ins.Hora_Salida,
			ins.Observaciones,
			cla.TipoVehiculo AS clasificacion,
			veh.Placa,
			ins.Id_Vehiculo
			
			FROM
			inspeccion_parqueo ins 
			INNER JOIN vehiculos veh ON veh.Id_Vehiculo = ins.Id_Vehiculo
			INNER JOIN clientes cli ON cli.Id_Cliente = veh.Id_Cliente
			INNER JOIN clasificacion cla ON cla.Id_Clasificacion = veh.Id_Clasificacion");
			if ($t->execute()) {
				return $t->fetchAll(PDO::FETCH_ASSOC);
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT 
			CONCAT(cli.Nombre,' ',cli.Apellido) AS cliente,
			ins.Id_Inspeccion,
			ins.Fecha,
			ins.Hora_Ingreso,
			ins.Hora_Salida,
			ins.Observaciones,
			cla.TipoVehiculo AS clasificacion,
			veh.Placa,
			ins.Id_Vehiculo
			
			FROM
			inspeccion_parqueo ins 
			INNER JOIN vehiculos veh ON veh.Id_Vehiculo = ins.Id_Vehiculo
			INNER JOIN clientes cli ON cli.Id_Cliente = veh.Id_Cliente
			INNER JOIN clasificacion cla ON cla.Id_Clasificacion = veh.Id_Clasificacion
			where ins.Id_Inspeccion = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch(PDO::FETCH_ASSOC);
			}
			$g=null;
		}
		
	}

	static public function Add($data){
		
			$l = Conexion::conectar()->prepare("INSERT into inspeccion_parqueo (Id_Vehiculo,Fecha,Hora_Ingreso,Hora_Salida,Observaciones)
			 values (:vehiculo,:fecha,:hora_ingreso,:hora_salida,:observaciones)");
             $l->bindParam(":vehiculo",$data["vehiculo"],PDO::PARAM_INT);
             $l->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
             $l->bindParam(":hora_ingreso",$data["hora_ingreso"],PDO::PARAM_STR);
             $l->bindParam(":hora_salida",$data["hora_salida"],PDO::PARAM_STR);
             $l->bindParam(":observaciones",$data["observaciones"],PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l=null;
	}
	static public function Edit($data){
		
			$l = Conexion::conectar()->prepare("UPDATE inspeccion_parqueo 
			set Id_Vehiculo=:vehiculo,Fecha=:fecha,Hora_Ingreso=:hora_ingreso,Hora_Salida=:hora_salida,Observaciones=:observaciones where Id_Inspeccion = :id");
             $l->bindParam(":vehiculo",$data["vehiculo"],PDO::PARAM_INT);
             $l->bindParam(":fecha",$data["fecha"],PDO::PARAM_STR);
             $l->bindParam(":hora_ingreso",$data["hora_ingreso"],PDO::PARAM_STR);
             $l->bindParam(":hora_salida",$data["hora_salida"],PDO::PARAM_STR);
             $l->bindParam(":observaciones",$data["observaciones"],PDO::PARAM_STR);
             $l->bindParam(":id",$data["id"],PDO::PARAM_INT);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l=null;
		
	}
	static public function Del($id){
				$f = Conexion::conectar()->prepare("DELETE from inspeccion_parqueo where Id_Inspeccion = :id");
				$f->bindParam(":id",$id,PDO::PARAM_INT);
				if ($f->execute()) {
					return "ok";
				}else{
					return "error";
				}
				$f=null;
			
			
		}
	static public function vehiculo(){
		$t = Conexion::conectar()->prepare("SELECT
									veh.Id_Vehiculo,
									cla.TipoVehiculo AS clasificacion,
									veh.Placa,
									CONCAT(cli.Nombre ,' ' ,cli.Apellido) As cliente
								from 
								vehiculos veh 
								INNER JOIN clientes cli ON cli.Id_Cliente = veh.Id_Cliente
								INNER JOIN clasificacion cla ON cla.Id_Clasificacion = veh.Id_Clasificacion");
		if ($t->execute()) {
			return $t->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return "error";
		}
		$t=null;
	}
	
}

