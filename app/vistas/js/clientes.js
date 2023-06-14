$("#tableClientes").DataTable({
  responsive:true,
  deferRender:true,
  retrieve:true,
  processing:true,
  language:{
    url:'app/asset/DataTables/lenguaje.json'
  }
});

$("#btnAdd").click(function(){
  $("#modalAdd").modal("show");
});

function add(){
 $('#btnAddModal').attr("disabled",true);
 $("#btnAddModal").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
 var fd = new FormData(document.querySelector("#formAdd"));
 fd.append("op",1);
 fetch("controller/cliente.controller.php",{
   method:"POST",
   body:fd
 })
 .then(function(e){
   return e.text();
 })
 .then(function(e){
   $("#joel").html(e);
   $(".txtModalBody input").val("");
 });
}

$("#tableClientes").on("click","#btnEdit",function(){
  let fd = new FormData();
  fd.append("op",2);
  fd.append("id",$(this).attr("idEdit"));
  fetch("controller/cliente.controller.php",{
    method:"POST",
    body:fd
  })
  .then(function (e) {
    return e.json();
  })
  .then(function(e){
    $("#txtNombre").val(e.Nombre);
    $("#txtApellido").val(e.Apellido);
    $("#txtDireccion").val(e.Direccion);
    $("#txtTelefono").val(e.Telefono);
    $("#txtCorreo").val(e.Correo);
    $("#btnEditModal").attr("idEdit",e.Id_Cliente);
    $("#modalEdit").modal("show");
  });
});

function Edit(){
  $('#btnEditModal').attr("disabled",true);
  $("#btnEditModal").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  var fd = new FormData(document.querySelector("#formEdit"));
  fd.append("op",3);
  fd.append("id",$("#btnEditModal").attr("idEdit"));
  fetch("controller/cliente.controller.php",{
    method:"POST",
    body:fd
  })
  .then(function(e){
    return e.text();
  })
  .then(function(e){
    $("#joel").html(e);
  });
}

$("#tableClientes").on("click","#btnElim",function(){
  var fd = new FormData();
  fd.append("op",4);
  fd.append("id",$(this).attr("idElim"));
  fd.append("token",$(this).attr("token"));
  



  Swal.fire({
    title: '¿Está seguro de borrar el cliente?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then(function(result){
    if (result.value) { 
      fetch("controller/cliente.controller.php",{
        method:"POST",
        body:fd
      })
      .then(function(e){
        return e.text();
      })
      .then(function(e){
        
        $("#joel").html(e);
      });
    }



  });
});