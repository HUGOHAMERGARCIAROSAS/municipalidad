<div class="modal fade show" id="modal-default" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar Acción</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-nombre">Está seguro de querer cambiar el estado del usuario <b>{{ $p->per_login }}</b>
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                {!! Form::open(['url'=>'administracion/usuario/estado/','method'=>'POST']) !!}
                {!! Form::token() !!}
                <input type="hidden" name="codigo" id="codigo" value="{{$p->per_codigo}}">
                <input type="hidden" name="login" id="login" value="{{$p->per_login}}">
                <input type="hidden" name="valor" id="valor" value="{{$p->estado}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
                {!! Form::close()!!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

