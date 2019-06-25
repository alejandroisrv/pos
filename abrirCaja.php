<div class="col-12 text-center justify-content-center">
  <p class="my-4">Debes abrir la caja primero</p>
  <div class="row mt-4">
    <div class="col-12 ">
      <center>
        <div class="form-group">
          <input type="hidden" name="accion" value="abrir">
            <input type="text" name="fondo" class="form-control col-6 text-center" value="" placeholder="Fondo">
        </div>
      </center>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <button type="button" name="button" class="btn btn-danger col-4 mx-2 salir">Salir</button>
      <button type="submit" name="submit" class="btn btn-primary col-4 mx-2">Abrir caja</button>
    </div>

  </div>
</div>

<script>
$(".salir").on('click',function () {
  location.href="out.php";
})
</script>
