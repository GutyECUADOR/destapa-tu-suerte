<?php require_once 'sis_modules/navbar.php' ?>


    <div class="main-container main-background">
        <div class="fireworks">
            <section style="z-index: 2; height: 600px;" class="text-light">
                <div class="container">
                    
                    <div class="row justify-content-center mb-4">
                        
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
