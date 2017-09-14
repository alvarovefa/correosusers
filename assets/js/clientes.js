
$(document).on("ready", main);

$("#checkTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  });

function main(){
	mostrarDatos("",1);

	$("input[name=busqueda]").keyup(function(){
		valorBuscar = $(this).val();
		mostrarDatos(valorBuscar,1);
	});
}


function mostrarDatos(valorBuscar){

	$.ajax({
		url : "http://localhost/ci_crud/Cpersona/mostrar",
		type: "POST",
		data: {buscar: valorBuscar},
		dataType:"json",
		success:function(response){
			
			
			filas = "";
			$.each(response.clientes,function(key,item){
				filas+="<tr><td><input type='checkbox' id='check' value="+item.correo+"></td><td>"+item.contacto+"<br />"+item.correo+"<br />"+item.nombre_empresa+"</td></tr>";
			});
			$("#tbclientes tbody").html(filas);

		}
	});

}
function llenarDestino(){
    // Comprobar los checkbox seleccionados
    var seleccion = new Array();
	    $('input[type=checkbox][id=check]:checked').each(function() {
	        seleccion.push($(this).val());
	    });
	    $("#email").val(seleccion);		

   
}

	