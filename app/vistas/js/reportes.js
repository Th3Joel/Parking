var dActuales = () => {
    // Obtener la fecha actual
    var fechaActual = new Date();

    // Obtener los componentes de la fecha
    var año = fechaActual.getFullYear();
    var mes = ("0" + (fechaActual.getMonth() + 1)).slice(-2); // Los meses van de 0 a 11, por eso se suma 1
    var dia = ("0" + fechaActual.getDate()).slice(-2);

    // Formatear la fecha
    var fechaFormateada = año + "-" + mes + "-" + dia;

     // Salida: aaaa/mm/dd}
     $("#fechaInit").val(fechaFormateada);
     $("#fechaFinal").val(fechaFormateada);
     $("#fecha").val(fechaFormateada);
}

dActuales();
Planes =  () => {
    let form = document.querySelector("#formPlanes");
    console.log(form.target.fechaInit.value);
}

//Reporte de la factura de suscripcion
var optionsFactSuscripcion = () =>{
    let fd = new FormData();
    fd.append("op",0);
    fetch("controller/suscripciones.controller.php",{
        method:"POST",
        body:fd
    })
    .then(x => {
        return x.json();
    })
    .then(x =>{
        x.map(d => {
            $("#selectSuscripcion").append("<option value="+d.Id_Suscripcion+">"+d.Cliente+"( "+d.Marca+" "+d.Placa+" )</option>");
        });
        
    });
}
optionsFactSuscripcion();

var ValidateDate = (inicio,final,btn) => {
    if(!inicio.val() || !final.val()) return;
    if(inicio.val() > final.val()){
        var Toast = Swal.mixin({
            toast:true,
            position: 'top-end',
            showConfirmButton:false,
            timer:2000,
            timerProgressBar:true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter',Swal.stopTimer);
                toast.addEventListener('mouseleave',Swal.resumeTimer);
            }
            });
            Toast.fire({
                icon:'error',
                title: 'La fecha de inicio no debe ser mayor a la final'
                });
        btn.attr("disabled",true);
    }else{
        btn.attr("disabled",false);
    }
}

$("#inicio1").change(function(){
    ValidateDate($("#inicio1"),$("#final1"),$("#btn1"));
});

$("#final1").change(function(){
    ValidateDate($("#inicio1"),$("#final1"),$("#btn1"));
});


$("#inicio2").change(function(){
    ValidateDate($("#inicio2"),$("#final2"),$("#btn2"));
});

$("#final2").change(function(){
    ValidateDate($("#inicio2"),$("#final2"),$("#btn2"));
});


$("#inicio3").change(function(){
    ValidateDate($("#inicio3"),$("#final3"),$("#btn3"));
});

$("#final3").change(function(){
    ValidateDate($("#inicio3"),$("#final3"),$("#btn3"));
});

var ventana = (url) =>{
    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
    width=0,height=0,left=-1000,top=-1000`;
    
    open(url, "test", params);
}