<?php require_once 'sis_modules/navbar-rockolaganadora.php' ?>

<div class="main-container">
    
    <section class="text-light" style="background: url('./assets/img/FONDO.png'); padding: 0 !important">
        <div class="container">
            
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    <img src="assets/img/KV-LA-ROCKOLA-GANADORA.png" alt="Promo" class="img-responsive w-75 zoom mb-1 mt-4" style="border-radius:10px">
                </div>
            </div>

            
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <img src="assets/img/paso1.png" alt="premios" class="img-responsive w-100 zoom">
                </div>
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <img src="assets/img/paso2.png" alt="premios" class="img-responsive w-100 zoom">
                </div>
            </div>
           
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <img src="assets/img/paso3.png" alt="premios" class="img-responsive w-100 zoom">
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <img src="assets/img/bodegon.png" alt="premios" class="img-responsive w-100 zoom">
                </div>
            </div>

          
          
            <!--end of row-->
        </div>
    <!--end of container-->
    </section>

    <?php require_once 'modals/terminosModal-LaRockola.php' ?>
    <?php require_once 'sis_modules/footer.php' ?>
    <?php require_once 'modals/whatsapp.php'?>

    <!-- Modal Video -->
    <div class="modal fade" id="modal-video" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0" style="background-color: #0000;">
            <div class="">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="font-size:5rem">&times;</span>
            </button>
            </div>
            <div class="">
            <div class="embed-responsive embed-responsive-16by9 mb-3" style="border-width: 4px; margin-top:5%; border-radius: 5px;">
                <iframe class="embed-responsive-item" style="border: 6px solid #CCCCCC" src="https://youtube.com/embed/5gMmpbCc48Y?autoplay=1&controls=1&mute=1"></iframe>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>


<!-- Required vendor scripts (Do not remove) -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>

<!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->
<script type="text/javascript" src="assets/js/jquery.fireworks.js"></script>


<script type="text/javascript" >
  $('.fireworks').fireworks();
  $(function () {
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
          $("#downloadpopover").popover("show");
    })
</script>

<script type="text/javascript">
      $(window).on('load', function() {
          $('#modal-video').modal('show');

          $("#modal-video").on('hidden.bs.modal', function (e) {
            $("#modal-video iframe").attr("src", $("#modal-video iframe").attr("src"));
            $('#modal-fin').modal('show');
        });
      });
</script>