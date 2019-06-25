$( window ).on( "load", function() {
   $('.preloader').css('display', 'none');

function loadModal(tipo){
  remDisable();
  switch (tipo) {

    case 'registerVenta':
      cargarRegisterVenta();
    break;
    case 'registerEntrada':
        cargarRegisterEntrada();
    break;
    
    case 'addProduct':
        addProduct();
      break;
    case 'selling':
        selling();
    break;
    case 'favoritos':
          addFavoritos('addfavoritos.php',null);
      break;
      case 'cajachica':
        cajachica();
        break;
    case 'pedidoDelivery':
          pedidoDelivery();
    break;
    default:
      break;

  }

}

//controlando los click

$('.loadModal').on('click', function () {
  loadModal($(this).attr('data-tipo'));
});
$('.cerrarSesion').on('click',function () {
  cerrarCaja();
});
$('.changeModo').on('click', function(){
    $.get('changeModo.php', {'modoventa': $(this).attr('data-modo')}, function(res){
      if(res=="OK"){
        location.reload();
      }else{
        $('.result').text("Ha ocurrido un error");
        $('.result').addClass("alert-danger")
      }
    })
  });
});
loadProducts();
loadSelling();
loadDelivery();
