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
        <div class="container">
          <div class="row flex-md-row card card-lg border-0">
            <div class="col-12 col-md-6 card-body">
              <div class="row">
                <div class="col-12 justify-content-center text-center">
                  <h5 class="tertiary-color">Regístra tus datos y canjea tu premio</h5>
                </div>
                
                <div class="col-12 justify-content-center text-center mt-2">
                </div>
               
              
              </div>
              
              <div class="row justify-content-center mb-2">
                <div class="col-12 col-lg-9">
                  
                  <form @submit.prevent="verify_code" method="POST">
                    <div>

                      <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" v-model="usuario.nombre" class="form-control form-control-sm text-uppercase" id="nombre" placeholder="Ingrese su nombre y apellido" maxlength="200" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="cedula">Documento de Identidad</label>
                        <input type="text" v-model="usuario.cedula" class="form-control form-control-sm" id="cedula" placeholder="Ingrese su numero de documento" pattern="[0-9]+" maxlength="13" required>
                      </div>
                      <div class="form-group">
                        <label for="cedula">Confirmar Documento de Identidad</label>
                        <input type="text" v-model="usuario.confcedula" class="form-control form-control-sm" id="confcedula" placeholder="Confirme su Documento de Identidad" pattern="[0-9]+" maxlength="13" required>
                      </div>

                      <div class="form-group">
                        <label for="telefono">Teléfono celular</label>
                        <input type="text" v-model="usuario.telefono" class="form-control form-control-sm" id="telefono" placeholder="Ingrese su numero de Teléfono" pattern="[0-9]+" maxlength="10" required>
                      </div>
                      <div class="form-group">
                        <label for="telefono">Confirmar Teléfono celular</label>
                        <input type="text" v-model="usuario.conftelefono" class="form-control form-control-sm" id="conftelefono" placeholder="Confirme su numero de Teléfono" pattern="[0-9]+" maxlength="10" required>
                      </div>

                      <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" v-model="usuario.correo" class="form-control form-control-sm" id="email" placeholder="Indique su email" maxlength="50" required>
                      </div>
                      <div class="form-group">
                        <label for="codigoPremio" style="text-align: center;color: #002693 !important; font-weight: bold;">INGRESA EL CÓDIGO GANADOR QUE ENCONTRASTE BAJO LA TAPA</label>
                        <input type="text" v-model="usuario.codigo" class="form-control form-control-sm" id="codigoPremio" placeholder="Ingresa tu codigo del premio" required>
                      </div>
                      <div class="">
                        <div class="custom-control custom-checkbox primary-color">
                          <input type="checkbox" v-model="usuario.terminos" class="custom-control-input" value="agree" name="agree-terms" id="check-agree">
                          <label class="custom-control-label text-justify small tertiary-color font-weight-bold" for="check-agree">He leído y aceptado los Términos y condiciones, y autorizo el tratamiento de mis datos personales para participar en la Actividad promocional.</label>
                          </label>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary btn-block tertiary-color-background" :disabled="search_user.isloading"  >
                          <i class="fa" :class="[{'fa-spin fa-refresh': search_user.isloading}, {  'fa-trophy' : !search_user.isloading  }]" ></i> Canjear Premio
                      </button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!--end of col-->
            <div class="col-12 col-md-6 card-body pt-0" style="background-color: #0054ac">
              <div class="col-12 float-right pr-2 mt-2">
              </div>
              <div style="height: 100%">
                <div class="text-center mt-4">
                  <h3 class="h3 mb-2 text-uppercase" style="font-weight: bold !important; color: #fff">Términos &amp; Condiciones</h3>
                  
                </div>
               
                <div class="card card-sm shadow text-justify border-0" style="height: 50%;">
                  <div class="card-body terms-box text-white" style="color: white;background: #0054ac;">
                    <h3 class="text-center">MEGA PROMOCIÓN DESTAPA TU SUERTE</h3>
                    
                    
                    <p>La participaci&oacute;n en la actividad promocional&nbsp;<strong>&ldquo;DESTAPA TU SUERTE&rdquo;&nbsp;</strong>implica la aceptaci&oacute;n total e incondicional de los presentes T&eacute;rminos y Condiciones, los cuales resultan definitivos y vinculantes para quienes decidan participar, y cumplan con los requisitos aqu&iacute; dispuestos (en adelante los <strong>&ldquo;Usuarios Participantes&rdquo;</strong> o los <strong>&ldquo;Participantes Ganadores&rdquo;</strong> cuando aplique).</p>
                    <p>En consecuencia, en el momento en que los Usuarios Participantes cumplan con los requisitos que se disponen por parte de <strong>LA F&Aacute;BRICA DE LICORES Y ALCOHOLES DE ANTIOQUIA EICE</strong> y de&nbsp;los Comercializadores de los productos <strong>FLA EICE &nbsp;</strong>(en adelante <strong>LOS ORGANIZADORES </strong><strong>Y RESPONSABLES) </strong>y participen en la actividad&nbsp;<strong>&ldquo;</strong><strong>DESTAPA TU SUERTE&rdquo;, </strong>se entiende que &eacute;stos aceptan de manera voluntaria, expresa e irrevocable sujetarse a los presentes T&eacute;rminos y Condiciones publicados en la p&aacute;gina web <a href="http://www.destapatusuerte.com">www.destapatusuerte.com</a>, as&iacute; como su Pol&iacute;tica de Privacidad y Tratamiento de Datos, &nbsp;las cuales manifiesta y reconoce que ha le&iacute;do, comprendido y aceptado en todas sus partes. En caso en que no est&eacute; de acuerdo con los T&eacute;rminos y Condiciones establecidos, deber&aacute; abstenerse de participar en cualquier forma en La actividad promocional.</p>
                    <ol>
                    <li><strong>ORGANIZADORES Y RESPONSABLES DE LA PROMOCI&Oacute;N: </strong></li>
                    </ol>
                   
                    <p>Los comercializadores <strong>ALIANZA MAYORISTA S.A.S &ldquo;ALIMA&rdquo; </strong>con NIT<strong> 811.029.972, DISPRESCO S.A.S </strong>con NIT<strong> 900.324.055 </strong>e <strong>INTERNACIONAL DE ABASTOS Y LICORES </strong>con NIT<strong> 900.196.22</strong>, ser&aacute;n <strong>LOS ORGANIZADORES Y RESPONSABLES</strong> de la Promoci&oacute;n <strong>&ldquo;DESTAPA TU SUERTE&rdquo;</strong>. La <strong>FLA EICE</strong> ser&aacute; responsable de la verificaci&oacute;n del cumplimiento de la Promoci&oacute;n en los T&amp;C aqu&iacute; definidos.</p>
                   
                    <ol start="2">
                    <li><strong>NOMBRE DE LA PROMOCI&Oacute;N Y OBJETIVO: </strong></li>
                    </ol>
                   
                    <p>La actividad promocional que desarrollar&aacute; <strong>EL ORGANIZADOR Y RESPONSABLE</strong>, se denomina <strong>MEGA PROMOCI&Oacute;N &ldquo;DESTAPA TU SUERTE&rdquo;</strong> (en adelante la &ldquo;Promoci&oacute;n&rdquo;), la cual tendr&aacute; como objetivo premiar a los Usuarios Participantes que compran los productos y las referencias espec&iacute;ficas de Aguardiente Antioque&ntilde;o&reg; y Ron Medell&iacute;n&reg; en las siguientes presentaciones y referencias y de conformidad con lo ac&aacute; definido:</p>
                   
                   
                    <table>
                    <tbody>
                    <tr>
                    <td width="66">
                    <p><strong>&Iacute;TEM</strong></p>
                    </td>
                    <td width="321">
                    <p><strong>PRODUCTO</strong></p>
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>1</strong></p>
                    </td>
                    <td width="321">
                    <p>Aguardiente Antioque&ntilde;o sin Az&uacute;car 24&deg; 375 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>2</strong></p>
                    </td>
                    <td width="321">
                    <p>Aguardiente Antioque&ntilde;o sin Az&uacute;car 24&deg; 750 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>3</strong></p>
                    </td>
                    <td width="321">
                    <p>Aguardiente Antioque&ntilde;o Tradicional 750 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>4</strong></p>
                    </td>
                    <td width="321">
                    <p>Aguardiente Antioque&ntilde;o sin Az&uacute;car 750ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>5</strong></p>
                    </td>
                    <td width="321">
                    <p>Ron Medell&iacute;n Dorado 375 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>6</strong></p>
                    </td>
                    <td width="321">
                    <p>Ron Medell&iacute;n Dorado 750 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>7</strong></p>
                    </td>
                    <td width="321">
                    <p>Ron Medell&iacute;n 3 a&ntilde;os&nbsp;&nbsp; 375 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>8</strong></p>
                    </td>
                    <td width="321">
                    <p>Ron Medell&iacute;n 3 a&ntilde;os 750 ml</p>
                   
                    </td>
                    </tr>
                    <tr>
                    <td width="66">
                    <p><strong>9</strong></p>
                    </td>
                    <td width="321">
                    <p>Ron Medell&iacute;n 3 a&ntilde;os 1000ml</p>
                   
                    </td>
                    </tr>
                    </tbody>
                    </table>
                   
                    <ol start="3">
                    <li><strong>VIGENCIA</strong></li>
                    </ol>
                   
                    <p>La promoci&oacute;n&nbsp;<strong>&ldquo;DESTAPA TU SUERTE&rdquo;,</strong> estar&aacute; vigente a partir del quince (15) de noviembre del a&ntilde;o 2021 hasta el d&iacute;a quince (15) de febrero del a&ntilde;o 2022 o hasta agotar existencias, lo que suceda primero, sin perjuicio del plazo que conforme a estos T&amp;C se dispone para la redenci&oacute;n de cada premio.</p>
                   
                    <p>Los plazos de redenci&oacute;n de los premios depender&aacute;n del tipo de premio y de las condiciones de cada uno de ellos, las cuales se especifican en el numeral octavo de los presentes t&eacute;rminos y condiciones.</p>
                   
                   
                    <p>La Promoci&oacute;n se llevar&aacute; a cabo a trav&eacute;s de la p&aacute;gina web <a href="http://www.destapatusuerte.com">www.destapatusuerte.com</a> y ser&aacute; v&aacute;lida &uacute;nica y exclusivamente para los productos y referencias ya relacionadas y que sean adquiridos por los Usuarios Participantes en el Departamento de Antioquia &ndash; Colombia.</p>
                    
                    <ol start="5">
                    <li><strong>REQUISITOS PARA PARTICIPAR Y EXCLUYENTES. </strong></li>
                    </ol>
                   
                    <p>Los requisitos que deber&aacute; cumplir todo Usuario Participante y Ganador en la Promoci&oacute;n ser&aacute;n los siguientes:</p>
                   
                    <ul>
                    <li>Ser mayor de edad y residente en Colombia</li>
                    <li>Registrarse con sus datos personales en la p&aacute;gina web <a href="http://www.destapatusuerte.com">destapatusuerte.com</a></li>
                    <li>Cumplir con los requisitos descritos en la mec&aacute;nica de la Promoci&oacute;n</li>
                    </ul>
                    
                    <p>Quedan expresamente <strong>excluidos</strong> de participar de la Promoci&oacute;n las siguientes personas:</p>
                   
                    <ul>
                    <li>Los empleados y prestadores de servicios personales del ORGANIZADOR Y RESPONSABLE, sus c&oacute;nyuges y familiares hasta el segundo grado de consanguinidad, segundo de afinidad y &uacute;nico civil.</li>
                    </ul>
                   
                    <ul>
                    <li>Los servidores p&uacute;blicos y prestadores de servicios personales de LA F&Aacute;BRICA DE LICORES Y ALCOHOLES EICE sus c&oacute;nyuges y familiares hasta el segundo grado de consanguinidad, segundo de afinidad y &uacute;nico civil.</li>
                    </ul>
                   
                    <ul>
                    <li>Los empleados y prestadores de servicios de las agencias de publicidad e internet intervinientes en la Promoci&oacute;n, sus c&oacute;nyuges y familiares hasta el segundo grado de consanguinidad, segundo de afinidad y &uacute;nico civil</li>
                    </ul>
                   
                    <ul>
                    <li>Los tenderos, distribuidores minoristas y mayoristas y en general todos aquellos que no sean consumidores finales de los productos y referencias participantes.</li>
                    </ul>
                    
                    <ol start="6">
                    <li><strong>MEC&Aacute;NICA DE LA PROMOCI&Oacute;N: </strong></li>
                    </ol>
                    
                    <p><strong>La Promoci&oacute;n se llevar&aacute; a cabo de la siguiente manera: </strong></p>
                    
                    <ul>
                    <li>Todas las botellas de los productos participantes contar&aacute;n con un Sticker informativo en el que se expondr&aacute; la mec&aacute;nica de participaci&oacute;n y la informaci&oacute;n relacionada a la Promoci&oacute;n.</li>
                    </ul>
                   
                    <p>Para participar en la Promoci&oacute;n, los Usuarios Participantes deber&aacute;n:</p>
                   
                    <ol>
                    <li>Comprar los productos AGUARDIENTE ANTIOQUE&Ntilde;O &reg; Y RON MEDELL&Iacute;N en las referencias participantes, las cuales tendr&aacute;n un sticker informativo de la promoci&oacute;n y se encontrar&aacute;n en diferentes canales y puntos de venta &uacute;nica y exclusivamente para el departamento de Antioquia.</li>
                    </ol>
                   
                    <ol start="457">
                    <li>Una vez realizada la compra, los Usuarios Participantes deber&aacute;n destapar la botella y verificar si bajo la tapa se encuentra uno de los c&oacute;digos ganadores. <strong>En total son 457.431 c&oacute;digos alfanum&eacute;ricos con premio</strong>.</li>
                    </ol>
                   
                    <ul>
                    <li>Una vez el Usuario Participante verifique que bajo la tapa existe un c&oacute;digo ganador, &eacute;ste deber&aacute; ingresar a la plataforma <a href="http://www.destapatusuerte.com">destapatusuerte.com</a> y realizar el siguiente proceso:</li>
                    </ul>
                   
                    <ul>
                    <li>Leer detalladamente, entender y ACEPTAR los t&eacute;rminos y condiciones mediante el bot&oacute;n de aceptaci&oacute;n que se encontrar&aacute; en la p&aacute;gina web de registro (T&amp;C) definidos para esta Promoci&oacute;n, as&iacute; como la POL&Iacute;TICA DE TRATAMIENTO DE DATOS PERSONALES y DE PRIVACIDAD.</li>
                    </ul>
                   
                    <ul>
                    <li>Registrarse con los siguientes datos personales: Nombres y apellidos; n&uacute;mero de identificaci&oacute;n, n&uacute;mero de celular y correo electr&oacute;nico (Este &uacute;ltimo opcional)</li>
                    <li>Una vez el Usuario Ganador se haya registrado, deber&aacute; ingresar en el campo habilitado el c&oacute;digo ganador que aparece bajo la tapa.</li>
                    </ul>
                   
                    <ul>
                    <li>Posteriormente la plataforma le indicar&aacute; al Usuario Ganador el premio asociado al c&oacute;digo y as&iacute; mismo, la forma de redimirlo o reclamarlo seg&uacute;n sea el caso, a trav&eacute;s de unas sencillas y detalladas instrucciones.</li>
                    </ul>
                   
                    <p><strong>Responsabilidad de los Participantes.&nbsp;</strong>Es responsabilidad exclusiva de cada uno de los Usuarios Participantes contar con los medios, herramientas, dispositivo, conexiones y cualquier elemento que sea necesario para participar en la Promoci&oacute;n, sin que&nbsp;<strong>EL ORGANIZADOR Y RESPONSABLE y/o LA FLA EICE </strong>tengan ninguna responsabilidad alguna por este concepto, ni deba asumir ning&uacute;n valor.</p>
                   
                    <p>En caso de que el USUARIO PARTICIPANTE, el USUARIO GANADOR O ALG&Uacute;N INTERESADO EN PARTICIPAR tenga alguna duda o necesite apoyo en el proceso, se tendr&aacute; habilitada una l&iacute;nea WhatsApp de soporte al cliente con n&uacute;mero (57) 3154771684 y as&iacute; mismo, un correo de contacto: <a href="mailto:soportedestapatusuerte@gmail.com">soportedestapatusuerte@gmail.com</a>. El horario de atenci&oacute;n y l&iacute;nea de apoyo ser&aacute; de lunes a domingo de 12:00 m&nbsp;&nbsp; a 8:00 pm.&nbsp;</p>
                   
                    <p>Lo anterior tambi&eacute;n estar&aacute; descrito en el material de comunicaci&oacute;n destinado para la Promoci&oacute;n, para efectos de facilitar todo el proceso al Usuario Participante.</p>
                   
                    <ol start="7">
                    <li><strong>PREMIOS</strong></li>
                    </ol>
                   
                    <p>Los premios ofrecidos en la Promoci&oacute;n corresponden a CUATROCIENTOS CINCUENTA Y SIETE MIL CUATROCIENTOS TREINTA Y UNO (457.431) en total, catalogados y divididos de la siguiente manera con su respectivo valor aproximado incluido IVA. &nbsp;1 de cada 4 tapas de los productos solicitantes est&aacute;n premiadas.</p>
                    
                    
                    <p><strong>PREMIOS TIPO A:</strong> En total: 260 premios a saber:</p>
                   
                    <ol start="5">
                    <li>Motos AKT Ref. NKD 125 cc Cantidad: 10 Unidades&nbsp; Precio aproximado x un. $5.100.000</li>
                    </ol>
                   
                    <ol>
                    <li>Televisores Challenger de 42&rdquo; Cantidad: 50 Unidades. Precio Aproximado x un. $ 1.534.000</li>
                    </ol>
                   
                    <ul>
                    <li>Tel&eacute;fono Celular Inteligente Xiaomi Poco M3 125 GB &nbsp;Cantidad: 100 Unidades&nbsp;</li>
                    </ul>
                    <p>Precio aprox. x un. $ 870.000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                   
                    <ol start="790">
                    <li>Bicicletas todo terreno 18 velocidades Cantidad: 100 Unidades. Precio aproximado x unidad $ 790.000</li>
                    </ol>
                   
                   
                   
                   
                   
                    <p><strong>PREMIOS TIPO B:</strong> En total: 2.000 premios a saber:</p>
                   
                    <ol start="100">
                    <li>Bonos o giros SURED en dinero <strong>Cien mil pesos cada uno (100.000 COP). </strong>Cantidad: 500 Unidades.</li>
                    </ol>
                   
                    <ol>
                    <li>Cuentas Amazon Prime (por 1 mes): 1.500 Unidades. Precio estimado $ 25.000 pesos c/u</li>
                    </ol>
                   
                    <p><strong>PREMIOS TIPO C</strong>: En total:&nbsp; 455.171 premios a saber:</p>
                   
                    <p>vii.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recargas a celular (Minutos y Plan de datos) por valor de Cinco mil pesos ($5.000) cada una. Cantidad: 156.671 recargas para minutos y/o datos para celular / Cualquier operador.</p>
                   
                    <p>viii.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recargas para apuestas BETPLAY por valor de Cinco mil pesos ($5.000) cada una. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cantidad: 298.500 Unidades.</p>
                   
                    <p>Estos productos est&aacute;n sujetos a los lineamientos que en materia de garant&iacute;a establece la Ley 1480 de 2011 &ndash; Estatuto del Consumidor &ndash;.</p>
                    
                    <ol start="8">
                    <li><strong>INFORMACI&Oacute;N SOBRE LOS PREMIOS Y SU ENTREGA: </strong></li>
                    </ol>
                    
                    <p>La mec&aacute;nica de entrega de premios ser&aacute; la siguiente:</p>
                   
                    <p><strong>PREMIOS TIPO A:</strong> (Motos, Televisores, Tel&eacute;fonos Celulares, Bicicletas Todoterreno)</p>
                   
                    <p>La entrega de los premios tipo A se ejecutar&aacute; de la siguiente manera:</p>
                   
                    <ol>
                    <li>Dentro un plazo m&aacute;ximo de quince (15) d&iacute;as h&aacute;biles despu&eacute;s de haber sido registrado el c&oacute;digo ganador y en relaci&oacute;n al premio en referencia, se establecer&aacute; contacto con el <strong>USUARIO GANADOR</strong> del premio a trav&eacute;s del n&uacute;mero celular y/o el correo electr&oacute;nico registrado en la plataforma, de manera que el encargado de la Promoci&oacute;n corrobore los datos y proceda a coordinar el lugar y fecha de entrega del premio, ya sea en el domicilio&nbsp; o en el establecimiento d&oacute;nde se realiz&oacute; la compra del mismo.</li>
                    </ol>
                   
                    <p>En caso de que no se pueda establecer contacto con el <strong>USUARIO GANADOR</strong>, &eacute;ste se deber&aacute; comunicar dentro un plazo m&aacute;ximo de quince (15) d&iacute;as h&aacute;biles adicionales al t&eacute;rmino anterior, con el WhatsApp habilitado No. (57) 3154771684 &nbsp;o v&iacute;a correo electr&oacute;nico con el Centro de Contacto: <a href="mailto:soportedestapatusuerte@gmail.com">soportedestapatusuerte@gmail.com</a>.</p>
                   
                    <p>El plazo m&aacute;ximo para la entrega de este tipo de premios ser&aacute; de treinta (30) d&iacute;as h&aacute;biles, posterior y a partir del contacto y acuerdo entre el ENCARGADO y el USUARIO GANADOR.</p>
                   
                    <ol>
                    <li>La constancia de la entrega del premio tipo A ser&aacute; el certificado de entrega expedido por la transportadora.</li>
                    </ol>
                   
                    <p>PREMIOS TIPO B (Pines o Cuentas Amazon por 1 mes / Giro por $100.000 pesos)</p>
                   
                    <p>Premios Cuentas digitales AMAZON (acceso a una cuenta de AMAZON por el plazo m&aacute;ximo de un (1) mes)</p>
                   
                    <p>Este premio ser&aacute; enviado al correo electr&oacute;nico registrado por el USUARIO GANADOR en un plazo m&aacute;ximo de SETENTA Y DOS (72) horas posteriores al registro en la plataforma del c&oacute;digo ganador.</p>
                   
                    <p>El Usuario ganador tendr&aacute; seis (6) meses contados a partir de la fecha del env&iacute;o del pin v&iacute;a correo electr&oacute;nico para hacer efectiva la recarga y usar los servicios de AMAZON PRIME. *Aplican condiciones y restricciones del proveedor (AMAZON).</p>
                   
                    <p>En caso de presentarse alg&uacute;n inconveniente con el premio, el&nbsp; USUARIO GANADOR podr&aacute; comunicarse con nuestro CENTRO DE CONTACTO al correo: <a href="mailto:soportedestapatusuerte@gmail.com">soportedestapatusuerte@gmail.com</a>. o escribir al whatsapp No. (57) 3154771684</p>
                   
                    <p>Premios Giro por cien mil pesos ($100.000) SURED</p>
                   
                    <p>Una vez se haya registrado el c&oacute;digo ganador en la plataforma, en un plazo m&aacute;ximo de setenta y dos (72) horas el CENTRO DE CONTACTO se comunicar&aacute; v&iacute;a WhatsApp o celular con el ganador, para coordinar la entrega del premio en el menor tiempo posible o en un plazo m&aacute;ximo estimado de 15 d&iacute;as a partir del contacto con el USUARIO GANADOR.</p>
                   
                    <p>El valor del premio se realizar&aacute; a trav&eacute;s de un GIRO al nombre y c&eacute;dula del USUARIO GANADOR registrado y &eacute;ste podr&aacute; retirar el dinero en cualquier punto de canje de SU RED en el territorio nacional.</p>
                   
                    <p>PREMIOS TIPO C (Recargas a celular por CINCO MIL PESOS ($5.000) / Recargas para apuestas en l&iacute;nea BETPLAY)</p>
                   
                    <p>Recargas a celular por CINCO MIL PESOS $5.000</p>
                   
                    <p>Este premio ser&aacute; cargado de forma directa al n&uacute;mero celular registrado en la plataforma por el USUARIO GANADOR en un plazo m&aacute;ximo de setenta y dos (72) horas, posterior al registro del c&oacute;digo ganador.</p>
                   
                    <p>Recargas de CINCO MIL PESOS $5.000 para apuestas en l&iacute;nea bajo la plataforma Betplay</h>
                   
                    <p>S&iacute; el USUARIO PARTICIPANTE resulta ganador de este premio, tendr&aacute; un link dentro de la plataforma de la promoci&oacute;n <a href="http://www.destapatusuerte.com">www.destapatusuerte.com</a>, sobre el cual deber&aacute; dar CLICK y este lo llevar&aacute; directamente a la plataforma BETPLAY, d&oacute;nde podr&aacute; participar y apostar el valor del premio asignado ($5.000 COP) siguiendo las instrucciones que all&iacute; se establecen para tal efecto.</p>
                   
                    <p>NOTA: Para todos los casos, esto es premios tipo A, premios Tipo B y Premios tipo C, el usuario ganador tendr&aacute; plazo hasta el 15 de febrero del 2022 para ingresar a la plataforma <a href="http://www.destapatusuerte.com">www.destapatusuerte.com</a> el c&oacute;digo ganador, sin perjuicio de la fecha de la compra, fecha en la cual empezara a correr los t&eacute;rminos para la entrega del premio.</p>
                   
                    <ol start="9">
                    <li><strong>RENUNCIA DEL PREMIO O NO POSIBILIDAD DE RECIBIRLO:</strong></li>
                    </ol>
                   
                    <p>Para que un Usuario Participante pueda hacerse ganador/ acreedor de cualquiera de los premios estipulados, debe cumplir con los siguientes&nbsp;&nbsp; requisitos:</p>
                   
                    <ul>
                    <li>Comprar cualquiera de los productos participantes y haber sido favorecido con una tapa que contenga un c&oacute;digo ganador bajo la misma.</li>
                    </ul>
                   
                    <ul>
                    <li>Haberse registrado con todos los datos solicitados en la plataforma.</li>
                    </ul>
                   
                    <ul>
                    <li>Contestar la llamada de contacto de la PROMOCI&Oacute;N o establecer contacto, en el tiempo indicado y haber confirmado su aceptaci&oacute;n, as&iacute; como el registro de su nombre, documento de identificaci&oacute;n, correo electr&oacute;nico y n&uacute;mero de tel&eacute;fono celular.</li>
                    </ul>
                   
                    <p><strong>EL ORGANIZADOR Y RESPONSABLE y La&nbsp; FLA EICE</strong> no se har&aacute; responsable si un ganador no puede recibir su premio por causas o acontecimientos de fuerza mayor o caso fortuito, as&iacute; como por errores en los datos de identificaci&oacute;n registrados por el Usuario Participante en la plataforma web www.destapatusuerte.com;&nbsp; Si el ganador no acepta el premio o sus condiciones, o no&nbsp; puede recibirlo, este premio se considera renunciado o extinguido con respecto al ganador y &eacute;ste&nbsp; &uacute;ltimo no tendr&aacute; derecho a solicitar indemnizaci&oacute;n alguna o al cambio del premio por dinero o&nbsp; por otro premio.</p>
                   
                    <p>EL ORGANIZADOR y/o la FLA EICE se reserva el derecho de descalificar a cualquier Usuario Participante y Ganador que considere que est&eacute; manipulando el proceso, o el funcionamiento de la Promoci&oacute;n, o que no cumpla con los t&eacute;rminos y condiciones, o act&uacute;e de una forma que atente contra el honor, dignidad, intimidad, imagen, integridad f&iacute;sica y moral de los dem&aacute;s Usuarios EL ORGANIZADOR Y RESPONSABLE y LA F&Aacute;BRICA DE LICORES Y ALCOHOLES DE ANTIOQUIA.</p>
                    
                    <ol start="10">
                    <li><strong>DISPOSICIONES GENERALES </strong></li>
                    </ol>
                   
                    <ul>
                    <li>La Promoci&oacute;n ser&aacute; difundida a los Usuarios a trav&eacute;s de los Stickers informativos en las botellas participantes, material de comunicaci&oacute;n en Punto de Venta (Afiches, saltarines, banderines; redes sociales [cu&aacute;les y de qui&eacute;n]; eucoles; medios digitales V&iacute;deo promocional en la p&aacute;gina&nbsp; web <a href="http://www.destapatusuerte.com">destapatusuerte.com</a>; pauta digital e influencers.</li>
                    </ul>
                   
                    <ul>
                    <li>Es responsabilidad del Usuario Ganador entregar correctamente los datos a nuestro centro de contacto y registrar correctamente los datos en la p&aacute;gina web <a href="http://www.destapatusuerte.com">destapatusuerte.com</a></li>
                    </ul>
                   
                    <ul>
                    <li>Los ganadores aceptan que cualquier imprevisto, motivo de fuerza mayor, caso fortuito o da&ntilde;o que pueda ser ocasionado con los premios recibidos, obedece a situaciones externas que eximen de responsabilidad a LOS ORGANIZADORES Y RESPONSABLES.</li>
                    </ul>
                   
                    <ul>
                    <li>LOS ORGANIZADORES Y RESPONSABLES y la FLA EICE no responder&aacute;n por los impuestos que se generen como matricula, impuestos de rodamiento o circulaci&oacute;n, ganancia ocasional, timbres y/o cualquiera otro gravamen, tasa o contribuci&oacute;n que se genere para todos los premios que se entregan, en el entendido que dichos impuestos, tasas, contribuciones o grav&aacute;menes deben ser asumidos &uacute;nica y exclusivamente por el Usuario Ganador del premio, quien, en caso de ser aplicable, deber&aacute; acreditar el pago de los mismos previo a&nbsp; la entrega del premio.</li>
                    </ul>
                   
                    <ul>
                    <li>El valor correspondiente a la ganancia ocasional ser&aacute; asumido por el Usuario Ganador.</li>
                    </ul>
                   
                    <ul>
                    <li>En caso de presentarse eventos de fuerza mayor, caso fortuito, o hechos de terceros que afecten la Promoci&oacute;n, o en el evento de presentarse un fraude en perjuicio de LOS ORGANIZADORES Y RESPONSABLES o de los Usuario de la PROMOCI&Oacute;N, EL ORGANIZADOR Y LOS RESPONSABLES podr&aacute;n modificar en todo o en parte esta PROMOCI&Oacute;N, as&iacute; como suspenderla temporal o permanentemente sin asumir ninguna responsabilidad al respecto.</li>
                    </ul>
                   
                    <ul>
                    <li>Los USUARIOS PARTICIPANTES Y LOS USUARIOS GANADORES autorizan de manera expresa libre e informada la utilizaci&oacute;n, publicación y reproducción, sin limitación o restricción alguna, de su imagen, nombre, ciudad y fotografía en cualquier tipo de publicidad, promoci&oacute;n, publicaci&oacute;n, a través de cualquier medio, con fines comerciales o informativos por parte de los organizadores. Los participantes y/o ganadores no tendrán derecho a recibir contraprestación alguna por los hechos descritos en el presente numeral.</li>
                    </ul>
                   
                    <ul>
                    <li>Se proh&iacute;be la publicaci&oacute;n en la p&aacute;gina webdestapatusuerte.com de informaciones difamatorias, amenazantes o con contenidos que vayan contra la ley. LOS ORGANIZADORES Y RESPONSABLES y la FLA EICE, se reserva el derecho de eliminar del sitio cualquier material que considere inadecuado, derecho &eacute;ste que podr&aacute; ejercer en cualquier momento.</li>
                    </ul>
                   
                    <ul>
                    <li>Las marcas, nombres comerciales, ense&ntilde;as, gr&aacute;ficos, dibujos, dise&ntilde;os y cualquier otra figura que constituya propiedad intelectual o industrial y que aparezca en la p&aacute;gina web destapatusuerte.com, est&aacute;n protegidos a favor de LA FLA EICE, de conformidad con las disposiciones legales sobre la materia. En consecuencia, los elementos aqu&iacute; referidos no podr&aacute;n ser utilizados, modificados, copiados, reproducidos, transmitidos o distribuidos de ninguna manera y por ning&uacute;n medio, salvo autorizaci&oacute;n previa, escrita y expresa de la compa&ntilde;&iacute;a. Los contenidos protegidos de conformidad con el p&aacute;rrafo anterior incluyen: textos, im&aacute;genes, ilustraciones, dibujos, dise&ntilde;os, software, m&uacute;sica, sonido, fotograf&iacute;as y videos, adem&aacute;s de cualquier otro medio o forma de difusi&oacute;n de dichos contenidos.</li>
                    <li>Los premios aqu&iacute; ofrecidos no ser&aacute;n canjeables en ninguna circunstancia, por dinero en efectivo, y el Usuario Ganador que no pueda recibir su premio no tendr&aacute; derecho a compensaci&oacute;n alguna.</li>
                    </ul>
                   
                   
                    <ol start="11">
                    <li><strong> PETICIONES, QUEJAS, RECLAMOS, SOLICITUDES E INQUIETUDES DE LA PROMOCI&Oacute;N</strong></li>
                    </ol>
                   
                    <p>El canal de atenci&oacute;n para peticiones, quejas, reclamos, solicitudes o inquietudes que tenga el&nbsp;&nbsp; usuario respecto de la Promoci&oacute;n ser&aacute;: soportedestapatusuerte@gmail.com o en su defecto al WhatsApp no. (57) 3154771684.</p>
                   
                    <p>Las decisiones tomadas por LA FLA EICE al momento de resolver las peticiones, quejas, reclamos, solicitudes o inquietudes ser&aacute;n definitivas e independientes, y no afectar&aacute;n de ninguna forma la Promoci&oacute;n.</p>
                   
                    <ol start="12">
                    <li><strong> TRATAMIENTO DE DATOS PERSONALES</strong></li>
                    </ol>
                   
                    <p>El Usuario autoriza expresamente a LA FLA EICE identificada con NIT 901.436.775-1 y a LOS ORGANIZADORES RESPONSABLES UNI&Oacute;N TEMPORAL COMERCIALIZADORES DE LICORES DE ANTIOQUIA, identificada con NIT N&deg; 900.364.114-8, domiciliados en ITAGUI, cuya direcci&oacute;n electr&oacute;nica es <a href="mailto:MERCURIOFLA@FLA.COM.CO">MERCURIOFLA@FLA.COM.CO</a> y <a href="mailto:FELIPE.NAVAS@UNIONT.COM.CO">FELIPE.NAVAS@UNIONT.COM.CO</a> respectivamente (en adelante los &rdquo; Responsables&rdquo; para realizar, el tratamiento de sus datos personales en desarrollo de la Promoci&oacute;n, conforme a las condiciones aplicables establecidas en la Pol&iacute;tica de Tratamiento de la Informaci&oacute;n de la FLA EICE &nbsp;y los comercializadores UNI&Oacute;N TEMPORAL COMERCIALIZADORES DE LICORES DE ANTIOQUIA publicadas en sus p&aacute;ginas web que declara conocer y aceptar. El Usuario Participante y Ganador declara que la informaci&oacute;n proporcionada a trav&eacute;s de cualquier medio es veraz, completa, exacta, actualizada y verificable.</p>
                   
                    <p>Las finalidades aplicables para el tratamiento de los datos personales del Usuario en relaci&oacute;n con la Promoci&oacute;n se describen a continuaci&oacute;n:</p>
                   
                    <ul>
                    <li>Llevar a cabo las actividades derivadas de la PROMOCI&Oacute;N &ldquo;DESTAPA TU SUERTE&rdquo;</li>
                    <li>Informar sobre cambios sustanciales en la Pol&iacute;tica de Tratamiento de Informaci&oacute;n adoptada por el Responsable.</li>
                    <li>Responder a las peticiones, consultas, reclamos y/o quejas que realicen los Titulares a trav&eacute;s de cualquiera de los canales habilitados por el Responsable para dicho efecto.</li>
                    <li>Identificarlo y registrarlo como Usuario para que el Responsable pueda ofrecer y prestar sus servicios.</li>
                    <li>Informar al Usuario sobre las actividades promocionales que llevamos a cabo, todo dentro de los t&eacute;rminos autorizados por la legislaci&oacute;n respectiva.</li>
                    <li>Recolectar, registrar y actualizar los datos personales del Usuario.</li>
                    <li>Responder a solicitudes o requerimientos de informaci&oacute;n de los servicios del Responsable.</li>
                    <li>Enviar al correo f&iacute;sico, electr&oacute;nico, celular o dispositivo m&oacute;vil, v&iacute;a mensajes de texto (SMS y/o MMS) o a trav&eacute;s de cualquier otro medio an&aacute;logo y/o digital de comunicaci&oacute;n creado o por crearse, informaci&oacute;n comercial, publicitaria o promocional sobre los productos y/o servicios, eventos y/o promociones de tipo comercial, con el fin de impulsar, invitar, dirigir, ejecutar, informar y, de manera general, llevar a cabo campa&ntilde;as, promociones o concursos de car&aacute;cter comercial o publicitario, adelantados directamente por el Responsable y/o por terceras personas.</li>
                    <li>Levantar registros contables, financieros y estad&iacute;sticos.</li>
                    <li>Realizar an&aacute;lisis estad&iacute;sticos de tendencias, h&aacute;bitos de consumo y comportamientos del Usuario.</li>
                    <li>Transferir sus datos personales a entidades y/o autoridades judiciales y/o administrativas, cuando estos sean requeridos en relaci&oacute;n con su objeto y necesarios para el cumplimiento de sus funciones legales o contractuales.</li>
                    <li>Transmitir los datos personales respectivos a Encargados, seg&uacute;n aplique, para el cumplimiento de las finalidades descritas anteriormente y conforme con el alcance de las presentes pol&iacute;ticas y la respectiva autorizaci&oacute;n por parte del Titular.</li>
                    <li>Transferir los datos personales respectivos a terceros, seg&uacute;n aplique, para el cumplimiento de las finalidades establecidas por el Responsable receptor y atendiendo a las exigencias legales para este tipo de operaci&oacute;n.</li>
                    </ul>
                   
                    <p>Se le informa al Usuario que, como titular de los datos personales, le asisten los siguientes derechos:</p>
                   
                    <ol>
                    <li>a) Conocer, actualizar y rectificar sus datos personales frente a los Responsables o Encargados.</li>
                    <li>b) Solicitar prueba de la autorizaci&oacute;n otorgada a los Responsables o Encargados.</li>
                    <li>c) Ser informado por los Responsables o Encargados, previa solicitud, respecto del uso que les ha dado a sus datos personales.</li>
                    <li>d) Previa queja o consulta ante los Responsables o Encargados, presentar ante la Superintendencia de Industria y Comercio quejas por infracciones a la normatividad legal aplicable en la Rep&uacute;blica de Colombia.</li>
                    <li>e) Revocar la autorizaci&oacute;n y/o solicitar la supresi&oacute;n del dato cuando en el Tratamiento no se respeten los principios, derechos y garant&iacute;as constitucionales y legales, para la Rep&uacute;blica de Colombia.</li>
                    <li>f) Acceder en forma gratuita a sus datos personales que hayan sido objeto de Tratamiento.</li>
                    </ol>
                   
                    <p>Para consultas, reclamos o ampliar informaci&oacute;n en relaci&oacute;n con sus derechos como titular del tratamiento de datos personales, puede acceder a trav&eacute;s de los canales dispuestos en la Pol&iacute;tica de Tratamiento de Informaci&oacute;n del Responsable.</p>
                   
                   
                    <p>Los T&amp;C se modificar&aacute;n cada vez que exista un cambio en la Promoci&oacute;n que genere cambios en las condiciones de ejecuci&oacute;n de esta. La modificaci&oacute;n de estos ser&aacute; debidamente informada en la p&aacute;gina web <a href="http://www.destapatusuerte.com">www.destapatusuerte.com</a>.</p>
                   
                    <p>***Hasta aqu&iacute; los T&eacute;rminos &amp; Condiciones***</p>
                   
                  </div>
                  
                </div>

                <div class="embed-responsive embed-responsive-16by9 mb-3" style="border-width: 4px; margin-top:5%; border-radius: 5px;">
                  <iframe class="embed-responsive-item" style="border: 6px solid #CCCCCC" src="https://youtube.com/embed/ywlWBlNTmi?autoplay=1&amp;controls=1&amp;mute=0"></iframe>
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
    <script src="assets\js\pages\canjePremio.js?<?php echo date('Ymdhiiss')?>"></script>