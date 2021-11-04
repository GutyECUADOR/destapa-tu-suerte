<?php
use App\Controllers\LoginController;
$login = new LoginController();

if (isset($_SESSION["usuario_cedula".APP_UNIQUE_KEY])){
    header("Location:index.php?&action=dashboard");  
 } 
 
?> 
    <?php require_once 'sis_modules/navbar.php' ?>

    <div class="main-container main-background" id="app" >
      <section style="padding-top: 1.5rem;">
        <div class="container" style="width: 800px;">
          <div class="row justify-content-center card card-lg border-0">
           
            
          </div>
          <!--end of row-->
          
        </div>
        <!--end of container-->
      </section>
      <!--end of section-->
    
      
      <?php require_once 'modals/modalProcesoCanjePremio.php' ?>
      <?php require_once 'modals/terminosModal.php' ?>
      <?php require_once 'modals/whatsapp.php'?>

    </div>

    
    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/libs/sweetalert2.min.js"></script>
    

    <script>
        $(function () {
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
        })

     
    </script>

    <!-- VUE y Scripts de la pagina-->
    <script src="assets/js/libs/vue.js"></script>
    <script src="assets/js/pages/buscarPremio.js?<?php echo date('Ymdhiiss')?>"></script>