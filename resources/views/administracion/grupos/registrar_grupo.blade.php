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
                         Registrar Grupo
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header">
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="container-fluid card" style="padding: 1%">
                                    {!! Form::open(['url'=>'/administracion/grupos/registrar','method'=>'post']) !!}
                                    {!! Form::token() !!}
                                    <div class="row">
                                        <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                            <label>Seleccionar Modulo</label>
                                            <select class="form-control  select2-blue" name="modulo">
                                                @foreach($modulos as $m)
                                                    <option value="{{$m->mod_codigo}}">{{$m->mod_descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Grupo</label>
                                            <input type="text" class="form-control" name="grupo"
                                                placeholder="Ingresar grupo">
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Descripcion</label>
                                            <input type="text" class="form-control" name="descripcion"
                                                placeholder="Ingresar descripcion">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Orden</label>
                                            <input type="text" class="form-control" name="orden"
                                                placeholder="Ingresar orden">
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Icono</label>
                                            <input type="text" class="form-control" name="icono"
                                                placeholder="Ingresar icono">
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <a href="{{url('administracion/grupos')}}"><input type="button"
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
    </div>
</div>

@endsection
