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
            <div class="col-12 card-body p-0 pt-3">
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
                    
                      <div class="">
                        <div class="custom-control custom-checkbox primary-color">
                          <input type="checkbox" v-model="usuario.terminos" class="custom-control-input" value="agree" name="agree-terms" id="check-agree">
                          <label class="custom-control-label text-justify small tertiary-color font-weight-bold" for="check-agree">He leído y aceptado los Términos y condiciones, y autorizo el tratamiento de mis datos personales para participar en la Actividad promocional.</label>
                          </label>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary btn-block tertiary-color-background" :disabled="search_user.isloading"  >
                          <i class="fa" :class="[{'fa-spin fa-refresh': search_user.isloading}, {  'fa-search' : !search_user.isloading  }]" ></i> Buscar
                      </button>
                    </div>
                  </form>

                  <table class="table"> 
                      <thead>
                          <tr> 
                              <th class="custom-table-head">Premio</th>
                              <th class="custom-table-head">Fecha de Canje</th>
                              <th class="custom-table-head">Instrucciones</th>
                          </tr>
                      </thead> 
                      
                      <tbody>
                          <tr v-for="premio in search_user.premios">
                              <td>{{premio.premio}}</td>
                              <td>{{premio.fecha}}</td>
                              <td>{{premio.instrucciones}}</td>
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

    
    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert2.min.js"></script>
    

    <script>
        $(function () {
          $('[data-toggle="popover"]').popover()
          $("#whatspopover").popover("show");
        })

     
    </script>

    <!-- VUE y Scripts de la pagina-->
    <script src="assets\js\vue.js"></script>
    <script src="assets\js\pages\buscarPremio.js?<?php echo date('Ymdhiiss')?>"></script>