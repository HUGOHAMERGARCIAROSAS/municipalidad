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
                            {!! Form::open(['url'=>'tramitedocumentario/rexpderfecha','method'=>'post']) !!}
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
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Desde:</label>
                                            <input type="date" name="finicio" class="form-control form-control-sm ui-datepicker"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <label>Hasta:</label>
                                            <input type="date" name="ffin" class="form-control form-control-sm ui-datepicker"
                                                style="display: inline"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span>
                                                Limpiar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-default btn-sm"><span class="fa fa-print"></span>
                                                Imprimir
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
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Expediente</th>
                                                            <th>Interesado</th>
                                                            <th>Asunto</th>
                                                            <th>Referencia</th>
                                                            <th>Fecha</th>
                                                            <th>Folios</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($k=1)
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td>{{$k}}</td>
                                                                <td>{{$i->documento_coddocumento."-".$i->documento_anio}}</td>
                                                                <td style="overflow-wrap: break-word;">{{$i->remitente}}</td>
                                                                <td style="overflow-wrap: break-word;">{{$i->asunto}}</td>
                                                                <td>{{$i->areaderiva}}</td>
                                                                <td>{{$i->fecha}} {{$i->hora}}</td>
                                                                <td>{{$i->folios}}</td>
                                                            </tr>
                                                            @php($k++)
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Expediente</th>
                                                            <th>Interesado</th>
                                                            <th>Asunto</th>
                                                            <th>Área</th>
                                                            <th>Fecha y Hora</th>
                                                            <th>Folios</th>
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
