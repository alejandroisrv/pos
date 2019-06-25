function addProduct() {
  prepareModal("Añadir nuevo producto al Inventario","Añadir producto","core/addProduct.php");
  xhr_get('modifyProduct.php',modal,null);
  remDisable();
}
function updateProducto(producto) {
  prepareModal("Modificar producto","guardar","core/updateProduct.php");
  xhr_get('modifyProduct.php',modal,{'id':producto});
}

function deleteProducto(producto) {
  var product = producto;
  if(confirm("Estas seguro que deseas eliminar este producto del inventario ?")){

        $.get('core/deleteProduct.php',{'id':product},function(res) {

            if(res=="  OK" || res=="OK" ){
              loadProducts();
              $(".result").addClass('alert-success');
              $(".result").removeClass('alert-danger');
              $(".result").html("Se ha eliminado el producto");
            }else {
              loadProducts();
              $(".result").removeClass('alert-success');
              $(".result").addClass('alert-danger');
              $(".result").html("Ha ocurrido un error");
            }
      });
  }
}


function cargarRegisterVenta() {
  remDisable();
  prepareModal('Registrar salida de productos','Registrar','core/registerVenta.php')
  xhr_get('registerVenta.php',modal,null)
}
function cargarRegisterEntrada() {
    remDisable()
    prepareModal('Registrar entrada de productos al inventario','Registrar','core/registerEntrada.php')
    xhr_get('registerEntrada.php',modal,null)
}


$('.hideAll').hide();
$('.showAll').on('click',function(){
       $(this).hide();
       $('.hideAll').show();
       all=true;
    $.get('product.php', {search : 'all' }, function(res){
        $(".content-product").html(res);
    });
})

$('.hideAll').on('click',function(){
       $(this).hide();
       all=false;
       $('.showAll').show();
    $.get('product.php', {search : '' }, function(res){
        $(".content-product").html(res);
    });
})
