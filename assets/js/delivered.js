$('.entregarPedido').on('click', function() {
  $('#exampleModal').modal('show');
  delivered($(this).attr('data-pedido'));
});
$('.rechazarPedido').on('click', function() {
  $('#exampleModal').modal('show');
  rejectedPedido($(this).attr('data-pedido'));
});

$('#observaciones').keyup(function(){
  if($('#observaciones').val()==""){
      addDisable()
  }else {
      remDisable()
  }
});
