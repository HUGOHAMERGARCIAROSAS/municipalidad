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
                        Mantenedor de Plantillas
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
                                <div class="container-fluid card" style="padding: 1%">
                                    {!! Form::open(['url'=>'administracion/plantillas','method'=>'GET']) !!}
                                    {!! Form::token() !!}
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                            Descripción:
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
                                            <a href="{{url('administracion/plantillas/registrar')}}">
                                                <button type="button" class="btn btn-info"><i class="fa fa-user-plus"></i>
                                                    Nuevo
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    @if(isset($query))
                                        <h6>Resultados para busqueda: "{{$query}}"</h6>
                                    @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">Plantillas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card">
                                    @if(isset($plantillas))
                                        <table class="table table-hover text-center" id="tableplantillas">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Plantilla</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Opciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($plantillas as $p)
                                                <tr>
                                                    <td>{{$p->plarol_id}}</td>
                                                    <td>{{$p->plarol_nombre}}</td>
                                                    <td>{{$p->plarol_descripcion}}</td>
                                                    <td>@if($p->plarol_estado==1) <span class="fa fa-check"></span>  @else
                                                            <span class="fa fa-times"></span> @endif</td>
                                                    <td>
                                                        <a href="{{ url('/administracion/plantillas/'.$p->plarol_id) }}"
                                                        title="Editar">
                                                            <button type="button" class="btn btn-default btn-xs"><span
                                                                        class="fa fa-edit"></span></button>
                                                        </a>
                                                        @if($p->plarol_estado==1)
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                    data-toggle="modal" data-target="#modal-default"
                                                                    data-id="{{$p->plarol_id}}"
                                                                    data-nombre="Esta seguro que desea cambiar el estado de la plantilla {{ $p->plarol_nombre }}"
                                                                    data-estado="0"><span class="fa fa-times"
                                                                                        title="Desactivar"></span>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                    data-toggle="modal" data-target="#modal-default"
                                                                    data-id="{{$p->plarol_id}}"
                                                                    data-nombre="Esta seguro que desea cambiar el estado de la plantilla {{ $p->plarol_nombre }}"
                                                                    data-estado="1"><span class="fa fa-check"
                                                                                        title="Activar"></span></button>
                                                        @endif
                                                        <a href="{{ url('/administracion/plantillas/permisos_modulos/'.$p->plarol_id) }}"
                                                        title="Editar">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                    title="Modulos">
                                                                <span class="fa fa-th-list"></span></button>
                                                        </a>
                                                        <a href="{{ url('/administracion/plantillas/permisos/'.$p->plarol_id) }}"
                                                        title="Editar">
                                                            <button type="button" class="btn btn-default btn-xs"
                                                                    title="Permisos">
                                                                <span class="fa fa-clipboard-list"></span></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('administracion.plantillas.modal_plantilla')
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row" style="text-align: center;">
                                            <div class="col-lg-4 col-md-4 col-sm-4"
                                                style="margin-left: auto; margin-right: auto">
                                                {{$plantillas->appends(request()->input())->links()}}
                                            </div>
                                        </div>
                                    @else
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Plantilla</th>
                                                <th>Descripcion</th>
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
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#tableplantillas').DataTable({
            bFilter: false,
            bPaginate: false,
            bInfo: false,
            scrollY: "50vh",
            //scrollX: "100vh",
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            }
        });
    </script>
@endsection
