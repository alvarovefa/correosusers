<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Domus</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sx-3" style="width: 350px;">
				<div>
					<div class="col-sx-3" style="width: 250px; padding-left: 15px">
						<select class="form-control" name="categoria" id="categoria">
							<option disabled selected>Seleccione Categoría</option>
							<?php foreach ($cat as $cats): ?>
							<option value="<?php echo $cats->id_categoria ?>"><?php echo $cats->nombre ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div style="float: right;">
						<button onclick="#" class="btn btn-default">Buscar</button>
					</div>
					<div class="panel-heading">
						<input type="text" class="form-control" name="busqueda" placeholder="Buscar por nombre o empresa" />
						<p>	
							<input type="checkbox" name="check" id="checkTodos" value="">Marcar/Desmarcar Todo
						</p>
						<p>
					</div>
					<div class="panel-body" style="overflow-x: scroll; overflow-x: hidden; height: 500px; ">
						<table style="width: 300px;" id="tbclientes" class="table table-bordered">
							<tbody>
								<tr>
									<th>Enviar</th>
									<th>Contacto</th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	
  $("#categoria").change(function() {
    $.ajax({
      type: "POST",
      url: "<? base_url()?>/CategoriaC",
      success: function(data){
        var json = $.parseJSON(data);
        $('#categoria').find('option').remove();
        $('#categoria').append('<option disabled selected>Seleccione Categoria</option>');
        json.forEach(function(element) {
          $('#categoria').append('<option value="' + element.id_categoria + '">' + element.nombre + '</option>');
        });
      }
    });
  });
</script>
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/clientes.js"></script>

  </body>
</html>