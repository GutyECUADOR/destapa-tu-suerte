<?php require_once 'sis_modules/navbar-rockolaganadora.php' ?>

<div class="main-container">
    
    <section class="text-light" style="background: url('./assets/img/FONDO.png')">
        <div class="container">
            <!--end of row-->
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <img src="assets/img/concepto-lado-derecho.png" alt="Promo" class="img-responsive w-75 zoom mb-3" style="border-radius:10px">
                </div>

                <div class="col-12 col-md-10 col-lg-12 text-center">
                <span class="text-secondary-nutresa " style="z-index: 2; font-weight: bold;">
                    Una vez se verifique que el participante haya cumplido con términos y condiciones de la actividad, será contactado en menos de 48 horas y en un tiempo maximo de 30 dias calendario se recargá del valor del Bono ganado en su cuenta de MI BOLSILLO de SU RED para que pueda redimirlo virtualmente
                </span>
                </div>
            </div>

            
            <div class="row justify-content-center mb-3">
                <div class="col-12 col-md-10 col-lg-3 text-center">
                    <img src="assets/img/BONO-125-rockola.jpg" alt="premios" class="img-responsive mb-3 w-100 zoom">
                </div>
                <div class="col-12 col-md-10 col-lg-3 text-center">
                    <img src="assets/img/BONO-200-rockola.jpg" alt="premios" class="img-responsive mb-3 w-100 zoom">
                </div>

                <div class="col-12 col-md-10 col-lg-3 text-center">
                    <img src="assets/img/BONO-300-rockola.jpg" alt="premios" class="img-responsive mb-3 w-100 zoom">
                </div>
                <div class="col-12 col-md-10 col-lg-3 text-center">
                    <img src="assets/img/BONO-900-rockola.jpg" alt="premios" class="img-responsive mb-3 w-100 zoom">
                </div>
            </div>
           
            <div class="row">
                <div class="col-12 col-md-10 col-lg-6 text-center">
                    <div class="embed-responsive embed-responsive-16by9 mb-3" style="border-width: 4px; margin-top:5%; border-radius: 5px;">
                        <iframe class="embed-responsive-item" style="border: 6px solid #CCCCCC" src="https://youtube.com/embed/smt9Qo_xqBM?&controls=1&mute=1"></iframe>
                    </div>
                </div>

                <div class="col-12 col-md-10 col-lg-6 text-center">
                <div class="embed-responsive embed-responsive-16by9 mb-3" style="border-width: 4px; margin-top:5%; border-radius: 5px;">
                        <iframe class="embed-responsive-item" style="border: 6px solid #CCCCCC" src="https://youtube.com/embed/pG5ECLc8N1U?&controls=1&mute=1"></iframe>
                    </div>
                </div>
            </div>

           
          
            <!--end of row-->
        </div>
    <!--end of container-->
    </section>
   
    <?php require_once 'modals/terminosModal.php' ?>
    <?php require_once 'sis_modules/footer.php' ?>
    <?php require_once 'modals/whatsapp.php'?>

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