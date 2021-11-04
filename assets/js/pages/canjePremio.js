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
                    //this.usuario = new Usuario();
                    this.instruccionesCanje = response.premio.instrucciones;
                    this.url_link = response.premio.url_link;
                    
                    if (this.url_link) {
                        this.link = '<br><a href="'+ this.url_link +'" target="_blank">Clic Aqui </a> '
                    }else{
                        this.link = '';
                    }

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: '#1c7e16',
                        html:
                            '<b> <img src="'+ response.premio.url_imagen +'" alt="premio" style="width: 400px;height: 250px;"></b>' +
                            '<b>' + response.premio.nombre_premio + '</b>' +
                            '<br><div style="font-size:14px">' +  this.instruccionesCanje + '</div>' +
                            this.link
                      })

                   
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
        }
    },
    mounted(){

    }
 
})
