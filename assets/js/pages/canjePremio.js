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
        title: 'Evento en Vivo',
        usuario: new Usuario(),
        instruccionesCanje: '',
        url_link: '',
        search_user: {
        isloading: false,
        isAutenticated: false
        },
    },
    methods:{
        async verify_code() {
            if (!this.validateForm()) {
                return;
            }

            this.search_user.isloading = true;
            let formData = new FormData();
            formData.append('usuario', JSON.stringify(this.usuario));  
            const response = await fetch(`./api/index.php?action=verify_code`, {
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
            if (response.usuario) {
                this.search_user.isAutenticated = true;
               
                if (response.status == 'success') {
                    this.usuario = new Usuario();
                    this.instruccionesCanje = response.usuario.instrucciones;
                    this.url_link = response.usuario.url_link;
                    
                    if (this.url_link) {
                        this.link = '<br><a href="'+ this.url_link +'" target="_blank">Clic Aqui </a> '
                    }else{
                        this.link = '';
                    }

                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        confirmButtonText: "Aceptar",
                        html:
                            '<b>' + response.usuario.premio + '</b>.' +
                            '<br>' +  this.instruccionesCanje +
                            this.link
                      })

                   
                }else{
                    alert(data.mensaje  + 'Si el problema persiste. Comuniquese a nuestro centro a atencion al cliente.');
                   
                }
            }else{
                this.search_user.isAutenticated = false;
                alert(response.message);
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
