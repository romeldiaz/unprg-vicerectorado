$(document).ready(function(){
});


function show_info_user(user_id){
  var op = 'show_info_user';
  var data = {op, user_id};
  var url = '../javascript';

  myPost(url, data, function(response, state){
    if(state=='ok'){
        console.log(response);

        var user = response.user;
        var actividades = response.actividades;
        var metas = response.metas;
        var puntaje = response.puntaje;
        $("#user-nombres").html(user.nombres);
        $("#user-paterno").html(user.paterno);
        $("#user-materno").html(user.materno);
        $("#user-oficina").html(response.oficina.nombre);
        $("#user-actividades").html(actividades['total']);
        $("#user-metas").html(metas.total);
        $("#user-puntaje").html(puntaje.total);
        $('#modalUserInfo').modal('show')

    }
  });
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
