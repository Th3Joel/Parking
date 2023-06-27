<?php

require "db.php";

class ModelUsuarios{
	static public function InitSession($datos){
       $con = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario = :user");
       $con->bindParam(":user",$datos["user"],PDO::PARAM_STR);
       $con->execute();
        return $con->fetch();  
       $con=null;
	}
    static public function AddUser($datos){
        $con1 = Conexion::conectar()->prepare("SELECT usuario from usuarios where usuario = :user");
        $con1->bindParam(":user",$datos["user"],PDO::PARAM_STR);
        $con1->execute();
        $result = $con1->fetch();
        if (is_array($result)) {
            return "duplicado";
            $con1=null;
            $result = null; 
        }else{

            $con = Conexion::conectar()->prepare("INSERT into usuarios (nombre,correo,contacto,cedula,usuario,passwd,tipo,img,estado) values(:nombre,:correo,:contacto,:cedula,:user,:passwd,:tipo,:img,'Activado')");
            $con->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $con->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
            $con->bindParam(":contacto",$datos["contacto"],PDO::PARAM_STR);
            $con->bindParam(":cedula",$datos["cedula"],PDO::PARAM_STR);
            $con->bindParam(":user",$datos["user"],PDO::PARAM_STR);
            $con->bindParam(":passwd",$datos["pass"],PDO::PARAM_STR);
            $con->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
            $con->bindParam(":img",$datos["img"],PDO::PARAM_STR);
            if ($con->execute()) {
                return "ok";
            }else{
                return "error";
            }
            $con=null;
        }
    }
    static public function EditUser($datos){
        $con3 = Conexion::conectar()->prepare("SELECT usuario from usuarios where id_user = :id");
        $con3->bindParam(":id",$datos["id"],PDO::PARAM_INT);
        $con3->execute();
        $us = $con3->fetch();

        $con = Conexion::conectar()->prepare("SELECT usuario from usuarios where usuario = :user");
        $con->bindParam(":user",$datos["user"],PDO::PARAM_STR);
        $con->execute();
        $re = $con->fetch();
        if (is_array($re) && ($datos["user"] !=  $us["usuario"])) {
            return "duplicado";    
        }else{
           $c = null;
           if ($datos["pass"] == 1) {
              $c =  Conexion::conectar()->prepare("UPDATE usuarios set nombre=:nombre,correo=:correo,contacto=:contacto,cedula=:cedula,usuario=:user,tipo=:tipo,img=:img where id_user = :id");
           }else{
            $c =  Conexion::conectar()->prepare("UPDATE usuarios set nombre=:nombre,correo=:correo,contacto=:contacto,cedula=:cedula,usuario=:user,passwd=:pass,tipo=:tipo,img=:img where id_user = :id");
              $c->bindParam(":pass",$datos["pass"],PDO::PARAM_STR);
           }
                 
            
            $c->bindParam(":id",$datos["id"],PDO::PARAM_INT);
            $c->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $c->bindParam(":correo",$datos["correo"],PDO::PARAM_STR);
            $c->bindParam(":contacto",$datos["contacto"],PDO::PARAM_STR);
            $c->bindParam(":cedula",$datos["cedula"],PDO::PARAM_STR);
            $c->bindParam(":user",$datos["user"],PDO::PARAM_STR);
            $c->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
            $c->bindParam(":img",$datos["img"],PDO::PARAM_STR);
            if ($c->execute()) {
                return "ok";
            }else{
                return "error";
            }
            $c=null;

        }
        $con=null;
            $re = null;
            $con3=null;
            $us=null;
    }

    static public function DelUser($id){
        $con = Conexion::conectar()->prepare("DELETE from usuarios where id_user = :id");
        $con->bindParam(":id",$id,PDO::PARAM_INT);
        if ($con->execute()) {
            return "ok";
        }else{
            return "error";
        }
        $con=null;
    }
    static public function DatosUser($id){
        $con = Conexion::conectar()->prepare("SELECT nombre, correo, contacto, cedula, usuario, img, tipo from usuarios where id_user = :id");
        $con->bindParam(":id",$id,PDO::PARAM_INT);
        $con->execute();
        return $con->fetch();
        $con=null;
    }
    static public function Estado($id){
        $ac = "Activado";
        $de = "Desactivado";
        $f = Conexion::conectar()->prepare("SELECT estado from usuarios where id_user = :id");
        $f->bindParam(":id",$id,PDO::PARAM_INT);
        $f->execute();
        $r = $f->fetch();

        $i = Conexion::conectar()->prepare("UPDATE usuarios set estado=:estado where id_user = :id");
        $i->bindParam(":id",$id,PDO::PARAM_INT);
        if ($r["estado"] == "Activado"){
            $i->bindParam(":estado",$de,PDO::PARAM_STR);
        }else if ($r["estado"] == "Desactivado"){
            $i->bindParam(":estado",$ac,PDO::PARAM_STR);
        }
        if ($i->execute()) {
            $f->execute();
            return $f->fetch();
        }
        $r=null;
        $ac = null;
        $de=null;
        $f=null;
        $i=null;
    }
}  