$(document).on("ready",main);

//verifico que los datos de acceso estén correctos

function main(){

	$("#login").submit(function(event){
		event.preventDefault();
		$.ajax({
			url:$(this).attr("action"),
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success: function(resp){
				if(resp==="error"){
					alert("Usuario o Contraseña inválidos");
					$("#login")[0].reset();
					$("#email").focus();
				}else{
					window.location.href = "http://mail.mayordomus.cl/Cpersona/verLista";
				}
			}
		});
	});
}

//evento onclick en botón cerrar sesión

function cerrar(){

		$.ajax({
			url:"http://mail.mayordomus.cl/login/cerrar",
			type:"POST", 
			data:{},
			success:function(){
				if (confirm('¿Está seguro que desea cerrar sesión?')) {					
					window.location.href = "http://mail.mayordomus.cl";
				}
			}
		});

	
}

