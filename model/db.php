<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("sqlsrv:Server=localhost;Database=Parking","admin","1234");
		$link->exec("set names utf8");
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $link;
	}
}