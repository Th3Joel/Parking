
var url = "controller/planes.controller.php";

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

//Para mostrar los datos en las tablas
var datosTablas = () => {
    let fd = new FormData();
    //Para la tabla de Planes
    let TPlanes = (input) => {
      fd.append("op",0)
      //Si se crear la variable
        input ? 
          serve(fd,url,"json").then(datos => {
            //llama para renderizar los datos con los datos filtrados
            render(busqueda(datos,input),1);
          })
        :
        //llama para renderizar todos los datos
          serve(fd,url,"json").then(datos => {
            render(datos,1);
          });
      }

      let Ttipos = (input) => {
        fd.append("op",5);
        if(input){
          serve(fd,url,"json").then(datos => {
            render(busqueda(datos,input));
          })
        }else{
          serve(fd,url,"json").then(datos => {
            render(datos);
          });
        }
      }
    
        //Metodo para filtrar los datos
      let busqueda = (d,term) => {
        return d.filter(objeto => {
          for (let key in objeto){
            if (objeto[key].toLowerCase().includes(term.toLowerCase())) {
              return true;
            }
          }
        });
      }

    let render = (d,op) => {
      let ren = "";
      let cont = 0;
      d.map(x => {
        cont++;
        if (op === 1) {
          ren += "<tr>"+
                      "<td>"+cont+"</td>"+
                      "<td>"+x.NombrePlan+"</td>"+
                      "<td>"+x.PrecioPlan+"</td>"+
                      "<td>"+x.Duracion+"</td>"+
                      "<td>"+
                       "<button class='btn btn-primary' idEdit="+x.Id_Planes+" id='btnEdit'><i class='bi bi-pen'></i></button>"+
                       "<button class='btn btn-danger' idElim="+x.Id_Planes+" id='btnElim'><i class='bi bi-trash'></i></button>"+
                      "</td>"
        }else{
          ren += "<tr>"+
                      "<td>"+cont+"</td>"+
                      "<td>"+x.TipoVehiculo+"</td>"+
                      "<td>"+
                       "<button class='btn btn-primary' idEdit="+x.Id_Clasificacion+" id='btnEdit'><i class='bi bi-pen'></i></button>"+
                       "<button class='btn btn-danger' idElim="+x.Id_Clasificacion+" id='btnElim'><i class='bi bi-trash'></i></button>"+
                      "</td>"
        }
      });
      if(d.length === 0){
        ren = "<tr><td colspan='5'><h4>No hay datos</h4></td></tr>";
      }
      op === 1 ? $("#bodyPlanes").html(ren) : $("#bodyTipos").html(ren)   
    }

    return {
      TPlanes,
      Ttipos
    }
}


var crud = (form) => {//SI form es nulo
  let fd = form ? new FormData(form) : new FormData();
  let get = async (id, op) => {
    fd.append("op", op);
    fd.append("id", id);
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


datosTablas().TPlanes();


$("#pajinaPlanes").click(function () {
  $("#btnAdd").attr("op", 0);
  datosTablas().TPlanes();
});

$("#pajinaVehiculos").click(function () {
  $("#btnAdd").attr("op", 1);
  datosTablas().Ttipos();
});



$("#btnAdd").click(function () {
  if ($("#btnAdd").attr("op") == 0) {
    $("#modalAddPlanes").modal("show");
  } else if ($("#btnAdd").attr("op") == 1) {
    $("#modalAddTipo").modal("show");
  }
});

//CRUD

$("#btnEditModalPlanes").off("click").click(function () {
  $('#btnEditModalPlanes').attr("disabled", true);
  $("#btnEditModalPlanes").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formEditPlanes")).edit(3, $("#btnEditModalPlanes").attr("idEdit"));
});

$("#btnAddModalPlanes").off("click").click(function () {
  $('#btnAddModalPlanes').attr("disabled", true);
  $("#btnAddModalPlanes").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector('#formAddPlanes')).add(2);
});

$("#btnAddModalTipo").off("click").click(function () {
  $('#btnAddModalTipo').attr("disabled", true);
  $("#btnAddModalTipo").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector('#formAddTipo')).add(7);
});

$("#btnEditModalTipo").off("click").click(function () {
  $('#btnEditModalTipo').attr("disabled", true);
  $("#btnEditModalTipo").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formEditTipo")).edit(8, $("#btnEditModalTipo").attr("idEdit"));
});

$("#bodyPlanes").on("click", "#btnEdit", function () {
  crud().get($(this).attr("idEdit"), 1).then(x => {
    $("#txtNombre").val(x.NombrePlan);
    $("#txtPrecio").val(x.PrecioPlan);
    $("#txtDuracion").val(x.Duracion);
    $("#btnEditModalPlanes").attr("idEdit", x.Id_Planes);
    $("#modalEditPlanes").modal("show");
  });

});

$("#bodyPlanes").on("click", "#btnElim", function () {
  let id = $(this).attr("idElim");
  Swal.fire({
    title: '¿Está seguro de borrar el Plan?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Plan!'
  }).then(function (result) {
    if (result.value) {
      crud().del(4, id);
    }
  });
});

$("#bodyTipos").on("click", "#btnEdit", function () {
  crud().get($(this).attr("idEdit"), 6).then(x => {
    $("#txtNombreTipo").val(x.TipoVehiculo);
    $("#btnEditModalTipo").attr("idEdit", x.Id_Clasificacion);
    $("#modalEditTipo").modal("show");
  });

});

$("#bodyTipos").on("click", "#btnElim", function () {
  let id = $(this).attr("idElim");
  Swal.fire({
    title: '¿Está seguro de borrar el Tipo?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Tipo!'
  }).then(function (result) {
    if (result.value) {
      crud().del(9, id);
    }
  });
});

//Busquedas

$("#txtBusPlanes").on("keyup",function(){
  datosTablas().TPlanes($("#txtBusPlanes").val());
});

$("#txtBusTipos").on("keyup",function(){
  datosTablas().Ttipos($("#txtBusTipos").val());
});