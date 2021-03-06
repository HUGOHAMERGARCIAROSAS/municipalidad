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
                            {!! Form::open(['url'=>'tramitedocumentario/informestrp','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Área:</label>
                                            <select class="form-control form-control-sm select2-blue" name="area" id="area">
                                                <option value="" selected>Seleccionar Área</option>
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Tipo de Documento:</label>
                                            <select class="form-control form-control-sm select2-blue" name="tipo" id="tipodoc">
                                                <option value="" selected>Seleccionar Tipo de Documento</option>
                                                @foreach($tipodoc as $t)
                                                    <option value="{{$t->valor}}">{{$t->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Expediente:</label>
                                            <input type="text" name="expediente" class="form-control form-control-sm"
                                                placeholder="Expediente" value="{{old('expediente')}}"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Año:</label>
                                            <input type="text" name="anio" class="form-control form-control-sm" placeholder="Año"
                                                value="2020"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Desde:</label>
                                            <input type="date" name="finicio" class="form-control form-control-sm ui-datepicker"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Hasta:</label>
                                            <input type="date" name="ffin" class="form-control form-control-sm ui-datepicker"
                                                style="display: inline"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Interesado:</label>
                                            <input type="text" name="interesado" class="form-control form-control-sm"
                                                placeholder="Interesado" value="{{old('interesado')}}"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Asunto:</label>
                                            <input type="text" name="asunto" class="form-control form-control-sm"
                                                placeholder="Asunto"
                                                value="{{old('asunto')}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-success btn-sm"><span class="fa fa-file"></span>
                                                Nuevo
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span>
                                                Limpiar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h3 class="card-title">Resultados de Búsqueda</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="card">
                                                @if(isset($informes))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Número</th>
                                                            <th>Tipo Documento</th>
                                                            <th>Fecha</th>
                                                            <th>Área</th>
                                                            <th>Destino</th>
                                                            <th>Asunto</th>
                                                            <th>Descripcion</th>
                                                            <th>Referencia</th>
                                                            <th>Folios</th>
                                                            <th>Nota</th>
                                                            <th>Estado</th>
                                                            <th>Archivo</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($informes as $i)
                                                            <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->numero."-".$i->anio}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->tpd_descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->fecha}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->are_descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->destinos}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->asunto}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->referencia}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->folios}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->nota}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">@if($i->estado=='P')
                                                                        <span style="color:#F00">Pendiente</span>  @elseif($i->estado=='T')
                                                                        <span style="color:#3CF">Tramite</span> @elseif($i->estado=='A')
                                                                        <span style="color:#3C9">Archivado</span> @elseif($i->estado=='D')
                                                                        <span style="color:#339">Devuelto</span> @endif</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i->nota}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                    <button type="button" class="btn btn-default"
                                                                            title="Descargar"><span
                                                                                class="fa fa-download"></span></button>
                                                                </td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                    @if($i->estado!='P')
                                                                        {!! Form::open(['url'=>'tramitedocumentario/informetrp/archivar','method'=>'GET','style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="id"
                                                                            value="{{$i->idinformetr}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarArchivar('".$e->coddocumento."-".$e->anio."')"}}"
                                                                                class="btn btn-default"><span
                                                                                    class="fa fa-archive"
                                                                                    title="Archivar"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif

                                                                    @if($i->estado!='P')
                                                                        {!! Form::open(['url'=>'tramitedocumentario/informetrp/proveido','method'=>'post','id'=>"Aexped-".$e->coddocumento."-".$e->anio,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="id"
                                                                            value="{{$e->idinformetr}}">
                                                                        <button type="submit" class="btn btn-default"
                                                                                title="Proveido"><span
                                                                                    class="fa fa-edit"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-lg-4 col-md-4 col-sm-4"
                                                            style="margin-left: auto; margin-right: auto">
                                                            {{$informes->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Número</th>
                                                            <th>Tipo Documento</th>
                                                            <th>Fecha</th>
                                                            <th>Área</th>
                                                            <th>Destino</th>
                                                            <th>Asunto</th>
                                                            <th>Descripcion</th>
                                                            <th>Referencia</th>
                                                            <th>Folios</th>
                                                            <th>Nota</th>
                                                            <th>Estado</th>
                                                            <th>Archivo</th>
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
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function Printt(expe, annn) {
            window.open("expedientes/verbarcode?exped=" + expe + "&anio=" + annn, "", "width=350,height=180,menubar=yes,scrollbars=no");
        }

        function ConfirmarArchivar(exped) {
            var id = "Aexped" + exped;
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de archivar el informe?");
            if (opcion == true) {
                form.submit();
            }
        }
    </script>
@endsection
