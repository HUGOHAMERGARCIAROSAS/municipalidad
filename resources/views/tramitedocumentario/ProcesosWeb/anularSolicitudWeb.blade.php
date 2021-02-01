<div class="modal fade show" id="{{"modal-anular-".$i->id}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['url'=>'tramitedocumentario/solicitudes/anular','method'=>'POST']) !!}
            {!! Form::token() !!}
            <div class="modal-header">
                <h4 class="modal-title text-center">ANULAR SOLICITUD WEB {{$i->id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <input type="hidden" name="id" value="{{$i->id}}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Motivo:</label>
                        <textarea type="text" class="form-control" cols="40" rows="2" name="motivo" style="font-size: 12px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Anular</button>
            </div>
            {!! Form::close()!!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>