//selling
function selling(producto,nombre){
  prepareModal("Vender " + nombre,"vender","core/sell.php");
  xhr_get("selling.php",modal,{'id':producto});
}
function pedidoDelivery(){
  prepareModal("Nuevo pedido delivery","Guardar","core/pedidoDelivery.php");
  xhr_get('pedidoDelivery.php',modal,null);
}
function updateSell(producto) {
  prepareModal("Modificar venta","Modificar","core/updateSell.php");
  xhr_get('modifySell.php',modal,{'id':producto});
}

function deleteSell(producto) {
  prepareModal("Elimnar venta","Eliminar","core/deleteSell.php");
  xhr_get('deleteSell.php',modal,{'id':producto});
  remDisable();
}
function deleteAllSell() {
  prepareModal("Vaciar venta","Vaciar","core/deleteAllSell.php");
  xhr_get('deleteAllSell.php',modal,null);
  remDisable();
}
function closeSell(total){
  prepareModal("","","core/closeSell.php");
  $('.modalclose').show();
  $('.modal-header').hide();
  $('.modal-footer').hide();
  xhr_get("closeSell.php",modal,{'total':total});
}

$('#payment-button').on('click',function(){
  var a = document.createElement("a");
		a.target = "_blank";
		a.href = 'impresion.php';
		a.click();

});

function addFavoritos(url,search){
  prepareModal("Lista de productos favoritos","Guardar","core/addFavoritos.php")
  xhr_get(url,modal,{'searchFavorito':search})
  remDisable();
}
function cajachica() {
  prepareModal("Registrar gastos","Registrar", "core/cajaChica.php");
  xhr_get('cajaChica.php',modal,null);

}
function cerrarCaja() {
  $('.modal-footer').hide();
  $('#exampleModal').modal('show');
  prepareModal("Cierre de caja","Cerrar caja", "");
  xhr_get("cerrarCaja.php",modal,null);
  remDisable();
}
function abrirCaja() {
  $('#exampleModal').modal({
    backdrop:'static',
    keyboard:false
  })
  $('.close').hide();
  $('.modal-footer').hide();
  $('.modal-header').hide();
  $('#exampleModal').modal('show')

  prepareModal("Abrir caja","Abrir", "core/abrirCaja.php");
  xhr_get('abrirCaja.php',modal,null);
  remDisable();
}




//delivery
function delivered(idpedido){
  prepareModal("Pedido entregado","Entregar pedido", "core/entregarPedido.php");
  xhr_get("entregarPedido.php",modal,{'id': idpedido});
  remDisable();
}
function rejectedPedido(idpedido){
  prepareModal("Pedido rechazado","Guardar", "core/rechazarPedido.php");
  xhr_get("rechazarPedido.php",modal,{'id': idpedido});
}
