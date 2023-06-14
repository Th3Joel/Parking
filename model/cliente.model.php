<?php

require "db.php";

class ModelCliente{
	public static function Mostrar($id){
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

	static public function Add($data){
		$h = Conexion::conectar()->prepare("SELECT Nombre from clientes where REPLACE(LOWER(Nombre),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["Nombre"]);
		}else{
			$l = Conexion::conectar()->prepare("INSERT into clientes (Nombre,Apellido,Direccion,Telefono,Correo) values (:nombre,:apellido,:direccion,:telefono,:correo)");
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$l->bindParam(":apellido",$data["apellido"],PDO::PARAM_STR);
			$l->bindParam(":direccion",$data["direccion"],PDO::PARAM_STR);
			$l->bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
			$l->bindParam(":correo",$data["correo"],PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l->close();
		}
		$h=null; 
		$hh=null;
	}
	static public function Edit($data,$id){
		$t = ModelCliente::Mostrar($id);
		$h = Conexion::conectar()->prepare("SELECT Nombre from clientes where REPLACE(LOWER(Nombre),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh) && $data["nombre"] != $t["Nombre"]) {
			return array('status'=>'duplicado','name'=>$hh["Nombre"]);
		}else{
			$l = Conexion::conectar()->prepare("UPDATE clientes set Nombre=:nombre,Apellido=:apellido,Direccion=:direccion,Telefono=:telefono,Correo=:correo where Id_Cliente = :id");
			$l->bindParam(":id",$id,PDO::PARAM_INT);
			$l->bindParam(":nombre",$data["nombre"],PDO::PARAM_STR);
			$l->bindParam(":apellido",$data["apellido"],PDO::PARAM_STR);
			$l->bindParam(":direccion",$data["direccion"],PDO::PARAM_STR);
			$l->bindParam(":telefono",$data["telefono"],PDO::PARAM_STR);
			$l->bindParam(":correo",$data["correo"],PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l->close();
		}
		$t=null;
		$h=null;
		$hh=null;
	}
	static public function Del($id){
			/*$o = Conexion::conectar()->prepare("SELECT Nombre from clientes where IdCliente = :id");
			$o->bindParam(":id",$id,PDO::PARAM_INT);
			$o->execute();
			$oo = $o->fetch();
			if (is_array($oo)) {
				return array('error' => 'ok',"cliente" => $oo["Nombre"], 'categoria' => ModeloCategoria::Mostrar($id)["nombre"] );
			}else{*/

				$f = Conexion::conectar()->prepare("DELETE from clientes where Id_Cliente = :id");
				$f->bindParam(":id",$id,PDO::PARAM_INT);
				if ($f->execute()) {
					return "ok";
				}else{
					return "error";
				}
				$f->close();
			
			$o=null;
			$oo=null;
		}
}