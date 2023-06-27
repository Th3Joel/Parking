<?php
require "db.php";
class ModelInicio{
    static public function Vehiculos(){
        $t = Conexion::conectar()->prepare("SELECT COUNT(Id_Vehiculo)as total from vehiculos");
        if($t->execute()){
            return $t->fetch(PDO::FETCH_ASSOC);
        }else{
            return "error";
        }
        $t=null;
    }
    static public function Suscripciones(){
        $t = Conexion::conectar()->prepare("SELECT COUNT(Id_Suscripcion)as total from suscripciones");
        if($t->execute()){
            return $t->fetch(PDO::FETCH_ASSOC);
        }else{
            return "error";
        }
        $t=null;
    }
    static public function Clientes(){
        $t = Conexion::conectar()->prepare("SELECT COUNT(Id_Cliente)as total from clientes");
        if($t->execute()){
            return $t->fetch(PDO::FETCH_ASSOC);
        }else{
            return "error";
        }
        $t=null;
    }
    static public function Espacios(){
        $t = Conexion::conectar()->prepare("SELECT COUNT(Id_Parqueo)as total from parqueos");
        if($t->execute()){
            return $t->fetch(PDO::FETCH_ASSOC);
        }else{
            return "error";
        }
        $t=null;
    }
}