<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://rawgit.com/markdalgleish/stellar.js/master/jquery.stellar.js'></script>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <link rel="shortcut icon" href="imagenes/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/funciones.js"></script>
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
    .cuerpo{
        float: right;
        margin-right: 100px;
    }
table{
    position: relative;
    margin: 10px auto;
    padding: 0;
    width: 100%;
    height: auto;
    border-collapse: collapse;
    text-align: center;
}

table > thead.sticky{
    height:42px;
    position:fixed;
    background:#fff;
    width:100% !important;
    margin-top:-40px;
}

table > thead.sticky > tr{
    width:500% !important;
}

table > thead th:nth-of-type(odd) {
   width:10%;
}
table > thead th:nth-of-type(even) {
   width:80%;
}

table > tbody td:nth-of-type(odd) {
   width:10%;
}
table > tbody td:nth-of-type(even) {
   width:80%;
}
tbody.scroll{
    width:100%;  
}
td {
    font-size: 12px;
}
.opciones {
width: 702px;
border: 1px #000000 solid;
margin-left: 290px;

}



#textBox {
width: 700px;
height: 400px;
border: 1px #000000 solid;
padding: 10px;
overflow: scroll;
}
</style>
<script>
    function formatoFuente(sCmd, sValue) {
    document.execCommand(sCmd, false, sValue);
    }
function processFiles(files) {
    var file = files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
    var output = document.getElementById("textBox");
        output.innerHTML = e.target.result;
    };
        reader.readAsText(file);
}

// ---------------------------------------

var dropBox;
    window.onload = function() {
        dropBox = document.getElementById("textBox");
        dropBox.ondragenter = ignoreDrag;
        dropBox.ondragover = ignoreDrag;
        dropBox.ondrop = drop;
    }

function ignoreDrag(e) {
    e.stopPropagation();
    e.preventDefault();
}

function drop(e) {
    e.stopPropagation();
    e.preventDefault();
    var data = e.dataTransfer;
    var files = data.files;
    processFiles(files);

}

// ----------------------------------------

function saveData() {
    var localData = document.getElementById("textBox").innerHTML;
    localStorage["lData"] = localData;
        alert(localData);

}

function loadData() {
    var localData = localStorage["lData"]; 
        if (localData != null) {
            document.getElementById("textBox").innerHTML = localData;
    }
}
</script>
    <div class="cuerpo container" style="margin-right: 200px;">
        <div class="row">
            <div class="col-md-9 col-md-offset-3">
                <form class="form-horizontal" enctype='multipart/form-data' method="POST" action="<?=base_url();?>Cpersona/sendMail">
                    <fieldset>
                        <h1 style="font-weight: 800; text-align: center;">Redactar correo</h1> 
                        <br>
                        <br>
                        <br>
                        <br>        
                        <div class="container">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label style="font-size: 15px; margin-left: 293px;">Destinatarios</label><br />
                                    <input type="button" name="agregardes" id="agregardes" onclick="llenarDestino();correos();" style="font-size: 15px; margin-left: 293px;" value="Agregar Destinatarios">
                                    <input style="margin-left: 293px;" id="email" name="email" type="text" class="form-control" required>
                                    <label style="font-size: 15px; margin-left: 293px;">Asunto</label><br />
                                    <input style="margin-left: 293px;" type="text" class="form-control" name="asunto" id="asunto">
                                    <label style="font-size: 15px; margin-left: 293px;">Mensaje</label><br />
                                </div>
                                <div class="col-md-9" style="float: right;">
                                <label style="font-size: 15px; margin-left: 293px;"></label><br />
                                    <textarea id="mensaje" data-form-field="Message" name="mensaje" rows="15" cols="110"></textarea>
                                </div> 
                            </div>
                            <section class="opciones">
                                <p id="msg"></p>
                                <input type="file" id="file" name="file" />
                                <button id="upload">Cargar</button>
                            </section>

                            <div>
                                <input style="margin-left: 290px;" class="btn btn-primary" type="submit" name="enviar" value="Enviar">
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

<script type="text/javascript">
    function submit() {
    var form = document.getElementById('uploadform');
    form.submit();
  };
</script>
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/clientes.js"></script>

<script type="text/javascript">
    $(document).ready(function (e) {
        $('#upload').on('click', function () {
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: 'http://www.mayordomus.cl/dev/Cpersona/upload_file', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#msg').html(response); // display success response from the server
                },
                error: function (response) {
                    $('#msg').html(response); // display error response from the server
                }
            });
        });
    });
</script>

