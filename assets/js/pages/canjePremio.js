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
                    this.usuario = new Usuario();
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
                                '<b> <img src="'+ response.premio.url_imagen +'" alt="premio" style="width: 90%;height: 250px;"></b>' +
                                '<b>' + response.premio.nombre_premio + '</b>' +
                                '<br><div style="font-size:14px">' +
                                '<br><label>Ingrese Número de Teléfono Celular</label>' +
                                '<input id="swal-input-number" class="swal2-input">' +
                                '<br><label style="color: red;margin-top: 5px;font-size: 12px;">Puedes dejar el campo teléfono en blanco y agregarlo después en tu perfil, después de agregarlo no puedes cambiarlo ni corregirlo.</label>' +
                                '<br><label style="margin-top: 10px;">Ingrese Nombre de la Operadora (Tiggo, Claro, Movistar, etc)</label>' +
                                '<select id="swal-input-operadora" class="swal2-input">'+
                                    '+<option value="Tiggo" selected>Tiggo</option>'+
                                    '+<option value="Claro" >Claro</option>'+
                                    '+<option value="Movistar">Movistar</option>'+
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
                            this.updateRecargaData(formValues);
                          }
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
                    this.search_user.isloading = false
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

            
        }
    },
    mounted(){

    }
 
})
