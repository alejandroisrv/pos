<p class="text-left p-1">Explica porque el pedido fue rechazado</p>
<textarea rows="8" cols="80"  name="observaciones" id="observaciones" class="form-control"></textarea>
<input type="hidden" name="idpedido" value="<?php echo $_GET['id'] ?>">
<script type="text/javascript">
      $("#observaciones").keyup(function() {
          if($(this).val()!=""){
            remDisable()
          }else{
            addDisable()
          }
      })
</script>
