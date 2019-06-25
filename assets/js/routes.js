function routes(route) {
  var content = $('#content');
  var ruta="pages/"+route+".php"
  return $.ajax({
    url: ruta,
    type: 'get',
    data:null,
    dataType: 'html',
    beforeSend: function(){
        content.html("<img src='../assets/img/gif-load.gif' style='margin-left:40%;margin-top:30px;width:110px;' />");
    }
  }).done(function(data) {
      content.html(data)
  }).fail(function(data) {
      content.html("<p class='alert alert-danger'> Ha ocurrido un error inesperado en el servidor  </p>")
  })
}



$('.routes').on('click',function() {
    routes($(this).attr('route'));
});
