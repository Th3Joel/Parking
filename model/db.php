<?php
class Conexion
{
	static public function conectar()
	{
		$link = new PDO("mysql:host=gateway01.us-east-1.prod.aws.tidbcloud.com;port=4000;dbname=Parking", "VwgHAVyMup7XfY6.root", "AS1txOqxdLDsUHFy", array(
			PDO::MYSQL_ATTR_SSL_CA     => "ssl.pem",
			PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,  // Puedes ajustar esto según tus necesidades de verificación de certificado del servidor
		));
		$link->exec("set names utf8");
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $link;
		//code...

	}
}
