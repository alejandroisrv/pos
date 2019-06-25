
function deleteProduct(elemento) {
  swal({
    title: "¿Estas seguro que deseas borrar este producto?",
    text: "Desaparecerá de tu lista de producto",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
  }).then(function(isConfirm){
    if (isConfirm) {
      $.get("core/deleteProduct.php",{'idproducto':$(elemento).attr('data-producto')},function(respuesta) {
          if(respuesta=="OK"){
            routes('inventario')
            swal("Elimnado", "El producto ha sido eliminado", "success");
          }else{
            swal("No se ha eliminado", "Su producto no se ha eliminado del inventario.", "error");
          }
      });

    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
  });
}


$('.modalLoad').on('click',function() {
    modalLoad(this)
});
