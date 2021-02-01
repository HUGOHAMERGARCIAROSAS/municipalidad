<div class="modal fade show" id="{{"modal-derivar-".$i->id}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            {!! Form::open(['url'=>'tramitedocumentario/solicitudes/derivar','method'=>'POST']) !!}
            {!! Form::token() !!}
            <div class="modal-header text-center">
                <h4 class="modal-title">DERIVAR SOLICITUD WEB {{$i->id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <input type="hidden" name="id" value="{{$i->id}}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label>Área a derivar:</label>
                        <select class="form-control  select2-blue" name="area" id="areaT">
                            <option value="" selected>Seleccionar Área</option>
                            @foreach($areas1 as $a)
                                <option value="{{$a->valor}}">{{$a->texto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Derivar</button>
            </div>
            {!! Form::close()!!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>