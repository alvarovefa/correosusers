<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Domus</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php 
    $tipo = $this->session->userdata('tipo');
      if ( $tipo == "1") {
        $this->load->view('navbar'); 
      }else{
        $this->load->view('usernavbar');
      }
      ?>
<br />
<br />
<br />
                
  <div class="container">
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Agregar contacto </button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
					<th>Categoría</th>
					<th>Empresa</th>
					<th>Contacto</th>
					<th>Correo</th>
					<th>Teléfono</th>
          <th>Alias</th>

          <th style="width:125px;">Administrar
          </p></th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($books as $book){?>
				     <tr>
                  <td><?php echo $book->id;?></td>
                  <td><?php echo $book->nombre;?></td>
                  <td><?php echo $book->nombre_empresa;?></td>
                  <td><?php echo $book->contacto;?></td>
                  <td><?php echo $book->correo;?></td>
                  <td><?php echo $book->celular;?></td>
                  <td><?php echo $book->alias;?></td>
                  <td>
									<button class="btn btn-warning" onclick="edit_book(<?php echo $book->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_book(<?php echo $book->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


								</td>
				      </tr>
				     <?php }?>
</tbody>

      <tfoot>
        <tr>
          <th>ID</th>
          <th>Categoría</th>
          <th>Empresa</th>
          <th>Contacto</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Alias</th>
        </tr>
      </tfoot>
    </table>

  </div>

  <script src="<?php echo base_url('assets/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assets/js/login.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add_book()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_book(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('/book/ajax_edit/')?>/" +id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="categoria"]').val(data.nombre);
            $('[name="empresa"]').val(data.nombre_empresa);
            $('[name="contacto"]').val(data.contacto);
            $('[name="correo"]').val(data.correo);
            $('[name="celular"]').val(data.celular);
            $('[name="alias"]').val(data.alias);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Contacto'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error obteniendo datos');
        }
    });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('/book/book_add')?>";
      }
      else
      {
        url = "<?php echo site_url('/book/book_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error agregando / Actualizando');
            }
        });
    }


    function delete_book(id)
    {
      if(confirm('¿Estás seguro de hacer esto?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('/book/book_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error borrando la información');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Contacto</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Categoría</label>
              <div class="col-md-9">
                <select class="form-control" name="categoria" id="categoria">
                  <option disabled selected>Seleccione Categoría</option>
                  <?php foreach ($cat as $cats): ?>
                  <option value="<?php echo $cats->id_categoria ?>"><?php echo $cats->nombre ?></option>
                  <?php endforeach; ?>
              </select>
                
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Empresa</label>
              <div class="col-md-9">
                <input name="empresa" placeholder="Empresa" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Contacto</label>
              <div class="col-md-9">
								<input name="contacto" placeholder="Contacto" class="form-control" type="text">

              </div>
            </div>
						<div class="form-group">
							<label class="control-label col-md-3">Correo</label>
							<div class="col-md-9">
								<input name="correo" placeholder="Correo" class="form-control" type="text">
							</div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Celular</label>
              <div class="col-md-9">
                <input name="celular" placeholder="Celular" class="form-control" type="tel">
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Alias</label>
              <div class="col-md-9">
                <input name="alias" placeholder="Alias" class="form-control" type="text">
              </div>
						</div>
          </div>
        </form>
      </div>
      
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  </body>
</html>
