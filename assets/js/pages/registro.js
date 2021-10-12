const app = new Vue({
    el: '#app',
    data: {
      titulo: 'Registro Clientes',
      cliente: new Cliente(),
      ciudades:[],
      puntosVenta:[]
    },
    methods:{
        init(){
            fetch(`./api/index.php?action=getInfoInitForm`)
                .then( response => {
                return response.json();
                })
                .then( result => {
                console.log('InitForm', result.data);
                this.ciudades = result.data.ciudades;  
                this.puntosVenta = result.data.puntosVenta; 
               
            }).catch( error => {
                console.error(error);
            });  
        },
        addNewCliente(){
            console.log(this.cliente);
            
            let reg_nombres = /^[a-zA-Z\s]*$/;
            if (!reg_nombres.test(this.cliente.nombres)) {
                alert('Ingrese un nombre válido. Solo letras y sin acentos');
                return false;
            }

            if (!this.cliente.nombres) {
                alert('Ingrese su nombre completo.');
                return
            }

            
            let reg_cedula = /^[A-Za-z0-9]+$/g;
            if (!reg_cedula.test(this.cliente.cedula)) {
                alert('Ingrese un número de documento de identificación válido. De hasta 13 caracteres sin espacios.');
                return false;
            }

            if (this.cliente.cedula != this.cliente.confcedula || this.cliente.confcedula.length < 0) {
                alert('El documento de identidad y su verificación no coinciden.');
                return false;
            }

            let reg_telefono = /^([0-9]){6,10}$/;
            if (!reg_telefono.test(this.cliente.telefono)) {
                alert('Ingrese un numero de telefono celular correcto. Solo números y máximo 10 digitos.');
                return false;
            }

            if (this.cliente.telefono != this.cliente.conftelefono || this.cliente.conftelefono.length < 0) {
                alert('El número de teléfono y su verificación no coinciden.');
                return false;
            }


            if (!this.cliente.terminos) {
                alert('Acepte nuestros Terminos & Condiciones para poder participar.');
                return
            }



            let formData = new FormData();
            formData.append('cliente', JSON.stringify(this.cliente));  
          

            fetch(`./api/index.php?action=postAddCliente`, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data)
                if (data.status == 'success') {
                    //alert(data.mensaje);
                    this.cliente = new Cliente();

                    swal({
                    title: "Listo!!!",
                    text: data.mensaje,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                    },
                    function(){
                        window.location = './index.php?action=login'
                    });

                   
                }else{
                    alert(data.mensaje  + 'Si el problema persiste. Comuniquese a nuestro centro a atencion al cliente.');
                   
                }

               
            }).catch(function(error) {
                console.error(error);
            });  

           
            
            
        }
    },
    mounted(){
        $('[data-toggle="popover"]').popover()
        $("button").popover("show");
        
      }
  })
