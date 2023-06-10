
 function empresa(){
 					$("#btnEmpresaDisplay").html("<button id='btnEmpresaConfig' class='btn btn-primary animate__animated animate__rubberBand' disabled><div class='spinner-grow spinner-grow-sm' role='status'></div></button>");
          var fd = new FormData(document.querySelector("#formEmpresa"));
          fd.append("opcion",1);
          fetch("controller/config.controller.php",{
            method:"POST",
            body:fd
          })
          .then(function(e){ 
            return e.text();
          })
          .then(function(e){
            $("#joel").html(e);
            $('#btnEmpresaDisplay').html("<button class='btn btn-primary' disabled>Guardar</button>");
          });
        }
function perfil(){
	$('#btnPerfil').html("<div class='spinner-grow' role='status'></div>");
	$('#btnPerfil').attr('disabled',true);
	var fd = new FormData(document.querySelector("#formPerfil"));
	fd.append("opcion",2);
	fetch("controller/config.controller.php",{
		method:"POST",
		body:fd
	})
	.then(function(e){
		return e.text();
	})
	.then(function(e){
		$("#joel").html(e);
		$('#btnPerfil').html("Guardar");
	});
}
function users(){
	$('#btnUse').html("<div class='spinner-grow spinner-grow-sm' role='status'></div>");
	$('#btnUse').attr('disabled',true);
	var fd = new FormData(document.querySelector("#formUser"));
	fd.append("opcion",3);
	fetch("controller/config.controller.php",{
		method:"POST",
		body:fd
	})
	.then(function(e){
		return e.text();
	})
	.then(function(e){
		$("#joel").html(e);
		$("#btnUse").html("Guardar");
	});
}
function Pass(){
	$("#btnPass").html("<div class='spinner-grow spinner-grow-sm' role='status'></div>");
	$('#btnPass').attr('disabled',true);
	var fd = new FormData(document.querySelector("#formPasswd"));
	fd.append("opcion",4);
	fetch("controller/config.controller.php",{
		method:"POST",
		body:fd
	})
	.then(function(e){
		return e.text();
	})
	.then(function(e){
		$("#joel").html(e);
		$("#btnPass").html("Guardar"); 
	});
}


        
   function cambiar(img,inp,imgSrc){
        const imajen = img;
      const input = inp;
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
        imajen.src =imgSrc;
       // $("#img").attr("src","<?php echo $empresa['logo']; ?>");
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
        //$('#InputImg').attr('style','border:1px solid red;transition:1s;width: 350px;margin-top: 13px;padding:4px;');
        input.style="border:1px solid red;transition:1s;width: 300px;margin-top: 13px;padding:4px;";
                  setTimeout(function(){
                   // $('#InputImg').attr('style','transition:1s;width: 350px;margin-top: 13px;padding:4px;');
                    //},1000);
                    input.style="transition:1s;width: 300px;margin-top: 13px;padding:4px;";
                  },1000);
        
      }
}