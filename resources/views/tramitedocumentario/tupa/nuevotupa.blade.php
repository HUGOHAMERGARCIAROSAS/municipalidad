@extends('layouts.main')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-keypad" style="color: #3f6ad8"></i>
                    </div>
                    <div>
                        {{$pagina}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="container-fluid card" style="padding: 1%">
                            @if(isset($proceso))
                                {!! Form::open(['url'=>'tramitedocumentario/procesos/registrar','method'=>'post']) !!}
                                {!! Form::token() !!}
                                <div class="card card-gray">
                                    <div class="card-body">
                                        <input type="hidden" name="proceso" value="{{$proceso[0]->proceso_id}}">
                                        <div class="row">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Área</label>
                                                <select class="form-control select2bs4 select2-blue" name="are_codigo">
                                                    @foreach($areas as $a)
                                                        @if($proceso[0]->are_codigo==$a->Are_Codigo)
                                                            <option value="{{$a->Are_Codigo}}" selected>{{$a->Are_Descripcion}}</option>
                                                        @else
                                                            <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Nombre:</label>
                                                <input type="text" class="form-control" name="nombre" value="{{$proceso[0]->nombre}}">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Sub Nombre:</label>
                                                <input type="text" class="form-control" name="sub_nombre" value="{{$proceso[0]->sub_nombre}}">
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                                <label>Porcentaje UIT:</label>
                                                <input type="number" class="form-control" name="porcentaje_uit" value="{{$proceso[0]->porcentaje_uit}}">
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                                <label>Precio:</label>
                                                <input type="number" class="form-control" name="soles_uit" value="{{$proceso[0]->soles_uit}}">
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                                <label>Días Plazo:</label>
                                                <input type="number" class="form-control" name="plazo_resolver" value="{{$proceso[0]->plazo_resolver}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Área Inicia Proceso:</label>
                                                <select class="form-control select2bs4 select2-blue" name="inicia_proceso">
                                                    @foreach($areas as $a)
                                                        @if($proceso[0]->inicio_procedimiento==$a->Are_Codigo)
                                                            <option value="{{$a->Are_Codigo}}" selected>{{$a->Are_Descripcion}}</option>
                                                        @else
                                                            <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Área Resuelve Proceso:</label>
                                                <select class="form-control select2bs4 select2-blue" name="autoridad_resuelve">
                                                    @foreach($areas as $a)
                                                        @if($proceso[0]->autoridad_resuelve==$a->Are_Codigo)
                                                            <option value="{{$a->Are_Codigo}}" selected>{{$a->Are_Descripcion}}</option>
                                                        @else
                                                            <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Instancia:</label>
                                                <input type="text" class="form-control" name="instancia_consideracion" value="{{$proceso[0]->instancia_consideracion}}">
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                                <label>Presentar Apelación:</label>
                                                <input type="text" class="form-control" name="presenta_apelacion" value="{{$proceso[0]->presenta_apelacion}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                                <a href="{{url('tramitedocumentario/procesos')}}"><input type="button"
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
                            @else
                            {!! Form::open(['url'=>'tramitedocumentario/procesos/registrar','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Área</label>
                                            <select class="form-control select2bs4 select2-blue" name="are_codigo">
                                                @foreach($areas as $a)
                                                    <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Nombre:</label>
                                            <input type="text" class="form-control" name="nombre">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Sub Nombre:</label>
                                            <input type="text" class="form-control" name="sub_nombre">
                                        </div>
                                        <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                            <label>Porcentaje UIT:</label>
                                            <input type="number" class="form-control" name="porcentaje_uit">
                                        </div>
                                        <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                            <label>Precio:</label>
                                            <input type="number" class="form-control" name="soles_uit">
                                        </div>
                                        <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                            <label>Días Plazo:</label>
                                            <input type="number" class="form-control" name="plazo_resolver">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Área Inicia Proceso:</label>
                                            <select class="form-control select2bs4 select2-blue" name="inicia_proceso">
                                                @foreach($areas as $a)
                                                    <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Área Resuelve Proceso:</label>
                                            <select class="form-control select2bs4 select2-blue" name="autoridad_resuelve">
                                                @foreach($areas as $a)
                                                    <option value="{{$a->Are_Codigo}}">{{$a->Are_Descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Instancia:</label>
                                            <input type="text" class="form-control" name="instancia_consideracion">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                            <label>Presentar Apelación:</label>
                                            <input type="text" class="form-control" name="presenta_apelacion">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <a href="{{url('tramitedocumentario/procesos')}}"><input type="button"
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
