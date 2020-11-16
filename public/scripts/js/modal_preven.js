  $(document).ready(function(){
    console.log(fuente, org, partida, reg, ub);
    if (fuente != "" && org != "" && partida != "" && reg > 0)
      $('#btn-pdf').removeAttr('disabled');

    // if (fuente != "" && org != "" && partida != "" && ub != "" && reg > 0)
    if (fuente != "" && org != "" && ub != "" && reg > 0)
      $('#btn-pdf2').removeAttr('disabled');

    $('#btn-pdf').click(function(){
      if ($(this).attr('disabled') != 'disabled') {
        var form = $('#form-filter');
        form.attr('action', url_pdf);
        form.submit();
        form.attr('action', url_preventivos);
      }

    });

    // Boton para descargar compras menores
    $('#btn-pdf2').click(function(){
      if ($(this).attr('disabled') != 'disabled') {
        var form = $('#form-filter');
        form.attr('action', url_pdf_menores);
        form.submit();
        form.attr('action', url_menores);
      }

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

    $('#t').change(function(){
      var tipo = $(this).val();
      $('#ub').empty();
      $('#ub').append("<option value='' disabled selected style='display:none;'>ubicacion</option>");
      
      $.ajax({
          url: (tipo == 1) ? url_ubicaciones_men : url_ubicaciones_dir,
          type: 'get',
          dataType: 'json',
          data: {"id": tipo},
          success: function (response) {
              $.each(response.data, function (index, value) {
                  $('#ub').append("<option value='" + value.id_ubicacion + "'>"+value.id_ubicacion+". "+ value.ubicacion + "</option>");
              });
          }
      });
      
    });

    $('.btn-view').click(function(){
      var row = $(this).parents('tr');
      var id = row.data('id');
      var data = "id="+id+"&_token="+token;
      var url = url_view;
      var type = "json";
      $.post(url, data, function(data){
        $('#preventivo').html(data.preventivo);
        $('#importe').html(data.importe);
        $('#pagado').html(data.pagado);
        if (data.secretaria)
          $('#secretaria').html(data.secretaria+' ('+data.sigla+')');
        else
          $('#secretaria').html();
        $('#unidad').html(data.unidad);
        $('#detalle').html(data.glosa);
        $('#fecha_elab').html(data.fecha_elab);
        $('#fuente').html(data.fuente);
        $('#organismo').html(data.organismo);
        $('#id_objeto').html(data.id_objeto);
        var label = (data.label) ? data.label : "default";
        $('#tipo').html("<span class='label label-"+label+"'>"+data.tipo+"</span>");

        if (data.porcent){
          if (data.id_ubimen)
            $('#ubicacion').html(data.ubimen);
          else
            $('#ubicacion').html(data.ubidir);
          var color = 'green';
          if (data.porcent <= 25) color = 'red';
          if (data.porcent > 26 && data.porcent <= 50) color = 'yellow';
          if (data.porcent > 51 && data.porcent <= 75) color = 'aqua';
          $('#porcent_barra').removeClass();
          $('#porcent_barra').addClass('progress-bar progress-bar-'+color);
          $('#porcent_barra').width(data.porcent+'%');
          $('#porcent_data').removeClass();
          $('#porcent_data').addClass('badge bg-'+color);
          $('#porcent_data').html(data.porcent+'%');
          $('#progreso').show();
        }
        else{
         $('#progreso').hide();
       }
       $('#estado').html(data.estado);

       var obs = 'NINGUNO';
       if (data.observaciones)
        obs = data.observaciones;
      $('#obs').html(obs);

      var des = 'SIN CLASIFICAR';
      if (data.desembolso){
        switch (data.desembolso){
          case 24: des = "24 MILLONES"; break;
          case 23: des = "23 MILLONES"; break;
        }
      }
      $('#desembolso').html(des);

      var link = url_edit+"/preventivos/edit/"+data.id_preventivo;
      $('#btn_edit').attr('href', link);
    }, type);
    });

  });