@extends('layout.index3')
@section('content')
    <div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Editar Plantilla "{{$plantilla[0]->plarol_nombre}}"</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="container-fluid card" style="padding: 1%">
                                {!! Form::open(['url'=>'/administracion/plantillas/'.$plantilla[0]->plarol_id,'method'=>'post']) !!}
                                {!! Form::token() !!}
                                <div class="row">
                                    <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                        <label>Plantilla</label>
                                        <input type="text" class="form-control" name="plantilla"
                                               placeholder="Ingresar plantilla"
                                               value="{{ $plantilla[0]->plarol_nombre }}">
                                    </div>
                                    <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                        <label>Descripcion</label>
                                        <input type="text" class="form-control" name="descripcion"
                                               placeholder="Ingresar descripcion"
                                               value="{{ $plantilla[0]->plarol_descripcion }}">
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 1%">
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <a href="{{url('administracion/plantillas')}}"><input type="button"
                                                                                              class="btn btn-danger"
                                                                                              value="Cancelar"></a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <input type="submit" class="btn btn-primary" value="Guardar">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
