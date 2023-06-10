

function pajina(rut,id){
$("#"+id).load("app.php",{ruta:rut});
}
pajina("inicio","app");

$("#btnSalir").click(function(){
        pajina("salir","joel");
     });

$("#btnConfig").click(function(){
  $("#btnConfig").addClass("active");
  $("#sistema").addClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnUsers").removeClass("active");
$("#btnClientes").removeClass("active");
  pajina("config","app");
});
 
$("#btnInicio").click(function(){
  $("#btnInicio").addClass("active");
  $("#btnConfig").removeClass("active");
  $("#btnUsers").removeClass("active");
$("#btnClientes").removeClass("active");
$("#sistema").removeClass("active");
  pajina("inicio","app");
});

$("#btnUsers").click(function(){
  $("#btnUsers").addClass("active");
  $("#sistema").addClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
$("#btnClientes").removeClass("active");
  pajina("users","app");
});



$("#btnClientes").click(function(){
    $("#btnClientes").addClass("active");   
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  pajina("clientes","app");
});