var url_controller = '../javascript';
var dominio = 'http://localhost/unprg5/public/oficinas/';
$(document).ready(function(){

  if($("#id").val()!=0){
    url_controller = '../'+url_controller;
  }

  $('#search_word').keyup(function(){
    consultar_oficinas_por_nombre($(this).val());
  });

  //consultar_oficinas_por_nombre("");
});


function consultar_oficinas_por_nombre(nombre){
  var op = 'consultar_oficinas_por_nombre';
  var data = {op, nombre};

  myPost(url_controller, data, function(response, state){
    if(state=='ok'){
      console.log(response);
      show_oficinas(response);
    }
  });
}

function show_oficinas(response){
  var token = $("input[name=_token]").val();
  var html = '';
  for(var i in response){
    html += '<tr>';
      html += '<td>'+response[i].id+'</td>';
      html += '<td>'+response[i].nombre+'</td>';
      html += '<td>';
        html += '<div class="d-flex flex-row-reverse">';
          html += '<div class="form-inline">';
            html += '<form method="POST" action="'+dominio+response[i].id+'" accept-charset="UTF-8">';
              html += '<input name="_method" type="hidden" value="DELETE">';
              html += '<input name="_token" type="hidden" value="'+token+'">';
              html += '<button type="submit" class="btn btn-sm btn-secondary">Eliminar</button>';
              html += '</form>';
          html += '</div>';
          html += '<a href="'+dominio+response[i].id+'/edit" class="btn btn-sm btn-success mr-1">Editar</a>';
        html += '</div>';
      html += '</td>';
    html += '</tr>';
  }
  $("#table-body-oficinas").html(html);
}

function myPost(url, data, callback){
  $.ajax({
      url: url,
      headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
      type: 'post',
      data: data,
      success:function(data){
        return callback(data, 'ok');
      },
      error: function(e){
        return callback(e,'error' )
      }
  });
  return callback(null, 'none');
}
