<?php
require "../model/suscripciones.model.php";
session_start();
class ControlSuscripciones
{
    static public function Mostrar($id)
    { 
        foreach (ModelSuscripciones::Mostrar(null) as $key => $value) {
            if (date("Y-m-d") > $value["Fecha_Final"]) {
                ModelSuscripciones::SusEstado($value["Id_Suscripcion"],"Vencida");
            }else{
                ModelSuscripciones::SusEstado($value["Id_Suscripcion"],"Activa");
            }
        }

        return ModelSuscripciones::Mostrar($id);
    }

    static public function inputSel(){
        echo json_encode(ModelSuscripciones::parqueos());
    }
    static public function Pagos($id,$pagos){
        $pagosAnte = ModelSuscripciones::Mostrar($id)["Pagos"];
        
        $array_numeros = explode(',', $pagosAnte);

        $posicion = array_search($pagos, $array_numeros);
        
        if ($posicion !== false) {
            unset($array_numeros[$posicion]);
            //echo "El número $pagos estaba presente y ha sido eliminado del array.";
        } else {
            $array_numeros[] = $pagos;
            //echo "El número $pagos no estaba presente y ha sido agregado al array.";
        }
        //Para que no incluya clave => valor
        $array_numeros = array_values($array_numeros);

        $cadena = implode(',', $array_numeros);

        if(ModelSuscripciones::Pagos($id,$cadena) == "ok"){
            echo json_encode(array("status"=>"ok"));
        }
            


    }
    static public function Detalle($id)
    {
        $datos = ModelSuscripciones::Mostrar($id);

        //Para convertir texto plano en un array valido
        $texto_plano = $datos["Pagos"];
        $elementos = explode(',', $texto_plano);
        $enteros = array_map('intval', $elementos);

        switch ($datos["Duracion"]) {
            case 'Diario':
                $factura = ControlSuscripciones::RecorrerTiempo($datos["Fecha_Inicio"], $datos["Fecha_Final"],$datos["PrecioPlan"],"day",$enteros);
                break;
            case "Semanal":
                $factura = ControlSuscripciones::RecorrerTiempo($datos["Fecha_Inicio"], $datos["Fecha_Final"],$datos["PrecioPlan"],"week",$enteros);
                break;
            case "Mensual":
                $factura = ControlSuscripciones::RecorrerTiempo($datos["Fecha_Inicio"], $datos["Fecha_Final"],$datos["PrecioPlan"],"month",$enteros);
                break;
            case "Anual":
                $factura = ControlSuscripciones::RecorrerTiempo($datos["Fecha_Inicio"], $datos["Fecha_Final"],$datos["PrecioPlan"],"year",$enteros);
                break;
        }

        echo json_encode(array(
            "datos" => $datos,
            "factura" => $factura
        ));
    }

    static public function RecorrerTiempo($i,$f,$precio,$tiempo,$pagos)
    {
        // Fecha inicial
        $fechaInicio = new DateTime($i);
        // Fecha final
        $fechaFinal = new DateTime($f);
        // Fecha actual
        $fechaActual = new DateTime();

        $detalle = array();

        // Verificar si la fecha final ha pasado
        //if ($fechaActual > $fechaFinal) {
            //return "Fecha vencida.";
        //} else {
            // Contador de días
            $dias = 0;
            $subtotal= 0;

            // Recorrer los días entre la fecha inicial y la fecha final
            while ($fechaInicio <= $fechaFinal) {
                // Incrementar el contador si el día actual es mayor o igual a la fecha actual
                if ($fechaInicio <= $fechaActual) {
                    $dias++;
                    
                    if (in_array($dias, $pagos)) {
                        $detalle[$dias] = array("Fecha" => $fechaInicio->format('Y-m-d'),"Deuda" => "Pagado", "subtotal" => 'C$ '.number_format($precio,2));
                    }else{
                        $subtotal += $precio;
                        $detalle[$dias] = array("Fecha" => $fechaInicio->format('Y-m-d'),"Deuda" => "Pendiente", "subtotal" => 'C$ '.number_format($subtotal,2));
                    }
                    
                }

                // Añadir un día a la fecha inicial
                $fechaInicio->modify('+1 '.$tiempo);
            }
            $detalle["Total"] = 'C$ '.number_format($subtotal,2);
            return $detalle;
        //}
    }

    static public function Add($datos)
    {



        $fechaActual = date("Y-m-d");
        $fechaSumada = "";
        switch (ModelSuscripciones::planes($datos["plan"])["Duracion"]) {
            case "Diario":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' day'));
                break;
            case "Semanal":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' week'));
                break;
            case "Mensual":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' month'));
                break;
            case "Anual":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' year'));
                break;
        }


        $dNew = array(
            "vehiculo" => $datos["vehiculo"],
            "usuario" => $_SESSION["id"],
            "plan" => $datos["plan"],
            "parqueo" => $datos["parqueo"],
            "inicio" => $fechaActual,
            "final" => $fechaSumada,
            "cantidad" => $datos["cantidad"],
            "estado" => "Activo"
        );

        $respuesta = ModelSuscripciones::Add($dNew);
        if ($respuesta == "ok") {
            ModelSuscripciones::estadoParqueo($datos["parqueo"], "Ocupado");
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'success',
                        title: 'Suscripción creada correctamente'
                        });
                        
                        $('#modalAdd').modal('hide');
                        $('#btnAddModal').attr('disabled',false);
                     $('#btnAddModal').html('Guardar');
                     datosTablas().TSus();
                     inputSel();
                </script>
            ";
        }else if ($respuesta == "duplicado") {
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'error',
                        title: 'Este vehículo ya tiene una suscripción activa'
                        });
                        $('#btnAddModal').attr('disabled',false);
                     $('#btnAddModal').html('Guardar');
                     
                </script>
                        ";
        } else if ($respuesta == "error") {
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'error',
                        title: 'Error al crear suscripción'
                        });
                </script>
                        ";
        }
    }

    static public function Edit($datos)
    {

        $fechaActual = ModelSuscripciones::Mostrar($datos["id"])["Fecha_Inicio"];
        $fechaSumada = "";
        switch (ModelSuscripciones::planes($datos["plan"])["Duracion"]) {
            case "Diario":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' day'));
                break;
            case "Semanal":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' week'));
                break;
            case "Mensual":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' month'));
                break;
            case "Anual":
                $fechaSumada = date("Y-m-d", strtotime($fechaActual . '+' . $datos["cantidad"] . ' year'));
                break;
        }

        if ($datos["parqueo"] == "") {
            $parqueo = ModelSuscripciones::Mostrar($datos["id"])["Id_Parqueo"];
        } else {
            $idparqueo = ModelSuscripciones::Mostrar($datos["id"])["Id_Parqueo"];
            $parqueo = $datos["parqueo"];
        }
        $dNew = array(
            "id" => $datos["id"],
            "vehiculo" => $datos["vehiculo"],
            "usuario" => $_SESSION["id"],
            "plan" => $datos["plan"],
            "parqueo" => $parqueo,
            "inicio" => $fechaActual,
            "final" => $fechaSumada,
            "cantidad" => $datos["cantidad"],
            "estado" => "Activo"
        );

        $respuesta = ModelSuscripciones::Edit($dNew);
        if ($respuesta == "ok") {
            if ($datos["parqueo"] != "") {
                ModelSuscripciones::estadoParqueo($idparqueo, "Libre");
                ModelSuscripciones::estadoParqueo($datos["parqueo"], "Ocupado");
            }

            echo "  
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'success',
                        title: 'Suscripción actualizada correctamente'
                        });
                        $('#modalEdit').modal('hide');
							$('#btnEditModal').attr('disabled',false);
	 					    $('#btnEditModal').html('Guardar');
							 datosTablas().TSus();
                             inputSel();
            ";
        } else if ($respuesta == "duplicado") {
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'error',
                        title: 'Este vehículo ya tiene una suscripción activa'
                        });
                        $('#btnEditModal').attr('disabled',false);
                        $('#btnEditModal').html('Guardar');
                        </script>
                        ";
        }else if ($respuesta == "error") {
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'error',
                        title: 'Error al actualizar suscripción'
                        });
                        $('#btnEditModal').attr('disabled',false);
                        $('#btnEditModal').html('Guardar');
                        </script>
                        ";
        }
    }

    static public function Del($id)
    {
        $idparqueo = ModelSuscripciones::Mostrar($id)["Id_Parqueo"];
        $respuesta = ModelSuscripciones::Del($id);
        if ($respuesta == "ok") {
            ModelSuscripciones::estadoParqueo($idparqueo, "Libre");
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                    }
                    });
                    Toast.fire({
                        icon:'success',
                        title: 'Suscripción eliminada correctamente'
                        });
                       datosTablas().TSus();
                       inputSel();
                            ";
        } else if ($respuesta == "error") {
            echo "
                <script>
                var Toast = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    showConfirmButton:false,
                    timer:1500,
                    timerProgressBar:true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter',Swal.stopTimer);
                        toast.addEventListener('mouseleave',Swal.resumeTimer);
                        }
                        });
                        Toast.fire({
                            icon:'error',
                            title: 'Error al eliminar suscripción'
                            });
                            inputSel();

            ";
        }
    }
}

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 0:
            echo json_encode(ControlSuscripciones::Mostrar(null));
            break;
        case 1:
            echo json_encode(ControlSuscripciones::Mostrar($_POST['id']));

            break;
        case 2:
            ControlSuscripciones::Add(array(
                "vehiculo" => $_POST['vehiculo'],
                "plan" => $_POST['plan'],
                "usuario" => $_POST['usuario'],
                "parqueo" => $_POST['parqueo'],
                "cantidad" => $_POST['cantidad']
            ));
            break;
        case 3:
            ControlSuscripciones::Edit(array(
                "id" => $_POST['id'],
                "vehiculo" => $_POST['vehiculo'],
                "plan" => $_POST['plan'],
                "parqueo" => $_POST['parqueo'],
                "cantidad" => $_POST['cantidad']
            ));
            break;
        case 4:
            ControlSuscripciones::Del($_POST['id']);
            break;
        case 5:
            ControlSuscripciones::Detalle($_POST['id']);
            break;
        case 6:
            ControlSuscripciones::Pagos($_POST["id"],$_POST["pagos"]);
            break;
        case 7:
            ControlSuscripciones::inputSel();
    }
}
