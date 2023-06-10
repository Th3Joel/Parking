<?php
require "db.php";
/**
 * 
 */
class ModeloClientes
{
	

	static public function Mostrar($id){
		if ($id == null) {
			$g = Conexion::conectar()->prepare("select * from categorias");
			if ($g->execute()) {
				return $g->fetchAll();
			}
			$g->close();
		}else{
			$g = Conexion::conectar()->prepare("select * from categorias where id_categoria = :id");
			$g->bindParam(":id",$id,PDO::PARAM_INT);
			if ($g->execute()) {
				return $g->fetch();
			}
			$g->close();
		}
		
	}
	static public function Add($nm){
		$h = Conexion::conectar()->prepare("select nombre from categorias where REPLACE(LOWER(nombre),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$nm,PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh)) {
			return array('status'=>'duplicado','name'=>$hh["nombre"]);
		}else{
			$l = Conexion::conectar()->prepare("insert into categorias (nombre) values (:nombre)");
			$l->bindParam(":nombre",$nm,PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l->close();
		}
		$h->close();
		$hh=null;
	}
	static public function Edit($nm,$id){
		$t = ModeloCategoria::Mostrar($id);
		$h = Conexion::conectar()->prepare("select nombre from categorias where REPLACE(LOWER(nombre),' ','') = REPLACE(LOWER(:nombre),' ','')");
		$h->bindParam(":nombre",$nm,PDO::PARAM_STR);
		$h->execute();
		$hh = $h->fetch();
		if (is_array($hh) && $nm != $t["nombre"]) {
			return array('status'=>'duplicado','name'=>$hh["nombre"]);
		}else{
			$l = Conexion::conectar()->prepare("update categorias set nombre=:nombre where id_categoria = :id");
			$l->bindParam(":id",$id,PDO::PARAM_INT);
			$l->bindParam(":nombre",$nm,PDO::PARAM_STR);
			if ($l->execute()) {
				return "ok";
			}else{
				return "error";
			}
			$l->close();
		}
		$t=null;
		$h->close();
		$hh=null;
	}
	static public function Del($id){
			$o = Conexion::conectar()->prepare("select descripcion from productos where id_categoria = :id");
			$o->bindParam(":id",$id,PDO::PARAM_INT);
			$o->execute();
			$oo = $o->fetch();
			if (is_array($oo)) {
				return array('error' => 'ok',"producto" => $oo["descripcion"], 'categoria' => ModeloCategoria::Mostrar($id)["nombre"] );
			}else{

				$f = Conexion::conectar()->prepare("delete from categorias where id_categoria = :id");
				$f->bindParam(":id",$id,PDO::PARAM_INT);
				if ($f->execute()) {
					return "ok";
				}else{
					return "error";
				}
				$f->close();
			}
			$o->close();
			$oo=null;
		}
}