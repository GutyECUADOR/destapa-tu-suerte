class Usuario {
    constructor() {
      this.cedula = '';
      this.terminos = false
    }

}

const app = new Vue({
    el: '#app',
    data: {
        title: 'Busquesa de Premios',
        usuario: new Usuario(),
        instruccionesCanje: '',
        url_link: '',
        search_user: {
            isloading: false,
            isAutenticated: false,
            premios: []
        },
    },
    methods:{
        async searchPremios() {
            if (!this.validateForm()) {
                return;
            }

            this.search_user.isloading = true;
            let formData = new FormData();
            formData.append('usuario', JSON.stringify(this.usuario));  
            const response = await fetch(`./api/index.php?action=searchPremios`, {
                method: 'POST',
                body: formData
                })
                .then(response => {
                    this.search_user.isloading = false;
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 

            console.log(response.data);
            this.search_user.premios = response.data;
           
            
            
        },
        validateForm(){

            if (!this.usuario.cedula) {
                alert('El documento de identidad no se ha indicado.');
                return false;
            }

            if (!this.usuario.terminos) {
                alert('Acepte nuestros Terminos & Condiciones para realizar la búsqueda.');
                return false;
            }
            return true;
        }
    },
    mounted(){

    }
 
})
