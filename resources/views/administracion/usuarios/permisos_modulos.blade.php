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
                        Permisos de módulos para usuario {{$usuario['0']->texto}}
                            ({{$usuario['0']->per_login}}
                            )
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header"></div>
        <div class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                {!! Form::open(['url' => 'administracion/usuarios/permisos_modulos/'.$usuario['0']->per_codigo,'method'=>'POST']) !!}
                                {!! Form::token() !!}
                                <div class="card" style="padding: 2%">
                                    <div class="row">
                                        <input type="hidden" value="asd" name="asd">
                                        @foreach($modulos as $m)
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="Modulos[]"
                                                        value="{{$m->mod_codigo}}"
                                                        @foreach($mod_men as $n)
                                                        @if($n->mod_codigo==$m->mod_codigo)
                                                        checked
                                                            @endif
                                                            @endforeach
                                                    >
                                                    <label class="form-check-label">{{$m->mod_descripcion}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
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
</div>
@endsection
