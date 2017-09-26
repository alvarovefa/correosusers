<!DOCTYPE html>
<html lang="en">
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
	<meta charset="UTF-8">
	<title>Domus</title>
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
	<div class="form-group container col-md-10 col-md-offset-1">
		<div class="form-group">
<br>
<br>
<br>
		<div class="jumbotron">
			<p class="lead text-center text-uppercase">
				Seleccione la imagen que usará como firma
			</p>
		</div>
			<div class="form-group">
				<p id="msg"></p>
					<input type="file" id="file" name="file" />
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function (e) {
    $('#file').on('change', function () {
      var file_data = $('#file').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
        url: 'http://localhost/empresa/User/upload_firma', 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            $('#msg').html(response);
        },
        error: function (response) {
            $('#msg').html(response);
        }
      });
    });
  });
</script>