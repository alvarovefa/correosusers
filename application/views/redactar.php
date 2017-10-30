<!DOCTYPE html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://rawgit.com/markdalgleish/stellar.js/master/jquery.stellar.js'></script>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/simditor.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/module.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/uploader.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/simditor.js"></script>
<title>Domus</title>
  <style type="text/css">
    .bs-twrapper{
    width: 30%;
    height:500px;
    overflow-x:scroll;
    overflow-x:hidden;
    padding-top:10px;
    margin-top: -350px;
    margin-left: 100px;
    float: left;
  }

  .opciones {
  width: 702px;
  border: 1px #000000 solid;
  margin-left: 290px;

  }

  </style>

    <?php
    $tipo = $this->session->userdata('tipo');
    if ( $tipo == "1") {
      $this->load->view('navbar');
    }else{
      $this->load->view('usernavbar');
    }
    ?>
<br>
<br>
<br>

<div class="container" style="margin-right: 100px;">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <form id="form" class="form-horizontal" enctype='multipart/form-data' method="POST" action="<?=base_url();?>Cpersona/sendMail">
                <fieldset>
                  <div class="form-group">
                      <div class="col-md-6">
                          <label style="font-size: 15px; margin-left: 215px;">Destinatarios</label><br />
                          <input type="button" name="agregardes" id="agregardes" onclick="llenarDestino();" style="font-size: 15px; margin-left: 215px;" value="Agregar Destinatarios">
                          <input style="margin-left: 215px;" id="email" name="email" type="text" class="form-control" required>
                          <label style="font-size: 15px; margin-left: 215px;">Asunto</label><br />
                          <input style="margin-left: 215px;" type="text" class="form-control" name="asunto" id="asunto"><br>
                      </div>

                      <div class="col-md-6" style="margin-left: 215px;">
                          <select class="form-control" name="terreno" id="terreno">
                            <option disabled selected>Seleccione Terreno</option>
                            <?php foreach ($terreno as $ter): ?>
                            <option value="<?php echo $ter->id_terreno ?>"><?php echo $ter->codigo ?></option>
                            <?php endforeach; ?>
                          </select>
                        <br>
                      </div>
                      <div class="col-md-9" style="float: right;">
                        <label style="font-size: 15px; margin-left: 0%;">Mensaje</label><br />
                          <textarea id="editor" name="mensaje">
                            <? $this->load->view('firma'); ?>
                          </textarea>
                      </div>
                  </div>
                  <section>

                      <div style="margin-left: 215px;">
                      <p id="msg"></p>
                      <input type="file" id="file" name="file" />
                      </div>
                  </section>
                  <div>
                      <br />
                      <input style="margin-left: 215px;" class="btn btn-primary" type="submit" onclick="loading()" name="enviar" value="Enviar">

                  </div>
                <div class="modal fade" id="loader" role="dialog">
                  <div class="modal-dialog">

                      <img style="margin-top: 10%; margin-left: 50%; margin-right: 50%;" src="../assets/images/loading.gif">

                  </div>
                </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div style="margin-top: -600px; float: left;">
        <?php $this->load->view("clientes"); ?>
</div>
<script>
  $(document).ready(function (e){
    $('#file').on('change', function () {
      var cadena = $('#file').val();
      cadena= cadena.replace(/\s/g,"_");
      document.getElementById('file').innerHTML = cadena;
    }
  }
</script>
<script>
$(document).on("ready", main);
function main(){
  $("select[name=terreno]").change(function(){
    dato = $(this).val();
    datosTerreno(dato);

  });
}
function datosTerreno(dato){

	$.ajax({
		url : "http://localhost/empresa/TerrenosC/template/" + dato,
		type: "POST",
		data: {terreno: dato},
		dataType:"json",
		success:function(response){

			filas = "";
			$.each(response.ter,function(key,item){
				filas+="<p>"+item.codigo+"</p>";
			});
      $("#text").val(filas);
			$("#editor").val(filas);

		}
	});

}
</script>
<script type="text/javascript">

  function loading(){

    $('#form').on('submit', function(){
    $('#loader').modal('show');


    });

  }

</script>

<script type="text/javascript">
    function submit() {
    var form = document.getElementById('uploadform');
    form.submit();
  };
</script>

<script type="text/javascript">
    var editor = new Simditor({
    textarea: $('#editor'),
    placeholder: 'Escribir mensaje',

});

</script>

<script type="text/javascript">
  $(document).ready(function (e) {
    $('#file').on('change', function () {
      var file_data = $('#file').prop('files')[0];
      var form_data = new FormData();

      form_data.append('file', file_data);
      $.ajax({
        url: 'http://mail.mayordomus.cl/Cpersona/upload_file',
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

<script src="<?php echo base_url('assets/js/login.js')?>"></script>
<script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/clientes.js"></script>
