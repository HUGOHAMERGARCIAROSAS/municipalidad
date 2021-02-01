@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="container-fluid card" style="padding: 1%">
                        {!! Form::open(['url'=>'tramitedocumentario/tipotramite/editar','method'=>'post']) !!}
                        {!! Form::token() !!}
                        <div class="card card-gray">
                            <div class="card-header text-center">
                                <h3 class="card-title">{{$pagina}}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="codcontri" value="{{$tipotramite[0]->tptra_id}}">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>Fecha de Registro</label>
                                        <input type="date" name="freg" class="form-control ui-datepicker"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group-lg col-lg-8 col-md-8 col-sm-8">
                                        <label>Destino</label>
                                        <select class="form-control  select2-blue" name="persona" id="persona">
                                        </select>
                                    </div>
                                    <div class="form-group-lg form-check col-lg-6 col-md-6 col-sm-6">
                                <textarea type="text" class="form-control" cols="40" rows="1" name="observ"
                                          placeholder="Ingresar contraseña" style="font-size: 12px;">
                                </textarea>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 1%">
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <a href="{{url('tramitedocumentario/tipotramites')}}"><input type="button"
                                                                                                     class="btn btn-danger"
                                                                                                     value="Cancelar"></a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection