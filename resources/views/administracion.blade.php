@extends('layout.index3')
@section('content')
   {{-- <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="container-fluid card" style="padding: 1%">
                        {!! Form::open(['url'=>'usuarios','method'=>'GET']) !!}
                        {!! Form::token() !!}
                        <h5>Buscar</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="query" class="form-control input-lg" placeholder="Ingrese un texto para buscar" value="{{old('query')}}"/>
                            </div>
                            {{csrf_field()}}
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>Buscar</button>
                            </div>
                        </div>
                        @if(isset($query))
                            <h6>Resultados para busqueda: "{{$query}}"</h6>
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        @if(isset($usuarios))
                            <table class="table table-hover text-nowrap text-center">
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
                                        <td>{{$p->persona_ID}}</td>
                                        <td>{{$p->nombres.' '.$p->paterno.' '.$p->materno}}</td>
                                        <td>{{$p->per_login}}</td>
                                        <td>@if($p->estado==1) <span class="fa fa-user-check"></span>  @else <span class="fa fa-user-times"></span> @endif</td>
                                        <td>
                                            <a href="" title="Editar"><span class="fa fa-user-edit"></span></a>
                                            <a href="" title="Desactivar"><span class="fa fa-user-alt-slash"></span></a>
                                            <a href="{{'permisos_modulos/'.$p->persona_ID}}" title="Modulos"><span class="fa fa-th-list"></span></a>
                                            <a href="{{'permisos/'.$p->persona_ID}}" title="Permisos"><span class="fa fa-clipboard-list"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                {{$usuarios->appends(request()->input())->links()}}
                            </div>
                            <div class="col-lg-4"></div>
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
    </div>--}}
@endsection