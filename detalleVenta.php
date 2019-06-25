
<?php 

setlocale(LC_MONETARY,"es_PE");
include 'core/conexion.php';
$codigo=$_GET['codigo'];
$querySell=$con_pdo->query("SELECT * FROM venta WHERE codigo='$codigo' ");

?>

       <?php  echo '<style>
            .modal-dialog {
                 max-width: 700px !important;;
            }
            #muestra td,th{
                font-size:0.9rem !important;
                font-family:Arial;
                
            }
            
            
            #muestra small {
                margin-right:10px;
                display:inline-block;
            }

        </style>
        <div class="col-12 p-2" id="muestra">
            
            <table class="col-12w">
                <thead class="text-center">
                <tr><td>Licoreria </td></tr>
                <tr>
                    <td>
                        '.$_GET['fecha'].'
                    </td>
                </tr>
                </thead>
        </table>

        <table class="col-12">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';?>
            
   <?php  while($sell=$querySell->fetch(PDO::FETCH_ASSOC)):
        
        $idproducto=$sell['idproducto'];
       echo ' <tr class="itemProducto">
                    <th>'.$sell['cantidad'].'</th>
                    <td>'.ucwords(strtolower($sell['producto'])).'</td>
                    <td></td>
                    <td></td>
               </tr>';
               $precioCosto=$sell['precioCosto'];
               $queryDetalle=$con_pdo->query("SELECT cantidad,precio,producto,modo,DATE_FORMAT(fecha,'%d/%m/%Y las %h:%i:%s %p') AS fecha_nueva FROM detalle WHERE codigo='$codigo' AND idproducto='$idproducto' ORDER BY idproducto ASC");
               while ($detalle=$queryDetalle->fetch(PDO::FETCH_ASSOC)) {
                   echo "<tr class='".$detalle['idproducto']." detalle' style='font-size:0.7rem !important;margin-top:3px 0px;'>
                            <td style='font-size:0.7rem !important;margin-top:3px 0px;'>".$detalle['cantidad']."</td>
                            <td style='font-size:0.7rem !important;margin-top:3px 0px;'>".$detalle['producto']."</td>
                            <td style='font-size:0.7rem !important;margin-top:3px 0px;'>".money_format('%(#10n',$detalle['precio'])."</td>
                            <td style='font-size:0.7rem !important;margin-top:3px 0px;'>".$detalle['fecha_nueva']."</td>
                            <td style='font-size:0.7rem !important;margin-top:3px 0px;'>".ucfirst($detalle['modo'])."</td>
                        </tr>";
                $subtotal+=$detalle['precio']*$detalle['cantidad'];

                $precioCostoGeneral+=$precioCosto*$detalle['cantidad'];

               }
        $ganancia+=$subtotal-$precioCostoGeneral;
        $cantidad+=$sell['cantidad']; $total+=$subtotal; endwhile;
        
        echo '</tbody>
                    <tr>
                        <th>Total de productos</th>
                        <th></th>
                        <th></th>
                        <th>'.$cantidad.'</th>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>'.money_format('%(#10n',$total).'</th>
                    </tr>
                    <tr>
                        <th>Ganancia en esta venta</th>
                        <th></th>
                        <th></th>
                        <th>'.money_format('%(#10n',$ganancia).'</th>
                    </tr>
                </table>
        </div>';
        
        
        
        ?>
        
        <button type='button' class="btn btn-success" id="print">Imprimir</button>
        <script type="text/javascript">
        function imprSelec(muestra){
                var ficha=document.getElementById(muestra);
                var ventimp=window.open(' ','popimpr');
                ventimp.document.write(ficha.innerHTML);
                ventimp.document.close();
                ventimp.print();
                ventimp.close();
                $('#exampleModal').modal('hide');
                
              }
        $('#print').on('click', function(){
            imprSelec('muestra');
        });
            
              
              
        </script>
        
        <input type="hidden" name="body" value='<?php echo $body; ?>' />
        <input type="hidden" name="total" value='<?php echo $total; ?>' />

        <script>
           
            $('.itemProducto').on('click', function(){
                var id = $(this).attr('data-producto');
                $('.'+id).show();

                $('.itemProducto').on('click',function() {
                     $('.'+id).hide();
                })

            });
        </script>