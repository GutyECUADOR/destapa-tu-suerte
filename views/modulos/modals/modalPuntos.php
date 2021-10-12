<div class="modal fade" id="modalPuntos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Puntos a Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="submitPuntos">
        <div class="modal-body">
            <div class="form-group">
              <label for="factura" class="col-form-label">Punto Venta (NIT):</label>
              <input type="text" v-model="clientePuntos.puntoVenta" class="form-control form-control-sm">
            </div>
            <div class="form-group">
              <label for="factura" class="col-form-label">Nombre:</label>
              <input type="text" v-model="clientePuntos.nombre" class="form-control form-control-sm">
              
            </div>
            <div class="form-group">
              <label for="factura" class="col-form-label">Número de factura:</label>
              <input type="text" v-model="clientePuntos.factura" class="form-control form-control-sm">
            </div>
            <div class="form-group">
              <label for="cedula" class="col-form-label">Documento de Identidad:</label>
              <input type="text" @keyup="getUsuario()" v-model="clientePuntos.cedula" class="form-control form-control-sm" :class="{ 'is-invalid': statusCedula.error == true, 'is-valid': statusCedula.error == false }">
              <div class="invalid-feedback">
                {{ statusCedula.message }}
              </div>
              <div class="valid-feedback">
                {{ statusCedula.message }}
              </div>
            </div>
            <div class="form-group">
              <label for="fecha" class="col-form-label">Fecha:</label>
              <input type="text" v-model="clientePuntos.fecha" class="form-control form-control-sm" id="fechaPuntos" placeholder="Fecha" data-flatpickr data-alt-input="true">
            </div>
            <div class="form-group">
              <label for="valor" class="col-form-label">Valor:</label>
              <input type="number" v-model="clientePuntos.valor" @keyup="calcularKilos()" class="form-control form-control-sm" id="valor">
            </div>
            <div class="form-group">
              <label for="Kilos" class="col-form-label">Puntos: (Autocalculado)</label>
              <input type="number" v-model="clientePuntos.kilos" class="form-control form-control-sm" id="Kilos" readonly>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Agregar Puntos</button>
        </div>
      </form>
    </div>
  </div>
</div>