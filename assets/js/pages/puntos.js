class ClientePuntos {
    constructor() {
        this.puntoVenta = '';
        this.nombre = '';
        this.factura = '';
        this.cedula = '';
        this.fecha = '';
        this.valor = 0;
        this.kilos = 0;
      
    }

  }

class ErrorManager {
    constructor() {
      this.message = '';
      this.error = true;
    }
}

const app = new Vue({
    el: '#app',
    data: {
      titulo: 'Lista Clientes',
      statusCedula: new ErrorManager,
      clientes: [],
      puntosVenta : [],
      clientePuntos: new ClientePuntos()
    },
    methods:{
        getAllClientes(){
            fetch(`./api/index.php?action=getAllClientes`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log('Clientes', data);
                this.clientes = data.data;  
            }).catch( error => {
                console.error(error);
            });  
        },
        submitPuntos(e){
           
          if (this.clientePuntos.puntoVenta && 
            this.clientePuntos.nombre && 
            this.clientePuntos.cedula && 
            this.clientePuntos.fecha && 
            this.clientePuntos.valor && 
            this.clientePuntos.kilos && 
            this.statusCedula.error == false){

                let formData = new FormData();
                formData.append('clientePuntos', JSON.stringify(this.clientePuntos));  
                
                fetch(`./api/index.php?action=postActualizaPuntos`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    console.log('Puntos Actualizados', data);
                    if (data.status === 'success') {
                      this.getAllClientes();
                      this.clientePuntos = new ClientePuntos();
                      let flatpickr = $("#fechaPuntos").flatpickr();
                      flatpickr.clear();
                      this.statusCedula = new ErrorManager();
                    }
                    alert(data.message)
                }).catch(function(error) {
                    console.error(error);
                });  
            } else {
              alert('Complete los datos de registro de forma correcta para agregar puntos.');
            }
        
        },
        getUsuario() {
          fetch(`./api/index.php?action=getUsuarioBy&cedula=${this.clientePuntos.cedula}`)
          .then(response => {
              return response.json();
          })
          .then(usuario => {
            console.log(usuario.data);
              this.statusCedula = [];
             if (usuario.data) {
              this.statusCedula = ({message: `El usuario ${usuario.data.nombres} es correcto.`, error: false});
              if (usuario.data.status == '2') {
                this.statusCedula = ({message:  `El usuario ${usuario.data.nombres} esta baneado de la plataforma.`, error: true});
              }
             }else{
              this.statusCedula = ({message: 'El usuario no existe en la base de datos', error: true});
             
             }
          }).catch( error => {
              console.error(error);
          }); 
          
          
        },
        calcularKilos() {
            this.clientePuntos.kilos = this.clientePuntos.valor / 1000
        }
    },
    mounted(){
        this.getAllClientes();
      }
})

