
var pass = true;

function session(){
  
  if (pass == false) {return;}
  var fd = new FormData(document.querySelector(".form"));
  fd.append("opcion","session");
  fetch("controller/usuarios.controller.php",{
    method:"POST",
    body:fd
  })
  .then(function(e){
    return e.text(); 
  })
  .then(function(e){  
    if (e == 1) {
      mensaje("Credenciales incorrectas");
    }else if(e == 2){
      mensaje("Usuario desactivado");
    }else{
      $("#exe").html(e);
    }
  });
    pass = false;
    $("#btn").attr("disabled",true);
      $("#btn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
}

function mensaje(msj){
  $(".login__title").html(msj);
      $(".login__title").attr("style","animation:bounceIn;animation-duration:1s;background-color:red;border-radius:20px;");
      setTimeout(function(){
        $(".login__title").attr("style","");
      },1000);

      setTimeout(function(){
        $(".login__title").html("PARKING");
        $(".login__title").attr("style","animation:zoomIn;animation-duration:0.8s;");
         $("#btn").attr("disabled",false);
                $("#btn").html('Iniciar sesión');
      },1000);
      setTimeout(function(){
        $(".login__title").attr("style","");
        pass=true;

      },2000);
}