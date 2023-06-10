
 
 $(document).ready(function () {
    $('#tableUser').DataTable({
      'responsive':true,
      'deferRender': true,
  'retrieve': true,
  'processing': true,
  'language': {
            url: 'app/asset/DataTables/lenguaje.json'
        }
    });
});



function cambiar(img,inputImg,srcc){
  const imajen = img;
  const input = inputImg;
  const archivo = input.files[0];
  const lector = new FileReader();

  if (archivo && archivo.type.startsWith('image/')) {
    lector.addEventListener('load',function(){
      imajen.src = lector.result;
    });
    if (archivo) {
      lector.readAsDataURL(archivo);
    }
  }else{
    imajen.src = srcc;
    input.value="";
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
              title: 'Solo se permiten imajenes'
              });
    input.style="border:1px solid red;transition:1s;width: 300px;margin-top: 13px;padding:4px;";
                  setTimeout(function(){
                   // $('#InputImg').attr('style','transition:1s;width: 350px;margin-top: 13px;padding:4px;');
                    //},1000);
                    input.style="transition:1s;width: 300px;margin-top: 13px;padding:4px;";
                  },1000);
    
  }
}

function AddUsuario(){
  var fd = new FormData(document.querySelector("#formUsuario"));
  fd.append("opcion",0);
  fetch("controller/usuarios.controller.php",{
    method:"POST",
    body:fd
  })
  .then(function(e){
    return e.text();
  })
  .then(function(e){
    $("#joel").html(e);
  });
$("#btnAddUser").attr("disabled",true);
$("#btnAddUser").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
}






  function EditUser(){
      $("#btnEditUser").attr("disabled",true);
    let fd = new FormData(document.querySelector("#formUserEdit"));
    fd.append("opcion",4);
    fetch("controller/usuarios.controller.php",{
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
   
$("#tableUser").on('click','#btnEdit',function(){
  $("#idEdit").val($(this).attr("idUSer"));
  let fd = new FormData();
  fd.append("opcion",3);
  fd.append("id",$(this).attr("idUSer"));
  fetch("controller/usuarios.controller.php",{  
    method:"POST",
    body:fd
  })
  .then(function(e){
    return e.json();
  })
  .then(function(e){
     $("#nombreEdit").val(e.nombre);
     $("#correoEdit").val(e.correo);
     $("#contactoEdit").val(e.contacto);
     $("#cedulaEdit").val(e.cedula);
     $("#userEdit").val(e.usuario);
     $("#tipoEdit").val(e.tipo);
     $("#img2").attr("src",e.img);
     $("#img2").attr("im",e.img);
      $("#modalUserEdit").modal("show");
  });
});

$("#tableUser").on('click','#btnElim',function(){
          let fd = new FormData();
                    fd.append("opcion",2);
          fd.append("token",$(this).attr("token"));
          fd.append("id",$(this).attr("idUSer"));
  Swal.fire({
        title: '¿Está seguro de borrar el usuario?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
      }).then(function(result){
        if (result.value) { 
          fetch("controller/usuarios.controller.php",{
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



  $("#tableUser").on("click","#btnEstado",function(){
    let btn = $(this).attr("status");
    let fd = new FormData();
    fd.append("opcion",5);
    fd.append("id",$(this).attr("idUser"));
    fd.append("token",$("#tokenEstado").val());
    fetch("controller/usuarios.controller.php",{
      method:"POST",
      body:fd
    });
    
  if (btn == 1) {
           $(this).attr("class","btn btn-danger");
            $(this).html("Desactivado");
             $(this).attr("status",0);
            
          }else if (btn == 0) {
            $(this).attr("class","btn btn-success");
            $(this).html("Activado");
            $(this).attr("status",1);
          }
  });