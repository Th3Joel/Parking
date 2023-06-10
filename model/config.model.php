<?php

require "db.php";

class ConfigModelo{
	static public function Insertar($datos)
	{
		$con = Conexion::conectar()->prepare("insert into empresa (nombre,ruc,correo,contacto) values (:nombre,:ruc,:correo,:contacto)");
		$con->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$con->bindParam(":ruc",$datos["ruc"],PDO::PARAM_STR);
		$con->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
		$con->bindParam(":contacto",$datos["contacto"],PDO::PARAM_STR);
		if($con->execute()){
			return "ok";
		}else{
			return "fail";
		}
		$con->close();
	}

	static public function UpdateEmpresa($id,$datos){
		$con = Conexion::conectar()->prepare("update empresa set nombre=:nombre, ruc=:ruc, direccion=:direccion, correo=:correo, contacto=:contacto,contacto2=:contacto2,logo=:logo where id=:id");
		$con->bindParam(":id",$id,PDO::PARAM_INT);
		$con->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$con->bindParam(":ruc",$datos["ruc"],PDO::PARAM_STR);
		$con->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$con->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
		$con->bindParam(":contacto",$datos["contacto"],PDO::PARAM_STR);
		$con->bindParam(":contacto2",$datos["contacto2"],PDO::PARAM_STR);
		$con->bindParam(":logo",$datos["logo"],PDO::PARAM_STR);
		if ($con->execute()) {
			return "ok";
		}else{
			return "fail";
		}
		$con->close();
	}

	static public function MostrarEmpresa(){
		$con = Conexion::conectar()->prepare("select * from empresa where id = 1");
		$con->execute();
		return $con->fetch();
		$con->close();
	}

	static public function UpdatePerfil($datos){
		$con3 = Conexion::conectar()->prepare("select passwd from usuarios where id_user = :id");
		$con3->bindParam(":id",$datos["id"],PDO::PARAM_INT);
		$con3->execute();
		$result = $con3->fetch();

		if (password_verify($datos["pass"],$result["passwd"])) {
			$con2 = Conexion::conectar()->prepare("select usuario from usuarios where user = :user");
			$con2->bindParam(":user",$datos["user"],PDO::PARAM_STR);
			$con2->execute();
			if (is_array($con2->fetch())) {
				return "duplicado";
				

			}else{
		      $con = Conexion::conectar()->prepare("update usuarios set usuario=:user where id_user = :id");
		      $con->bindParam(":id",$datos["id"],PDO::PARAM_INT);
		      $con->bindParam(":user",$datos["user"],PDO::PARAM_STR);
		      if($con->execute()){
		      	return "ok";
		      }else{
		      	return "fail";
		      }
		       $con->close();
		  }
		  $con2->close();
		 
		}else{
			return "incorrecta";
		}
		 $con3->close();
		  $result=null;
	}
	static public function UpdatePass($datos){
		$con = Conexion::conectar()->prepare("select passwd from usuarios where id_user=:id");
		$con->bindParam(":id",$datos["id"],PDO::PARAM_INT);
		$con->execute();
		$result = $con->fetch();
		if ( password_verify($datos["passAnte"],$result["passwd"])) {
			$con2 = Conexion::conectar()->prepare("update usuarios set passwd=:pass where id_user = :id");
			$con2->bindParam(":id",$datos["id"],PDO::PARAM_INT);
			$con2->bindParam(":pass",password_hash($datos["pass"],PASSWORD_BCRYPT,['cost' => 10]),PDO::PARAM_STR);
			if ($con2->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$con2->close();
		}else{
			return "incorrecta";
		}
		$con->close();
		$result = null;
	}

		  static public function UpdateUser($datos)
			  {
			  	$con = Conexion::conectar()->prepare("update usuarios set nombre=:nombre, cedula=:cedula, contacto=:contacto, correo=:correo, img=:img where id_user = :id");
			  	$con->bindParam(":id",$datos["id"],PDO::PARAM_INT);
			  	$con->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			  	$con->bindParam(":cedula",$datos["cedula"],PDO::PARAM_STR);
			  	$con->bindParam(":contacto",$datos["contacto"],PDO::PARAM_STR);
			  	$con->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
			  	$con->bindParam(":img",$datos["img"],PDO::PARAM_STR);
			  	if ($con->execute()) {
			  		return "ok";
			  	}else{
			  		return "fail";
			  	}
			  	$con->close();
			  }
	  	 
	static public function MostrarPerfil($id,$opcion){
		if ($opcion == 1) {
			$con = Conexion::conectar()->prepare("select * from usuarios where id_user <> :id;");
			$con->bindParam(":id",$id,PDO::PARAM_INT);
			$con->execute();
				return $con->fetchAll();
			
		
			$con->close();
		}else{
				$con = Conexion::conectar()->prepare("SELECT * from usuarios where id_user = :id");
				$con->bindParam(":id",$id,PDO::PARAM_INT);
				$con->execute();
				return $con->fetch();
				$con->close();
		
		}
	}
}