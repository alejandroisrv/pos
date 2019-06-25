var modal =$('.modal-body');
var modalTitle=$('.modal-title');
var searchText = $('#searchText');
var btnModal = $('#registerBtn');
var edit= false;
var all=false;

function xhr_get(url,content,information) {
  return $.ajax({
    url: url,
    type: 'get',
    data:information,
    dataType: 'html',
    beforeSend: function(){
      preloader();
    }
  }).done(function(data) {
    if(content!=null)
      content.html(data);
  }).fail(function(data) {
      content.html("<p class='alert alert-danger'> Ha ocurrido un error inesperado en el servidor  </p>")
  })
}

function clear() {
  $("#producto").val("");
  $("#precioCosto").val("");
  $("#precioVenta").val("");
  $("#cantidad").val("");
  $("#producto").focus();

}

function desaparecerAlert() {
    setTimeout(function(){
      $('.result').removeClass('alert-danger');
      $('.result').removeClass('alert-success');
      $('.result').text("");
    },5000)
}
$('.edit').on('click',function(){ edit=true;})
$('.saveEdit').on('click',function(){ edit=false;loadProducts();})
$('.nocturnoMode').on('click',function(){
    xhr_get('changeNocturn.php',null,null).always(function(res) {
      console.log(res);
        location.reload();
    })
});

function remDisable(){
    $('#payment-button').prop('disabled',false);
    btnModal.prop('disabled', false);
}

function addDisable(){
    $('#payment-button').prop('disabled',true);
    btnModal.prop('disabled', true);
}

//preloader
function preloader(){
   modal.html("<img src='assets/img/gif-load.gif' style='margin-left:35%;' />");
}

function prepareModal(titulo,boton,action){
  addDisable();
  modalTitle.text(titulo);
  btnModal.text(boton).button("refresh");
  $('#formSendData').attr('action',action);
}


//Cargar tabla de productos
function loadProducts() {
    var carga = ""
    if(all)
        carga = "all"
    else
        carga = ""

    $.get('product.php', {search : carga}, function(res){
        $(".content-product").html(res);
    });

}

function loadSelling() {
  $(".content-selling").load('sell.php');
}
function loadDelivery() {
  $(".content-delivery").load('delivery.php');
}
function searchProduct(){
    var search = searchText.val();
    $.get('product.php', {search : search }, function(res){
        $(".content-product").html(res);
    }).fail(function(data,err){
        console.log(err)
    })
}
searchText.keyup(searchProduct);
//Cargar Modal
$("#exampleModal").on('hidden.bs.modal', function () {
  $('.modalclose').hide();
  $('.modal-header').show();
  $('.modal-footer').show();
  btnModal.show();
  $('#cancelar').text('Cancelar').button("refresh");
});
$('.modalclose').hide();
