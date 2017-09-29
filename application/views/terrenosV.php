<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Domus</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/login.js')?>"></script>
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
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Código</th>
          <th>Ciudad</th>
          <th>Comuna</th>
          <th>Descripción</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach($regs as $reg){?>
             <tr>
                  <td><?php echo $reg->codigo;?></td>
                  <td><?php echo $reg->ciudad;?></td>
                  <td><?php echo $reg->comuna;?></td>
                  <td><?php echo $reg->desc;?></td>
              </tr>
             <?php }?>
</tbody>

      <tfoot>
        <tr>
          <th>Código</th>
          <th>Ciudad</th>
          <th>Comuna</th>
          <th>Descripción</th>
        </tr>
      </tfoot>
    </table>

  </div>

  <script src="<?php echo base_url('assets/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>


  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
  </script>
  </body>
</html>
