
$(document).on("ready", main);

$("#checkTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  });

function main(){

	$("select[name=categoria]").change(function(){
		valorBuscar2 = $(this).val();
		mostrarDatos2(valorBuscar2);
	});
}


function mostrarDatos2(valorBuscar){

	$.ajax({
		url : "http://localhost/empresa/CategoriaC/mostrarCat",
		type: "POST",
		data: {categoria: valorBuscar},
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


	    //$("#email").val(seleccion);	

	    $("#email").val( function( index, val ) {
	    return val + seleccion + ",";
			});
	

   
}

	