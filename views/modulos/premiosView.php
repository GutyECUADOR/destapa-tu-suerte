<?php require_once 'sis_modules/navbar.php' ?>


    <div class="main-container main-background">
        <div class="fireworks">
            <section style="z-index: 2;" class="text-light">
                <div class="container">
                    
                    <div class="row justify-content-center mb-4">
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/1moto.png" alt="Promo" style="max-height: 200px;" >
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">10 motos AKT Ref. NKD 125 cc</h2>
          
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/2tv.png" alt="premios"  style="max-height: 200px;">
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">50 televisores Challenger de 42”</h2>
          
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/3celular.png" alt="Promo" style="max-height: 200px;" >
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                                100 teléfonos Celulares Inteligente Xiaomi Poco M3 125 GB
                            </h2>
          
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/4bicicleta.png" alt="premios" style="max-height: 200px;">
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                                100 bicicletas todo terreno 18 velocidades
                            </h2>
          
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/5sured.png" alt="Promo" style="max-height: 100px;" >
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                                500 Bonos o giros SURED en dinero por cien mil pesos cada uno (100.000 COP). 
                            </h2>
          
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/6amazon.png" alt="premios" style="max-height: 100px;">
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                                1.500 cuentas Amazon Prime (por 1 mes)
                            </h2>
          
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/7recargarcelular.png" alt="Promo" style="max-height: 100px;" >
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                            156.671 recargas a celular (Minutos y Plan de datos) por valor de Cinco mil pesos ($5.000) cada una a cualquier operador.

                            </h2>
          
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 text-center">
                            <img src="assets/img/8betplay.png" alt="premios" style="max-height: 100px;">
                            <h2 class="text-center text-white mb-3" style="color: #fff !important; font-weight: bold; font-size: 1.5rem;">
                            298.500   recargas para apuestas BETPLAY por valor de Cinco mil pesos ($5.000) cada una 

                            </h2>
          
                        </div>
                    </div>
                    
                
                    <!--end of row-->
                </div>
            <!--end of container-->
            </section>
        </div>

            <?php require_once 'modals/terminosModal.php' ?>
            <?php require_once 'sis_modules/footer.php' ?>
            <?php require_once 'modals/whatsapp.php'?>
    </div>





<!-- Required vendor scripts (Do not remove) -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.fireworks.js"></script>


<script type="text/javascript" >
$('.fireworks').fireworks();
  $(function () {
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
    })
</script>
