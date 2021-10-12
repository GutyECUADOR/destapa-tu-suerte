<?php
  use App\Models\ajaxModel;
  $model = new ajaxModel();
  $resultset = $model->getPuntosVenta();
  var_dump($resultset);
?>

<div class="modal fade" id="puntosVentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Puntos de Venta Autorizados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table">
        <tbody>
          <?php
            foreach ($resultset as $row) {
              echo '
              <tr class="bg-white">
                  <td>'.$row['puntoVenta'].'</td>
              </tr>
              ';
            }

          ?>
          
          
         
        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>