<div class="modal fade show" id="{{"modal-veradjuntos-".$i->id}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['url'=>'tramitedocumentario/expediente/derivar','method'=>'POST']) !!}
            {!! Form::token() !!}
            <div class="modal-header">
                <h4 class="modal-title text-center">DESCARGAR ARCHIVOS ADJUNTOS DE {{$i->id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="form-group-lg col-lg-12 col-md-12 col-sm-12 text-center">
                        <table class="table table-hover text-nowrap text-center table-responsive">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody id="{{"body-adjuntos-".$i->id}}">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>