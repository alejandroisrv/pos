var modal= $('.modal-body');
function request  (url,data,content) {
  return $.ajax({
    url: url, type: 'get', data:data, dataType: 'html',
    beforeSend: function(){
        content.html("<img src='../assets/img/gif-load.gif' style='margin-left:40%;margin-top:30px;width:110px;' />");
    }
  }).done(function(res) {
      content.html(res)

  }).fail(function() {
      content.html("<p class='alert alert-danger'> Ha ocurrido un error inesperado en el servidor  </p>")
      return console.log(data)
  })

}
$('#form-modal').on('submit',function(e) {
    var ruta=$(this).attr('route');
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'), type: 'post', data:$(this).serialize(), dataType: 'html',
      beforeSend: function(){
          modal.html("<img src='../assets/img/gif-load.gif' style='margin-left:40%;margin-top:30px;width:110px;' />");
      }
    }).done(function(res) {
      if(res!="OK"){
          modal.html("<p class='alert alert-danger'> Ha ocurrido un error al procesar la informacion</p>")
          console.log(res);
      }else {
        routes(ruta);
        $("#myModalone").modal("hide");
      }


    }).fail(function(data) {
        modal.html("<p class='alert alert-danger'> Ha ocurrido un error inesperado en el servidor  </p>");
        return console.log(data);
    })
});



function formModal(action,boton,route){
  $('#form-modal').attr('action',"core/"+action+".php");
  $('#form-modal').attr('route',route);
  $("#btn-modal").text(boton).button("refresh");
}
function modalLoad(elemento){
  $("#myModalone").modal("show");
  request($(elemento).attr('url')+'.php',{'idproducto':$(elemento).attr('data-producto')},modal);
  formModal($(elemento).attr('url'),"Guardar",$(elemento).attr('redirect'));
}
