$(".tipoMovimientos").on('click',function() {
  cargarMovimientos($(this).attr('data-movimiento'));
});
function cargarMovimientos(tipo) {
  var tipo = tipo;
  $.get('movimientos.php',{'tipo':tipo},function(res) {
      $('.content-history').html(res);
  });
}
cargarMovimientos(0);
$('.vaciarStock').on('click',function(){
    if(confirm("Estas seguro que desea vaciar el stock ")){
        $.get('core/vaciarStock.php',function(res){
        if(res=="OK"){
            $('.result').text("Se ha procesado con exito la informacion");
            $('.result').addClass('alert-success');
            $('.result').removeClass('alert-danger');
        }else{
            $('.result').text("Ha ocurrido un error");
             $('.result').removeClass('alert-success');
            $('.result').addClass('alert-danger');
        }
    })
    }

    
});

$('.nocturnoMode').on('click',function(){
    $.get('changeNocturn.php', function(res){
          console.log(res);
            location.reload();
        
    });
    
});