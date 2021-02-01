<div class="modal fade show" id="{{"modal-archivar-".$e->coddocumento}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['url'=>'tramitedocumentario/expediente/archivar','method'=>'POST']) !!}
            {!! Form::token() !!}
            <div class="modal-header">
                <h4 class="modal-title text-center">ARCHIVAR EL EXPEDIENTE {{$e->numero}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <input type="hidden" name="exp" value="{{$e->coddocumento}}">
                <input type="hidden" name="anio" value="{{$e->anio}}">
                <input type="hidden" name="folios" value="{{$e->folios}}">
                <input type="hidden" name="asunto" value="{{$e->asunto}}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Área a derivar:</label>
                        <select class="form-control  select2-blue" name="area1" >
                            <option value="" selected>Seleccionar Área</option>
                            @foreach($areas1 as $a)
                                <option value="{{$a->valor}}">{{$a->texto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Observación:</label>
                        <textarea type="text" class="form-control" cols="40" rows="1" name="observ" style="font-size: 12px;"></textarea>
                    </div>
                </div>
                <div class="form-group-lg form-check col-lg-6 col-md-6 col-sm-6">
                    <input type="checkbox" class="form-check-input" name="copia">
                    <label class="form-check-label">Copia</label>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Archivar</button>
            </div>
            {!! Form::close()!!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>