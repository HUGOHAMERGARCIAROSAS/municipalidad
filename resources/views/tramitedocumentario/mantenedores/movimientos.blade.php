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
                            {!! Form::open(['url'=>'tramitedocumentario/movimientos','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Expediente:</label>
                                            <input type="text" name="expediente" class="form-control input-sm"
                                                placeholder="Expediente" value="{{old('expediente')}}"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Año:</label>
                                            <input type="text" name="anio" class="form-control input-lg" placeholder="Año"
                                                value="2020"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <label>Interesado:</label>
                                            <input type="text" name="interesado" class="form-control input-sm"
                                                placeholder="Interesado" value="{{old('interesado')}}"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <label>Asunto:</label>
                                            <input type="text" name="asunto" class="form-control input-sm"
                                                placeholder="Asunto" value="{{old('asunto')}}"/>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <label>Estado:</label>
                                            <select name="estado" class="form-control form-control-sm select2bs4 select2-blue">
                                                <option value="" selected>Seleccionar Estado</option>
                                                @foreach($estados as $e)
                                                    <option value="{{$e["valor"]}}"
                                                            @if($e["valor"]==old('estado')) selected @endif >{{$e["texto"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <label>Área:</label>
                                            <select class="form-control form-control-sm select2-blue" name="area" id="area">
                                                <option value="" selected>Seleccionar Área</option>
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
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
                                                @if(isset($movimientos))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Expediente</th>
                                                            <th>Área</th>
                                                            <th>Estado</th>
                                                            <th>Copia</th>
                                                            <th>Observación</th>
                                                            <th>Fecha y Hora</th>
                                                            <th>N° Días</th>
                                                            <th>Folios</th>
                                                            <th>Activo</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($movimientos as $m)
                                                            <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 11px;">
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->expediente}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->are_descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->estadodoc}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->copia}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->observacion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->fecha." ".$m->hora}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->nro_dias}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">{{$m->folios}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">@if($m->estado==1)
                                                                        <span class="fa fa-check"></span>  @else <span
                                                                                class="fa fa-close"></span> @endif</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 11px;">
                                                                    {!! Form::open(['url'=>'tramitedocumentario/expediente','method'=>'GET','style'=>'display: inline;']) !!}
                                                                    {!! Form::token() !!}
                                                                    <input type="hidden" name="exped"
                                                                        value="{{$m->documento_coddocumento}}">
                                                                    <input type="hidden" name="anio"
                                                                        value="{{$m->documento_anio}}">
                                                                    <button type="submit" class="btn btn-default btn-sm"
                                                                            title="Editar"><span class="fa fa-edit"></span>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                                    @if($m->estado==1)
                                                                        {!! Form::open(['url'=>'tramitedocumentario/expediente/anular','method'=>'post','id'=>"Aexped-".$m->documento_coddocumento."-".$m->documento_anio,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="exped"
                                                                            value="{{$m->documento_coddocumento}}">
                                                                        <input type="hidden" name="anio"
                                                                            value="{{$m->documento_anio}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarAnular('".$m->documento_coddocumento."-".$m->documento_anio."')"}}"
                                                                                class="btn btn-default btn-sm"><span
                                                                                    class="fa fa-times"
                                                                                    title="Anular"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                    <button type="button"
                                                                            onclick="{{"Printt(".$m->documento_coddocumento.",".$m->documento_anio.")"}}"
                                                                            class="btn btn-default btn-sm"
                                                                            title="Codigo de Barras"><span
                                                                                class="fa fa-barcode"></span></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-lg-4 col-md-4 col-sm-4"
                                                            style="margin-left: auto; margin-right: auto">
                                                            {{$movimientos->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Expediente</th>
                                                            <th>Área</th>
                                                            <th>Estado</th>
                                                            <th>Copia</th>
                                                            <th>Observación</th>
                                                            <th>Fecha y Hora</th>
                                                            <th>N° Días</th>
                                                            <th>Folios</th>
                                                            <th>Activo</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
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

        function ConfirmarAnular(exped) {
            var id = "Aexped" + exped;
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de anular el expediente?");
            if (opcion == true) {
                form.submit();
            }
        }
    </script>
@endsection
