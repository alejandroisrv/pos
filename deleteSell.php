<?php
  include 'core/conexion.php';
  session_start();

if (isset($_GET['id'])):
   $id=$_GET['id'];
   $queryUpdateProductos=$con_pdo->query("SELECT * FROM venta WHERE idventa='$id'");
    if($queryUpdateProductos->rowCount()>0):
    while($productos=$queryUpdateProductos->fetch(PDO::FETCH_ASSOC)): ?>
    <p>¿Estas seguro que desea eliminar este producto de la venta?</p>
       <div class="form-inline align-items-self-start text-center">
            <div class="form-row text-left px-5">
                <input type="hidden"
                         value="<?php echo $productos['idventa'] ?>"
                         name="idventa">
                <input type="hidden"
                  value="<?php echo $productos['idproducto'] ?>"
                  name="idproducto" required>
            </div>





            <script>
            remDisable();
            $('#registerBtn').text('Eliminar').button("refresh");
            </script>
     <?php
     endwhile;

    endif;


 endif; ?>
