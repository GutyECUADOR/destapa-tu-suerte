<?php require_once 'sis_modules/navbar-tardemagica.php' ?>

<div class="main-container" id="app" oncontextmenu="return false; ">
  
        <section class="text-light" style="background: url('./assets/img/tardemagica/fondo.png'); padding-top:20px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <h3 class="text-secondary-nutresa" style="font-weight: bold; line-height: 1;">EVENTO EN VIVO</h3>
                        <h4 class="text-secondary-nutresa" style="font-weight: bold; line-height: 1; margin-bottom: 5px;">Domingo, 08 de Agosto 2021 - De 5pm a 7pm</h4>
                    </div>

                    <div class="col-12 col-md-6 justify-content-center text-center mb-3" style="padding-left: 40px;" v-if="!search_user.isAutenticated">
                        <div 
                            class="flipper" 
                            data-datetime="2021-08-08 00:00:00"
                            data-reverse="true" 
                            data-template="dd|HH|ii|ss" 
                            data-labels="Dias|Horas|Minutos|Segundos" 
                            id="modalFlipper">
                        </div>
                    </div>

                    <div class="col-12 col-md-8 text-center mb-3"  v-if="!search_user.isAutenticated">
                        
                        <div id="info">
                            <h4 class="text-secondary-nutresa" style="font-weight: bold; line-height: 0.5; margin-bottom: 10px!important;">¿CÓMO FUNCIONA?</h4>
                           
                        </div>
                            <p class="text-white mb-3">
                               
                                ¡Será toda una rumba! Los participantes deberán adivinar el nombre de la canción, según las pistas que va dando la orquesta en vivo con cada uno de sus instrumentos, y de acuerdo a los géneros que salgal del a Rockola Virtual, se realizaran 20 performance y los participantes que sean los primeros en adivinar el nombre de la canción o artista podrán ganar enviando la respuesta vía Whatsapp (320 3192388) o por el chat del evento y de esa manera poder ser uno de nuestros ganadores. Una Actividad llena de alegría y diversión para que las disfrutes en casa, junto a tu familia y/o amigos, degustando de un delicioso cafe Sello Rojo y Colcafe.
                                
                            </p>

                        <img src="assets/img/previewEventoCafe.jpg" style="border: 6px solid #CCCCCC" alt="premios" class="img-responsive mb-3 w-100">
                    
                        
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
                                <input class="form-control form-control-lg" v-model="usuario.correo" type="email" name="correo" id="login-email" placeholder="Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="login-nombre" class="text-secondary-nutresa">Nombre</label>
                                <input class="form-control form-control-lg"  v-model="usuario.nombre" type="text" name="nombre" id="login-nombre" placeholder="Nombre" required/>
                            </div>
                            <div class="form-group">
                                <label for="login-telefono" class="text-secondary-nutresa">Teléfono</label>
                                <input class="form-control form-control-lg" v-model="usuario.telefono" type="text" name="telefono" id="login-telefono" placeholder="Teléfono" required/>
                            </div>
                            <div class="form-group">
                                <label for="login-codigo" class="text-secondary-nutresa">Código</label>
                                <input class="form-control form-control-lg" v-model="usuario.codigo" type="password" name="codigo" id="login-codigo" placeholder="Código" required/>
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
    <?php require_once 'sis_modules/footer.php' ?>
    <?php require_once 'modals/whatsapp.php'?>
</div>


<!-- Required vendor scripts (Do not remove) -->
<script type="text/javascript" src="assets/js/vue.js"></script>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.flipTimer.js"></script>
<script type="text/javascript" src="assets/js/sweetalert.min.js"></script>

<script type="text/javascript" src="<?php echo ROOT_PATH; ?>assets\js\pages\evento.js?<?php echo date('Ymdhiiss')?>"></script>

<script type="text/javascript" >
  $(function () {
        $('#modalFlipper').flipper('init');
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
          $("#downloadpopover").popover("show");
        })
</script>