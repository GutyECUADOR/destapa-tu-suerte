class Usuario {
    constructor() {
      this.nombre = '';
      this.cedula = '';
      this.confcedula = '';
      this.telefono = '';
      this.conftelefono = '';
      this.correo = '';
      this.terminos = false
      this.codigo = '';
    }

}

const app = new Vue({
    el: '#app',
    data: {
        title: 'Canje de Premios',
        usuario: new Usuario(),
        instruccionesCanje: '',
        url_link: '',
        search_user: {
        isloading: false,
        isAutenticated: false
        },
    },
    methods:{
        async procesar_premio() {
            if (!this.validateForm()) {
                return;
            }

            this.search_user.isloading = true;
            let formData = new FormData();
            formData.append('usuario', JSON.stringify(this.usuario));  
            const response = await fetch(`./api/index.php?action=procesar_premio`, {
                method: 'POST',
                body: formData
                })
                .then(response => {
                    this.search_user.isloading = false
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 

                console.log(response);
            
                if (response.status == 'success') {
                    this.usuario = new Usuario(); //Resetea el formulario al enviar
                    this.instruccionesCanje = response.premio.instrucciones;
                    this.url_link = response.premio.url_link;
                    
                    if (this.url_link) {
                        this.link = '<br><a href="'+ this.url_link +'" target="_blank">Clic Aqui </a> '
                    }else{
                        this.link = '';
                    }

                    if (response.premio.premio_id == 7) {
                        const { value: formValues } = await Swal.fire({
                            icon: 'success',
                            title: response.message,
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: '#1c7e16',
                            html:
                                '<b> <img src="'+ response.premio.url_imagen +'" alt="premio" style="width: 90%"></b>' +
                                '<b>' + response.premio.nombre_premio + '</b>' +
                                '<br><div style="font-size:14px">' +
                                '<br><label>Ingrese Número de Teléfono Celular</label>' +
                                '<input id="swal-input-number" class="swal2-input">' +
                                '<br><label style="color: red;margin-top: 5px;font-size: 12px;">Puedes dejar el campo teléfono en blanco y agregarlo después en tu perfil, después de agregarlo no puedes cambiarlo ni corregirlo.</label>' +
                                '<br><label style="margin-top: 10px;">Ingrese Nombre de la Operadora (Tiggo, Claro, Movistar, etc)</label>' +
                                '<select id="swal-input-operadora" class="swal2-input">'+
                                    '+<option value="Avantel" selected>Avantel</option>'+
                                    '+<option value="Claro" >Claro</option>'+
                                    '+<option value="ETB">ETB</option>'+
                                    '+<option value="FlashMobile">FlashMobile</option>'+
                                    '+<option value="Kalley">Kalley</option>'+
                                    '+<option value="MovilExito">MovilExito</option>'+
                                    '+<option value="Movistar">Movistar</option>'+
                                    '+<option value="Tigo">Tigo</option>'+
                                    '+<option value="Virgin">Virgin</option>'+
                                    '+<option value="WOM">WOM</option>'+
                                '</select>' +
                                '</div>',
                            focusConfirm: false,
                            preConfirm: () => {
                              return {
                                  telefono: document.getElementById('swal-input-number').value,
                                  operadora: document.getElementById('swal-input-operadora').value,
                                  codigo: response.premio.codigo
                              }
                            }
                          })
                          
                          if (formValues) {
                              if (formValues.telefono.length != 10) {
                                formValues.telefono = '';
                              }
                            this.updateRecargaData(formValues);
                          }
                    }else if (response.premio.premio_id == 8) {
                        const codigoBetplay = await this.getBetPlayCode(response.premio.dni);
                        if (codigoBetplay.codigobetpay) {
                            var msg_betplay = codigoBetplay.codigobetpay;
                        }else{
                            var msg_betplay = codigoBetplay.message;
                        }
                       
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: '#1c7e16',
                            html:
                                '<b> <img src="'+ response.premio.url_imagen +'" alt="premio" style="width: 90%;"></b>' +
                                '<b>' + response.premio.nombre_premio + '</b>' +
                                '<p style="text-align: left; margin-top: 10px;">Felicitaciones ganaste un bono de $5000 para apuestas deportivas en linea en la plataforma Betplay<br />Sigue las siguientes indicaciones para hacer efectivo tu bono.<br />1. Si no estas registrado aun en la plataforma de Betplay, registrate.</p>'+
                                '<p style="margin-top: 10px; text-align: center;"><a href="https://betplay.com.co/registrarse" target="_blank">Reg&iacute;strate</a><br /><a href="https://www.youtube.com/watch?v=dj6ZAko1tB8&amp;ab_channel=BetPlay" target="_blank">Video Explicativo</a></p>'+
                                '<p style="margin-top: 10px;">2. Ingresa a tu cuenta y redime tu bono de $5000 para apuestas deportivas con este c&oacute;digo: <div id="codigobetplay" onclick="CopyToClipboard();return false;" style="font-size:20px; color:green">'+ msg_betplay  +'</div></p>'+
                                '<p style="margin-top: 10px;">3. Apuesta desde 500 pesos en nuestra plataforma y podr&aacute;s ganar hasta 500 millones de pesos<br />aplican t&eacute;rminos y condiciones&nbsp;</p>'+
                                '<p style="margin-top: 10px; text-align: center;"><a href="https://apicrm.betplay.com.co/terms/Terminos%20y%20condiciones%20202111.pdf" target="_blank" rel="noopener">T&eacute;rminos &amp; Condiciones</a></p>'+
                                '<p style="text-align: left;">4. Si tienes alguna duda o inconveniente en la plataforma de Betplay comunicate con (l&iacute;nea 018000112188 o correo ayuda.corredor@cempresarial.co.</p>'
                          })
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: '#1c7e16',
                            html:
                                '<b> <img src="'+ response.premio.url_imagen +'" alt="premio" style="width: 90%;"></b>' +
                                '<b>' + response.premio.nombre_premio + '</b>' +
                                '<br><div style="font-size:14px">' +  this.instruccionesCanje + '</div>'
                          })
                    }

                    

                   
                }else{
                  
                    Swal.fire({
                        icon: 'warning',
                        title: 'Código no válido',
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: '#1c7e16',
                        text: response.message
                    })
                }
           
            
            
            
        },
        validateForm(){

            if (this.usuario.cedula != this.usuario.confcedula || this.usuario.confcedula.length < 0) {
                alert('El documento de identidad y su verificación no coinciden.');
                return false;
            }

            if (this.usuario.telefono != this.usuario.conftelefono || this.usuario.conftelefono.length < 0) {
                alert('El número de teléfono y su verificación no coinciden.');
                return false;
            }

            if (!this.usuario.terminos) {
                alert('Acepte nuestros Terminos & Condiciones para poder participar.');
                return false;
            }
            return true;
        }, 
        async updateRecargaData(recargadata){
            let formData = new FormData();
            formData.append('recargadata', JSON.stringify(recargadata));  
            const response = await fetch(`./api/index.php?action=updateRecargaData`, {
                method: 'POST',
                body: formData
                })
                .then(response => {
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 

            if (response.status == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Realizado',
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: '#1c7e16',
                    text: response.message
                  })
            }else{
                Swal.fire({
                    icon: 'warning',
                    title: 'Hubo un problema en el registro',
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: '#1c7e16',
                    text: response.message
                  })
            }

            
        },
        async getBetPlayCode(dni){
            let formData = new FormData();
            formData.append('dni', JSON.stringify({'dni': dni}));  
            const response = await fetch(`./api/index.php?action=getBetPlayCode`, {
                method: 'POST',
                body: formData
                })
                .then(response => {
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 
            return response; 
        }, 
        CopyToClipboard(){
            var r = document.createRange();
            r.selectNode(document.getElementById('codigobetplay'));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(r);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
        }
    },
    mounted(){

    }
 
})
