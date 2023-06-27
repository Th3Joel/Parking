var url = "controller/suscripciones.controller.php";

var serve = async (datos, api, res) => {

  let da = await fetch(api, {
    method: "POST",
    body: datos
  });
  if (res == "json") {
    return await da.json();
  } else if (res == "text") {
    $("#joel").html(await da.text());
  }

}


var datosTablas = () => {
  let fd = new FormData();
  //Para la tabla de Planes
  let TSus = (input) => {
    fd.append("op", 0)
    //Si se crear la variable
    input ?
      serve(fd, url, "json").then(datos => {
        //llama para renderizar los datos con los datos filtrados
        render(busqueda(datos, input));
      })
      :
      //llama para renderizar todos los datos
      serve(fd, url, "json").then(datos => {
        render(datos);
      });
  }

  //Metodo para filtrar los datos
  let busqueda = (d, term) => {
    return d.filter(objeto => {
      for (let key in objeto) {
        if (objeto[key].toLowerCase().includes(term.toLowerCase())) {
          return true;
        }
      }
    });
  }

  let render = (d) => {
    let ren = "";
    let cont = 0;
    d.map(x => {
      cont++;
      ren += 
      "<tr>" +
        "<td>" + cont + "</td>" +
        "<td>" + x.Cliente + "</td>" +
        "<td>" + x.Marca + " (" + x.Placa + ")</td>" +
        "<td>" + x.NombrePlan + " (" + x.CantidadTiempo + " " + x.Duracion + ")" + "</td>" +
        "<td>" + x.NumeroParqueo + "</td>" +
        "<td>" + x.Fecha_Final + "</td>";
        //SI esta activa bla bla bal si no bla bla bla
        ren += 
        x.Estado == "Activa" &&
         "<td style='color:green;'>" + x.Estado + "</td>"
        || 
        x.Estado == "Vencida" && "<td style='color:red;'>" + x.Estado + "</td>";

       ren += 
        "<td style='width:170px'>" +
        "<button class='btn btn-success' idDet=" + x.Id_Suscripcion + " id='btnDet'><i class='bi bi-card-text'></i></button>";
        ren += 
        x.Estado == "Activa" ? "<button class='btn btn-primary' idEdit=" + x.Id_Suscripcion + " id='btnEdit'><i class='bi bi-pen'></i></button>" : "";
        
        ren += 
        "<button class='btn btn-danger' idElim=" + x.Id_Suscripcion + " id='btnElim'><i class='bi bi-trash'></i></button>" +
      "</td>"
    });
    if (d.length === 0) {
      ren = "<tr><td colspan='9'><h4>No hay datos</h4></td></tr>";
    }
    $("#tableVehiculos tbody").html(ren);
  }

  return {
    TSus
  }
}


var crud = (form) => {//SI form es nulo
  let fd = form ? new FormData(form) : new FormData();
  let get = async (id, op, pa) => {
    fd.append("op", op);
    fd.append("id", id);
    pa && fd.append("pagos", pa);
    return await serve(fd, url, "json");
  }
  let add = (op) => {
    fd.append("op", op);
    serve(fd, url, "text");
  }
  let edit = (op, id) => {
    fd.append("op", op);
    fd.append("id", id);
    serve(fd, url, "text");
  }
  let del = async (op, id) => {
    fd.append("op", op);
    fd.append("id", id);
    serve(fd, url, "text");
  }
  return {
    get,
    add,
    edit,
    del
  };
}


datosTablas().TSus();
//Búsqueda
$("#txtSearch").on("keyup", function () {
  datosTablas().TSus($("#txtSearch").val()); 
});

//Acciones para agregar
$("#btnAdd").click(function () {
  $("#modalAdd").modal("show");
});

function formAdd() {
  $('#btnAddModal').attr("disabled", true);
  $("#btnAddModal")
    .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formAdd")).add(2);
}


//Acciones para editar

$("tbody").on("click", "#btnEdit", function () {
  crud().get($(this).attr("idEdit"), 1).then(d => {
    $("#txtVehiculo").val(d.Id_Vehiculo);
    $("#txtTipo").val(d.Id_Planes);
    $("#txtParqueo").val(d.Id_Parqueo);
    $("#txtCantidad").val(d.CantidadTiempo);
    $("#btnEditModal").attr("idEdit", d.Id_Suscripcion);
    $("#modalEdit").modal("show");
  });
});
function formEdit() {
  $('#btnEditModal').attr("disabled", true);
  $("#btnEditModal")
    .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formEdit")).edit(3, $("#btnEditModal").attr("idEdit"));
}


$("tbody").on("click", "#btnElim", function () {
  let id = $(this).attr("idElim");
  Swal.fire({
    title: '¿Está seguro de borrar la suscripcion?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Suscripcion!'
  }).then(function (result) {
    if (result.value) {
      crud().del(4, id);
    }
  });
});

var Dfactura = (d) => {
  let conte = "";
  for (var clave in d.factura) {
    //console.log("Clave: " + clave + ", Valor: " + d.factura[clave].Fecha);
    if (clave != "Total") {
      conte += "<tr><td>" +
        clave + "</td><td>" +
        d.factura[clave].Fecha +
        "</td><td>";
      if (d.factura[clave].Deuda === "Pendiente") {
        conte += "<button class='btn btn-warning' id='btnPago' idSus=" + d.datos.Id_Suscripcion + " idPago=" + clave + ">Pendiente</button>";
      } else if (d.factura[clave].Deuda === "Pagado") {
        conte += "<button class='btn btn-success' id='btnPago' idSus=" + d.datos.Id_Suscripcion + " idPago=" + clave + ">Pagado</button>";
      }


      conte += "</td><td>" +
        d.factura[clave].subtotal +
        "</td></tr>";
    }
  }
  conte += "<tr><td colspan='3'>Total:</td><td>" + d.factura.Total + "</td></tr>"
  $("#tablaFactura tbody").html(conte);
}

$("tbody").on("click", "#btnDet", function () {
  crud().get($(this).attr("idDet"), 5).then(d => {
    // d =JSON.parse(d);
    let tiempo;
     switch (d.datos.Duracion) {
      case "Diario":
        tiempo = "Dias";
        $("#Encabezado").html("Dias");
        break;
      case "Semanal":
        tiempo = "Semanas";
        $("#Encabezado").html("Semanas");
        break;
      case "Mensual":
        tiempo = "Meses";
        $("#Encabezado").html("Meses");
        break;
      case "Anual":
        tiempo = "Años";
        $("#Encabezado").html("Años");
        break;
    }
    d.datos.Estado == "Activa" && $("#EstadoSuscripcion").html("<button class='btn btn-success'>Activa</button>");
    d.datos.Estado == "Vencida" && $("#EstadoSuscripcion").html("<button class='btn btn-danger'>Vencida</button>"); 

    $("#usuario").val(d.datos.Usuario);
    $("#cliente").val(d.datos.Cliente);
    $("#parqueo").val(d.datos.NumeroParqueo);
    $("#facturacion").val(d.datos.Duracion + " (C$ " + d.datos.PrecioPlan + ")");
    $("#txtplan").val(d.datos.NombrePlan);
    $("#duracion").val(d.datos.CantidadTiempo + " " + tiempo);
    $("#DateInicio").val(d.datos.Fecha_Inicio);
    $("#vencimiento").val(d.datos.Fecha_Final);
    Dfactura(d);
    $("#modalDetalle").modal("show");
  });
});

$("#tablaFactura tbody").on("click", "#btnPago", function () {
  crud().get($(this).attr("idSus"), 6, $(this).attr("idPago")).then(d => {
    //SI es ok el cambion se vuelve a renderizar la tabla factura
    d.status == "ok" &&
      crud().get($(this).attr("idSus"), 5).then(d => {
        Dfactura(d);
      });
  });
});


var inputSel = () =>{
  crud().get(0, 7).then(d => {
    let ren = '<option value="">---Seleccionar---</option>';
    for (var clave in d) {
      ren += "<option value=" + d[clave].Id_Parqueo + ">Espacio ( " + d[clave].NumeroParqueo + " )</option>"
    }

    $("#opSel").html(ren);
    $("#txtParqueo").html(ren);
  });
}

inputSel();