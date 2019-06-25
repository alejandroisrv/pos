<?php
session_start();
if(isset($_SESSION['usuario'])){
  if($_SESSION['rol-user']=="admin"){
  include 'head.php';
  include 'nav.php';?>
  <div class="modal fade" id="myModalone" role="dialog">
      <div class="modal-dialog modals-default">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form  id="form-modal" route="" enctype="multipart/form-data"  action="" method="post">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-default" id="btn-modal">Save changes</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
          </div>
      </div>
  </div>
  <section id="content" style="height:100%;">

  </section>

  <?php include 'footer.php';

}else {
    header('Location:../');
}
}else{
  header('Location:../');
}
?>
<script type="text/javascript">
    routes('home');
</script>
