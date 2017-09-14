<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Domus</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sx-3" style="width: 350px;">
				<div>
					<div class="panel-heading">
						<input type="text" class="form-control" name="busqueda" placeholder="Buscar" />
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
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/clientes.js"></script>

  </body>
</html>