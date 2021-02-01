@extends('layout.index3')
@section('content')
    <div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Mantenedor de Grupos</h3>

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
                                {!! Form::open(['url'=>'administracion/grupos','method'=>'GET']) !!}
                                {!! Form::token() !!}
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        Descripción:
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" name="query" class="form-control input-sm"
                                               placeholder="Ingrese un texto para buscar" value="{{old('query')}}"/>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>
                                            Buscar
                                        </button>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        <a href="{{url('administracion/grupos/registrar')}}">
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
                    <h3 class="card-title">
                        @if(isset($query))
                            Resultados para busqueda: "{{$query}}"
                        @else
                            Grupos
                        @endif
                    </h3>

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
                            <div class="table-responsive">
                                @if(isset($grupos))
                                    <table class="table table-hover text-center" id="tablegrupos">
                                        <thead class="bg-gray">
                                        <tr>
                                            <th>Código</th>
                                            <th>Grupo</th>
                                            <th>Descripción</th>
                                            <th>Módulo</th>
                                            <th>Ícono</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($grupos as $g)
                                            <tr>
                                                <td>{{$g->grupo_id}}</td>
                                                <td>{{$g->gru_nombre}}</td>
                                                <td>{{$g->gru_descripcion}}</td>
                                                <td>{{$g->mod_descripcion}}</td>
                                                <td>{{$g->gru_icono}}</td>
                                                <td>@if($g->gru_activo==1) <span class="fa fa-check"></span>  @else
                                                        <span class="fa fa-times"></span> @endif</td>
                                                <td>
                                                    <a href="{{ url('/administracion/grupos/'.$g->grupo_id) }}"
                                                       title="Editar">
                                                        <button type="button" class="btn btn-default btn-xs"><span
                                                                    class="fa fa-edit"></span></button>
                                                    </a>
                                                    @if($g->gru_activo==1)
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#modal-default"
                                                                data-id="{{$g->grupo_id}}"
                                                                data-nombre="Esta seguro que desea cambiar el estado del grupo {{ $g->gru_nombre }}"
                                                                data-estado="0"><span class="fa fa-times"
                                                                                      title="Desactivar"></span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-default btn-xs"
                                                                data-toggle="modal" data-target="#modal-default"
                                                                data-id="{{$g->grupo_id}}"
                                                                data-nombre="Esta seguro que desea cambiar el estado del grupo {{ $g->gru_nombre }}"
                                                                data-estado="1"><span class="fa fa-check"
                                                                                      title="Activar"></span></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @include('administracion.grupos.modal_grupo')
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row text-center" style="text-align: center;">
                                        <div class="col-lg-4 col-md-4 col-sm-4"
                                             style="margin-left: auto; margin-right: auto">
                                            {{$grupos->appends(request()->input())->links()}}
                                        </div>
                                    </div>
                                @else
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Grupo</th>
                                            <th>Descripcion</th>
                                            <th>Modulo</th>
                                            <th>Icono</th>
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
@section('scripts')
    <script>
        $('#tablegrupos').DataTable({
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

