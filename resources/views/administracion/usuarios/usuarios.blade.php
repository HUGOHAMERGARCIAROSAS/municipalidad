@extends('layout.index3')
@section('content')
    <div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Mantenedor de Usuarios</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="container-fluid card" style="padding: 1%">
                                {!! Form::open(['url'=>'administracion/usuarios','method'=>'GET']) !!}
                                {!! Form::token() !!}
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        Apellidos y Nombres:
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="query" class="form-control input-lg"
                                               placeholder="Ingrese un texto para buscar" value="{{old('query')}}"/>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>
                                            Buscar
                                        </button>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        <a href="{{url('administracion/usuarios/registrar')}}">
                                            <button type="button" class="btn btn-info"><i class="fa fa-user-plus"></i>
                                                Nuevo
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Usuarios @if(isset($query))para búsqueda: "{{$query}}"@endif</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                @if(isset($usuarios))
                                    <table class="table table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombres</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($usuarios as $p)
                                            <tr>
                                                <td>{{$p->per_codigo}}</td>
                                                <td>{{$p->texto}}</td>
                                                <td>{{$p->per_login}}</td>
                                                <td>@if($p->estado==1) <span class="fa fa-user-check"></span>  @else
                                                        <span class="fa fa-user-times"></span> @endif</td>
                                                <td>
                                                    <a href="{{ url('/administracion/usuarios/'.$p->per_codigo) }}"
                                                       title="Editar">
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                title="Editar">
                                                            <span class="fa fa-user-edit"></span></button>
                                                    </a>
                                                    @if($p->estado==1)
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#modal-default"
                                                                data-id="{{$p->per_codigo}}"
                                                                data-nombre="Esta seguro que desea cambiar el estado del usuario {{ $p->per_login }}"
                                                                data-estado="0"><span class="fa fa fa-user-times"
                                                                                      title="Desactivar"></span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#modal-default"
                                                                data-id="{{$p->per_codigo}}"
                                                                data-nombre="Esta seguro que desea cambiar el estado del usuario {{ $p->per_login }}"
                                                                data-estado="1"><span class="fa fa-user-check"
                                                                                      title="Activar"></span></button>
                                                    @endif
                                                    <a href="{{ url('/administracion/usuarios/permisos_modulos/'.$p->per_codigo) }}"
                                                       title="Editar">
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                title="Modulos">
                                                            <span class="fa fa-th-list"></span></button>
                                                    </a>
                                                    <a href="{{ url('/administracion/usuarios/permisos/'.$p->per_codigo) }}"
                                                       title="Editar">
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                title="Permisos">
                                                            <span class="fa fa-clipboard-list"></span></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('administracion.usuarios.modal_usuario')
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row" style="text-align: center;">
                                        <div class="col-lg-4 col-md-4 col-sm-4"
                                             style="margin-left: auto; margin-right: auto">
                                            {{$usuarios->appends(request()->input())->links()}}
                                        </div>
                                    </div>
                                @else
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombres</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection