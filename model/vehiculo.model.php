<?php

require "db.php";

class ModelVehiculo{
	
	public static function Mostrar($id){
		if ($id == null) {
			$t = Conexion::conectar()->prepare("SELECT
													v.Placa,
													c.TipoVehiculo As Tipo,
													cl.Nombre,
													cl.Apellido,
													v.Marca,
													v.Modelo,
													v.Color 
												FROM
													vehiculos v
													INNER JOIN clasificacion c ON v.Id_Clasificacion = c.Id_Clasificacion
													INNER JOIN clientes cl ON v.Id_Cliente = cl.Id_Cliente
													");

			if ($t->execute()) {
				return $t->fetchAll();
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT * from vehiculos where Placa = :id");
			$g->bindParam(":id",$id,PDO::PARAM_STR);
			if ($g->execute()) {
				return $g->fetch();
			}
			$g=null;
		}
		
	}

	static public function Add($data){
		$h = Conexion::conectar()->prepare("SELECT Placa from vehiculos where REPLACE(LOWER(Placa),' ','') 
		= REPLACE(LOWER(:placa),' ','')");
		$h->bindParam(":placa",$data["placa"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["Placa"]);
		}else{
			$l = Conexion::conectar()->prepare("INSERT into vehiculos (Placa,Id_Cliente,Id_Clasificacion,Marca,Modelo,Color) 
			values (:placa,:cliente,:tipo,:marca,:modelo,:color)");

			$l->bindParam(":placa",$data["placa"],PDO::PARAM_STR);
			$l->bindParam(":cliente",$data["cliente"],PDO::PARAM_INT);
			$l->bindParam(":tipo",$data["tipo"],PDO::PARAM_INT);
			$l->bindParam(":marca",$data["marca"],PDO::PARAM_STR);
			$l->bindParam(":modelo",$data["modelo"],PDO::PARAM_STR);
			$l->bindParam(":color",$data["color"],PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l=null;
		}
		$h=null; 
		$hh=null;
	}

		
	static public function Edit($data){
		$t = ModelVehiculo::Mostrar($data["placa"]);
		$h = Conexion::conectar()->prepare("SELECT Placa from vehiculos 
		where REPLACE(LOWER(Placa),' ','') = REPLACE(LOWER(:placa),' ','')");
		$h->bindParam(":placa",$data["placa"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh) && $data["placa"] != $t["Placa"]) {
			return array('status'=>'duplicado','name'=>$hh["Placa"]);
		}else{
			$pl = $data["placa"];
			$l = Conexion::conectar()->prepare("UPDATE vehiculos 
			set 
				Placa=:placa,
				Id_Cliente=:cliente,
				Id_Clasificacion=:tipo,
				Marca=:marca,
				Modelo=:modelo,
				Color=:color 
			where Placa = '$pl'");

			//$l->bindParam(":id",$data["placa"],PDO::PARAM_STR);
			$l->bindParam(":placa",$data["placa"],PDO::PARAM_STR);
			$l->bindParam(":cliente",$data["cliente"],PDO::PARAM_INT);
			$l->bindParam(":tipo",$data["tipo"],PDO::PARAM_INT);
			$l->bindParam(":marca",$data["marca"],PDO::PARAM_STR);
			$l->bindParam(":modelo",$data["modelo"],PDO::PARAM_STR);
			$l->bindParam(":color",$data["color"],PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l=null;
		}
		$t=null;
		$h=null;
		$hh=null;
	}
	static public function Del($id){

				$f = Conexion::conectar()->prepare("DELETE from vehiculos where Placa = :id");
				$f->bindParam(":id",$id,PDO::PARAM_STR);
				if ($f->execute()) {
					return "ok";
				}else{
					return "error";
				}
			$f=null;		
			$o=null;
			$oo=null;
		}

		
	static public function clientes(){
		$y = Conexion::conectar()->prepare("SELECT Id_Cliente, Nombre, Apellido FROM clientes");
		if ($y->execute()) {
			return $y->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return "error";
		}
		$y = null;
	}

	static public function tipo(){
		$y = Conexion::conectar()->prepare("SELECT Id_Clasificacion, TipoVehiculo FROM clasificacion");
		if ($y->execute()) {
			return $y->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return "error";
		}
		$y = null;
	}
}