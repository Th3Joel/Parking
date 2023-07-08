
var carga = (btn,page) =>{
    let btns = ["btnVehiculos","btnSuscripcion","btnClientes","btnEspacios","btnInicio"];
    btns.map(x=>{
        if(x === btn){
            $("#"+x).addClass("active");
            
        }else{
         $("#"+x).removeClass("active");
        }
    });
    $("#app").load("app.php",{ruta:page});
}

$(".btnSuscripciones").click(function(){
    carga("btnSuscripcion","suscripciones");
});
$(".btnVehiculos").click(function(){
    carga("btnVehiculos","vehiculos");
});
$(".btnClientes").click(function(){
    carga("btnClientes","clientes");
});
$(".btnEspacios").click(function(){
    carga("btnEspacios","espacios");
});