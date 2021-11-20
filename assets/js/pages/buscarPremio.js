class Usuario {
    constructor() {
      this.cedula = '';
      this.telefono = '';
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
        }, 
        async registrarTelefono(premio){
            const { value: formValues } = await Swal.fire({
                icon: 'success',
                title: premio.message,
                confirmButtonText: "Aceptar",
                confirmButtonColor: '#1c7e16',
                html:
                    '<b> <img src="'+ premio.url_imagen +'" alt="premio" style="width: 90%;"></b>' +
                    '<b>' + premio.nombre_premio + '</b>' +
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
                      codigo: premio.codigo
                  }
                }
              })
              
              if (formValues) {
                if (formValues.telefono.length != 10) {
                  formValues.telefono = '';
                }
              this.updateRecargaData(formValues);
            }
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
            console.log(response.codigobetpay);
            return response.codigobetpay; 
        }, 
        showcode(dni){
            let codigo = this.getBetPlayCode(dni);
            return codigo;
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
