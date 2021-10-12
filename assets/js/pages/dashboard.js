const app = new Vue({
    el: '#app',
    data: {
      titulo: 'DashBoard',
      totalKilos : 0,
      transacciones: []
    },
    methods:{
        getPuntosByCliente(){
            let cedula = document.querySelector('#cedulaHidden').value;
            fetch(`./api/index.php?action=getAllPuntosByCliente&cedula=${cedula}`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log('Respuesta', data.data);
                this.totalKilos = data.data.totalKilos.totalKilos;
                this.transacciones = data.data.transacciones; 
                console.log(this.totalKilos);
            }).catch(function(error) {
                console.error(error);
            });  
        },jqueryInit(){
            $('[data-toggle="popover"]').popover()
            $("#whatspopover").popover("show");
            $("#tiendaramopopover").popover("show");
        }
       
    },
    mounted(){
        this.getPuntosByCliente();
        this.jqueryInit();
    },
    filters: {
        checkPuntos: function (value) {
            if (value) {
                return value;
            }else{
                return '0'
            }
          }
    },
    nodecimal: function (value) {
            return parseInt(value);
          }
  })
