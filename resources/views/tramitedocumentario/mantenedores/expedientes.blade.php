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
                            {!! Form::open(['url'=>'tramitedocumentario/expedientes','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
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
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <a href="{{url('tramitedocumentario/expediente/registrar')}}"><button type="button" class="btn btn-success btn-sm"><span class="fa fa-file"></span>
                                                Nuevo
                                            </button>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-warning btn-sm"><span class="fa fa-search"></span>
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
                                                @if(isset($expedientes))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Expediente</th>
                                                            <th>Tipo de Trámite</th>
                                                            <th>Remitente</th>
                                                            <th>Asunto</th>
                                                            <th>Fecha y Hora</th>
                                                            <th>Referencia</th>
                                                            <th>Folios</th>
                                                            <th>Descripción</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($expedientes as $e)
                                                            <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                <td style="">{{$e->expediente}}</td>
                                                                <td style="">{{$e->descripcion}}</td>
                                                                <td style="">{{$e->remitente}}</td>
                                                                <td style="">{{$e->asunto}}</td>
                                                                <td style="">{{$e->fecha." ".$e->hora}}</td>
                                                                <td style="">{{$e->referencia}}</td>
                                                                <td style="">{{$e->folios}}</td>
                                                                <td style="">{{$e->descdocumento}}</td>
                                                                <td style="">@if($e->estado==1)
                                                                        <span class="fa fa-check"></span>  @else <span
                                                                                class="fa fa-close"></span> @endif</td>
                                                                <td style="">
                                                                    {!! Form::open(['url'=>'tramitedocumentario/expediente','method'=>'GET','style'=>'display: inline;']) !!}
                                                                    {!! Form::token() !!}
                                                                    <input type="hidden" name="exped"
                                                                           value="{{$e->coddocumento}}">
                                                                    <input type="hidden" name="anio" value="{{$e->anio}}">
                                                                    <button type="submit" class="btn btn-default btn-xs"
                                                                            title="Editar"><span class="fa fa-edit"></span>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                                    @if($e->estado==1)
                                                                        {!! Form::open(['url'=>'tramitedocumentario/expediente/anular','method'=>'post','id'=>"Aexped-".$e->coddocumento."-".$e->anio,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="exped"
                                                                               value="{{$e->coddocumento}}">
                                                                        <input type="hidden" name="anio"
                                                                               value="{{$e->anio}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarAnular('".$e->coddocumento."-".$e->anio."')"}}"
                                                                                class="btn btn-default btn-xs"><span
                                                                                    class="fa fa-times"
                                                                                    title="Anular"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                    <button type="button"
                                                                            onclick="{{"Printt(".$e->coddocumento.",".$e->anio.")"}}"
                                                                            class="btn btn-default btn-xs"
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
                                                            {{$expedientes->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Expediente</th>
                                                            <th>Tipo de Trámite</th>
                                                            <th>Remitente</th>
                                                            <th>Asunto</th>
                                                            <th>Fecha y Hora</th>
                                                            <th>Referencia</th>
                                                            <th>Folios</th>
                                                            <th>Descripción</th>
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
