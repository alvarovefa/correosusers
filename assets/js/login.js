$(document).on("ready",main);

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
					window.location.href = "http://localhost/empresa/Cpersona/verLista";
				}
			}
		});
	});
}

function cerrar(){

		$.ajax({
			url:"http://localhost/empresa/login/cerrar",
			type:"POST", 
			data:{},
			success:function(){
				if (confirm('¿Está seguro que desea cerrar sesión?')) {					
					window.location.href = "http://localhost/empresa";
				}
			}
		});

	
}

