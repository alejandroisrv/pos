$("#formSendData").on('submit', function(e) {
  e.preventDefault();
  $.ajax({
   type: $('#formSendData').attr('method'),
   url: $('#formSendData').attr('action'),
   data: $('#formSendData').serialize(),
   beforeSend: preloader(),
   success: function (res) {
     $(".result").fadeIn(400);
    if(res=="  OK" || res=="OK" ){
      $('#exampleModal').modal('hide');
      $(".result").addClass('alert-success');
      $(".result").removeClass('alert-danger');
      $(".result").html("Se ha procesado la informacion");
    }else{
        console.log(res);
      $('.modal-body').html("<p class='alert alert-danger'>Ha ocurrido un error</p>");
    }
      loadProducts();
      loadSelling();
      loadDelivery();
      desaparecerAlert();
   }

 }).fail(function (res) {
   console.log(res);
 $('.modal-body').html("<p class='alert alert-danger'>Ha ocurrido un error</p>");
 })

  return false;
});
