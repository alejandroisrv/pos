$('.modalLoad').on('click',function () {
  $("#myModalone").modal("show")
  request($(this).attr('url')+'.php',$(this).attr('data-producto'),modal)
  formModal($(this).attr('url'),"Guardar")
  alert("Ejecutando")
})
