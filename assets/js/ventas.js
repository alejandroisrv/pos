$('.dates').hide();
$('.hideDate').hide();
var modal =$('.modal-body');
var modalTitle=$('.modal-title');
function preloader(){
   modal.html("<img src='../gif-load.gif' style='margin-left:35%;' />");
}
$('.nocturnoMode').on('click',function(){
    $.get('changeNocturn.php', function(res){
          console.log(res);
            location.reload();
        
    });
    
});
$('.selectDate').on('click', function(){
    $('.dates').fadeIn(300);
    $('.hideDate').show();

});
$('.hideDate').on('click', function(){
        $('.dates').fadeOut(300);
        $('.hideDate').hide();
        
});

$('#searchVentas').on('click', function(){
    
    var desde = $("#desde").val();
    var hasta = $("#hasta").val();
    
    $.get('ventaHistorial.php', {'desde':desde,'hasta':hasta},function(res){
        
        $('.content-history').html(res);
        
    });
    
});

$('.content-history').load('ventaHistorial.php');

$('.deVenta').on('click', function(){
  var codigo = $(this).attr('data-codigo');
  var fecha = $(this).attr('data-fecha');
  $('.modal-title').text(" Detalle de venta " + codigo );
  $.get('detalleVenta.php',{'codigo':codigo,'fecha':fecha},function(res) {
    $('.modal-body').html(res);
  });
    
});


