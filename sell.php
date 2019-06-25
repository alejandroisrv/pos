<?php
    include 'core/conexion.php';
    setlocale(LC_MONETARY,"es_PE");
    $codigo=$_COOKIE['codigo'];
    $sqlSellList="SELECT * FROM venta WHERE codigo='$codigo'";
    $querySellList=$con_pdo->query($sqlSellList);
    if($querySellList->rowCount()>0):
?>
  <table class="table my-2 col-12" id="selling">
      <thead>
        <tr class="col-12">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Sub-Total</th>
            <th></th>

        </tr>
      </thead>
    <tbody>

    <?php while($list=$querySellList->fetch(PDO::FETCH_ASSOC)):?>

        <tr>
            <td>
                <?php echo ucwords(strtolower($list['producto'])); ?>
            </td>
            <td>
                <?php echo $list['cantidad']; ?>
            </td>
            <td>
                <?php
                $subtotal=$list['cantidad']*$list['precio'];
                $total+=$subtotal;
                $productos+=$list['cantidad'];
                echo money_format('%(#10n',$subtotal);
                ?>
            </td>
            <td>
        <button type="button" class="updateSell btn btn-light" data-toggle="modal" data-target="#exampleModal"
            data-sell="<?php echo $list['idventa']; ?>">
            <i class="fas fa-edit"></i>
        </button>
        <button type="button" class=" deleteSell btn btn-danger" data-toggle="modal" data-target="#exampleModal"  data-sell="<?php echo $list['idventa']; ?>">
            <i class="fa fa-trash" aria-hidden="true" ></i></button>
            </td>
        </tr>

    <?php endwhile; ?>
        <tr class="col-12">

            <th>Total:
            </th>
            <th>

            </th>
            <th><?php

                    echo money_format('%(#10n',$total); ?> </th>
        </tr>
        <tr>
          <td>
            <button  data-toggle="modal" data-target="#exampleModal" type="button" class="deleteAllSell btn btn-danger d-inline mx-1">
                <i class="fa fa-trash"></i>
            </button>
            <button type="button" data-sell="<?php echo $total ?>" class="d-inline closeSell btn btn-success p-2 px-4" data-toggle="modal" data-target="#exampleModal" >
              Cobrar
            </button>
            </td>
        </tr>






    </tbody>
  </table>
  <?php else:

      echo '<p class="alert alert-warning col-12" role="alert">No se ha vendido aún<br>
            <small> Intenta vender algún producto</small>
      </p>';

     endif;

    ?>
    <script src="assets/js/sell.js" charset="utf-8"></script>
