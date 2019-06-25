$("#product").tablesorter();
$('.updateProduct').on('click',function() {
  updateProducto($(this).attr('data-producto'));
})
$('.deleteProducto').on('click',function() {
  deleteProducto($(this).attr('data-producto'));
});

$('.sellProduct').on('click',function() {

    selling($(this).attr('data-producto'),$(this).attr('data-nombre'));

});
