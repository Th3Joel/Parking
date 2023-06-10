
$("#tableCate").DataTable({
  responsive:true,
  deferRender:true,
  retrieve:true,
  processing:true,
  language:{
    url:'app/asset/DataTables/lenguaje.json'
  }
});
$("#AddCate").click(function(){
  $("#modalAddCate").modal("show");
});

function addCate(){
 $('#btnAddCate').attr("disabled",true);
 $("#btnAddCate").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
 var fd = new FormData(document.querySelector("#formAdd"));
 fd.append("op",1);
 fetch("controller/categoria.controller.php",{
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

$("#tableCate").on("click","#btnEdit",function(){
  let fd = new FormData();
  fd.append("op",2);
  fd.append("id",$(this).attr("idEdit"));
  fetch("controller/categoria.controller.php",{
    method:"POST",
    body:fd
  })
  .then(function (e) {
    return e.json();
  })
  .then(function(e){
    $("#categoria").val(e.nombre);
    $("#btnEditCate").attr("idEdit",e.id_categoria);
    $("#modalEditCate").modal("show");
  });
});

function EditCate(){
  $('#btnEditCate').attr("disabled",true);
  $("#btnEditCate").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  var fd = new FormData(document.querySelector("#formEdit"));
  fd.append("op",3);
  fd.append("id",$("#btnEditCate").attr("idEdit"));
  fetch("controller/categoria.controller.php",{
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

$("#tableCate").on("click","#btnElim",function(){
  var fd = new FormData();
  fd.append("op",4);
  fd.append("id",$(this).attr("idElim"));
  fd.append("token",$(this).attr("token"));
  



  Swal.fire({
    title: '¿Está seguro de borrar la categoría?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar categoría!'
  }).then(function(result){
    if (result.value) { 
      fetch("controller/categoria.controller.php",{
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