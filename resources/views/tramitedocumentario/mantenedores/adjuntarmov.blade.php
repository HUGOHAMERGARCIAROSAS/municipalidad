<div class="modal fade show" id="{{"modal-adjuntarmov-".$i}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['url'=>'http://192.168.3.133/Sistemas/TramiteExterno/tramite.php?modulo=movimientos_ar&task=subir1','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            {!! Form::token() !!}
            <div class="modal-header text-center">
                <h4 class="modal-title">ADJUNTAR A EXPEDIENTE {{$m->expediente}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Elegir archivo para adjuntar: </label>
                        <input type="hidden" name="idv" value="{{$m->codregdocumentos}}">
                        <input type="file" name="adjunto" id="adjunto" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Adjuntar</button>
            </div>
            {!! Form::close()!!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>