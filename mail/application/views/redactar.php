 <meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://rawgit.com/markdalgleish/stellar.js/master/jquery.stellar.js'></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/normalize.css" />
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
                <form id="form" class="form-vertical" enctype='multipart/form-data' method="POST" action="<?=base_url();?>Cpersona/sendMail">
                    <fieldset>
                        <h1 style="font-weight: 800; text-align: center;">Redactar correo</h1> 
                        <br>
                        <br>
                        <br>
                        <br>        

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <label style="font-size: 15px;">Destinatarios</label><br />
                                    <input type="button" name="agregardes" id="agregardes" onclick="llenarDestino();" style="font-size: 15px;"  value="Agregar Destinatarios">
                                    <input class="form-control" id="email" name="email" type="text" class="form-control" required>
                                    <label style="font-size: 15px;">Asunto</label><br />
                                    <input class="form-control" type="text" class="form-control" name="asunto" id="asunto">
                                    <label style="font-size: 15px;">Mensaje</label><br />
                                    <textarea id="editor" name="mensaje"></textarea>
                                    <p id="msg"></p>
                                    Nombre de archivo no debe contener espacios en blanco
                                    <input type="file" id="file" name="file" />No envíar hasta que se muestre mensaje de carga<br />
                                    <input class="btn btn-primary" type="submit" name="enviar" onclick="loading()" id="enviar" value="Enviar">
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>             
    <div style="margin-top: -800px; float: left;">    
            <?php $this->load->view("clientes"); ?>
    </div>
    <div class="modal fade" id="loader" role="dialog">
      <div class="modal-dialog">

          <img style="margin-top: 10%; margin-left: 50%; margin-right: 50%;" src="../assets/images/loading.gif">

      </div> 

<script type="text/javascript">
    function submit() {
    var form = document.getElementById('uploadform');
    form.submit();
  };
</script>
<script type="text/javascript">
  
  function loading(){

    $('#form').on('submit', function(){
    $('#loader').modal('show');


    });

  }

</script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/clientes.js"></script>

<script type="text/javascript">
    var editor = new Simditor({
    textarea: $('#editor')

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
                 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/clientes.js"></script>
    <script type="text/javascript">

    </script>

