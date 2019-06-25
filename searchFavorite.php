
<?php

include 'core/conexion.php';
if(isset($_GET['searchFavorito'])){
  $search=$_GET['searchFavorito'];
  $sql="SELECT idproducto,producto,favoritos FROM productos WHERE producto LIKE '$search%' ORDER BY favoritos DESC LIMIT 0,10";
}else{
  $sql="SELECT idproducto,producto,favoritos FROM productos ORDER BY favoritos DESC LIMIT 0,10";
}

$productos=$con_pdo->query($sql);
echo '
    <table class="table my-2 col-12">';
while ($row=$productos->fetch(PDO::FETCH_ASSOC)) : ?>
<tbody>
  <tr>
    <td> <input class="form-control col-7" <?php if($row['favoritos']) echo " checked" ; ?> type="checkbox" name="idproducto[]" value="<?php echo $row['idproducto'] ?>" data-favorito = "<?php echo $row['favorito']?>"
      data-producto= "<?php echo $row['producto']?>"
      id="idproducto<?php echo $row['idproducto'] ?>"
      /> </td>
    <td> <label for="idproducto<?php echo $row['idproducto'] ?>"><?php echo $row['producto'] ?> </label>  </td>
  </tr>
</tbody>


<? if($row['favoritos']): ?>



<script>
  addFav('<?php echo $row['producto']; ?>')
</script>

<?php
  endif;
endwhile; ?>
</table>
<input type="hidden" name='fav' id="favIn">
<script>

    showfav();
var cantidadMaxima=10


$('input[name="idproducto[]"]').click(function(){
$('#searchFormFavorito').val('');
var contador=0;
  // Recorremos todos los checkbox para contar los que estan seleccionados
  $('input[name="idproducto[]"]').each(function(indice,elemento){
    if($(this).is(":checked"))
      contador++

  })

  // Comprobamos si supera la cantidad máxima indicada
  if(contador>cantidadMaxima){
    $(this).prop('checked', false)
    contador--
  }

  if($(this).is(":checked")){
    if(favoritos.indexOf($(this).attr('data-producto'))<0){
        favoritos.push($(this).attr('data-producto'));
        showfav();
    }
  }else {
    favoritos.splice(favoritos.indexOf($(this).attr('data-producto')),1)
    showfav();
  }
})

function deleteFav(elemento) {

  var elem = $(elemento).attr('data-producto');
  var borrar = favoritos.indexOf(elem);
  if(borrar>-1){
    favoritos.splice(borrar, 1);
    showfav();
    $.post('core/addFavoritos.php', {'fav': $('#favIn').val() } , function (res) {
        console.log(res);
    });
  }
  $('input[name="idproducto[]"]').each(function(){
    if($(this).attr('data-producto')==elem){
      $(this).prop('checked', false)
    }
  })
  showfav();
}


</script>
