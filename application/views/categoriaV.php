
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <select name="categoria" id="categoria">
    <option disabled selected>Seleccione Categoría</option>
    <?php foreach ($cat as $cats): ?>
      <option value="<?php echo $cats->id_categoria ?>"><?php echo $cats->nombre ?></option>
    <?php endforeach; ?>
  </select>

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
