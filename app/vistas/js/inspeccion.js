var url = "controller/inspeccion.controller.php";

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
    let Tins = (input) => {
      fd.append("op",0)
      //Si se crear la variable
        input ? 
          serve(fd,url,"json").then(datos => {
            //llama para renderizar los datos con los datos filtrados
            render(busqueda(datos,input));
          })
        :
        //llama para renderizar todos los datos
          serve(fd,url,"json").then(datos => {
            render(datos);
          });
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

    let render = (d) => {
      let ren = "";
      let cont = 0;
      d.map(x => {
        cont++;
          ren += "<tr>"+
                      "<td>"+cont+"</td>"+
                      "<td>"+x.Placa+"</td>"+
                      "<td>"+x.cliente+"</td>"+
                      "<td>"+x.clasificacion+"</td>"+
                      "<td>"+x.Fecha+"</td>"+
                      "<td>"+x.Hora_Ingreso+"</td>"+
                      "<td>"+x.Hora_Salida+"</td>"+
                      "<td>"+x.Observaciones+"</td>"+
                      "<td>"+
                       "<button class='btn btn-primary' idEdit="+x.Id_Inspeccion+" id='btnEdit'><i class='bi bi-pen'></i></button>"+
                       "<button class='btn btn-danger' idElim="+x.Id_Inspeccion+" id='btnElim'><i class='bi bi-trash'></i></button>"+
                      "</td>"
      });
      if(d.length === 0){
        ren = "<tr><td colspan='8'><h4>No hay datos</h4></td></tr>";
      }
       $("tbody").html(ren);   
    }

    return {
      Tins
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
  

datosTablas().Tins();
//Búsqueda
$("#txtSearch").on("keyup",function(){
    datosTablas().Tins($("#txtSearch").val());
});

//Acciones para agregar
$("#btnAdd").click(function(){
    $("#modalAdd").modal("show");
});

function formAdd(){
  $('#btnAddModal').attr("disabled", true);
    $("#btnAddModal")
    .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    crud(document.querySelector("#formAdd")).add(2);
} 


//Acciones para editar

$("tbody").on("click","#btnEdit",function(){
    crud().get($(this).attr("idEdit"),1).then(d => {
        $("#txtVehiculo").val(d.Id_Vehiculo);
        $("#txtFecha").val(d.Fecha);
        $("#txtHoraIngreso").val(d.Hora_Ingreso);
        $("#txtHoraSalida").val(d.Hora_Salida);
        $("#txtObservaciones").val(d.Observaciones);
        $("#btnEditModal").attr("idEdit",d.Id_Inspeccion)
        $("#modalEdit").modal("show");
    });
});
function formEdit(){
  $('#btnEditModal').attr("disabled", true);
    $("#btnEditModal")
    .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    crud(document.querySelector("#formEdit")).edit(3,$("#btnEditModal").attr("idEdit"));
}


$("tbody").on("click","#btnElim",function(){
    let id = $(this).attr("idElim");
  Swal.fire({
    title: '¿Está seguro de borrar la inspección?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Inspección!'
  }).then(function (result) {
    if (result.value) {
      crud().del(4, id);
    }
  });
});