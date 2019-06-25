$("#selling").tablesorter();
$('.sellProduct').on('click',function() {
    selling($(this).attr('data-producto'),$(this).attr('data-nombre'));

});
$('.updateSell').on('click',function() {
    updateSell($(this).attr('data-sell'));

});
$('.deleteSell').on('click',function() {

    deleteSell($(this).attr('data-sell'));

});
$('.deleteAllSell').on('click',function() {
  deleteAllSell()

});

$('.closeSell').on('click',function() {
    closeSell($(this).attr('data-sell'));

});
