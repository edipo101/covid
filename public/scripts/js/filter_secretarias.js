  $(document).ready(function(){
    $('#id_secretaria').change(function(){
      var id_secretaria = $(this).val();
      $('#id_unidad').empty();
      $.ajax({
        url: url_unidades,
        type: 'get',
        dataType: 'json',
        data: {"id": id_secretaria},
        success: function (response) {
            $('#id_unidad').append("<option value='' disabled selected style='display:none;'>Seleccione una opcion</option>");
            $.each(response.data, function (index, value) {
                $('#id_unidad').append("<option value='" + value.id_unidad + "'>"+ value.unidad + "</option>");
            });
        }
      });
    });

    $('#f').change(function(){
      var fuente = $(this).val();
      $('#o').empty();
      $('#o').append("<option value='' disabled selected style='display:none;'>Organismo</option>");
      if (fuente == 20){
        $('#o').append("<option>210</option>");
        $('#o').append("<option>230</option>");
      }
      else if (fuente == 41){
        $('#o').append("<option>111</option>");
        $('#o').append("<option>113</option>");
        $('#o').append("<option>119</option>");
      }
    });    

  });