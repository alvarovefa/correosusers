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
			<div class="col-sx-3" style="width: 300px;">
				<div>

					<div class="col-sx-3" style="float: left; width: 66%; padding-left: 4%;">
						<select class="form-control" name="categoria" id="categoria">
							<option disabled selected>Seleccione Categoría</option>
							<?php foreach ($cat as $cats): ?>
							<option value="<?php echo $cats->id_categoria ?>"><?php echo $cats->nombre ?></option>
							<?php endforeach; ?>
						</select>
						<br>
					</div>
					<div class="panel-heading" style="padding-right: 10%">
						<input type="text" class="form-control" name="busqueda" placeholder="Buscar por nombre o empresa" />
						<p>
							<input type="checkbox" name="check" id="checkTodos" value="">Marcar/Desmarcar Todo
						</p>
						<p>
					</div>
					<div class="panel-body" style="overflow-x: auto; height: 500px;">
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


	<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/clientes.js"></script>


  </body>
</html>
