

<form class="form-inline pb-3" id='searchForm'>
  <input class="form-control col-12" type="search" placeholder="Prueba buscar aquí" aria-label="Search" id='searchFormFavorito' />
</form>
<div class="seleccionados col-12"> </div>
<div class="content-favoritos">

</div>


<script>
var seleccionados = $('.seleccionados');
var favoritos =  [];
function showfav() {
  seleccionados.empty();
  favoritos.forEach(function (elemento) {
      seleccionados.append("<button title='Eliminar' alt='Eliminar' type='button' onclick='deleteFav(this)' style='margin:1px 2px' class='favoritosButton btn btn-light d-inline' data-producto='"+elemento+"' >"+elemento+ " </button>")
      $('input[name="idproducto[]"]').each(function(){
        if($(this).attr('data-producto')==elemento){
          $(this).prop('checked', true)
        }
      })
  })
  $('#favIn').val(favoritos);
}
$('.content-favoritos').html("<img src='assets/img/gif-load.gif' style='margin-left:35%;' />")
$('.content-favoritos').load('searchFavorite.php')
$("#searchFormFavorito").keyup(function(){
  $.get('searchFavorite.php',{searchFavorito: $(this).val()}, function(res) {
    $('.content-favoritos').html(res);
    showfav();
  })
})

function addFav(elemento) {
  if(favoritos.indexOf(elemento)<0){
      favoritos.push(elemento);
  }
}





</script>
