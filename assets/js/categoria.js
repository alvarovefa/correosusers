
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
