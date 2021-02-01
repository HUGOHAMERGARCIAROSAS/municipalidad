@extends('layout.index3')
@section('content')
    <div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Registrar Usuario</h3>

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
                                {!! Form::open(['url'=>'administracion/usuarios/registrar','method'=>'post']) !!}
                                {!! Form::token() !!}
                                <div class="row">
                                    <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                        <label>Seleccionar Persona</label>
                                        <select class="form-control  select2-blue" name="persona" id="persona">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" name="login"
                                               placeholder="Ingresar usuario">
                                    </div>
                                    <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control" name="pass"
                                               placeholder="Ingresar contraseña">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                        <label>Seleccionar Área</label>
                                        <select class="form-control select2bs4 select2-blue" name="area">
                                            @foreach($areas as $a)
                                                <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                        <label>Seleccionar Plantilla Rol</label>
                                        <select class="form-control select2bs4 select2-blue" name="plantilla">
                                            @foreach($plantillas as $p)
                                                <option value="{{$p->plarol_id}}">{{$p->plarol_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 1%">
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <a href="{{url('administracion/usuarios')}}"><input type="button"
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
