<?php

require "db.php";

class ModelPlanes{
	public static function Mostrar($id){ 
		if ($id == null) {
			$t = Conexion::conectar()->prepare("SELECT * FROM planes_suscripcion");
			if ($t->execute()) {
				return $t->fetchAll(PDO::FETCH_ASSOC);
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT * from planes_suscripcion where Id_Planes = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch(PDO::FETCH_ASSOC);
			}
			$g=null;
		}
		
	}

	static public function Add($data){
		$h = Conexion::conectar()->prepare("SELECT NombrePlan from planes_suscripcion where REPLACE(LOWER(NombrePlan),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch(PDO::FETCH_ASSOC);
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["NombrePlan"]);
		}else{
			$l = Conexion::conectar()->prepare("INSERT into planes_suscripcion (NombrePlan,PrecioPlan,Duracion)
			 values (:nombre,:precio,:duracion)");
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$l->bindParam(":precio",$data["precio"],PDO::PARAM_INT);
			$l->bindParam(":duracion",$data["duracion"],PDO::PARAM_STR);
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
	static public function Edit($data,$id){
		$t = ModelPlanes::Mostrar($id);
		$h = Conexion::conectar()->prepare("SELECT NombrePlan from planes_suscripcion where REPLACE(LOWER(NombrePlan),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch(PDO::FETCH_ASSOC);
		if (is_array($hh) && $data["nombre"] != $t["NombrePlan"]) {
			return array('status'=>'duplicado','name'=>$hh["NombrePlan"]);
		}else{
			$l = Conexion::conectar()->prepare("UPDATE planes_suscripcion 
			set NombrePlan=:nombre,PrecioPlan=:precio,Duracion=:duracion where Id_Planes = :id");
			$l->bindParam(":id",$id,PDO::PARAM_INT);
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$l->bindParam(":precio",$data["precio"],PDO::PARAM_INT);
			$l->bindParam(":duracion",$data["duracion"],PDO::PARAM_STR);
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
				$f = Conexion::conectar()->prepare("DELETE from planes_suscripcion where Id_Planes = :id");
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



class ModelTipos{
	public static function Mostrar($id){
		if ($id == null) {
			$t = Conexion::conectar()->prepare("SELECT * FROM clasificacion");
			if ($t->execute()) {
				return $t->fetchAll(PDO::FETCH_ASSOC);
			}
			$t=null;
		}else{
			$g = Conexion::conectar()->prepare("SELECT * from clasificacion where Id_Clasificacion = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch(PDO::FETCH_ASSOC);
			}
			$g=null;
		}
		
	}

	static public function Add($data){
		$h = Conexion::conectar()->prepare("SELECT TipoVehiculo from clasificacion where REPLACE(LOWER(TipoVehiculo),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch(PDO::FETCH_ASSOC);
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["TipoVehiculo"]);
		}else{
			$l = Conexion::conectar()->prepare("INSERT into clasificacion (TipoVehiculo) values (:nombre)");
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
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
	static public function Edit($data,$id){
		$t = ModelTipos::Mostrar($id);
		$h = Conexion::conectar()->prepare("SELECT TipoVehiculo from clasificacion where REPLACE(LOWER(TipoVehiculo),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch(PDO::FETCH_ASSOC);
		if (is_array($hh) && $data["nombre"] != $t["TipoVehiculo"]) {
			return array('status'=>'duplicado','name'=>$hh["TipoVehiculo"]);
		}else{
			$l = Conexion::conectar()->prepare("UPDATE clasificacion set TipoVehiculo=:nombre where Id_Clasificacion = :id");
			$l->bindParam(":id",$id,PDO::PARAM_INT);
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
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
				$f = Conexion::conectar()->prepare("DELETE from clasificacion where Id_Clasificacion = :id");
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