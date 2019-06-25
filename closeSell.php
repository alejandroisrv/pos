<?php
session_start();
      setlocale(LC_MONETARY,"es_PE");
      $total=str_replace(',','.', $_GET['total']);
?>
  <div id="pay-invoice">
    <div class="card-body pt-0">
      <div class="card-title">
        <?php if($_COOKIE['modoventa']=="delivery" || $_COOKIE['modoventa']=="domicilios.com"):?>
        <h3 class="text-center">Pedido</h3>
      <?php else:?>

        <h3 class="text-center">Método de pago</h3>
      <?php endif;?>
      </div>
    <hr>
    <?php if($_COOKIE['modoventa']=="delivery" || $_COOKIE['modoventa']=="domicilios.com"):?>
        <center>
        <div class="form-row form-inline text-center">
          <input type="text" name="nombre" value="" placeholder="Nombre" class="form-control col- 6 ml-1 mr-1">
          <input type="text" name="telefono" value="" placeholder="Télefono" class="form-control col-5 ml-1">
        </div>
        <div class="form-row">
          <input type="text" name="direccion" value="" placeholder="Dirección" class="form-control col-11 m-1 mt-2">
          <input type="text" name="observaciones" value="" placeholder="Observaciones " class="form-control col-11 m-1 mt-2">
        </div>
      </center>

   <?php endif;?>
   <?php if($_COOKIE['modoventa']!="domicilios.com"): ?>
     <div class="form-group text-center">
       <?php if($_COOKIE['modoventa']=="delivery"):?>
       <p class="m-3 mt-4 h4">Método de pago</p>
        <?php endif;?>
      <ul class="list-inline">
        <li class="list-inline-item px-3 py-2"><i class="text-muted far fa-credit-card fa-2x d-block metodoPago" data-metodo='visa'></i>Visa</li>
        <li class="list-inline-item px-2 py-2"><i class="text-muted far fa-money-bill-alt fa-2x d-block metodoPago" data-metodo='efectivo'></i>Efectivo</li>
        <li class="list-inline-item px-2 py-2"><img class="text-muted d-block metodoPago" src="https://live.pystatic.com/webassets/whitelabel/domicilios/logo-smartbanner-aacdacbc1e9866f7563298ded2fa39c5.png"  data-metodo="Domicilios.com" style="height: 45px;margin-top: -37px;margin-left: 28px;">Domocilios.com</li>
      </ul>
    </div>
    <div class="form-group text-center my-4 px-0 metodoCuadro" id='efectivo'>
        <button type="button" name="pagoCon" class="btn btn-light billete mx-1" data-billete="10">S/. 10</button>
        <button type="button" name="pagoCon" class="btn btn-light billete mx-1" data-billete="20">S/. 20</button>
        <button type="button" name="pagoCon" class="btn btn-light billete mx-1" data-billete="50">S/. 50</button>
        <button type="button" name="pagoCon" class="btn btn-light billete mx-1" data-billete="100">S/. 100</button>
        <div class="form-group text-center my-4" id='vueltoNegativo'>
          <label for="total">Otro monto: S/.</label> <input type="text" class="form-control d-inline col-3" id="vueltoNegativoMonto" name="pagoCon" value="" />
        </div>
    </div>
    <?php endif;?>
    <div class="form-group text-center my-2">
      <label for="total">Total a pagar: <?php echo money_format('%(#10n',$total) ?>
      </label>
      <input type="hidden" name="total" value="<?php echo $total ?>">
      <input type="hidden" name="metodoPago" value="" id="pagoMetodo">
      <p class="col-6 my-4 d-inline" id="vuelto"></p>
    </div>
      <button id="payment-button" disabled="true" type="submit" class="btn btn-lg btn-primary btn-block">

        <span id="payment-button-amount">Cobrar <?php echo money_format('%(#10n',$total)?></span>
        <span id="payment-button-sending" style="display:none;">Enviando...</span>
      </button>
    </div>
  </div>
  <script>
  var pagocon;
  var vueltoadar;
  <?php if($_SESSION['usuario']!=3):?>
  $('#payment-button').on('click',function(){
  var a = document.createElement("a");
		a.target = "_blank";
		a.href = 'impresion?codigo=<?php echo $_COOKIE['codigo'];
		if($_COOKIE['modoventa']=="delivery" || $_COOKIE['modoventa']=="domicilios.com"): echo "&pedido=true";  endif; ?>&pagocon='+pagocon+'&vuelto='+vueltoadar;
		a.click();
  });
  <?php endif; ?>

  var metodoPago;
  var denominacion;
  var vuelto;
  var total = <?php echo $total ?>;
  var billetes;
  var billeteAnterior
  $('#vueltoNegativo').hide();
  $('#vuelto').hide();
  function animacion(clase,otro){
      $('.'+clase).addClass('text-muted');
      $('.'+clase).addClass('btn-light');
      $('.'+clase).removeClass('btn-dark');
      $('.'+clase).css('font-size','1rem');
      $(otro).addClass('btn-dark');
      $(otro).removeClass('text-muted');
      $(otro).css('font-size','1.3rem');
      $(otro).css('height','50px');
  }
  $('.metodoCuadro').hide();
      $('.metodoPago').on('click', function(){
        addDisable();
        $('#pagoMetodo').val($(this).attr('data-metodo'));
        $('.metodoPago').addClass("text-muted");
        $('.metodoPago').css('font-size','2em');
        $('.metodoPago').css('height','45px');
        $(this).removeClass('text-muted');
        $(this).css('font-size','3em');
        $(this).css('height','68px');

        switch ($(this).attr('data-metodo')) {
          case 'efectivo':
          $('#vuelto').show();
          $('.metodoCuadro').fadeIn(300);
          $('.billete').on('click',function(){
             animacion('billete',this);
             function darVuelto(denominacion,total) {
              vuelto = denominacion-total;
              if(vuelto){
                $('#vuelto').text('Su vuelto S/. '+ vuelto.toFixed(2));
                vueltoadar = vuelto.toFixed(2);
                pagocon = denominacion;
              }else{
                  $('#vuelto').text('');
              }

              if(vuelto>=0){
                  remDisable();
              }else{
                  addDisable();
              }
              return vuelto;
             }


              darVuelto($(this).attr('data-billete'),total);

              if(vuelto>=0){
                remDisable();
              }else{

                  $('#vueltoNegativo').show();
                  $('#vueltoNegativoMonto').focus();
                  $('#vueltoNegativoMonto').keyup(function() {
                        darVuelto($(this).val(),total);
                  });

                addDisable();
              }

          });
            break;
          case 'visa':
          $('#vuelto').text('');
          $('#vuelto').hide();
          $('.metodoCuadro').fadeOut(300);
          remDisable();
            break;
          case 'Domicilios.com':
          $('#vuelto').text('');
          $('#vuelto').hide();
          $('.metodoCuadro').fadeOut(300);
          remDisable();
              break;
          default:
          alert(metodoPago);
            break;
          }
        });
        <?php if($_COOKIE['modoventa']=="domicilios.com"): ?>
          remDisable();
          $('#pagoMetodo').val('domicilios.com');
        <?php endif; ?>
  </script>
