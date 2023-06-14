

$("#tablePlanes").DataTable({
  responsive:true,
  deferRender:true,
  retrieve:true,
  processing:true,
  language:{
    url:'app/asset/DataTables/lenguaje.json'
  }
});

$("#tableClasificacion").DataTable({
  responsive:true,
  deferRender:true,
  retrieve:true,
  processing:true,
  language:{
    url:'app/asset/DataTables/lenguaje.json'
  }
});



var serve = async (datos,api,res) => {

  let da = await fetch(api,{
                            method:"POST",
                            body:datos
                          });
     let da2;
     if (res == "json") {
      return await da.json();
     }else if(res == "text"){
      $("#joel").html(await da.text());
     }
     
  }

var datosTablas = (op) => {
  let td ="";
  let cont = 0;
  if (op == 1) {
    let fd = new FormData();
    fd.append("op",0);
    serve(fd,"controller/planes.controller.php","json").then(x => {
        x.map(d => { cont++;
          td += "<tr>"+
                  "<td>"+cont+"</td>"+
                  "<td>"+d.NombrePlan+"</td>"+
                  "<td>"+d.PrecioPlan+"</td>"+
                  "<td>"+
                  '<button class="btn btn-primary" idEdit="'+d.Id_Planes+'" id="btnEdit"><i class="bi bi-pen"></i></button>'+
                  '<button class="btn btn-danger" idElim="'+d.Id_Planes+'" id="btnElim"><i class="bi bi-trash"></i></button>'+
                  "</td>"+
                "</tr>"
        });
    $("#bodyPlanes").html(td);
    });
  }
  if (op == 2) {
    let fd = new FormData();
    fd.append("op",5);
    serve(fd,"controller/planes.controller.php","json").then(x => {
        x.map(d => { cont++;
          td += "<tr>"+
                  "<td>"+cont+"</td>"+
                  "<td>"+d.TipoVehiculo+"</td>"+
                  "<td>"+
                  '<button class="btn btn-primary" idEdit="'+d.Id_Clasificacion+'" id="btnEdit"><i class="bi bi-pen"></i></button>'+
                  '<button class="btn btn-danger" idElim="'+d.Id_Clasificacion+'" id="btnElim"><i class="bi bi-trash"></i></button>'+
                  "</td>"+
                "</tr>"
        });
    $("#bodyTipos").html(td);
    });
  }

}

var crud =  (form) => {//SI form es nulo
  let fd = form ? new FormData(form) : new FormData();
  let get = async(id,op) => {
    fd.append("op",op);
    fd.append("id",id);
    return await serve(fd,"controller/planes.controller.php","json");
  }
  let add = (op) => {
    fd.append("op",op);
     serve(fd,"controller/planes.controller.php","text");
  }
  let edit = (op,id) => {
    fd.append("op",op);
    fd.append("id",id);
     serve(fd,"controller/planes.controller.php","text");
  }
  let del = async(op,id) => {
    fd.append("op",op);
    fd.append("id",id);
     serve(fd,"controller/planes.controller.php","text");
  }
  return {
    get,
    add,
    edit,
    del
  };
}


datosTablas(1);


$("#pajinaPlanes").click(function(){
  $("#btnAdd").attr("op",0);
    datosTablas(1);
});

$("#pajinaVehiculos").click(function(){
  $("#btnAdd").attr("op",1);
    datosTablas(2);
});



$("#btnAdd").click(function(){
  if ($("#btnAdd").attr("op") == 0) {
      $("#modalAddPlanes").modal("show");
  }else if ($("#btnAdd").attr("op") == 1) {
    $("#modalAddTipo").modal("show");
  }
});

//CRUD

$("#btnEditModalPlanes").off("click").click(function(){
   $('#btnEditModalPlanes').attr("disabled",true);
   $("#btnEditModalPlanes").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formEditPlanes")).edit(3,$("#btnEditModalPlanes").attr("idEdit"));
});

$("#btnAddModalPlanes").off("click").click(function(){
   $('#btnAddModalPlanes').attr("disabled",true);
   $("#btnAddModalPlanes").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
   crud(document.querySelector('#formAddPlanes')).add(2);
});

$("#btnAddModalTipo").off("click").click(function(){
   $('#btnAddModalTipo').attr("disabled",true);
   $("#btnAddModalTipo").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
   crud(document.querySelector('#formAddTipo')).add(7);
});

$("#btnEditModalTipo").off("click"). click(function(){
   $('#btnEditModalTipo').attr("disabled",true);
   $("#btnEditModalTipo").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  crud(document.querySelector("#formEditTipo")).edit(8,$("#btnEditModalTipo").attr("idEdit"));
});

$("#bodyPlanes").on("click","#btnEdit",function(){
   crud().get($(this).attr("idEdit"),1).then(x => {
    $("#txtNombre").val(x.NombrePlan);
    $("#txtPrecio").val(x.PrecioPlan);
    $("#btnEditModalPlanes").attr("idEdit",x.Id_Planes);
    $("#modalEditPlanes").modal("show");
  });

});

$("#bodyPlanes").on("click","#btnElim",function(){
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
  }).then(function(result){
    if (result.value) { 
      crud().del(4,id);
    }
  });
});

$("#bodyTipos").on("click","#btnEdit",function(){
   crud().get($(this).attr("idEdit"),6).then(x => {
    $("#txtNombreTipo").val(x.TipoVehiculo);
    $("#btnEditModalTipo").attr("idEdit",x.Id_Clasificacion);
    $("#modalEditTipo").modal("show");
  });

});

$("#bodyTipos").on("click","#btnElim",function(){
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
  }).then(function(result){
    if (result.value) { 
      crud().del(9,id);
    }
  });
});