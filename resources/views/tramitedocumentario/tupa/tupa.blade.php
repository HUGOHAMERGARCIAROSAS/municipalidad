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
                            {!! Form::open(['url'=>'tramitedocumentario/procesos','method'=>'POST']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-0 col-md-0 col-sm-0">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <input type="text" name="nombre" class="form-control input-lg"
                                                placeholder="Nombre" value="{{old('nombre')}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <a href="{{url("tramitedocumentario/procesos/registrar")}}">
                                                <button type="button" class="btn btn-success"><span class="fa fa-file"></span>
                                                    Nuevo
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="reset" class="btn btn-warning"><span class="fa fa-brush"></span>
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
                                                @if(isset($tupas))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Nro</th>
                                                            <th>Área</th>
                                                            <th>Nombre</th>
                                                            <th>Detalle</th>
                                                            <th>% UIT</th>
                                                            <th>S/</th>
                                                            <th>Plazo Resolver</th>
                                                            <th>Inicia</th>
                                                            <th>Resuelve</th>
                                                            <th>Instancia que Considera</th>
                                                            <th>Apelación</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($i=1)
                                                        @foreach($tupas as $t)
                                                            <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$i}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->Are_Descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->nombre}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->sub_nombre}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->porcentaje_uit}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->soles_uit}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->plazo_resolver}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->inicio_procedimiento}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->autoridad_resuelve}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->instancia_consideracion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$t->presenta_apelacion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">@if($t->estado==1)
                                                                        <span class="fa fa-check"></span>  @else <span
                                                                                class="fa fa-times"></span> @endif</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px; width: 80px;">
                                                                    {!! Form::open(['url'=>'tramitedocumentario/proceso','method'=>'GET','style'=>'display: inline;']) !!}
                                                                    {!! Form::token() !!}
                                                                    <input type="hidden" name="proceso"
                                                                        value="{{$t->proceso_id}}">
                                                                    <button type="submit" class="btn btn-default btn-sm"
                                                                            title="Editar"><span class="fa fa-edit"></span>
                                                                    </button>
                                                                    {!! Form::close() !!}
                                                                    @if($t->estado==1)
                                                                        {!! Form::open(['url'=>'tramitedocumentario/proceso/anular','method'=>'post','id'=>"AnulaProceso-".$t->proceso_id,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="proceso"
                                                                            value="{{$t->proceso_id}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarAnular('".$t->proceso_id."')"}}"
                                                                                class="btn btn-default btn-sm"><span
                                                                                    class="fa fa-times"
                                                                                    title="Anular"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @else
                                                                        {!! Form::open(['url'=>'tramitedocumentario/proceso/activar','method'=>'post','id'=>"ActivaProceso-".$t->proceso_id,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="proceso"
                                                                            value="{{$t->proceso_id}}">
                                                                        <button type="button"
                                                                                onclick="{{"ConfirmarActivar('".$t->proceso_id."')"}}"
                                                                                class="btn btn-default btn-sm"><span
                                                                                    class="fa fa-check"
                                                                                    title="Activar"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @php($i++)
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-lg-4 col-md-4 col-sm-4"
                                                            style="margin-left: auto; margin-right: auto">
                                                            {{$tupas->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-nowrap">
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
        function ConfirmarAnular(exped) {
            var id = "AnulaProceso-" + exped;
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de anular el proceso?");
            if (opcion == true) {
                form.submit();
            }
        }
        function ConfirmarActivar(exped) {
            var id = "ActivaProceso-" + exped;
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de activar el proceso?");
            if (opcion == true) {
                form.submit();
            }
        }
    </script>
@endsection
