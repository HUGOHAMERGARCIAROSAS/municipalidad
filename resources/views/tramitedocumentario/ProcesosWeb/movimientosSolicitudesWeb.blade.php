<div class="modal fade show" id="{{"modal-movimientos-".$i->id}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">MOVIMIENTOS DE SOLICITUD WEB {{$i->id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <table class="table table-hover text-nowrap text-center table-responsive">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Movimiento</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tbody id="cuerpoMovimientos-{{$i->id}}">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>