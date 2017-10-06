<nav class="navbar navbar-inverse  navbar-fixed-top" style="background-color: #245379">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Domus</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?= base_url('book/book')?>">Contactos</a></li>
        <li><a href="<?= base_url('CategoriaC')?>">Redactar</a></li>
        <li><a href="<?= base_url('user/user')?>">Usuarios</a></li>
        <li><a href="<?= base_url('HistorialC')?>">Historial</a></li>
        <li><a href="<?= base_url('TerrenosC')?>">Terrenos</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <br>
        <li>  
          <label style="color: white; font-size: 18px;"><?= $this->session->userdata('name')?></label>
        </li>
        <li>
          &emsp; &emsp;
        </li>
        <li>  
          <button class="btn btn-default" onclick="cerrar()">Cerrar sesión
          </button>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<script type="text/javascript"></script>
<script>
  function cerrar(){

    $.ajax({
      url:"http://localhost/empresa/login/cerrar",
      type:"POST", 
      data:{},
      success:function(){
        if (confirm('¿Está seguro que desea cerrar sesión?')) {         
          window.location.href = "http://localhost/empresa";
        }
      }
    });

  
}
</script>