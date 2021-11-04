<?php require_once 'sis_modules/navbar.php' ?>

<div class="main-container" id="app" oncontextmenu="return false; ">
  
        <section class="text-light" style="background: radial-gradient(circle, #ffdc3e 0%, #ffd72c 100%); padding-top:20px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <h3 class="text-secondary-nutresa" style="font-weight: bold; line-height: 1;">EVENTO EN VIVO</h3>
                        <h4 class="text-secondary-nutresa" style="font-weight: bold; line-height: 1; margin-bottom: 5px;">Domingo, 04 de Julio 2021 - De 5pm a 7pm</h4>
                    </div>

                    <div class="col-12 col-md-6 justify-content-center text-center mb-3" style="padding-left: 40px;" v-if="!search_user.isAutenticated">
                        <div 
                            class="flipper" 
                            data-datetime="2021-07-04 00:00:00"
                            data-reverse="true" 
                            data-template="dd|HH|ii|ss" 
                            data-labels="Dias|Horas|Minutos|Segundos" 
                            id="modalFlipper">
                        </div>
                    </div>

                    <div class="col-12 col-md-8 text-center mb-3"  v-if="!search_user.isAutenticated">
                        
                        <div id="info">
                            <h4 class="text-secondary-nutresa" style="font-weight: bold; line-height: 0.5; margin-bottom: 10px!important;">¿CÓMO FUNCIONA?</h4>
                            <p class="text-secondary-nutresa mb-3">
                                Contaremos con un animador (host) y un actor teatral, los cuales realizarán diversos performance, representando a diferentes personajes de la vida cotidiana colombiana y del mundo, para que puedas identificarlos en el menor tiempo posible, enviando la respuesta vía Whatsapp (320 3192388) y de esa manera poder ser uno de nuestros ganadores.
                                Una Actividad llena de risas y alegrías, para que las disfrutes en casa, junto a tu familia y/o amigos, degustando de un delicioso y espumoso Chocolate Corona.
                            </p>
                        </div>

                        <img src="assets/img/previewEvento.jpg" style="border: 6px solid #CCCCCC" alt="premios" class="img-responsive mb-3 w-100">
                    
                        
                    </div>

                <!--end of col-->
                </div>

                

               
                    
                

                <!--end of row-->
                <div class="row justify-content-center" id="formregistro" v-if="!search_user.isAutenticated">
                    <div class="col-12 col-md-10 col-lg-6">
                        <p class="text-secondary-nutresa text-center">
                            Ingresa tus datos y el código de la promoción.
                        </p>
                        
                        <form  @submit.prevent="verify_code" >
                            <div class="form-group">
                                <label for="login-email" class="text-secondary-nutresa">Correo</label>
                                <input class="form-control form-control-lg" v-model="usuario.correo" type="email" name="correo" id="login-email" placeholder="Email" disabled required/>
                            </div>
                            <div class="form-group">
                                <label for="login-nombre" class="text-secondary-nutresa">Nombre</label>
                                <input class="form-control form-control-lg"  v-model="usuario.nombre" type="text" name="nombre" id="login-nombre" placeholder="Nombre" disabled required/>
                            </div>
                            <div class="form-group">
                                <label for="login-telefono" class="text-secondary-nutresa">Teléfono</label>
                                <input class="form-control form-control-lg" v-model="usuario.telefono" type="text" name="telefono" id="login-telefono" placeholder="Teléfono" disabled required/>
                            </div>
                            <div class="form-group">
                                <label for="login-codigo" class="text-secondary-nutresa">Codigo</label>
                                <input class="form-control form-control-lg" v-model="usuario.codigo" type="password" name="codigo" id="login-codigo" placeholder="Código" disabled required/>
                            </div>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" value="agree" name="agree-terms" id="check-agree" required>
                              <label style="color: #A20303;" class="custom-control-label text-justify" for="check-agree">He leído y aceptado los Términos y condiciones.</a>
                              </label>
                            </div>
                            
                             <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" value="agree" name="agree-personal-data" id="agree-personal-data" required>
                              <label style="color: #A20303;" class="custom-control-label text-justify" for="agree-personal-data">Autorizo el tratamiento de mis datos personales para participar en la Actividad promocional.</a>
                              </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg button-nutresa" style="background-color: #ffe000;" :disabled="search_user.isloading"  >
                                    <i class="fa" :class="[{'fa-spin fa-refresh': search_user.isloading}, {  'fa-key' : !search_user.isloading  }]" ></i> Ingresar al evento
                                </button>
                            </div>
                            
                        </form>
                    </div>
                <!--end of col-->
                </div>

                <div class="row" id="video" v-if="search_user.isAutenticated">
                    <div class="embed-responsive embed-responsive-16by9 mb-3 hide" style="border-width: 4px; margin-top:5px; border-radius: 5px;">
                        <iframe class="embed-responsive-item" style="border: 6px solid #CCCCCC" :src='getURLVideo()'></iframe>
                    </div>
                </div>

                
                <!--end of row-->
            </div>
      
        </section>
    
    
    <?php require_once 'modals/terminosModal.php' ?>
    <?php require_once 'modals/eventoSujerenciasModal.php' ?>
    <?php require_once 'sis_modules/footer.php' ?>
    <?php require_once 'modals/whatsapp.php'?>
</div>


<!-- Required vendor scripts (Do not remove) -->
<script type="text/javascript" src="assets/js/libs/vue.js"></script>
<script type="text/javascript" src="assets/js/libs/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/libs/popper.min.js"></script>
<script type="text/javascript" src="assets/js/libs/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/libs/jquery.flipTimer.js"></script>

<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pages\evento.js?<?php echo date('Ymdhiiss')?>"></script>

<script type="text/javascript" >
  $(function () {
        $('#eventoSujerenciasModal').modal('show');
        $('#modalFlipper').flipper('init');
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
          $("#downloadpopover").popover("show");

    })
</script>