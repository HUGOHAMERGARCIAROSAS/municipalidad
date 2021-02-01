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
                            {!! Form::open(['url'=>'tramitedocumentario/correlativos','method'=>'GET']) !!}
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
                                            <select class="form-control  form-control-sm select2-blue" name="tipo" id="tipodoc">
                                                <option value="" selected>Seleccionar Tipo de Documento</option>
                                                @foreach($tipodoc as $t)
                                                    <option value="{{$t->valor}}">{{$t->texto}}</option>
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
                                            <button type="reset" class="btn btn-warning btn-sm" ><span class="fa fa-brush"></span>
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
                                                @if(isset($correlativos))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Correlativo</th>
                                                            <th>Área</th>
                                                            <th>Tipo de Documento</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($correlativos as $c)
                                                            <tr style="padding-top: 1px; padding-bottom: 1px; height: 10px;">
                                                                <td>{{$c->numero."-".$c->anio}}</td>
                                                                <td>{{$c->Are_Descripcion}}</td>
                                                                <td>{{$c->tpd_descripcion}}</td>
                                                                <td>@if($c->activo==1) <span
                                                                            class="fa fa-check"></span>  @else <span
                                                                            class="fa fa-close"></span> @endif</td>
                                                                <td>
                                                                    @if($c->activo==1)
                                                                        {!! Form::open(['url'=>'tramitedocumentario/correlativo/anular','method'=>'post','id'=>$c->idcorrelativo,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="correlativo"
                                                                            value="{{$c->idcorrelativo}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarAnular('".$c->idcorrelativo."')"}}"
                                                                                class="btn btn-default"><span
                                                                                    class="fa fa-times"
                                                                                    title="Anular"></span></button>
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
                                                            {{$correlativos->appends(request()->input())->links()}}
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
        function ConfirmarAnular(id) {
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de anular el correlativo?");
            if (opcion == true) {
                form.submit();
            }
        }
    </script>
@endsection
