var datosEspacios = [];
function datos(){
	var fd = new FormData();
	fd.append("op",'');
	fetch("controller/espacios.controller.php",{
		method:"POST",
		body:fd
	})
	.then(d => {
		return d.json();
	})
	.then(d => {
		datosEspacios = d;
		MostrarDatos(datosEspacios);
	});
}

datos();

$("#txtBuscar").on("keyup",()=>{
	MostrarDatos(buscar($("#txtBuscar").val()));
});

function buscar(term) {
  return datosEspacios.filter(objeto => {
    for (let key in objeto) {
      if (objeto[key].toLowerCase().includes(term.toLowerCase())) {
        return true;
      }
    }
    //return false;
  });
}


function MostrarDatos(da){
	let f = "";
	if (da.length === 0) {
		f="<h1>No hay resultados</h1>";
	}else{
		da.map(es => {
			if(es.Estado == 'Ocupado'){
				f += 
				'<div class="col tarjetaRed">'+
					'<h5>( '+es.NumeroParqueo+' )</h5>'+
					'<p class="title">'+es.Estado+' por</p>'+
					'<h5>Joel Calderon Urbina</h5>'+
					'<h4>Motocicleta</h4>'+
					'<h4>MAT-65G</h4>'+
					'<div class="botones">'+
						'<button class="btn btn-primary" idEdit="'+es.Id_Parqueo+'" id="btnEdit"><i class="bi bi-pen"></i></button>'+
					'</div>'+
				'</div>'
				;
			}else if(es.Estado == 'Libre'){
				f += 
				'<div class="col tarjetaGreen">'+
					'<h5>( '+es.NumeroParqueo+' )</h5>'+
					'<h3>'+es.Estado+'</h3>'+
					'<div class="botones">'+
						'<button class="btn btn-primary" idEdit="'+es.Id_Parqueo+'" id="btnEdit"><i class="bi bi-pen"></i></button>'+
						'<button class="btn btn-danger" idElim="'+es.Id_Parqueo+'" id="btnElim"><i class="bi bi-trash"></i></button>'+
					'</div>'+
				'</div>'
				;
			}
		});
	}
	$(".tarjetas").html(f);
	$(".tarjetas").addClass("animate__animated animate__fadeIn animate__fast");
	setTimeout(()=>{
		$(".tarjetas").removeClass("animate__animated animate__fadeIn animate__fast");
	},800);
}


$("#btnAdd").click(function(){
  $("#modalAdd").modal("show");
});

function add(){
 $('#btnAddModal').attr("disabled",true);
 $("#btnAddModal").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
 var fd = new FormData(document.querySelector("#formAdd"));
 fd.append("op",1);
 fetch("controller/espacios.controller.php",{
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


$(".tarjetas").on("mouseenter",".tarjetaRed",function(){
	$(this).find(".botones").slideDown(200);
});

$(".tarjetas").on("mouseleave",".tarjetaRed",function(){
	$(this).find(".botones").fadeOut(200);
});

$(".tarjetas").on("mouseenter",".tarjetaGreen",function(){
	$(this).find(".botones").slideDown(200);
});

$(".tarjetas").on("mouseleave",".tarjetaGreen",function(){
	$(this).find(".botones").fadeOut(200);
});

$(".tarjetas").on("click","#btnEdit",function(){
	  let fd = new FormData();
	  fd.append("op",2);
	  fd.append("id",$(this).attr("idEdit"));
	  fetch("controller/espacios.controller.php",{
	    method:"POST",
	    body:fd
	  })
	  .then(function (e) {
	    return e.json();
	  })
	  .then(function(e){
	    $("#txtNombre").val(e.NumeroParqueo);
	    $("#btnEditModal").attr("idEdit",e.Id_Parqueo);
	    $("#modalEdit").modal("show");
	  });
})

function Edit(){
  $('#btnEditModal').attr("disabled",true);
  $("#btnEditModal").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
  var fd = new FormData(document.querySelector("#formEdit"));
  fd.append("op",3);
  fd.append("id",$("#btnEditModal").attr("idEdit"));
  fetch("controller/espacios.controller.php",{
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

$(".tarjetas").on("click","#btnElim",function(){
	 var fd = new FormData();
  fd.append("op",4);
  fd.append("id",$(this).attr("idElim"));
  
  Swal.fire({
    title: '¿Está seguro de borrar el Espacio?',
    text: "¡Si no lo está puede cancelar la acción!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then(function(result){
    if (result.value) { 
      fetch("controller/espacios.controller.php",{
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
})