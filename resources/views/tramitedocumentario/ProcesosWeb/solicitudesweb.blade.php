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
                            {!! Form::open(['url'=>'tramitedocumentario/solicitudes','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                            <div class="row" style="padding-bottom: 0.5%">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <label>Dni:</label>
                                    <input type="text" name="dni" class="form-control form-control-sm" placeholder="DNI" value="{{old('dni')}}"/>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <label>Apellidos:</label>
                                    <input type="text" name="apellidos" class="form-control form-control-sm" placeholder="Apellidos"/>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                    <label>Desde:</label>
                                    <input type="date" name="finicio" class="form-control form-control-sm ui-datepicker"/>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <label>Hasta:</label>
                                    <input type="date" name="ffin" class="form-control form-control-sm ui-datepicker"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Tipo de Trámite:</label>
                                    <select class="form-control form-control-sm select2-blue" name="tipo" id="modulo1">
                                        <option value="" selected>Seleccionar Tipo</option>
                                        @foreach($tipos as $t)
                                            <option value="{{$t->valor}}">{{$t->texto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span> Buscar</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                    <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span> Limpiar</button>
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
                                                @if(isset($solicitudes))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Codigo</th>
                                                            <th>DNI</th>
                                                            <th>Solicitante</th>
                                                            <th>Correo</th>
                                                            <th>Celular</th>
                                                            <th style="word-wrap: break-word;">Asunto</th>
                                                            <th>Tipo Trámite</th>
                                                            <th>Fecha</th>
                                                            <th>Cant. Adjuntos</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($solicitudes as $i)
                                                            <tr style="font-size: 13px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                <td>{{$i->id}}</td>
                                                                <td>{{$i->dni}}</td>
                                                                <td>{{$i->solicitante}}</td>
                                                                <td>{{$i->correo}}</td>
                                                                <td>{{$i->celular}}</td>
                                                                <td>{{$i->asunto}}</td>
                                                                <td>{{$i->tipo}}</td>
                                                                <td>{{$i->fecha}}</td>
                                                                <td>{{$i->adjuntos}}</td>
                                                                <td>
                                                                    @include('tramitedocumentario.ProcesosWeb.veradjuntossolweb')
                                                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-veradjuntos-".$i->id}}" title="Ver Adjuntos" onclick="cargarAdjuntos({{$i->id}})"><span class="fa fa-search"></span></button>
                                                                    @switch($i->estado)
                                                                        @case(0)
                                                                        @include('tramitedocumentario.ProcesosWeb.agregarAdjuntosSolicitudes')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-addadjuntos-".$i->id}}" title="Agregar Adjuntos"><span class="fa fa-plus-circle"></span></button>
                                                                        @include('tramitedocumentario.ProcesosWeb.anularSolicitudWeb')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-anular-".$i->id}}" title="Anular Solicitud"><span class="fa fa-times"></span></button>
                                                                        {!! Form::open(['url'=>'tramitedocumentario/solicitudes/verificar','id'=>"DSol-".$i->id,'method'=>'post','style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="id" value="{{$i->id}}">
                                                                        <button type="submit" onclick="return ConfirmarVerificar({{$i->id}})" class="btn btn-default btn-sm" title="Verificar"><span class="fa fa-check"></span></button>
                                                                        {!! Form::close() !!}
                                                                        @include('tramitedocumentario.mantenedores.derivarSolicitudWeb')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-derivar-".$i->id}}" title="Derivar"><span class="fa fa-arrow-right"></span></button>
                                                                        @include('tramitedocumentario.ProcesosWeb.movimientosSolicitudesWeb')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-movimientos-".$i->id}}"  onclick="movimientos({{$i->id}});"title="Movimientos"><span class="fa fa-list-ol"></span></button>
                                                                        @break
                                                                        @case(2)
                                                                        @include('tramitedocumentario.ProcesosWeb.movimientosSolicitudesWeb')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-movimientos-".$i->id}}" onclick="movimientos({{$i->id}});" title="Movimientos"><span class="fa fa-list-ol"></span></button>
                                                                        <button type="button" class="btn btn-default btn-sm" title="Derivado a: {{$i->deriva}}"><span class="fa fa-info"></span></button>
                                                                        @break
                                                                        @case(3)
                                                                        @include('tramitedocumentario.ProcesosWeb.movimientosSolicitudesWeb')
                                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="{{"#modal-movimientos-".$i->id}}" onclick="movimientos({{$i->id}});" title="Movimientos"><span class="fa fa-list-ol"></span></button>
                                                                        <button type="button" class="btn btn-default btn-sm" title="Anulado por motivo: {{$i->motivo}}"><span class="fa fa-info"></span></button>
                                                                        @break
                                                                    @endswitch
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-lg-4 col-md-4 col-sm-4" style="margin-left: auto; margin-right: auto">
                                                            {{$solicitudes->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>DNI</th>
                                                            <th>Solicitante</th>
                                                            <th>Correo</th>
                                                            <th>Celular</th>
                                                            <th style="word-wrap: break-word;">Asunto</th>
                                                            <th>Tipo Trámite</th>
                                                            <th>Fecha</th>
                                                            <th>Cant. Adjuntos</th>
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
        function ConfirmarVerificar(sol){
            var id="DSol"+sol;
            console.log(id);
            form=document.getElementById(id);
            if (confirm("¿Está seguro de verificar la solicitud web?")) {
                form.submit();
            }else{
                return false;
            }
        }

        function cargarAdjuntos(sol){
            $.ajax({
                url:'solicitudes/adjuntos',
                data:{'id':sol},
                type:'get',
                success: function (response) {
                    document.getElementById("body-adjuntos-"+sol).innerHTML=response;
                },
                statusCode: {
                    404: function() {
                        console.log('web not found');
                    }
                },
                error:function(x,xs,xt){
                    //nos dara el error si es que hay alguno
                    //window.open(JSON.stringify(x));
                    console.log(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

        function movimientos(sol){
            idb="cuerpoMovimientos-"+sol;
            document.getElementById(idb).innerHTML="";
            $.ajax({
                url:'solicitudes/movimientos',
                data:{'id':sol},
                type:'get',
                success: function (response) {
                    console.log(response);

                    document.getElementById(idb).innerHTML=response;
                },
                statusCode: {
                    404: function() {
                        console.log('web not found');
                    }
                },
                error:function(x,xs,xt){
                    //nos dara el error si es que hay alguno
                    //window.open(JSON.stringify(x));
                    console.log(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }
    </script>
@endsection
