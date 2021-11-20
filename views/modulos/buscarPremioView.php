
    <?php require_once 'sis_modules/navbar.php' ?>

    <div class="fireworks">
      <div class="main-container main-background" id="app" >
        
          <section style="z-index: 2; padding-top: 1.5rem;">
            <div class="container">
              <div class="row flex-md-row card card-lg border-0">
                <div class="col-12 col-md-12 card-body">
                  <div class="row">
                    <div class="col-12 justify-content-center text-center">
                      <h5 class="tertiary-color pb-2">Busca aqui tus premios canjeados</h5>
                    </div>
                  
                  
                  </div>
                  
                  <div class="row justify-content-center mb-2">
                    <div class="col-12 col-lg-9">
                      
                      <form @submit.prevent="searchPremios" method="POST">
                        <div>

                          <div class="form-group">
                            <label for="cedula">Documento de Identidad</label>
                            <input type="text" v-model="usuario.cedula" class="form-control form-control-sm" id="cedula" placeholder="Ingrese su numero de documento" pattern="[0-9]+" maxlength="13" required>
                          </div>

                          <div class="form-group">
                            <label for="telefono">Teléfono celular</label>
                            <input type="text" v-model="usuario.telefono" class="form-control form-control-sm" id="telefono" placeholder="Ingrese su numero de Teléfono" pattern="[0-9]+" maxlength="10" required>
                          </div>
                        
                          <div class="">
                            <div class="custom-control custom-checkbox primary-color">
                              <input type="checkbox" v-model="usuario.terminos" class="custom-control-input" value="agree" name="agree-terms" id="check-agree">
                              <label class="custom-control-label text-justify small tertiary-color font-weight-bold" for="check-agree">
                              Certifico que soy mayor de edad, he leído y aceptado los Términos y condiciones, y autorizo el tratamiento de mis datos personales para participar en la Actividad promocional.
                              </label>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-primary btn-block tertiary-color-background" :disabled="search_user.isloading"  >
                              <i class="fa" :class="[{'fa-spin fa-refresh': search_user.isloading}, {  'fa-search' : !search_user.isloading  }]" ></i> Buscar
                          </button>
                        </div>
                      </form>

                      <div class="col-12 justify-content-center text-center">
                        <h5 class="tertiary-color mt-2 pb-2">{{ search_user.premios[0]?.nombre || 'Anónimo' }} te has ganado {{ search_user.premios.length }} premios !</h5>
                      </div>

                      <table class="table table-responsive"> 
                          <thead>
                              <tr> 
                                  <th class="custom-table-head">Premio</th>
                                  <th class="custom-table-head">Fecha de Canje</th>
                                  <th class="custom-table-head">Instrucciones</th>
                              </tr>
                          </thead> 
                          
                          <tbody>
                              <tr v-for="premio in search_user.premios">
                                  <td>{{premio.nombre_premio}}</td>
                                  <td>{{premio.fecha}}</td>
                                  <td>
                                    <div v-html="premio.instrucciones">
                                    </div>

                                    <div v-if="premio.premio_id==8">
                                      <p style="text-align: left; margin-top: 10px;">Felicitaciones ganaste un bono de $5000 para apuestas deportivas en linea en la plataforma Betplay<br />Sigue las siguientes indicaciones para hacer efectivo tu bono.<br />1. Si no estas registrado aun en la plataforma de Betplay, registrate.</p>
                                      <p style="margin-top: 10px; text-align: center;"><a href="https://betplay.com.co/registrarse" target="_blank">Reg&iacute;strate</a><br /><a href="https://www.youtube.com/watch?v=dj6ZAko1tB8&amp;ab_channel=BetPlay" target="_blank">Video Explicativo</a></p>
                                      <p style="margin-top: 10px;">2. Ingresa a tu cuenta y redime tu bono de $5000 para apuestas deportivas con este c&oacute;digo: <div id="codigobetplay" onclick="CopyToClipboard();return false;" style="font-size:20px; color:green; text-align: center;">{{ premio.betplaycode }}</div></p>
                                      <p style="margin-top: 10px;">3. Apuesta desde 500 pesos en nuestra plataforma y podr&aacute;s ganar hasta 500 millones de pesos<br />aplican t&eacute;rminos y condiciones&nbsp;</p>
                                      <p style="margin-top: 10px; text-align: center;"><a href="https://apicrm.betplay.com.co/terms/Terminos%20y%20condiciones%20202111.pdf" target="_blank" rel="noopener">T&eacute;rminos &amp; Condiciones</a></p>
                                      <p style="text-align: left;">4. Si tienes alguna duda o inconveniente en la plataforma de Betplay comunicate con (l&iacute;nea 018000112188 o correo ayuda.corredor@cempresarial.co.</p>
                                    </div>

                                    <button v-if="premio.id==7&&premio.telefono_recarga==''" @click="registrarTelefono(premio)" class="btn btn-success btn-block">Registrar Teléfono para recarga</button>
                                    
                                  </td>
                              </tr>
                          </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                <!--end of col-->
                
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
    </div>

    
    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/libs/sweetalert2.min.js"></script>
    <script type="text/javascript" src="assets/js/libs/jquery.fireworks.js"></script>


    <script>
        $('.fireworks').fireworks();
        $(function () {
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
        })

     
    </script>

    <!-- VUE y Scripts de la pagina-->
    <script src="assets/js/libs/vue.js"></script>
    <script src="assets/js/pages/buscarPremio.js?<?php echo date('Ymdhiiss')?>"></script>