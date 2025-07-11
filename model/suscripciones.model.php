<?php

require "db.php";

class ModelSuscripciones
{

    public static function Mostrar($id)
    {
        if ($id == null) {
            $t = Conexion::conectar()->
                prepare("SELECT 
                        sus.`Id_Suscripcion`,
                        sus.`Estado`,
                        sus.`CantidadTiempo`,
                        sus.Fecha_Final,
                        usuarios.nombre AS Usuario,
                        vehiculos.`Marca`,
                        vehiculos.`Placa`,
                        ps.`NombrePlan`,
                        ps.`Duracion`,
                        ps.PrecioPlan,
                        parqueos.`NumeroParqueo`,
                        CONCAT(clientes.`Nombre`,' ',clientes.`Apellido`) AS Cliente
                        FROM
                            suscripciones sus
                            INNER JOIN usuarios ON usuarios.id_user = sus.`Id_Usuario`
                            INNER JOIN planes_suscripcion ps ON ps.`Id_Planes` = sus.`Id_Planes`
                            INNER JOIN vehiculos ON vehiculos.`Id_Vehiculo` = sus.`Id_Vehiculo`
                            INNER JOIN parqueos ON parqueos.`Id_Parqueo` = sus.`Id_Parqueo`
                            INNER JOIN clientes ON clientes.`Id_Cliente` = vehiculos.`Id_Cliente`;
                            ");

            if ($t->execute()) {
                return $t->fetchAll(PDO::FETCH_ASSOC);
            }
            $t = null;
        } else {
            $g = Conexion::conectar()->prepare("SELECT 
                    sus.`Id_Suscripcion`,
                    sus.`Estado`,
                    sus.`CantidadTiempo`,
                    sus.Fecha_Final,
                    sus.Fecha_Inicio,
                    usuarios.nombre AS Usuario,
                    vehiculos.Id_Vehiculo,
                    ps.Id_Planes,
                    parqueos.Id_Parqueo,
                    vehiculos.`Marca`,
                    vehiculos.`Placa`,
                    ps.`NombrePlan`,
                    ps.`Duracion`,
                    ps.PrecioPlan,
                    parqueos.`NumeroParqueo`,
                    CONCAT(clientes.`Nombre`,' ',clientes.`Apellido`) AS Cliente
                    FROM
                        suscripciones sus
                        INNER JOIN usuarios ON usuarios.id_user = sus.`Id_Usuario`
                        INNER JOIN planes_suscripcion ps ON ps.`Id_Planes` = sus.`Id_Planes`
                        INNER JOIN vehiculos ON vehiculos.`Id_Vehiculo` = sus.`Id_Vehiculo`
                        INNER JOIN parqueos ON parqueos.`Id_Parqueo` = sus.`Id_Parqueo`
                        INNER JOIN clientes ON clientes.`Id_Cliente` = vehiculos.`Id_Cliente`

                        WHERE sus.Id_Suscripcion = :id;");

            $g->bindParam(":id", $id, PDO::PARAM_INT);
            if ($g->execute()) {
                return $g->fetch(PDO::FETCH_ASSOC);
            }
            $g = null;
        }

    }

    static public function Add($data)
    {
        /*$p = Conexion::conectar()->prepare("SELECT * FROM suscripciones WHERE Id_Vehiculo = :id");
        $p->bindParam(":id",$data["vehiculo"],PDO::PARAM_INT);
        $p->execute();
        if (is_array($p->fetch(PDO::FETCH_ASSOC))) {
            return "duplicado";
        }else{*/
        $l = Conexion::conectar()->
            prepare("INSERT into 
                suscripciones (Id_Vehiculo,Id_Usuario,Id_Planes,Id_Parqueo,Fecha_Inicio,Fecha_Final,CantidadTiempo,Estado)
                values (:vehiculo,:usuario,:plan,:parqueo,:inicio,:final,:cantidad,:estado)");
        $l->bindParam(":vehiculo", $data["vehiculo"], PDO::PARAM_INT);
        $l->bindParam(":usuario", $data["usuario"], PDO::PARAM_INT);
        $l->bindParam(":plan", $data["plan"], PDO::PARAM_INT);
        $l->bindParam(":parqueo", $data["parqueo"], PDO::PARAM_INT);
        $l->bindParam(":inicio", $data["inicio"], PDO::PARAM_STR);
        $l->bindParam(":final", $data["final"], PDO::PARAM_STR);
        $l->bindParam(":cantidad", $data["cantidad"], PDO::PARAM_INT);
        $l->bindParam(":estado", $data["estado"], PDO::PARAM_STR);
        try {
            if ($l->execute()) {
                return "ok";
            }
        } catch (Exception $e) {
            return array("status" => "error", "msj" => $e->getMessage());
        }
        $l = null;

        $p = null;
    }



    static public function Edit($data)
    {
        $p = Conexion::conectar()->prepare("SELECT * FROM suscripciones WHERE Id_Vehiculo = :id");
        $p->bindParam(":id", $data["vehiculo"], PDO::PARAM_INT);
        $p->execute();
        $pp = $p->fetch(PDO::FETCH_ASSOC);
        if (is_array($pp) && $pp["Id_Suscripcion"] != $data["id"]) {
            return "duplicado";
        } else {
            $l = Conexion::conectar()->prepare("UPDATE suscripciones 
			set 
                Id_Vehiculo=:vehiculo,
                Id_Usuario=:usuario,
                Id_Planes=:plan,
                Id_Parqueo=:parqueo,
                Fecha_Final=:final,
                CantidadTiempo=:cantidad,
                Estado=:estado
                where Id_Suscripcion = :id");
            $l->bindParam(":id", $data["id"], PDO::PARAM_INT);
            $l->bindParam(":vehiculo", $data["vehiculo"], PDO::PARAM_INT);
            $l->bindParam(":usuario", $data["usuario"], PDO::PARAM_INT);
            $l->bindParam(":plan", $data["plan"], PDO::PARAM_INT);
            $l->bindParam(":parqueo", $data["parqueo"], PDO::PARAM_INT);
            //$l->bindParam(":inicio",$data["inicio"],PDO::PARAM_STR);
            $l->bindParam(":final", $data["final"], PDO::PARAM_STR);
            $l->bindParam(":cantidad", $data["cantidad"], PDO::PARAM_INT);
            $l->bindParam(":estado", $data["estado"], PDO::PARAM_STR);
            if ($l->execute()) {
                return "ok";
            } else {
                return "error";
            }
            $l = null;
        }
    }
    static public function Del($id)
    {

        $f = Conexion::conectar()->prepare("DELETE from suscripciones where Id_Suscripcion = :id");
        $f->bindParam(":id", $id, PDO::PARAM_STR);
        if ($f->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $f = null;
    }


    static public function vehiculos($id)
    {
        if ($id == null) {
            $y = Conexion::conectar()->prepare("	SELECT
                                                        ve.Id_Vehiculo,
                                                        ve.Marca,
                                                        ve.Placa,
                                                        CONCAT(cl.Nombre,' ',cl.Apellido) AS Cliente
                                                    FROM 
                                                    vehiculos ve
                                                    INNER JOIN clientes cl ON cl.Id_Cliente = ve.Id_Cliente ");
            if ($y->execute()) {
                return $y->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "error";
            }
        } else {
            $k = Conexion::conectar()->prepare("	SELECT
                                                        ve.Id_Vehiculo,
                                                        ve.Marca,
                                                        ve.Placa,
                                                        CONCAT(cl.Nombre,' ',cl.Apellido) AS Cliente
                                                    FROM 
                                                    vehiculos ve
                                                    INNER JOIN clientes cl ON cl.Id_Cliente = ve.Id_Cliente
                                                    WHERE ve.Id_Vehiculo = :id ");
            $k->bindParam(":id", $id, PDO::PARAM_INT);
            if ($k->execute()) {
                return $k->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "error";
            }
        }

        $y = null;
        $k = null;
    }

    static public function usuarios()
    {
        $h = Conexion::conectar()->prepare("SELECT id_user, nombre FROM usuarios");
        if ($h->execute()) {
            return $h->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "error";
        }
        $h = null;
    }

    static public function planes($id)
    {
        if ($id == null) {
            $d = Conexion::conectar()->prepare("SELECT Id_Planes, NombrePlan,PrecioPlan,Duracion FROM planes_suscripcion");
            if ($d->execute()) {
                return $d->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "error";
            }
        } else {
            $j = Conexion::conectar()->prepare("SELECT Id_Planes, NombrePlan,PrecioPlan, Duracion FROM planes_suscripcion WHERE Id_Planes = :id");
            $j->bindParam(":id", $id, PDO::PARAM_INT);
            if ($j->execute()) {
                return $j->fetch(PDO::FETCH_ASSOC);
            } else {
                return "error";
            }
            $j = null;


        }
        $d = null;
    }

    static public function parqueos()
    {
        $k = Conexion::conectar()->prepare("SELECT Id_Parqueo, NumeroParqueo FROM parqueos WHERE Estado = 'Libre'");
        if ($k->execute()) {
            return $k->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return "error";
        }
        $k = null;
    }

    static public function estadoParqueo($id, $estado)
    {
        $m = Conexion::conectar()->prepare("UPDATE parqueos SET Estado = :estado WHERE Id_Parqueo = :id");
        $m->bindParam(":id", $id, PDO::PARAM_INT);
        $m->bindParam(":estado", $estado, PDO::PARAM_STR);

        if ($m->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $m = null;
    }
    static public function Pagos($id, $pago)
    {
        $r = Conexion::conectar()->prepare("UPDATE suscripciones 
                                            SET PagosFecha = :pago WHERE Id_Suscripcion = :id");
        $r->bindParam(":id", $id, PDO::PARAM_INT);
        $r->bindParam(":pago", $pago, PDO::PARAM_STR);
        if ($r->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $r = null;
    }

    static public function SusEstado($id, $estado)
    {
        $r = Conexion::conectar()->prepare("UPDATE suscripciones SET Estado=:estado WHERE Id_Suscripcion = :id");
        $r->bindParam(":id", $id, PDO::PARAM_INT);
        $r->bindParam(":estado", $estado, PDO::PARAM_STR);
        if ($r->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $r = null;
    }




}


