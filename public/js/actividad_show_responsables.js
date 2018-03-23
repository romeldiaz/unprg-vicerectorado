var responsables = [];
var resultados = [];
var url_controller = ''
$(document).ready(function(){

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    url_controller = 'post_js';


    cargar_responsables(function(state){
      console.log('Responsables cargados!')
      search_usuario_by_nombre('');
    });




    $("#search_by_oficinas").change(function(){
      $("#search_word").val('');
      search_usuario_by_oficina($(this).val(), function(){});
    });

    $('#search_word').keyup(function(){
      search_usuario_by_nombre($(this).val());
    });

});


function search_usuario_by_oficina(oficina_id, callback){
    var op = 'select_usuario_by_oficina';
    var page = $("input[name=page]").val();
    var data = {oficina_id, op};
    var url = 'actividad_js';


    myPost(url_controller, data, function(response, state){
      if(state=='ok'){

        resultados = response;
        var html = '';
        for(var i in resultados){
          html += '<tr>';
            html += '<td>'+resultados[i].id+'</td>';
            html += '<td>'+resultados[i].nombres+'</td>';
            html += '<td><a href="javascript: seleccionar_uno('+resultados[i].id+')" class="btn btn-sm btn-secondary"><span id="span_'+resultados[i].id+'" class="'+marcar_responsable(resultados[i])+'"></td>';
          html += '</tr>';
        }
        $("#search_results").html(html);
        callback(state);
      }

    });
}

function search_usuario_by_nombre(usuario_nombre){
  var op = "search_usuario_by_nombre";
  var oficina_id = $("#search_by_oficinas").val();
  var data = {op, oficina_id, usuario_nombre};

  myPost(url_controller, data, function(response, state){
    if(state=='ok'){
      resultados = response;
      var html = '';
      for(var i in resultados){
        html += '<tr>';
          html += '<td>'+resultados[i].id+'</td>';
          html += '<td>'+resultados[i].nombres+'</td>';
          html += '<td><a href="javascript: seleccionar_uno('+resultados[i].id+')" class="btn btn-sm btn-secondary"><span id="span_'+resultados[i].id+'" class="'+marcar_responsable(resultados[i])+'"></td>';
        html += '</tr>';
      }
      $("#search_results").html(html);
    }
  });
}

function marcar_responsable(usuario){
  for(var i in responsables){
    if(responsables[i].id===usuario.id){
      return "icon-checkmark";
      break;
    }
  }
  return "icon-plus";
}

function span_check(id){//marca
  var span = $("#span_"+id).attr('class','icon-checkmark');;
}

function span_uncheck(id){//desmarca
  var span = $("#span_"+id).attr('class','icon-plus');;
}

function seleccionar_varios(usuario_id){
  if($("#span_"+usuario_id).attr('class')=='icon-plus'){
    for(var i in resultados){
      agregar_a_responsables(resultados[i]);
      span_check(resultados[i].id);
    }
    span_check(usuario_id);
  }else{
    for(var i in resultados){
      span_uncheck(resultados[i].id);
      quitar_de_responsables(resultados[i].id);
    }
    span_uncheck(usuario_id);
  }
  console.log(responsables);
}

function seleccionar_uno(usuario_id){
  if($("#span_"+usuario_id).attr('class')=='icon-plus'){
    usuario = get_user(usuario_id);
    agregar_a_responsables(usuario);
    span_check(usuario_id);
  }else{
    quitar_de_responsables(usuario_id);
    span_uncheck(usuario_id)
  }
  console.log(responsables);
}

function ver_seleccionados(){//acutaliza la tabla visula de responsables
  var num = 0;
  var html = '';
  for(var i in responsables){
    num++;
    html += '<tr>';
      html += '<td><input size="1" readonly style="border-width:0; background-color: transparent" type="text" name="usuarios[]" value="'+responsables[i].id+'"></td>';
      html += '<td>'+responsables[i].nombres+'</td>';
      html += '<td class="text-right"><a href="javascript: quitar_de_responsables('+responsables[i].id+')" class="btn btn-sm btn-light"><span class="icon-cross"></span></td>';
    html += '</tr>';
  }
  $("#responsables_selected").html(html);
}

function agregar_a_responsables(usuario){
  //verificamos si aun no esta en la lista de responsable
  var agregado = false;
  for(var i in responsables){
    if(responsables[i].id==usuario.id){
      agregado = true;
      break;
    }
  }
  if(!agregado){
    responsables.push(usuario);
    ver_seleccionados();
  }

}

function quitar_de_responsables(usuario_id){
  for(i=0; i<responsables.length; i++){
    if(responsables[i].id==usuario_id){
      responsables.splice(i,1);
      span_uncheck(usuario_id);
      ver_seleccionados();
      break;
    }
  }
}

function cargar_responsables(callback){
  var actividad_id = $('input[name=actividad_id]').val();
  var op = 'consultar_responsables';
  var data = {op, actividad_id};
  var url = 'actividad_js';

  myPost(url_controller, data, function(response, state){
    if(state=='ok'){
      console.log(response);
      responsables = response;
      ver_seleccionados();
      callback(state);
    }

  });
}

function marcar_resultado(id){
  $("#result_"+id).attr("checked", true);
}

function get_user(id){
  for(var i in resultados){
    if(resultados[i].id==id){
      return resultados[i];
      break;
    }
  }
  return null;
}

function myPost(url, data, callback){
  $.ajax({
      url: url,
      headers: {'X-CSRF-TOKEN': $("input[name=_token]").val()},
      type: 'post',
      data: data,
      success:function(data){
        callback(data, 'ok');
      },
      error: function(e){
        callback(e,'error' )
      }
  });
  callback(null, 'none');
}
